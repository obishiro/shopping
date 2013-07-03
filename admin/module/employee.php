<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="employees";
 
if(isset($_GET['section'])){
	switch($_GET['section']):
	case 'add':
	if($_POST['adddata']) {
		 
		$StrDB->InsertData($tb," '','".$_POST['txt-usr']."'
			,'".$_POST['txt-pwd']."' 
			,'".$_POST['txt-name']."'
			,'".$_POST['txt-surname']."'
		 
			,'".$_POST['txt-tel']."' 
			,'".$_POST['txt-email']."' 
			" );
		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);

	}
	$StrDisplay->Title_Form(employees,'1');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$StrDisplay->TxtInput('ชื่อ','txt-name');
	$StrDisplay->TxtInput('นามสกุล','txt-surname');
 	$StrDisplay->TxtInput('ชื่อผู้ใช้','txt-usr');
 	$StrDisplay->TxtInput('รหัสผ่าน','txt-pwd');
 
	$StrDisplay->TxtInput('เบอร์โทร','txt-tel');
	$StrDisplay->TxtInput('อีเมล์','txt-email');

	$StrDisplay->Button_Form('1');
	$StrDisplay->Close_Form();
 
	break;
	case 'edit':
	if($_POST['editdata']) {
		$StrDB->UpdateData($tb,"
			Emp_usr='".$_POST['txt-usr']."' 
			,Emp_pwd='".$_POST['txt-pwd']."'
			,Emp_name='".$_POST['txt-name']."'
			,Emp_surname='".$_POST['txt-surname']."'
			 
			,Emp_tel='".$_POST['txt-tel']."'
			,Emp_email='".$_POST['txt-email']."'  "
			,"where Emp_id='".$_POST['editdata']."'");
		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	}
	$rs=$StrDB->GetData($tb,"where Emp_id='".addslashes($_GET[id])."'");
	$StrDisplay->Title_Form(employees,'2');
 	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section."&id=".$_GET[id]);
	$StrDisplay->TxtInput('ชื่อ','txt-name',$rs[3]);
	$StrDisplay->TxtInput('นามสกุล','txt-surname',$rs[4]);
 	$StrDisplay->TxtInput('ชื่อผู้ใช้','txt-usr',$rs[1]);
 	$StrDisplay->TxtInput('รหัสผ่าน','txt-pwd',$rs[2]);
 
	$StrDisplay->TxtInput('เบอร์โทร','txt-tel',$rs[5]);
	$StrDisplay->TxtInput('อีเมล์','txt-email',$rs[6]);
 
	$StrDisplay->Button_Form('2',$_GET[id]);
	$StrDisplay->Close_Form();
	break;
	case 'del':
		$StrDB->DelData($tb," where Emp_id='".addslashes($_GET['id'])."' ");
		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	endswitch;
	}else{
		$StrDisplay->Title_Form(employees);
		echo "<table id=\"TableData\" width=\"100%\"    cellpadding=\"1\" cellspacing=\"1\" border=\"1\" bordercolor=\"#E9E9E9\"   >";
		echo "<thead>";
		echo "<th width=\"5%\">#</th>";
		echo "<th width=\"15%\">ชื่อ - สกุล</th>";
		echo "<th width=\"10%\">ชื่อผู้ใช้</th>";
		echo "<th width=\"10%\">รหัสผ่าน</th>";
 
	 	echo "<th width=\"10%\">อีเมล์</th>";
	 	echo "<th width=\"10%\">เบอร์โทร</th>";
		echo "<th width=\"10%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select * from $tb order by Emp_id desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[3] $rs[4]</td>";
	 	echo "<td>$rs[1]</td>";
	 	echo "<td>$rs[2]</td>";
	 	 echo "<td>$rs[6]</td>";
 
	 	echo "<td>$rs[5]</td>";
		echo "<td align=\"center\">
		<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[Emp_id]\"><i class=\"icon-edit\" title=\"แก้ไข\"></i>
			</a> | ";
 		echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=del&id=$rs[Emp_id]\"  onClick=\"return confirm('ต้องการลบจริงหรือไม่ ?')\">";
		echo " <i class=\"icon-trash\"></i></td>";
		echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";



	}
?>
 
