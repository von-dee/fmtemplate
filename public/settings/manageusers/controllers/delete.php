<?php 
  namespace manageusers;
  class delete extends \setup { 
    function __construct(){
      parent::__construct();
    }
    function Init(){
      $sql = $this->sql;
      if($this->engine->validatePostForm($this->microtime)){  
        $stmt = $sql->Execute("UPDATE ".$this->prefix."users SET USR_STATUS=".$sql->Param('a')." WHERE USR_CODE= ".$sql->Param('b')." ",['0', $this->keys]);
        print $sql->ErrorMsg();

        if($stmt){
          $this->engine->msg('success','System user deleted successfully.');
        }else{
          $this->engine->msg('error','Error deleting user.');
        }
      }
    }
  } 
?>