<?php
class Engine{
	public $sql;
	public $session;
	public $phpmailer;
	public $prefix = WEB_DB_PREFIX;
	
	function  __construct() {
	    global $sql,$session,$phpmailer,$mongo;
		$this->session= $session;
		$this->sql = $sql;
		$this->mongo = $mongo;
		$this->phpmailer = $phpmailer;
	}
	
	public function concatmoney($num){
		if($num>1000000000000) {
			return round(($num/1000000000000),1).' tri';
		}else if($num>1000000000){ return round(($num/1000000000),1).' bil';
		}else if($num>1000000) {return round(($num/1000000),1).' mil';
		}else if($num>1000){ return round(($num/1000),1).' k';
		}
		return number_format($num);
	}// end of money abreviation function 
	
	
	// Generate API Key
	public function generateApiKey() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
	}

	### Generate Sequential Codes 
	public function generateCode(String $table,String $prefix,String $base_col){
		global $sql;
		$no_prec = 10;#Maximum number of preceding Zeros;
		$stmt = $sql->Execute($sql->Prepare("SELECT $base_col FROM  $table ORDER BY RIGHT ($base_col,$no_prec) DESC LIMIT 1"));
		print $sql->ErrorMsg();
		if($stmt->RecordCount() > 0){
			$obj = $stmt->FetchNextObject();
			$rawcount = substr($obj->$base_col,strlen($prefix),100);
			$rawcount = $rawcount + 1;
			$multiplier = $no_prec - strlen($rawcount);
			$multiplier = $multiplier <=0 ? 0 : $multiplier ;
			$code = str_repeat("0",$multiplier) . $rawcount;
		}else{
			$code = str_repeat("0",$no_prec-1) . 1;
		}
	
		return $prefix.$code;
	}

	### Generate Account Number
	public function generateAccountNumber(String $table,String $prefix,String $base_col){
		global $sql;
		$no_prec = 4;#Maximum number of preceding Zeros;
		$stmt = $sql->Execute($sql->Prepare("SELECT $base_col FROM  $table ORDER BY RIGHT ($base_col,$no_prec) DESC LIMIT 1"));
		print $sql->ErrorMsg();
		if($stmt->RecordCount() > 0){
			$obj = $stmt->FetchNextObject();
			$rawcount = substr($obj->$base_col,strlen($prefix),100);
			$rawcount = $rawcount + 1;
			$multiplier = $no_prec - strlen($rawcount);
			$multiplier = $multiplier <=0 ? 0 : $multiplier ;
			$code = str_repeat("0",$multiplier) . $rawcount;
		}else{
			$code = str_repeat("0",$no_prec) . 1;
		}
	
		return $bankcode.date('dmy').$code;
	}
	
	function slugGenerator($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	
	public function savenotification($userid,$message,$type){
		global $sql;
		$notifydate = date('Y-m-d H:i:s');
		$notifycode = $this->generateCode('nct_notifications','NFY','NOTE_CODE');
		$stmt = $sql->Execute($sql->Prepare("INSERT INTO ".$this->prefix."notifications (NOTE_CODE,NOTE_USERID,NOTE_MESSAGE,NOTE_TYPE,NOTE_DATEADDED) VALUES(".$sql->Param('a').",".$sql->Param('b').",".$sql->Param('c').",".$sql->Param('d').",".$sql->Param('e').") "),[$notifycode,$userid,$message,$type,$notifydate]);
		print $sql->ErrorMsg();
		if($stmt==true){
			$notify = array('code'=>$notifycode,'status'=>'done');
		}else{
			$notify = array('code'=>'null','status'=>'done');
		}
		return $notify ;
	}

	//Event log
    public function setEventLog($event_type,$activity){
		$actor_id = $this->session->get("userid");
		$companycode = $this->session->get("companycode");
        $fullname = $this->session->get('userfullname');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $useragent = empty($_SERVER['HTTP_USER_AGENT'])? '': $_SERVER['HTTP_USER_AGENT'] ;
        $sessionid = $this->session->getSessionID();

        $stmt = $this->sql->Prepare("INSERT INTO ".$this->prefix."eventlog (EVL_EVTCODE,EVL_USERID,EVL_FULLNAME,EVL_ACTIVITIES,EVL_SESSION_ID,EVL_BROWSER,EVL_COMPCODE) VALUES (".$this->sql->Param('1').",".$this->sql->Param('2').",".$this->sql->Param('3').",".$this->sql->Param('4').",".$this->sql->Param('5').",".$this->sql->Param('6').",".$this->sql->Param('7').")");
        $stmt = $this->sql->Execute($stmt,array($event_type,$actor_id,$fullname,$activity,$sessionid,$useragent,$companycode));
        print $this->sql->ErrorMsg();
    }//end
	
	//Validate Posted Form
	public function validatePostForm($microtime){
		$postkey = $this->session->get('postkey');
		if(empty($postkey)){
			$postkey = 2;
		}
		if($postkey != $microtime){
			if($postkey == 2){
				$this->session->set('postkey',$microtime);
			}else{
				$this->session->del('postkey');
				$this->session->set('postkey',$microtime);
			}
			return true;
		}else{
			return false;
		}
   } 
   
   // Bootstrap Alerts
   public function msg($error_code='0',$msg_text=''){
		if(!empty($msg_text)){
			switch($error_code){
				case "error":
					$point = "alert-danger";
					break;
				case "success":
					$point = "alert-success";
					break;
				case "warning":
					$point = "alert-warning";
					break;
				case "info":
					$point = "alert-info";
					break;
				case "dark":
					$point = "alert-dark";
					break;
				default:
					$point = "alert-light";
					break;
			}
			echo '<div class="alert '. $point.'" alert-dismissble fade show role="alert">' . $msg_text . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span> </button></div>';
		}
		return '';
	}

	## Fetch all countries in the world
	public function countries(){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT CNT_CODE,CNT_NAME FROM ".$this->prefix."countries WHERE CNT_STATUS='1'"));
		print $sql->ErrorMsg();
		if($stmt && $stmt->RecordCount() > 0){
			$countries = $stmt->GetAll();
		}else{
			$countries = [];
		}
		return $countries;
	}

	## Fetch all regions in Ghana
	public function regions(){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT REG_CODE,REG_NAME,REG_CAPITAL FROM ".$this->prefix."regions WHERE REG_STATUS='1'"));
		print $sql->ErrorMsg();
		if($stmt && $stmt->RecordCount() > 0){
			$regions = $stmt->GetAll();
		}else{
			$regions = [];
		}
		return $regions;
	}
   
}
