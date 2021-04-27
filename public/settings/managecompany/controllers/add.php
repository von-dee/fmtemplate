<?php 
  namespace managecompany;
    class add extends \setup { 
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        global $views;
        $sql = $this->sql;
        $engine = $this->engine;
        $actor = array('id'=>$this->userid,'name'=>$this->fullname);
        //if($this->engine->validatePostForm($this->microtime)){  
          if(!empty($this->compname) && !empty($this->compphone)){
            $import = new \Import;
            if (!empty($_FILES['compimage']['name'])){
                $brandimage = $import->uploadImage($_FILES['compimage'],WEB_UPLOADS);
                //--> new image
            }else {
                $brandimage ='';
                //--> old image
            }
            $walletcode = 'not applicable';
            $writen_by = json_encode($actor);
            $date_added = date('Y-m-d H:i:s');
            $companycode = $engine->generateCode($this->prefix.'companies','CMP','COMP_CODE');
            $stmt = $sql->Execute($sql->Prepare("INSERT INTO ".$this->prefix."companies (COMP_CODE,COMP_ALIAS,COMP_NAME,COMP_RES_ADDRESS,COMP_POST_ADDRESS,COMP_EMAIL,COMP_PHONE,COMP_TIN_NUMBER,COMP_COUNTRY,COMP_WALLET_CODE,COMP_BRAND,COMP_ACTOR,COMP_DATE_ADDED,COMP_STATUS) VALUES (".$sql->Param('a').",".$sql->Param('b').",".$sql->Param('c').",".$sql->Param('d').",".$sql->Param('e').",".$sql->Param('f').",".$sql->Param('g').",".$sql->Param('h').",".$sql->Param('i').",".$sql->Param('j').",".$sql->Param('k').",".$sql->Param('l').",".$sql->Param('m').",".$sql->Param('n').")"),[$companycode,$this->compalias,$this->compname,$this->compraddress,$this->comppaddress,$this->compemail,$this->compphone,$this->comptin,$this->compcountry,$walletcode,$brandimage,$writen_by,$date_added,$this->compstatus]);
            print $sql->errorMsg();

            $branchname = "Main Branch";
            $branchcode = $engine->generateCode($this->prefix.'branches','BRC','BRA_CODE');
            $stmtbr = $sql->Execute($sql->Prepare("INSERT INTO ".$this->prefix."branches (BRA_CODE,BRA_COMP_CODE,BRA_NAME,BRA_RES_ADDRESS,BRA_POST_ADDRESS,BRA_EMAIL,BRA_PHONE,BRA_TIN_NUMBER,BRA_COUNTRY,BRA_ACTOR,BRA_ROOT,BRA_DATE_ADDED,BRA_STATUS) VALUES (".$sql->Param('a').",".$sql->Param('b').",".$sql->Param('c').",".$sql->Param('d').",".$sql->Param('e').",".$sql->Param('f').",".$sql->Param('g').",".$sql->Param('h').",".$sql->Param('i').",".$sql->Param('j').",".$sql->Param('k').",".$sql->Param('l').",".$sql->Param('m').")"),[$branchcode,$companycode,$branchname,$this->compraddress,$this->comppaddress,$this->compemail,$this->compphone,$this->comptin,$this->compcountry,$writen_by,'2',$date_added,$this->compstatus]);
            print $sql->errorMsg();

            if($stmt && $stmtbr){
                $this->engine->msg('success','Saved successfully');
            }else{
                $this->engine->msg('error',$sql->errorMsg());
                $views='add';
            }
        }else{
            $this->engine->msg('info','Please fill all required fields and try again');
            $views='add';
        }
      //}
    } 
  }
?>

