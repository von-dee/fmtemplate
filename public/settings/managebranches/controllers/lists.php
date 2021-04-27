<?php 
  namespace managebranches;
    class lists extends \setup { 
      public $fdsearch;
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        if(!empty($this->fdsearch)){
          $query = "SELECT * FROM {$this->prefix}branches WHERE BRA_COMP_CODE=".$this->sql->Param('a')." AND BRA_STATUS !='0' AND (BRA_NAME LIKE ".$this->sql->Param('a')." OR 
          BRA_CODE LIKE ".$this->sql->Param('b').") ORDER BY BRA_DATE_ADDED DESC";
          $input = [$this->companycode,$this->fdsearch.'%',$this->fdsearch.'%'];
        }else {
            $query = "SELECT * FROM {$this->prefix}branches WHERE BRA_COMP_CODE=".$this->sql->Param('a')." AND BRA_STATUS !='0' ORDER BY BRA_DATE_ADDED DESC";
            $input = [$this->companycode];
        }
        if(!isset($this->limit)){
            $this->limit = $this->session->get("limited");
        }else if(empty($this->limit)){
            $this->limit = 20;
        }

        global $fdsearch;
        $this->session->set("limited",$this->limit);
        $length = 10; 
        $params = ["odb"=>$this->sql, "query"=>$query, "limit"=>$this->limit, "offset"=> $length, "params"=>$input];
        $paging = new \Pagination("sql",$params);
        return $paging;
      }

      public function getcompanybrand($companycode){
        global $sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT COMP_BRAND FROM {$this->prefix}companies WHERE COMP_CODE=".$sql->Param('a')." AND COMP_STATUS !='0' "),[$companycode]);
        print $sql->ErrorMsg();
        if($stmt){
                $obj = $stmt->FetchRow();
                $brand = $obj['COMP_BRAND']; 
        }else{
          $brand = "";
        }
        return $brand;
      }
    } 
  ?>