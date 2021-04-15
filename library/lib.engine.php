<?php
class Engine{
	public $sql;
	public $session;
	public $phpmailer;
	
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
	
	public function generateNameforClientPhoto($clientname){
        $rand_numb = md5(uniqid(microtime()));
        $neu_name = $rand_numb.$clientname;
        return $neu_name;
	}
	
	// Generate API Key
	public function generateApiKey(){
		$length = '64';
		$token = bin2hex(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,$length));
		return $token;
	}

	// Generate Sequential Codes
	public function generateCode(String $collection,String $prefix,String $base_col){
		$no_prec = 10;#Maximum number of preceding Zeros;
		$filter = [];
		$options = ['projection'=>[$base_col=>1],'sort'=>[$base_col=> -1],'limit'=>1];
		$obj = $this->mongo->GetOne($collection, $filter, $options);
		print $this->mongo->ErrorMsg();
		if($obj){
			$rawcount = substr($obj->$base_col,strlen($prefix),100);
			$rawcount = $rawcount + 1;
			$multiplier = $no_prec - strlen($rawcount);
			$multiplier = $multiplier <=0 ? 0 : $multiplier ;
			$code = str_repeat("0",$multiplier). $rawcount;
		}else{
			$code = str_repeat("0",$no_prec - 1) . 1;
		}
		return $prefix.$code;
	}

	public function generate_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
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
	
	public function saveNotification($userid,$message,$type){
		$notifydate = date('Y-m-d H:i:s');
		$notifycode = generateCode('app_notifications','NFY','NOTE_CODE');
		$document = ['NOTE_CODE' => $notifycode,'NOTE_USERID'=>$userid,'NOTE_MESSAGE'=>$message,'NOTE_TYPE'=>$type,'NOTE_DATEADDED'=>$notifydate];
		$collection = "app_notify";
		$stmt = $this->mongo->InsertOne($collection, $document);
	

		print $mongo->ErrorMsg();
		if($stmt==true){
			$notify = array('code'=>$notifycode,'status'=>'done');
		}else{
			$notify = array('code'=>'null','status'=>'done');
		}
		return $notify ;
	}
	
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
	echo '<div class="alert '. $point.'" role="alert">' . $msg_text . '</div>';
	}
	return '';
   }
   
}
