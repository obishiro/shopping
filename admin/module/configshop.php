<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="tb_config_office";
if(empty($_GET['action'])){
	$action="configshop";
}
switch($_GET['section'])  {
	case 'add':
if($_POST['adddata']) {
		 
	 
	 	$StrDB->InsertData($tb," '".NULL."'
			,'".$_POST['txt-name-lo']."'
			,'".$_POST['txt-name-en']."'

			,'".$_POST['txt-addr']."'
			,'".$_POST['txt-tel']."'
			,'".$_POST['txt-webname']."'
			,'".$_POST['txt-title']."'
			,'".$_POST['txt-keyword']."'
			,'".$_POST['txt-detail']."'
			,'".$_SESSION['UsrId']."'
		 
			");

		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
 
	}
	break;
	case 'edit':
		if($_POST['editdata']) {
		 
	 
	 	 $StrDB->UpdateData($tb," 
			MMNameTh='".$_POST['txt-name-lo']."'
			,MMNameEn='".$_POST['txt-name-en']."'
			,Address='".$_POST['txt-addr']."'
			,MMTel='".$_POST['txt-tel']."'
			,MMWebName='".$_POST['txt-webname']."'
			,MMWebTitle='".$_POST['txt-title']."'
			,MMWebKeyword='".$_POST['txt-keyword']."'
			,MMWebDetail='".$_POST['txt-detail']."'
			"," where User='".$_SESSION['UsrId']."'
		 
			");

		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
 
	}
	break;
}
	if($StrDB->NumRows("select Id from $tb where User='".$_SESSION['UsrId']."' ")>"0") {
	$rs=$StrDB->GetData("$tb","where User='".$_SESSION['UsrId']."'");
	$form_type="2";
	$section="edit";
	$Disable="Disable";
	}else{
	$form_type="1";
	$section="add";

	}
	$StrDisplay->Title_Form(ConfigOffice,$form_type);
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
 	echo "<div class=\"row-fluid\">";
 	echo "<div class=\"span6\" >";
	$StrDisplay->TxtInput(txt_name_lo,'txt-name-lo',$rs['1']);
 	$StrDisplay->TxtInput(txt_name_en,'txt-name-en',$rs['2']);
	$StrDisplay->TxtInputArea(txt_addr,'txt-addr',$rs['3'],'450','200','0');
	echo '<div class="control-group" style="width:500px;"  >';
    echo '<label class="control-label" for="input'.$Name.'">'.$txtname.' </label>';
   	echo '<div class="controls">';
    echo "<img src=\"".WebUrl."img_shop/shop-icon.png\" class=\"img-polaroid\" >";
   	echo '</div>  </div>';
   	$StrDisplay->TxtInputFile(ShopImg,'file','file0',"");




 	echo '</div>';
	 
	echo "<div class=\"span6\" >";


	$StrDisplay->TxtInput(txt_tel,'txt-tel',$rs['4']);

 $num=$StrDB->NumRows("select User from tb_config_office where User='".$_SESSION['UsrId']."' ");
  if($num!="0") {
 	$StrDisplay->TxtInputDisable(txt_webname,'txt-webname',$rs['5']);
 }else{
 	$StrDisplay->TxtInput(txt_webname,'txt-webname');
 }
	$StrDisplay->TxtInput(txt_title,'txt-title',$rs['6']);

	$StrDisplay->TxtInput(txt_keyword,'txt-keyword',$rs['7']);
 	$StrDisplay->TxtInput(txt_detail,'txt-detail',$rs['8']);

	echo "</div></div>";
 
 	$StrDisplay->Button_Form("$form_type",$_SESSION['UsrId']);
	$StrDisplay->Close_Form();
 


	?> 
