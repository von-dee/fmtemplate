<?php 
  namespace manageusers;
    class lists extends \setup { 
        public $fdsearch;
        function __construct(){
          parent::__construct(); 
        }
        function Init(){
          if(!empty($this->fdsearch)){
            $query = "SELECT USR_CODE, USR_FIRSTNAME, USR_OTHERNAME, USR_EMAIL, USR_STATUS, USR_PHOTO FROM 
            ".$this->prefix."users WHERE USR_STATUS='1' AND (USR_FIRSTNAME LIKE ".$this->sql->Param('a')." OR 
            USR_OTHERNAME LIKE ".$this->sql->Param('b').") ORDER BY USR_DATE_ADDED DESC";
            $input = [$this->fdsearch.'%',$this->fdsearch.'%'];
          }else {
              $query = "SELECT USR_CODE, USR_FIRSTNAME, USR_OTHERNAME, USR_EMAIL, USR_STATUS, USR_PHOTO FROM 
              ".$this->prefix."users WHERE USR_STATUS='1' ORDER BY USR_DATE_ADDED DESC";
              $input = [];
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
  } ?>
