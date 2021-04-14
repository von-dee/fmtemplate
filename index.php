<?php
### FrameWork Gumdrop Edition which is compactible PHP 5.6+.
### Date Created: 1-07-2019.
### Developed By:  Qwesi Gyan @ Hyzli.

include "config.php"; 

if(isset($action) && strtolower($action) == 'register'){	
	include('public/auth/register.php');
	$reg = new Register();
	die();
}

if(isset($action) && strtolower($action) == 'login'){
	include('public/auth/login.php');
	die();
}
$log = new Login();

if(isset($action) && strtolower($action) == 'logout'){ 
	$log->logout();
}

if(isset($doLogin) && $doLogin == 'systemPingPass'){
	header('Location: index.php?action=index&pg=dashboard');
	die('Please wait...redirecting page');
}

### Inside the system now
$engine = new Engine();
$config = new JConfig();
$nav = new Nav();
$menu = new Menu();
$crypt = new Crypt();



### ini_set('display_errors', 1);

include("public/root.platform.php");

?>