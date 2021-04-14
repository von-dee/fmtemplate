<?php
### CORE System Information
global $pg,$option,$target,$view,$viewpage,$msg,$status,$keys,$microtime,$formToken,$limit;

### System Variables
define("DEV_MODE",'true');
define("APP_NAME","Ui Eleven");
define("APP_VERSION","ui eleven v1.0");
define("APP_FAVICON","theme/assets/img/favicon.png");
define("APP_LOGO","theme/assets/img/logo.svg");


define("WEB_ROOT",dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);
define("WEB_INSTALL",   WEB_ROOT.DS."install");
define("WEB_LIBRARIES", WEB_ROOT.DS."libraries");
define("WEB_MEDIA",     WEB_ROOT.DS."media");
define("WEB_PLUGINS",   WEB_ROOT.DS."plugins");
define("WEB_PUBLIC",    WEB_ROOT.DS."public");
define("WEB_THEME",     WEB_ROOT.DS."theme");
define("WEB_UPLOADS",   WEB_MEDIA.DS."uploads");

define("WEB_DB_PREFIX","amb_");

//Post Keeper
if($_REQUEST){
	foreach($_REQUEST as $key => $value){
		$prohibited = array('<script>','</script>','<style>','</style>');
		if(!is_array($value)){
			$value = str_ireplace($prohibited,"",$value);
			$value = prohibit($key,$value,$prohibited);
			$$key = @trim($value);
		}else{
			$value = prohibit($key,$value,$prohibited);
			$$key = $value ?? @trim($value);
		}
		
	}
}

function prohibit($key,$value,$prohibited){
	if(is_array($value)){
		$valuex = array();
		foreach ($value as $v) {
			if (is_array($v)){
			 	prohibit($value,$v,$prohibited);
			}else{
				$valuex[] = str_ireplace($prohibited,"",$v);
			}
		}
		$value = $valuex;
	}else{
		$value = str_ireplace($prohibited,"",$value);
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
include WEB_LIBRARIES.DS."lib.session.php";
include WEB_PLUGINS.DS."adodb".DS."adodb.inc.php";
include WEB_LIBRARIES.DS."lib.connect.php";
include WEB_LIBRARIES.DS."lib.sql.php";
if(!validateFormToken()){}
include WEB_LIBRARIES.DS."lib.crypt.php";
include WEB_LIBRARIES.DS."lib.engine.php";
include WEB_LIBRARIES.DS."lib.login.php";
include WEB_LIBRARIES.DS."lib.register.php";
include WEB_LIBRARIES.DS."lib.navigator.php";
include WEB_LIBRARIES.DS."lib.pagination.php";
include WEB_LIBRARIES.DS."lib.menu.php";
include WEB_LIBRARIES.DS."lib.import.php";
include WEB_LIBRARIES.DS."lib.validation.php";
if(DEV_MODE=='true'){
	include WEB_PLUGINS.DS."style.inc.php";
	include WEB_PLUGINS.DS."scssrouter".DS."generatelinks.php";
	include WEB_INSTALL.DS.'project.php';
}
include WEB_LIBRARIES.DS."lib.setup.php";

?>