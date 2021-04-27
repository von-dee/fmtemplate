<?php
$action = "manageusers\\".(($viewpage)? $viewpage :"lists"); 
$class_init= new $action;
$result = $class_init->Init(); 

$list = new manageusers\lists();
$paging = $list->Init();
$rs = $paging->paginate();
?>