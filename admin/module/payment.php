<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="account";
 
if(isset($_GET['section'])){
	switch($_GET['section']):
	case 'add':
	if($_POST['adddata']) {
		 
		$StrDB->InsertData($tb," '','".$_POST['txt-no']."'
			,'".$_POST['txt-name']."' 
			,'".$_POST['txt-type']."'
			,'".$_POST['txt-bank']."'
			,'".$_POST['txt-branch']."'
			,'".$_POST['txt-tel']."' " );
		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);

	}
	$StrDisplay->Title_Form(payment,'1');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$StrDisplay->TxtInput('เลขที่บัญชี','txt-no');
	$StrDisplay->TxtInput('ชื่อบัญชี','txt-name');
 	$StrDisplay->TxtInput('ประเภทบัญชี','txt-type');
 	$StrDisplay->TxtInput('ชื่อธนาคาร','txt-bank');
	$StrDisplay->TxtInput('ชื่อสาขา','txt-branch');
 	$StrDisplay->TxtInput('เบอร์โทร','txt-tel');
	$StrDisplay->Button_Form('1');
	$StrDisplay->Close_Form();
 
	break;
	case 'edit':
	if($_POST['editdata']) {
		$StrDB->UpdateData($tb,"
			Acc_no='".$_POST['txt-no']."' 
			,Acc_name='".$_POST['txt-name']."'
			,Acc_type='".$_POST['txt-type']."'
			,Acc_bank='".$_POST['txt-bank']."'
			,Acc_branch='".$_POST['txt-branch']."'
			,Acc_tel='".$_POST['txt-tel']."'  "


			,"where Id='".$_POST['editdata']."'");
		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	}
	$rs=$StrDB->GetData($tb,"where Id='".addslashes($_GET[id])."'");
	$StrDisplay->Title_Form(payment,'2');
 	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section."&id=".$_GET[id]);
$StrDisplay->TxtInput('เลขที่บัญชี','txt-no',$rs[1]);
	$StrDisplay->TxtInput('ชื่อบัญชี','txt-name',$rs[2]);
 	$StrDisplay->TxtInput('ประเภทบัญชี','txt-type',$rs[3]);
 	$StrDisplay->TxtInput('ชื่อธนาคาร','txt-bank',$rs[4]);
	$StrDisplay->TxtInput('ชื่อสาขา','txt-branch',$rs[5]);
 	$StrDisplay->TxtInput('เบอร์โทร','txt-tel',$rs[6]);
 
	$StrDisplay->Button_Form('2',$_GET[id]);
	$StrDisplay->Close_Form();
	break;
	case 'del':
		$StrDB->DelData($tb," where Id='".addslashes($_GET['id'])."' ");
		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	endswitch;
	}else{
		$StrDisplay->Title_Form(payment);
		echo "<table id=\"TableData\" width=\"100%\"    cellpadding=\"1\" cellspacing=\"1\" border=\"1\" bordercolor=\"#E9E9E9\"   >";
		echo "<thead>";
		echo "<th width=\"5%\">#</th>";
		echo "<th width=\"15%\">ชื่อบัญชี</th>";
		echo "<th width=\"15%\">เลขบัญชี</th>";
		echo "<th width=\"15%\">ประเภทบัญชี</th>";
		echo "<th width=\"15%\">ชื่อธนาคาร</th>";
	 	echo "<th width=\"15%\">ชื่อสาขา</th>";
	 	echo "<th width=\"10%\">เบอร์โทร</th>";
		echo "<th width=\"10%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select * from $tb order by Acc_name asc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[2]</td>";
	 	echo "<td>$rs[1]</td>";
	 	echo "<td>$rs[3]</td>";
	 	 echo "<td>$rs[4]</td>";
	 	echo "<td>$rs[5]</td>";
	 	echo "<td>$rs[6]</td>";
		echo "<td align=\"center\">
		<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[Id]\"><i class=\"icon-edit\" title=\"แก้ไข\"></i>
			</a> | ";
 		echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=del&id=$rs[Id]\"  onClick=\"return confirm('ต้องการลบจริงหรือไม่ ?')\">";
		echo " <i class=\"icon-trash\"></i></td>";
		echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";



	}
?>
 
