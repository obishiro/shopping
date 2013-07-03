<?php
session_start();
include("class/config.php");
include("class/function.php");
include("class/display.php");
include("class/lang.php");
include("class/lib.php");
include('class/common.inc.php');
$StrDB= new Db_Process();
$StrDisplay= new Web_Display();
$StrLibCart = new LibCart();

if(!isset($uri['2'])) {
	 include 'main_template/default/index.php'; 
	}else{
	switch($uri['2']){
		case 'main':
 			include 'main_template/default/index.php'; 
 		break;
 		default:
 		$StrDB->GetTheme($uri['2']);
 		break;
 	}
}
 


?>