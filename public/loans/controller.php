<?php
$action= "loans\\".(($viewpage)? $viewpage :"lists"); 
$class_init= new $action;
$result= $class_init->Init(); 


$list= new loans\lists();
$paging = $list->Init();
$rs= $paging->paginate();
include("scripts/js.php");
?>