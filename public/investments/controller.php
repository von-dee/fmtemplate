<?php
$action= "investments\\".(($viewpage)? $viewpage :"lists"); 
$class_init= new $action;
$result= $class_init->Init(); 


$list= new investments\lists();
$paging = $list->Init();
$rs= $paging->paginate();
include("scripts/js.php");
?>