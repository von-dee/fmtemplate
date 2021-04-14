<?php 
  namespace managecompany;
    class update extends \setup { 
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        global $views;
        $sql = $this->sql;
        $keys = $this->keys;
        $engine = $this->engine;
        if(!empty($this->compname) && !empty($this->compphone)){
          $import = new \Import;
          if (!empty($_FILES['compimage']['name'])){
              $brandimage = $import->uploadImage($_FILES['compimage'],WEB_UPLOADS);
              //--> new image
          }else {
              $brandimage = $this->oldphoto;
              //--> old image
          }
            
          $stmt = $sql->Execute($sql->Prepare("UPDATE ".$this->prefix."companies SET COMP_ALIAS=".$sql->Param('a').",COMP_NAME=".$sql->Param('b').",COMP_RES_ADDRESS=".$sql->Param('c').",COMP_POST_ADDRESS=".$sql->Param('d').",COMP_EMAIL=".$sql->Param('e').",COMP_PHONE=".$sql->Param('f').",COMP_TIN_NUMBER=".$sql->Param('g').",COMP_COUNTRY=".$sql->Param('h').",COMP_BRAND=".$sql->Param('i').",COMP_STATUS=".$sql->Param('j')." WHERE COMP_CODE=".$sql->Param('k').""),[$this->compalias,$this->compname,$this->compraddress,$this->comppaddress,$this->compemail,$this->compphone,$this->comptin,$this->compcountry,$brandimage,$this->compstatus,$keys]);

          $stmtbr = $sql->Execute($sql->Prepare("UPDATE ".$this->prefix."branches SET BRA_RES_ADDRESS=".$sql->Param('a').",BRA_POST_ADDRESS=".$sql->Param('b').",BRA_EMAIL=".$sql->Param('c').",BRA_PHONE=".$sql->Param('d').",BRA_TIN_NUMBER=".$sql->Param('e').",BRA_COUNTRY=".$sql->Param('f').",BRA_STATUS=".$sql->Param('g')." WHERE BRA_COMP_CODE=".$sql->Param('h')." AND BRA_ROOT=".$sql->Param('i')." "),[$this->compraddress,$this->comppaddress,$this->compemail,$this->compphone,$this->comptin,$this->compcountry,$this->compstatus,$keys,'2']);

          if($stmt && $stmtbr){
            $this->engine->msg('success','Updated successfully');
          }else{
            $this->engine->msg('error',$sql->errorMsg());
            $view ='add';
          }
        }else{
            $this->engine->msg('info','Please fill all required fields and try again');
            $view ='add';
        }
      }
    } 
?>

  