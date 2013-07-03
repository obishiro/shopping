<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="agent";
 
if(isset($_GET['section'])){
	switch($_GET['section']):
	case 'add':
	if($_POST['adddata']) {
		 
		$StrDB->InsertData($tb," '','".$_POST['txt-name']."' ,'".$_POST['txt-address']."','".$_POST['txt-tel']."' " );
		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);

	}
	$StrDisplay->Title_Form(agent,'1');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$StrDisplay->TxtInput('ชื่อผู้แทนจำหน่าย','txt-name');
 	$StrDisplay->TxtInputArea('ที่อยู่','txt-address');
 	$StrDisplay->TxtInput('เบอร์โทร','txt-tel');
	$StrDisplay->Button_Form('1');
	$StrDisplay->Close_Form();
 
	break;
	case 'edit':
	if($_POST['editdata']) {
		$StrDB->UpdateData($tb,"Agt_name='".$_POST['txt-name']."' 
			,Agt_address='".$_POST['txt-address']."'
			,Agt_tel='".$_POST['txt-tel']."'  ","where Agt_id='".$_POST['editdata']."'");
		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	}
	$rs=$StrDB->GetData($tb,"where Agt_id='".addslashes($_GET[id])."'");
	$StrDisplay->Title_Form(agent,'2');
 	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section."&id=".$_GET[id]);
	$StrDisplay->TxtInput('ชื่อผู้แทนจำหน่าย','txt-name',$rs[1]);
 	$StrDisplay->TxtInputArea('ที่อยู่','txt-address',$rs[2]);
 	$StrDisplay->TxtInput('เบอร์โทร','txt-tel',$rs[3]);
 
	$StrDisplay->Button_Form('2',$_GET[id]);
	$StrDisplay->Close_Form();
	break;
	case 'del':
		$StrDB->DelData($tb," where Agt_id='".addslashes($_GET['id'])."' ");
		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	endswitch;
	}else{
		$StrDisplay->Title_Form(agent);
		echo "<table id=\"TableData\" width=\"100%\"    cellpadding=\"1\" cellspacing=\"1\" border=\"1\" bordercolor=\"#E9E9E9\"   >";
		echo "<thead>";
		echo "<th width=\"5%\">#</th>";
		echo "<th width=\"40%\">".ListName."</th>";
	 	echo "<th width=\"30%\">ที่อยู่</th>";
	 	echo "<th width=\"15%\">เบอร์โทร</th>";
		echo "<th width=\"10%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select * from $tb order by Agt_name asc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[1]</td>";
	 	echo "<td>$rs[2]</td>";
	 	echo "<td>$rs[3]</td>";
		echo "<td align=\"center\">
		<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[Agt_id]\"><i class=\"icon-edit\" title=\"แก้ไข\"></i>
			</a> | ";
 		echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=del&id=$rs[Agt_id]\"  onClick=\"return confirm('ต้องการลบจริงหรือไม่ ?')\">";
		echo " <i class=\"icon-trash\"></i></td>";
		echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";



	}
?>
 
