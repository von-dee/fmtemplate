<?php 
  namespace managebranches;
    class update extends \setup { 
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        $sql = $this->sql;
        $engine = $this->engine;
        if($this->keys){
          $serviceArr = $_POST['comp_services'];
          if($serviceArr){
              foreach ($serviceArr as $key => $serve) {
                $arr = \explode(',',$serve);
                $objArray[] = array("code"=>$arr[0], "name"=>$arr[1]);
              }
            $compservices =  json_encode($objArray);
          }else{
            $compservices = '[]';
          }
          $stmt = $sql->Execute($sql->Prepare("UPDATE {$this->prefix}branches SET BRA_NAME=".$sql->Param('1').",BRA_PHONE=".$sql->Param('2').",BRA_EMAIL=".$sql->Param('3').",BRA_RES_ADDRESS=".$sql->Param('4').",BRA_POST_ADDRESS=".$sql->Param('5').",BRA_COUNTRY=".$sql->Param('6').",BRA_REGION=".$sql->Param('7').",BRA_CITY=".$sql->Param('8').",BRA_STATUS=".$sql->Param('9').",BRA_SINCE=".$sql->Param('10').",BRA_SEATS=".$sql->Param('11').",BRA_SERVICES=".$sql->Param('12')." WHERE BRA_CODE=".$sql->Param('10')." "),[$this->compname,$this->compphone,$this->compemail,$this->compraddress,$this->comppaddress,$this->compcountry,$this->compregion,$this->compcity,$this->compstatus,$this->compsince,$this->compseats,$compservices,$this->keys]);

          if($stmt == true){
              $this->engine->msg('success','Updated successfully');
            }else{
              $this->engine->msg('error',$sql->errorMsg());
              $view ='add'; $keys= $this->keys; $viewpage="edit";
          }
        }
      }
    } 
  ?>