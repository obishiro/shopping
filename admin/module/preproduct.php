<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="purchase";
 
if(isset($_GET['section'])){
	switch($_GET['section']):
	case 'add':
	
	$StrDisplay->Title_Form(preproduct,'1');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=list");
	$StrDisplay->TxtInput('จำนวนที่ต้อการสั่ง','txt-num');
 	$StrDisplay->Button_Form('3');
	$StrDisplay->Close_Form();
 
		
	break;
	case 'list':
	if($_POST['adddata']) {
		$StrDB->InsertData("purchase","'".NULL."','".$_POST['txt-title']."','".date("Y-m-d")."' , '' ,'0','".$_POST['txt-agent']."' ");
		$rskey=$StrDB->GetData("purchase","order by Pur_id desc limit 0,1");
		$Key=$rskey[0];
		for($i=0;$i<$_POST['num'];$i++)  {	
		$proid=$StrDB->randName(6);
		$price=$_POST['txt-num_order'][$i]*$_POST['txt-price'][$i];
		 $StrDB->InsertData("purchase_detail"," '','".$Key."' ,'".$proid."','".$_POST['txt-name'][$i]."','".$_POST['txt-num_order'][$i]."','".$_POST['txt-num_order'][$i]."'
		 ,'".$_POST['txt-price'][$i]."','".$price."' ");
		}
		$sql="select sum(Pur_total) as sumprice from  purchase_detail where Pur_id='".$Key."' ";
		$q=$StrDB->Query($sql);
		$rs=$StrDB->FetchData($q);
		$total= $rs[sumprice];
		 $StrDB->UpdateData("purchase"," Pur_net='".$total."' ","where Pur_id='".$Key."'");
		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);

	}
	$StrDisplay->Title_Form("รายการสั่งซื้อสินค้า",'1');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);

	if(!empty($_POST['txt-num'])) {
	$StrDisplay->TxtInput("หัวข้อการสั่งซื้อ  ",'txt-title');	
	echo "<table class=\"table table-bordered\">";
	// echo "<caption><h3>รายการสั่งซื้อสินค้า</h3></caption>";
  	echo "<thead style=\"background:#2899E0;color:#fff\"><tr>";
  	echo "<th >ลำดับ</th>";
  	echo "<th>ชื่อสินค้า</th>";
  	echo "<th>จำนวนสั่ง</th>";
  	echo "<th>ราคา/หน่วย</th>";
 
  	echo "</thead>";
  	echo "<tbody>";
	for($i=1;$i<=$_POST['txt-num'];$i++)	 {
	/*$StrDisplay->TxtInput("ชื่อรายการที่  ".$i,'txt-name[]');
	$StrDisplay->TxtInput("จำนวน ",'txt-num_order[]');
	$StrDisplay->TxtInput("ราคา/ชิ้น ",'txt-price[]');*/
	echo "<tr style=\"background:#fff;\">";
		echo "<td  style=\"text-align:center\"  width=\"5%\">$i</td>";
		echo "<td  width=\"50%\"><input style=\"width:550px\" type=\"text\"  name=\"txt-name[]\"></td>";
		echo "<td  style=\"text-align:center\" width=\"10%\"><input style=\"width:100px\" type=\"text\"  name=\"txt-num_order[]\"></td>";
		echo "<td  style=\"text-align:center\" width=\"10%\"><input style=\"width:100px\" type=\"text\" name=\"txt-price[]\"></td>";
		
		echo "</tr>";

	}
	echo "</tbody>";
	echo "</table>";
	$StrDisplay->OpenSelectInput('ตัวแทนจำหน่าย','txt-agent');
 	$StrDB->ListBoxData('agent','*','order by Agt_name asc','Agt_id','Agt_name');
  	$StrDisplay->CloseSelectInput();
	}
	$StrDisplay->TxtHidden("num",$_POST['txt-num']);
 	$StrDisplay->Button_Form('1');
	$StrDisplay->Close_Form();
	break;
	case 'edit':
	if($_POST['editdata']) {
	//	$StrDB->UpdateData($tb,"Pro_type_name='".$_POST['txt-name']."' ","where Pro_type_id='".$_POST['editdata']."'");
		for($i=0;$i<$_POST['txt-num'];$i++)  {	
			$price=$_POST['txt-num_order'][$i]*$_POST['txt-price'][$i];
			$StrDB->UpdateData("purchase_detail","
				Pro_name='".$_POST['txt-name'][$i]."'
				,Pur_amount='".$_POST['txt-num_order'][$i]."'
				,Pur_price='".$_POST['txt-price'][$i]."' 
				,Pur_total='".$price."' "
				,"where Id='".$_POST['txt-id'][$i]."' ");
		}
		$sql="select sum(Pur_total) as sumprice from  purchase_detail where Pur_id='".mysql_real_escape_string($_POST['editdata'])."' ";
		$q=$StrDB->Query($sql);
		$rs=$StrDB->FetchData($q);
		  $total= $rs[sumprice];
		 $StrDB->UpdateData("purchase"," Pur_net='".$total."' ","where Pur_id='".mysql_real_escape_string($_POST['editdata'])."'");

		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	}
	 
	$StrDisplay->Title_Form(preproduct,'2');
 	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$Sql=$StrDB->Query("select * from purchase_detail where Pur_id='".mysql_real_escape_string($_GET[id])."' ");
	$Num=$StrDB->NumRows("select * from purchase_detail where Pur_id='".mysql_real_escape_string($_GET[id])."' ");

	echo "<table class=\"table table-bordered\">";
	echo "<caption><h4>".$StrDB->ConName("purchase","Pur_id","Pur_name",$_GET[id])."</h4></caption>";
  	echo "<thead style=\"background:#2899E0;color:#fff\"><tr>";
  	echo "<th >ลำดับ</th>";
  	echo "<th>ชื่อสินค้า</th>";
  	echo "<th>จำนวนสั่ง</th>";
  	echo "<th>ราคา/หน่วย</th>";
 
  	echo "</thead>";
  	echo "<tbody>";
  	$i=1;
	while($rs=$StrDB->FetchData($Sql)) {
		echo "<tr style=\"background:#fff;\">";
		echo "<td  style=\"text-align:center\"  width=\"5%\">$i</td>";
		echo "<td  width=\"50%\"><input style=\"width:550px\" type=\"text\"  name=\"txt-name[]\" value=\"$rs[Pro_name]\"></td>";
		echo "<td  style=\"text-align:center\" width=\"10%\"><input style=\"width:100px\" type=\"text\"  name=\"txt-num_order[]\" value=\"$rs[Pur_amount]\"></td>";
		echo "<td  style=\"text-align:center\" width=\"10%\"><input style=\"width:100px\" type=\"text\" name=\"txt-price[]\" value=\"$rs[Pur_price]\"></td>";
		$StrDisplay->TxtHidden("txt-id[]",$rs[Id]);
		echo "</tr>";

	$i++;
	}
	echo "</tbody>";
	echo "</table>";
	 
 	$StrDisplay->TxtHidden("txt-num",$Num);
	$StrDisplay->Button_Form('2',$_GET[id]);
	$StrDisplay->Close_Form();
	break;
	case 'del':
		$StrDB->DelData($tb," where Pur_id='".addslashes($_GET['id'])."' ");
		$StrDB->DelData("purchase_detail"," where Pur_id='".addslashes($_GET['id'])."' ");
		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	case 'reciveproduct':
		if($_POST['adddata']) {
 
		for($i=0;$i<$_POST['txt-num'];$i++)  {	
		 
		$price=$_POST['txt-remain'][$i]*$_POST['txt-price'][$i];
	 	$StrDB->UpdateData("purchase_detail","Pur_remain='".$_POST['txt-remain'][$i]."',Pur_total='".$price."' ","where Id='".mysql_real_escape_string($_POST['txt-id'][$i])."' ");
	 	}
		$sql="select sum(Pur_total) as sumprice from  purchase_detail where Pur_id='".mysql_real_escape_string($_POST['txt-purid'])."' ";
		$q=$StrDB->Query($sql);
		$rs=$StrDB->FetchData($q);
		  $total= $rs[sumprice];
		 $StrDB->UpdateData("purchase"," Pur_net='".$total."',Pur_status='1' ","where Pur_id='".mysql_real_escape_string($_POST['txt-purid'])."'");

		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
 
}
	$StrDisplay->Title_Form("ตรวจรับ ".preproduct,'');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$Sql=$StrDB->Query("select * from purchase_detail where Pur_id='".mysql_real_escape_string($_GET[id])."' ");
	$Num=$StrDB->NumRows("select * from purchase_detail where Pur_id='".mysql_real_escape_string($_GET[id])."' ");

	echo "<table class=\"table table-bordered\">";
		echo "<caption><h4> ".$StrDB->ConName("purchase","Pur_id","Pur_name",$_GET[id])."</h4></caption>";
  	echo "<thead style=\"background:#2899E0;color:#fff\"><tr>";
  	echo "<th >ลำดับ</th>";
  	echo "<th>ชื่อสินค้า</th>";
  	echo "<th>จำนวนสั่ง</th>";
  	echo "<th>ราคา/หน่วย</th>";
  	echo "<th>จำนวนรับ</th>";
  	echo "<th>ราคารวม</th>";
  	echo "</thead>";
  	echo "<tbody>";
  	$i=1;
	while($rs=$StrDB->FetchData($Sql)) {
		echo "<tr style=\"background:#fff;\">";
		echo "<td  style=\"text-align:center\"  width=\"5%\">$i</td>";
		echo "<td  width=\"50%\">$rs[Pro_name]</td>";
		echo "<td  style=\"text-align:center\" width=\"10%\">$rs[Pur_amount]</td>";
		echo "<td  style=\"text-align:center\" width=\"10%\">".number_format($rs[Pur_price])."</td>";
		echo "<td width=\"10%\"><input style=\"width:50px\" type=\"text\" value=\"$rs[Pur_remain]\" name=\"txt-remain[]\"></td>";
		echo "<td  width=\"10%\">".number_format($rs[Pur_total])."</td>";
		$StrDisplay->TxtHidden("txt-id[]",$rs['Id']);
		$StrDisplay->TxtHidden("txt-price[]",$rs['Pur_price']);
		$StrDisplay->TxtHidden("txt-purid",$_GET['id']);
		$StrDisplay->TxtHidden("txt-num",$Num);
		echo "</tr>";
	$i++;
	}
	echo "</tbody>";
	echo "</table>";
	 
	 $StrDisplay->Button_Form('1');
	 
	$StrDisplay->Close_Form();
	break;
	case 'showproduct':
	$StrDisplay->Title_Form(" ".preproduct,'');
 	$Sql=$StrDB->Query("select * from purchase_detail where Pur_id='".mysql_real_escape_string($_GET[id])."' ");
 
	echo "<table class=\"table table-bordered\">";
	 echo "<caption><h3>รายการสินค้า ที่รับแล้ว</h3></caption>";
  	echo "<thead style=\"background:#2899E0;color:#fff\"><tr>";
  	echo "<th >ลำดับ</th>";
  	echo "<th>ชื่อสินค้า</th>";
  	echo "<th>จำนวนสั่ง</th>";
  	echo "<th>ราคา/หน่วย</th>";
  	echo "<th>จำนวนรับ</th>";
  	echo "<th>ราคารวม</th>";
  	echo "<th>เพิ่มสินค้า</th>";
  	echo "</thead>";
  	echo "<tbody>";
  	$i=1;
	while($rs=$StrDB->FetchData($Sql)) {
		echo "<tr style=\"background:#fff;\">";
		echo "<td  style=\"text-align:center\"  width=\"5%\">$i</td>";
		echo "<td  width=\"40%\">$rs[Pro_name]</td>";
		echo "<td  style=\"text-align:center\" width=\"5%\">$rs[Pur_amount]</td>";
		echo "<td  style=\"text-align:center\" width=\"7%\">".number_format($rs[Pur_price])."</td>";
		echo "<td    style=\"text-align:center\"  width=\"5%\">$rs[Pur_remain]</td>";
		echo "<td  width=\"5%\">".number_format($rs[Pur_total])."</td>";
	 	echo "<td  width=\"5%\"> ";
	 	$num=$StrDB->NumRows("select Pro_id from product where Pro_id='".$rs['Pro_id']."' ");
	 	if($num<=0){
	 	echo "<a href=\"".WebUrl."admin/index.php?action=product&section=add&id=$rs[Id]\" class=\"btn btn-warning\"  >เพิ่มสินค้า</a>";
		 }else{
		 echo "<a href=\"#\" class=\"btn btn-danger disabled\">เพิ่มแล้ว</a>";
		 }
	 	echo "</td>";
		echo "</tr>";
	$i++;
	}
	echo "</tbody>";
	echo "</table>";
	break;
	endswitch;
	}else{

		$StrDisplay->Title_Form(preproduct);
		echo "<div style=\"float:right\">
		<a class=\"btn btn-small btn btn-info\" href=\"".WebUrl."admin/module/print_preproduct.php\" target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานการสั่งซื้อ</a>
		<a class=\"btn btn-small btn btn-success\" href=\"".WebUrl."admin/module/print_reciveproduct.php\"  target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานการรับสินค้า</a>
		<a class=\"btn btn-small btn btn-danger\" href=\"".WebUrl."admin/module/print_unreciveproduct.php\"  target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานยังไม่รับสินค้า</a>
		</div>";
		
		echo "<table id=\"TableData\" width=\"100%\"    cellpadding=\"1\" cellspacing=\"1\" border=\"1\" bordercolor=\"#E9E9E9\"   >";
		echo "<thead>";
		echo "<th width=\"5%\">#</th>";
		echo "<th width=\"40%\">".ListName."</th>";
	 	echo "<th width=\"10%\">ยอดรวมที่สั่ง</th>";
	 	echo "<th width=\"10%\">วันที่สั่ง</th>";
	 	echo "<th width=\"10%\">สถานะ</th>";
	 	echo "<th width=\"15%\">ตัวแทนจำหน่าย</th>";
		echo "<th width=\"15%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select * from $tb order by Pur_id desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[1]</td>";
	 	echo "<td>".number_format($rs[3])."</td>";
	 	echo "<td>"; echo $StrDisplay->DateTh($rs[2]); echo "</td>";
	 	echo "<td  align=\"center\">";
	 	switch ($rs[4]) {
	 		case '0': echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=reciveproduct&id=$rs[0]\" class=\"btn btn-danger\" >ยังไม่รับ</a>";break;
	 		case '1': echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=showproduct&id=$rs[0]\" class=\"btn btn-success\" >รับแล้ว</a>";break;
	 	} 
	 	echo "</td>";
	 	echo "<td>";
	 	 echo $StrDB->ConName("agent","Agt_id","Agt_name",$rs[5]);
	 	echo "</td>";
		echo "<td align=\"center\">
		<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[0]\"><i class=\"icon-edit\" title=\"แก้ไข\"></i>
			</a> | ";
 		echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=del&id=$rs[0]\"  onClick=\"return confirm('ต้องการลบจริงหรือไม่ ?')\">";
		echo " <i class=\"icon-trash\"></i></td>";
		echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";



	}
?>
 
