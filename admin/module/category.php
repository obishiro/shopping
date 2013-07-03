<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="product_type";
 
if(isset($_GET['section'])){
	switch($_GET['section']):
	case 'add':
	if($_POST['adddata']) {
		 
		$StrDB->InsertData($tb," '','".mysql_real_escape_string($_POST['txt-name'])."','".$_SESSION['UsrId']."' ");
		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);

	}
	$StrDisplay->Title_Form(category,'1');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$StrDisplay->TxtInput(category,'txt-name');
 
	$StrDisplay->Button_Form('1');
	$StrDisplay->Close_Form();
 
	break;
	case 'edit':
	if($_POST['editdata']) {
		$StrDB->UpdateData($tb,"Pro_type_name='".$_POST['txt-name']."' ",
			"where Pro_type_id='".mysql_real_escape_string($_POST['editdata'])."'");
		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	}
	$rs=$StrDB->GetData($tb,"where Pro_type_id='".mysql_real_escape_string($_GET[id])."'");
	$StrDisplay->Title_Form(category,'2');
 	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section."&id=".$_GET[id]);
	$StrDisplay->TxtInput(category,'txt-name',$rs[1]);
 
	$StrDisplay->Button_Form('2',$_GET[id]);
	$StrDisplay->Close_Form();
	break;
	case 'del':
		$StrDB->DelData($tb," where Pro_type_id='".mysql_real_escape_string($_GET['id'])."' ");
		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	endswitch;
	}else{
		$StrDisplay->Title_Form(category);
		echo "<table id=\"TableData\" width=\"100%\"    cellpadding=\"1\" cellspacing=\"1\" border=\"1\" bordercolor=\"#E9E9E9\"   >";
		echo "<thead>";
		echo "<th width=\"5%\">No.</th>";
	 
		echo "<th width=\"70%\">".ListName."</th>";
	 
		echo "<th width=\"10%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select * from $tb where User='".$_SESSION['UsrId']."' order by Pro_type_id desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[1]</td>";
	 
		echo "<td align=\"center\">
		<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[Pro_type_id]\"><i class=\"icon-edit\" title=\"แก้ไข\"></i>
			</a> | ";
 		echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=del&id=$rs[Pro_type_id]\"  onClick=\"return confirm('ต้องการลบจริงหรือไม่ ?')\">";
		echo " <i class=\"icon-trash\"></i></td>";
		echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";



	}
?>
 
