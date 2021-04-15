<?php
    $action= "blankpage\\".(($class_call)? $class_call :"lists"); 
    $class_int = new $action;
    $result = $class_int->Init(); 

    // $class_int = new blankpage\lists;
    // $result = $class_int->Init();
    include("scripts/js.php");


    if(!empty($fdsearch)){
        $query = "SELECT USR_CODE, USR_FIRSTNAME, USR_OTHERNAME, USR_EMAIL, USR_STATUS, USR_PHOTO FROM framework_users WHERE USR_STATUS='1' AND (USR_FIRSTNAME LIKE ".$sql->Param('a')." OR  USR_OTHERNAME LIKE ".$sql->Param('b').") ORDER BY USR_DATE_ADDED DESC"; 
        $input = [$fdsearch.'%',$fdsearch.'%'];
    }else {
        $query = "SELECT USR_CODE, USR_FIRSTNAME, USR_OTHERNAME, USR_EMAIL, USR_STATUS, USR_PHOTO FROM framework_users WHERE USR_STATUS='1' ORDER BY USR_DATE_ADDED DESC";
        $input = [];
    }
    if(!isset($limit)){
        $limit = $session->get("limited");
    }else if(empty($limit)){
        $limit = 20;
    }
    
    global $fdsearch;
    $session->set("limited",$limit);
    $lenght = 10; 
    $paging = new Pagination($sql,$query,$limit,$lenght,$input,'/index.php?pg=FQObS8w5PT7rVBDxRtcF0g%3D%3D');
    $rs = $paging->paginate();
?>