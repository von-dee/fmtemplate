<?php 
  namespace clients;
    class lists extends \setup { 
      public $fdsearch;
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        if(!empty($this->fdsearch)){
          $query = "";
          $input = [];
        }else {
            $query = "SELECT * FROM {$this->prefix}clients WHERE USR_STATUS !='0' ORDER BY USR_FIRSTNAME ASC";
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