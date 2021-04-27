<?php 
  namespace managebranches;
    class add extends \setup { 
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        $sql = $this->sql;
        if($this->engine->validatePostForm($this->microtime)){  
          $dateadded = date('Y-m-d H:i:s');
          $actor = array('id'=>$this->userid,'name'=>$this->fullname);
          $compbranchcode = $this->engine->generateCode($this->prefix.'branches','BRC','BRA_CODE');
          $writtenby = json_encode($actor);
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
          $stmt = $sql->Execute($sql->Prepare("INSERT INTO {$this->prefix}branches (BRA_CODE,BRA_NAME,BRA_PHONE,BRA_EMAIL,BRA_RES_ADDRESS,BRA_POST_ADDRESS,BRA_COUNTRY,BRA_REGION,BRA_CITY,BRA_STATUS,BRA_ROOT,BRA_DATE_ADDED,BRA_COMP_CODE,BRA_ACTOR,BRA_SINCE,BRA_SEATS,BRA_SERVICES) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"),[$compbranchcode,$this->compname,$this->compphone,$this->compemail,$this->compraddress,$this->comppaddress,$this->compcountry,$this->compregion,$this->compcity,$this->compstatus,'1',$dateadded,$this->companycode,$writtenby,$this->compsince,$this->compseats,$compservices]);

          if($stmt == true){
              $this->engine->msg('success','Saved successfully');
            }else{
              $this->engine->msg('error',$sql->errorMsg());
              $view ='add'; $keys= $this->keys; $viewpage="edit";
          }
        return true;
        }
      }
    } 
  ?>