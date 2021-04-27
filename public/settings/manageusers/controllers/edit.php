<?php 
  namespace manageusers;
    class edit extends \setup { 
      function __construct(){
        parent::__construct();
      }
      function Init(){
        $sql = $this->sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT USR_CODE, USR_FIRSTNAME, USR_OTHERNAME, USR_EMAIL, USR_PHONE, USR_GENDER, USR_USERNAME, USR_STATUS, USR_ABOUT_USER, USR_COUNTRY, USR_ACCESS_LEVEL, USR_PHOTO FROM 
        ".$this->prefix."users WHERE USR_STATUS='1' AND USR_CODE = ".$sql->Param('a')." "),[$this->keys]);
        if($stmt && $stmt->RecordCount() > 0){
          $payload = $stmt->FetchRow();
        }else{
          $payload = [];
        }
        return $payload;
      }
  } ?>