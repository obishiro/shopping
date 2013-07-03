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
$tb="product";
$html="<div style=\"text-align:center\"><h2>รายงาน ".scrapet."</h2></div>";
$html.= "<table id=\"TableData\" width=\"100%\"  border=\"1\" cellpadding=\"0\" cellspacing=\"0\"   bordercolor=\"#E9E9E9\"  >";
		$html.= "<tr>";
		$html.= "<td height=32 widtd=\"5%\">#</td>";
		$html.= "<td widtd=\"10%\">รหัสสินค้า</td>";
		$html.= "<td widtd=\"\">".ListName."</td>";
		$html.= "<td widtd=\"10%\">สาเหตุที่ตัด</td>";
		$html.= "<td widtd=\"10%\">จำนวนที่ตัด</td>";
		$html.= "<td widtd=\"15%\">หมวดหมู่สินค้า</td>";

	 
		$html.= "</tr>";
		$html.= "<tbody>";
		$sql="select $tb.*,scrape_detail.* from $tb inner join scrape_detail on $tb.Id=scrape_detail.Pro_id   order by scrape_detail.Pro_id  desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		$html.= "<tr>";
		$html.= "<td align=\"center\">$i</td>";
		$html.= "<td>$rs[1]</td>";
		$html.= "<td> $rs[2] </td>";
		$html.= "<td  align=\"center\">$rs[Scrape_reason]</td>";
		$html.= "<td  align=\"center\">$rs[Scrape_amount]";
	 	$html.= "</td>";
		$html.= "<td align=\"center\">";
		   $type=$StrDB->ConName("product_type","Pro_type_id","Pro_type_name",$rs[7]);
		  $html.= $type;
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

$name="รายงาน".scrape.date("dmYHis");
//$mpdf->Output($txt_period.'.pdf','I');
$mpdf->Output($name.'.pdf','I');
exit;


?>