<?php 
  namespace managecompany;
    class edit extends \setup { 
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        $sql = $this->sql;
        $engine = $this->engine;
        if($this->keys){
          $stmt = $sql->Execute($sql->Prepare("SELECT COMP_CODE,COMP_ALIAS,COMP_NAME,COMP_RES_ADDRESS,COMP_POST_ADDRESS,COMP_EMAIL,COMP_PHONE,COMP_TIN_NUMBER,COMP_COUNTRY,COMP_BRAND,COMP_STATUS FROM ".$this->prefix."companies WHERE COMP_CODE = ".$sql->Param('a')." "),array($this->keys));
          $response = $stmt->FetchRow();
         
        }else{
          $this->engine->msg('info','Error fetching this page...try again');
          $response = [];
        }
        return $response;
      }
    } 
  ?>

  