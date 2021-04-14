<?php 
  namespace managecompany;
  class delete extends \setup { 
    function __construct(){
      parent::__construct(); 
    }
    function Init(){
      global $views;
      $sql = $this->sql;
      $engine = $this->engine;
      if($this->engine->validatePostForm($this->microtime)){  
        if($this->keys){
          $stmt = $sql->Execute($sql->Prepare("UPDATE ".$this->prefix."companies SET COMP_STATUS=".$sql->Param('a')." WHERE COMP_CODE=".$sql->Param('g')." "),['0',$this->keys]);

          if($stmt == true){
            $this->engine->msg('success','Deleted successfully');
          }else{
            $this->engine->msg('error',$sql->errorMsg());
          }
        }else{
          $this->engine->msg('info','Error deleting data');
        }
      }
    }
  } 
?>