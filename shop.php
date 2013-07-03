<?php
session_start();
include("class/config.php");
include("class/function.php");
include("class/display.php");
include("class/lang.php");
include("class/lib.php");
include('common.inc.php');
$StrDB= new Db_Process();
$StrDisplay= new Web_Display();
$StrLibCart = new LibCart();
 
switch ($val) {
	case '0':
 include 'index.php'; 

		break;
	
	case '1':
		$StrDB->GetTheme($uri['0']);
		break;
}



?>