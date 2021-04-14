<?php 
/**
 * Framework3 Module Initializer
 * By Solomon Akoto
 */

include('modules.php');
function buildDirs($modules,$platformdata=null, $indexdata=null ,$controllerdata=null,$path=null){ 
  $path= ($path) ? $path.DS : WEB_PUBLIC.DS ;
  foreach($modules as $key => $val1){
    if( !is_int($key)){
      $path.=$key;
      if(  !file_exists($path))  {
        mkdir($path);
        if(is_array($val1)){
          //if the module is an array build subs
          $stagecode = '<?php
          $option = (isset($option))? $option : NULL;
          $target = (isset($target))? $target : NULL;
          include ($nav->nav_option($pg,$option,$target)); 
          ?>';
          
          foreach($val1 as $map => $deep){
            if(is_array($deep)){
                $stagecode = '<?php
                $option = (isset($option))? $option : NULL;
                include ($nav->nav_option($pg,$option)); 
                ?>';
                break;
            }
          }
          file_put_contents($path . "/platform.php", $stagecode);
        }else{
          file_put_contents($path . "/platform.php", $platformdata);
        }
          file_put_contents($path . "/index.html", $indexdata);
      } 
    }

    if ( is_array($val1)) {
      buildDirs($val1,$platformdata,$indexdata,$controllerdata,$path);
        if( !is_int($key)){
            $path = WEB_PUBLIC.DS;
        }
    }else{ 
      writeContent($path,$val1);
      if( !is_int($key)){
        $path = WEB_PUBLIC.DS; 
      }
    }    
  }
} 


function writeContent($path,$value){
  global $platformdata,$indexdata,$controllerdata,$listdata,$editdata,$detailsdata;
  $path.= DS.$value;
  if(!file_exists ($path)) mkdir($path); 
  if(!file_exists ($path.'/platform.php')) file_put_contents($path . "/platform.php", $platformdata);
  if(!file_exists ($path.'/index.html')) file_put_contents($path . "/index.html", $indexdata);
  if(!file_exists ($path.'/controller.php')) file_put_contents($path . "/controller.php", str_replace( '@@@',$value,$controllerdata));
  if(!file_exists ($path.'/scripts')) mkdir($path.'/scripts');  
  if(!file_exists ($path.'/scripts/js.php')) file_put_contents($path.'/scripts/js.php','<script></script>'); 
  if(!file_exists ($path.'/scripts/style.scss')) file_put_contents($path.'/scripts/style.scss',".page-$value{}"); 
  if(!file_exists ($path.'/scripts/index.html'))file_put_contents($path . "/scripts/index.html", $indexdata);
  if(!file_exists ($path.'/views')) mkdir($path.'/views');
  if(!file_exists ($path.'/views/list.php'))file_put_contents($path . "/views/list.php",str_replace( '@@@',$value, $listdata));
  if(!file_exists ($path.'/views/add.php'))file_put_contents($path . "/views/add.php", '<div class="page-'.$value.'"><?php echo "ADD PAGE" ?></div>');
  if(!file_exists ($path.'/views/index.html'))file_put_contents($path . "/views/index.html", $indexdata);
  if(!file_exists ($path.'/controllers')) mkdir($path.'/controllers');  
  if(!file_exists ($path.'/controllers/lists.php'))file_put_contents($path . "/controllers/lists.php", '<?php 
  namespace '.$value.';
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
            $query = "";
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
  } ?>');
  
  if(!file_exists ($path.'/controllers/add.php'))file_put_contents($path . "/controllers/add.php","<?php 
  namespace ".$value.";
    class add extends \setup { 
      function __construct(){
        parent::__construct(); 
      }
      function Init(){
        if(\$this->engine->validatePostForm(\$this->microtime)){  
        return true;
        }
      }
  } ?>");
  if(!file_exists ($path.'/controllers/index.html'))file_put_contents($path . "/controllers/index.html", $indexdata);
  }
buildDirs($modules,$platformdata,$indexdata,$controllerdata);
?>
