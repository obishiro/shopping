<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="order_product";
 
if(isset($_GET['section'])){
	switch($_GET['section']):
	 case 'cus_confirm':
	 $StrDB->UpdateData($tb,"Order_status='2' ","where Order_id='".addslashes($_GET['id'])."' ");
	 $StrDisplay->AddSuccess();
	 $StrDisplay->GoUrl('3',"index.php?action=".$action);
	 break;
	 case 'confirm':
	 $StrDB->UpdateData($tb,"Order_status='2' ","where Order_id='".addslashes($_GET['id'])."' ");
	  $StrDisplay->AddSuccess();
	 $StrDisplay->GoUrl('3',"index.php?action=".$action);
	 break;
	  case 'send_confirm':
	  if($_POST['editdata']) {
	 $StrDB->UpdateData($tb,"Order_send='1' ,Order_datesend='".date("Y-m-d")."',ems_id='".$_POST['txt-name']."' ","where Order_id='".$_POST['editdata']."' ");
	 $StrDisplay->AddSuccess();
	 $StrDisplay->GoUrl('3',"index.php?action=".$action);
	}
	 $StrDisplay->Title_Form(sell,'2');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$StrDisplay->TxtInput('หมายเลขส่งพัสดุ','txt-name');
 	
	$StrDisplay->Button_Form('2',$_GET[id]);
	$StrDisplay->Close_Form();
	 break;
	case 'del':
	 
		$StrDB->DelData($tb," where Order_id='".addslashes($_GET['id'])."' ");
		$StrDB->DelData("order_detail"," where Order_id='".addslashes($_GET['id'])."' ");
		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	endswitch;
	}else{
		$StrDisplay->Title_Form(sell);
		echo "<div style=\"float:right\">
		<a class=\"btn btn-small btn btn-info\" href=\"".WebUrl."admin/module/print_sell.php\" target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานการขาย</a>
		<a class=\"btn btn-small btn btn-success\" href=\"".WebUrl."admin/module/print_recivemoney.php\"  target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานการชำระเงิน</a>
		<a class=\"btn btn-small btn btn-danger\" href=\"".WebUrl."admin/module/print_unrecivemoney.php\"  target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานยังไม่ชำระเงิน</a>
		<br><br>
		<a class=\"btn btn-small btn btn-info\" href=\"".WebUrl."admin/module/print_takemoney.php\" target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานการแจ้งชำระเงิน</a>
		<a class=\"btn btn-small btn btn-success\" href=\"".WebUrl."admin/module/print_sendproduct.php\"  target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานการจัดส่งสินค้า</a>
		<a class=\"btn btn-small btn btn-danger\" href=\"".WebUrl."admin/module/print_unsendproduct.php\"  target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงานยังไม่จัดส่งสินค้า</a>
		

		</div>";
		echo "<table id=\"TableData\" width=\"100%\"  border=\"1\" cellpadding=\"1\" cellspacing=\"1\"   bordercolor=\"#E9E9E9\"  >";
		echo "<thead>";
		echo "<th width=\"5%\">#</th>";
		echo "<th width=\"10%\">รหัสการสั่งซื้อ</th>";
		echo "<th width=\"\">ชื่อผู้สั่งสินค้า</th>";
		echo "<th width=\"10%\">ราคาสินค้า</th>";
		echo "<th width=\"10%\">วันที่สั่งซื้อ</th>";
		echo "<th width=\"12%\">จ่ายผ่าน</th>";
		echo "<th width=\"12%\">สถานะ</th>";
		echo "<th width=\"12%\">จัดส่งสินค้า</th>";
		echo "<th width=\"7%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select $tb.*,customer.Cus_name,customer.Cus_surname
		  from $tb inner join customer   on $tb.Cus_id=customer.Cus_id
		   order by $tb.Id desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[1]</td>";
		echo "<td><a  href=\"\">$rs[Cus_name] $rs[Cus_surname]</a></td>";
		echo "<td  align=\"center\">".number_format($rs[Order_total])."</td>";
		echo "<td  align=\"center\">";
		echo $StrDisplay->DateTh($rs[Order_date]);
	 	echo "</td>";
		echo "<td align=\"center\">";
		   $type=$StrDB->ConName("account","Id","Acc_bank",$rs[Acc_id]);
		  echo $type;
		echo "</td>";
		echo "<td  align=\"center\">";
		switch ($rs[Order_status]) {
			case '0':echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=cus_confirm&id=$rs[Order_id]\" class=\"btn btn-danger\" style=\"color:#fff\" onClick=\"return confirm('ยืนยันการแจ้งชำระเงินจากลูกค้า')\">ยังไม่ชำระเงิน !</a>";break;
			
			case '1': 
				echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=confirm&id=$rs[Order_id]\"   class=\"btn btn-primary\" style=\"color:#fff\">ลูกค้าแจ้งแล้ว !</a>";		 
				break;
			case '2':
				echo "<a href=\"#\"   class=\"btn btn-success\" style=\"color:#fff\">ชำระเงินแล้ว !</a>";		 
				break;

					}
		echo "</td>";
		echo "<td  align=\"center\">";
	 	if ($rs[Order_status]=="0")  {
		echo "<a href=\"#\" class=\"btn btn-danger\" style=\"color:#fff\">ยังไม่ชำระเงิน!</a>";
	 	}else{
		switch ($rs[Order_send]) {
			case '0':echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=send_confirm&id=$rs[Order_id]\" class=\"btn btn-danger\" style=\"color:#fff\"  >ยังไม่จัดส่ง !</a>";break;
			
			case '1':
			$datesend=$StrDisplay->DateTh($rs[Order_datesend]);
			echo "<a href=\"index.php\"  title=\"วันที่จัดส่ง : $datesend\" class=\"btn btn-primary\" style=\"color:#fff\">จัดส่งแล้ว</a>"; break;
		  
		 	}
		 }
		echo "</td>";
		echo "<td align=\"center\">";
	 
 		echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=del&id=$rs[Order_id]\"  onClick=\"return confirm('ต้องการลบจริงหรือไม่ ?')\">";
		echo " <i class=\"icon-trash\"></i></td>";
		echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";



	}
?>
 
