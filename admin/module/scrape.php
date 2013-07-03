<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="product";
 
if(isset($_GET['section'])){
	switch($_GET['section']):
	case 'add':
	 
		 
		$StrDisplay->GoUrl('0',"index.php?action=product");
 
 
 
	break;
 
	 
	case 'del':
		 
		$StrDB->DelData("scrape_detail"," where Id='".addslashes($_GET['id'])."' ");
		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	/*case 'edit':
	if($_POST['adddata']) {
		//echo $_POST['txt-id'];
		$rs=$StrDB->GetData($tb,"where Id='".$_GET['id']."'");
		$TotalUnit=$rs[Pro_unit]-$_POST['txt-num'];
		$StrDB->UpdateData($tb,"Pro_unit='".$TotalUnit."',Scrape_status='1' ","where Id='".addcslashes($_GET[id])."' ");
		$StrDB->InsertData("Scrape_detail","
			'".NULL."'
			,'".$_GET[id]."'
			,'".$_POST['txt-num']."'
			,'".$_POST['txt-detail']."'
			,'".date("Y-m-d")."'
			");
		$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);

	}
	$rs=$StrDB->GetData($tb,"where Id='".addslashes($_GET[id])."'");
	$rscut=$StrDB->GetData("Scrape_detail","where Pro_id='".addslashes($_GET[id])."'");
	$StrDisplay->Title_Form("การตัด".Product,'3');
		$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	 
	 
	$StrDisplay->TxtInputDisable('รหัสสินค้า','txt-code',$rs['Pro_id']);
	$StrDisplay->TxtInputDisable('ชื่อสินค้า','txt-name',$rs['Pro_name']);
  		echo '<div class="control-group" style="width:500px;"  >';
  		 echo '<label class="control-label"  >รูปสินค้า :</label>';
   		echo '<div class="controls">';
 		 echo "<img src=\"".WebUrl."img_product/$rs[Pro_img]\" width=\"200\"  class=\"img-polaroid\"  style=\"height:220px\"   alt=\"$rs_product[Pro_name]\" /></a>";
        
 		echo '</div>  </div>';

  	  
	$StrDisplay->TxtInputDisable('ราคาสินค้า','txt-price',$rs[Pro_price]);
 	$StrDisplay->TxtInputArea("สาเหตุการตัดสินค้า","txt-detail",$rscut[Scrape_reason]);
 	$StrDisplay->TxtInput("จำนวนที่ตัด","txt-num",$rscut[Scrape_amount]);
 	$StrDisplay->TxtHidden("txt-id",$_GET[id]);
  
	$StrDisplay->Button_Form('1');
	$StrDisplay->Close_Form();
	break; */
	endswitch;
	}else{
		$StrDisplay->Title_Form(scrape);
		echo "<div style=\"float:right\"><a class=\"btn btn-small btn btn-info\" href=\"".WebUrl."admin/module/print_scrape.php\" target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงาน</a></div>";
		echo "<table id=\"TableData\" width=\"100%\"  border=\"1\" cellpadding=\"1\" cellspacing=\"1\"   bordercolor=\"#E9E9E9\"  >";
		echo "<thead>";
		echo "<th width=\"5%\">#</th>";
		echo "<th width=\"10%\">รหัสสินค้า</th>";
		echo "<th width=\"\">".ListName."</th>";
		echo "<th width=\"10%\">สาเหตุที่ตัด</th>";
		echo "<th width=\"10%\">จำนวนที่ตัด</th>";
		echo "<th width=\"15%\">หมวดหมู่สินค้า</th>";

		echo "<th width=\"10%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select $tb.*,scrape_detail.* from $tb inner join scrape_detail on $tb.Id=scrape_detail.Pro_id   order by scrape_detail.Pro_id  desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[1]</td>";
		echo "<td><a  href=\"\" rel=\"tooltip\" title=\"$rs[3]\" >$rs[2]</a></td>";
		echo "<td  align=\"center\">$rs[Scrape_reason]</td>";
		echo "<td  align=\"center\">$rs[Scrape_amount]";
	 	echo "</td>";
		echo "<td align=\"center\">";
		   $type=$StrDB->ConName("product_type","Pro_type_id","Pro_type_name",$rs[7]);
		  echo $type;
		echo "</td>";
		echo "<td align=\"center\">";
		 
		/*<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[Id]\"><i class=\"icon-edit\" title=\"แก้ไข\"></i>
			</a> | ";*/
 		echo "<a href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=del&id=$rs[Id]\"  onClick=\"return confirm('ต้องการลบจริงหรือไม่ ?')\">";
		echo " <i class=\"icon-trash\"></i></td>";
		echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";



	}
?>
 
