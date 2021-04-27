<?php
$action= "withdrawal\\".(($viewpage)? $viewpage :"lists"); 
$class_init= new $action;
$result= $class_init->Init(); 


$list= new withdrawal\lists();
$paging = $list->Init();
$rs= $paging->paginate();
include("scripts/js.php");
?>