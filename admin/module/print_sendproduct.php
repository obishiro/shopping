<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
include("../../class/config.php");
include("../../class/function.php");
include("../../class/display.php");
include("../../class/lang.php");
include("../../mpdf/mpdf.php");
$StrDB= new Db_Process();
$StrDisplay = new Web_Display();
$tb="order_product";
$html="<div style=\"text-align:center\"><h2>รายงานการจัดส่งสินค้า</h2></div>";
$html.= "<table id=\"TableData\" width=\"100%\"  border=\"1\" cellpadding=\"0\" cellspacing=\"0\"   bordercolor=\"#E9E9E9\"  >";
		$html.= "<tr>";
		$html.= "<td height=\"32\" widtd=\"5%\">#</td>";
		$html.= "<td widtd=\"10%\">รหัสการสั่งซื้อ</td>";
		$html.= "<td widtd=\"\">ชื่อผู้สั่งสินค้า</td>";
		$html.= "<td widtd=\"10%\">ราคาสินค้า</td>";
		$html.= "<td widtd=\"10%\">วันที่สั่งซื้อ</td>";
		$html.= "<td widtd=\"12%\">จ่ายผ่าน</td>";
		$html.= "<td widtd=\"12%\">สถานะ</td>";
		$html.= "<td widtd=\"12%\">จัดส่งสินค้า</td>";
	 
		$html.= "</tr>";
		$html.= "<tbody>";
		$sql="select $tb.*,customer.Cus_name,customer.Cus_surname
		  from $tb inner join customer   on $tb.Cus_id=customer.Cus_id
		   where $tb.Order_send='1'
		   order by $tb.Id desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		$html.= "<tr>";
		$html.= "<td align=\"center\">$i</td>";
		$html.= "<td>$rs[1]</td>";
		$html.= "<td>$rs[Cus_name] $rs[Cus_surname]</td>";
		$html.= "<td  align=\"center\">".number_format($rs[Order_total])."</td>";
		$html.= "<td  align=\"center\">";
		$html.= $StrDisplay->DateTh($rs[Order_date]);
	 	$html.= "</td>";
		$html.= "<td align=\"center\">";
		   $type=$StrDB->ConName("account","Id","Acc_bank",$rs[Acc_id]);
		  $html.= $type;
		$html.= "</td>";
		$html.= "<td  align=\"center\">";
		switch ($rs[Order_status]) {
			case '0':$html.= "ยังไม่ชำระเงิน ";break;
			
			case '1': 
				$html.= "ลูกแจ้งแล้ว ";		 
				break;
			case '2':
				$html.= "ชำระเงินแล้ว ";		 
				break;

					}
		$html.= "</td>";
		$html.= "<td  align=\"center\">";
	 	if ($rs[Order_status]=="0")  {
		$html.= "ยังไม่ชำระเงิน!";
	 	}else{
		switch ($rs[Order_send]) {
			case '0':$html.= "ยังไม่จัดส่ง !";break;
			
			case '1':
			$datesend=$StrDisplay->DateTh($rs[Order_datesend]);
			$html.= "จัดส่งแล้ว"; break;
		  
		 	}
		 }
		$html.= "</td>";
		 
		$html.= "</tr>";
			$i++;
		}
		$html.= "</tbody>";
		$html.= "</table>";

		$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

// LOAD a stylesheet
$stylesheet = file_get_contents('../../mpdf/mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
$mpdf=new mPDF('UTF-8'); 
$mpdf->SetAutoFont();
//$docname=$StrDisplay->GetDate($rs1[period_date],'2');
//$doc=$docname.".pdf";

$mpdf->WriteHTML($html,2);

$name="รายงานการจัดส่งสินค้า".date("dmYHis");
//$mpdf->Output($txt_period.'.pdf','I');
$mpdf->Output($name.'.pdf','I');
exit;


?>