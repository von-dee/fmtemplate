<?php
$prefix  = WEB_DB_PREFIX;
include("controller.php");
    switch($view){
		case "add":
		   include "views/add.php";
        break;
        case "manage":
            include "views/manage.php";
         break;
        default:
            include "views/list.php";
        break;
    }
?>