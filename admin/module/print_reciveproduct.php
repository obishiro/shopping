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
$tb="purchase";
$html="<div style=\"text-align:center\"><h2>รายงาน การได้รับสินค้า</h2></div>";
$html.= "<table id=\"TableData\" width=\"100%\"    cellpadding=\"0\" cellspacing=\"0\" border=\"1\" bordercolor=\"#E9E9E9\"   >";
		$html.="<tr>" ;
		$html.= "<td height=32 widtd=\"5%\">#</td>";
		$html.= "<td widtd=\"40%\">".ListName."</td>";
	 	$html.= "<td widtd=\"10%\">ยอดรวมที่สั่ง</td>";
	 	$html.= "<td widtd=\"10%\">วันที่สั่ง</td>";
	 	$html.= "<td widtd=\"10%\">สถานะ</td>";
	 	$html.= "<td widtd=\"15%\">ตัวแทนจำหน่าย</td>";
	 	$html.="</tr>" ;
		 
		$html.= "<tbody>";
		$sql="select * from $tb where Pur_status='1' order by Pur_id desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		$html.= "<tr>";
		$html.= "<td align=\"center\">$i</td>";
		$html.= "<td>$rs[1]</td>";
	 	$html.= "<td>".number_format($rs[3])."</td>";
	 	$html.= "<td>"; $html.= $StrDisplay->DateTh($rs[2]); $html.= "</td>";
	 	$html.= "<td  align=\"center\">";
	 	switch ($rs[4]) {
	 		case '0': $html.= "ยังไม่รับ";break;
	 		case '1': $html.= "รับแล้ว";break;
	 	} 
	 	$html.= "</td>";
	 	$html.= "<td>";
	 	 $html.= $StrDB->ConName("agent","Agt_id","Agt_name",$rs[5]);
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

$name="รายงานการรับสินค้า".date("dmYHis");
//$mpdf->Output($txt_period.'.pdf','I');
$mpdf->Output($name.'.pdf','I');
exit;


?>