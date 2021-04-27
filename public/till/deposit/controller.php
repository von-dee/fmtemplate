<?php
$action= "deposit\\".(($viewpage)? $viewpage :"lists"); 
$class_init= new $action;
$result= $class_init->Init(); 


$list= new deposit\lists();
$paging = $list->Init();
$rs= $paging->paginate();
include("scripts/js.php");
?>