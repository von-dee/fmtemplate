<?php 
  namespace managecompany;
    class lists extends \setup { 
      public $fdsearch;
      function __construct(){
        parent::__construct(); 
      }
      function Init(){


        if(!empty($this->fdsearch)){
          $query = "SELECT * FROM ".$this->prefix."companies WHERE COMP_STATUS !='0' AND (COMP_NAME LIKE ".$this->sql->Param('a')." OR 
          COMP_CODE LIKE ".$this->sql->Param('b').") ORDER BY COMP_DATE_ADDED DESC";
          $input = [$this->fdsearch.'%',$this->fdsearch.'%'];
        }else {
            $query = "SELECT * FROM ".$this->prefix."companies WHERE COMP_STATUS !='0' ORDER BY COMP_DATE_ADDED DESC";
            $input = [];
        }
        if(!isset($this->limit)){
            $this->limit = $this->session->get("limited");
        }else if(empty($this->limit)){
            $this->limit = 20;
        }

        global $fdsearch;
        
        $length = 10; 
        $params = ["odb"=>$this->sql, "query"=>$query, "limit"=>$this->limit, "offset"=> $length, "params"=>$input];
        $paging = new \Pagination("sql",$params);
        return $paging;
      }
  } ?>