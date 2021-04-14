<?php 
  namespace managebranches;
    class edit extends \setup { 
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        $sql = $this->sql;
        $engine = $this->engine;
        if($this->keys){
          $stmt = $sql->Execute($sql->Prepare("SELECT * FROM {$this->prefix}branches WHERE BRA_CODE = ".$sql->Param('a')." "),array($this->keys));
          $response = $stmt->FetchRow();
         
        }else{
          $this->engine->msg('info','Error fetching this page...try again');
          $response = [];
        }
        return $response;
      }
  } ?>