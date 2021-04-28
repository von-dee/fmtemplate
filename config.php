<?php
global $pg,$option,$target,$view,$viewpage,$msg,$status,$keys,$microtime,$formToken;
// SYSTEM VARIABLES
define("DEV_MODE",'true');
define("APP_NAME","finsys.");
define("APP_FAVICON","media/img/building.png");
define("APP_LOGO","media/img/building.png");

define("SPATH_ROOT",dirname('__FILE__'));
define("DS",DIRECTORY_SEPARATOR);
define("SPATH_LIBRARIES", SPATH_ROOT.DS."library");
define("SPATH_MEDIA",     SPATH_ROOT.DS."media");
define("SPATH_PLUGINS",   SPATH_ROOT.DS."plugins");
define("SPATH_PUBLIC",    SPATH_ROOT.DS."public");
define("SPATH_THEME",     SPATH_ROOT.DS."theme");
define("SPATH_INSTALL",   SPATH_ROOT.DS."install");
define("SPATH_UPLOAD",    SPATH_MEDIA.DS."upload/");

define("WEB_DB_PREFIX",  "fmdb_");





//Post Keeper
if($_REQUEST){
	foreach($_REQUEST as $key => $value){
		$prohibited = array('<script>','</script>','<style>','</style>');
		$value = str_ireplace($prohibited,"",$value);
		$value = prohibit($key,$value);
		$$key = @trim($value);
	}
}

function prohibit($key,$value){
	if(is_array($value)){
		$valuex = array();
		foreach ($value as $v) {
			if (is_array($v)){
			 	prohibit($value,$v);
			}else{
				$valuex[] = strip_tags($v);
			}
		}
		$value = $valuex;
	}else{
		$value=strip_tags($value);
	}
	return $value;
}
if($_FILES){
	foreach($_FILES as $keyimg => $values){
		foreach($values as $key => $value){
			$$key = $value;
		}
	}
}

//SYSTEM TIMEZONE FORMAT
date_default_timezone_set('UTC');

class JConfig {
	public $secret='03Ui90d3XfCh80';
	public $debug = false;
	public $autoRollback= true;
	public $ADODB_COUNTRECS = false;
	public $SASS_DEV_MODE = true;
	private static $_instance;
	public function __construct(){}
	private function __clone(){}
	public static function getInstance(){
	if(!self::$_instance instanceof self){
	     self::$_instance = new self();
	 }
	    return self::$_instance;
	}
	public function codeDebug($params){
		echo '<pre>';
		var_dump($params);exit;
	 	echo '</pre>';
	}
}

$config = JConfig::getInstance();

//included classes
include SPATH_LIBRARIES.DS."lib.session.php";
include SPATH_PLUGINS.DS."adodb".DS."adodb.inc.php";
include SPATH_LIBRARIES.DS."lib.connect.php";
include SPATH_LIBRARIES.DS."lib.sql.php";
if(!validateFormToken()){}
include SPATH_LIBRARIES.DS."lib.crypt.php";
include SPATH_LIBRARIES.DS."lib.engine.php";
include SPATH_LIBRARIES.DS."lib.login.php";
include SPATH_LIBRARIES.DS."lib.navigator.php";
include SPATH_LIBRARIES.DS."lib.pagination.php";
include SPATH_LIBRARIES.DS."lib.menu.php";
if(DEV_MODE=='true'){
	include SPATH_PLUGINS.DS."style.inc.php";
	include SPATH_PLUGINS.DS."scssrouter".DS."generatelinks.php";
	include SPATH_INSTALL.DS.'project.php';
}
include SPATH_LIBRARIES.DS."lib.setup.php";

?>