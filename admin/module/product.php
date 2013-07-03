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
	if($_POST['adddata']) {

			$StrDB->InsertData($tb," ''
			,'".$_POST['txt-code']."'
			,'".$_POST['txt-name']."'
			,''
			,'".$_POST['txt-detail']."'
			,'".$_POST['txt-price']."'
			,'".$_POST['txt-unit']."'
			,'".$_POST['txt-cat']."','0','','','".$_SESSION['UsrId']."'
		 
			");
			$ImgId=$StrDB->GetData($tb,"  order by Id desc limit 0,1");

		Foreach ($_FILES["file"]["error"] as $key => $error) {			 
                            if($error==0)    {

	 	 $images = $_FILES["file"]["tmp_name"][$key];
                                $new_images = $_FILES["file"]["name"][$key];
		 $array_last=explode(".",$new_images);
			$c=count($array_last)-1;
			$lst=strtolower($array_last[$c]) ;
		  $new_images=$StrDB->randName("6");
		 $MfilesP=$new_images.".".$lst;

		 @list($width, $height) = @getimagesize($images);;
		if ($width>600 || $height>680){
			 $width=600; //*** Fix Width & Heigh (Autu caculate) ***//
         $size=@GetimageSize($images);
         $height=680;
         $images_orig = @ImageCreateFromJPEG($images);
        $photoX = @ImagesX($images_orig);
        $photoY = @ImagesY($images_orig);
         $images_fin = @ImageCreateTrueColor($width, $height);
		 @ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
 

         @ImageJPEG($images_fin,"../img_product/".$MfilesP);
         @ImageDestroy($images_orig);
         @ImageDestroy($images_fin);
         
          $width=180; //*** Fix Width & Heigh (Autu caculate)  
         $size=@GetimageSize($images);
         $height=220;
         $images_orig = @ImageCreateFromJPEG($images);
        $photoX = @ImagesX($images_orig);
        $photoY = @ImagesY($images_orig);
         $images_fin = @ImageCreateTrueColor($width, $height);
		 @ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
 

         ImageJPEG($images_fin,"../img_thumb/".$MfilesP);
         ImageDestroy($images_orig);
         ImageDestroy($images_fin);
        
    	 }else{
    	 	 @copy($_FILES["file"]["tmp_name"][$key],"../img_product/".$MfilesP);
                  $width=180; //*** Fix Width & Heigh (Autu caculate)  
         $size=@GetimageSize($images);
         $height=220;
         $images_orig = @ImageCreateFromJPEG($images);
        $photoX = @ImagesX($images_orig);
        $photoY = @ImagesY($images_orig);
         $images_fin = @ImageCreateTrueColor($width, $height);
		 @ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
 

         ImageJPEG($images_fin,"../img_thumb/".$MfilesP);
         ImageDestroy($images_orig);
         ImageDestroy($images_fin);
    	 }
/*
         $width=180; //*** Fix Width & Heigh (Autu caculate)  
         $size=@GetimageSize($images);
         $height=220;
         $images_orig = @ImageCreateFromJPEG($images);
        $photoX = @ImagesX($images_orig);
        $photoY = @ImagesY($images_orig);
         $images_fin = @ImageCreateTrueColor($width, $height);
		 @ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
 

         @ImageJPEG($images_fin,"../img_thumbproduct/".$MfilesP);
         @ImageDestroy($images_orig);
         @ImageDestroy($images_fin);*/
   		 $StrDB->InsertData("tb_imgproduct","'".NULL."','".$MfilesP."','".$ImgId['Id']."','".$_SESSION['UsrId']."' ");

    }
}
		 
	 
	 
		$StrDisplay->AddSuccess();
		 $StrDisplay->GoUrl('3',"index.php?action=".$action);
 
	}
	$StrDisplay->Title_Form(Product,'1');
	$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	$Pro_id=$StrDB->randName("6");
  	$StrDisplay->OpenSelectInput(category,'txt-cat');
 	$StrDB->ListBoxData('product_type','*','where user='.$_SESSION['UsrId'].' order by Pro_type_name asc','Pro_type_id','Pro_type_name');
  	$StrDisplay->CloseSelectInput();
	$StrDisplay->TxtInput(ProductId,'txt-code',$Pro_id);
	$StrDisplay->TxtInput(ProductName,'txt-name');
 	//$StrDisplay->TxtInput(ProductPriceBegin,'txt-bitprice');
	$StrDisplay->TxtInput(ProductPrice,'txt-price','','1');
	$StrDisplay->TxtInput(ProductAmount,'txt-unit','','1');
	for($i=0;$i<=4;$i++):
	$StrDisplay->TxtInputFile(ProductImg,'file[]','file'.$i,"");
	echo "<div id=\"re0\"></div>";
	endfor;

	$StrDisplay->TxtInputArea(ProductDetail,"txt-detail",'',"750","500","1");
 
 	$StrDisplay->Button_Form('1');
	$StrDisplay->Close_Form();
 
	break;
	case 'edit':
	if($_POST['editdata']) {
		 $rs=$StrDB->GetData($tb,"where Id='".$_POST['editdata']."'");
		    if($_FILES['file']['tmp_name']=="" || $_FILES['file']['tmp_name']=="0") {
    		  $Img=$rs['Pro_img'];
      
    		}else{
		 
     		  $Img=$StrDB->UploadFile('../img_product'); 
     		 $StrDisplay->DelFile($_POST['oimg'],'../img_product');  
   		 }

		$StrDB->UpdateData($tb,"
		Pro_id='".$_POST['txt-code']."'
		,Pro_name='".$_POST['txt-name']."'
	 	,Pro_price='".$_POST['txt-price']."'
	 	,Pro_type_id='".$_POST['txt-cat']."'
	 	,Pro_detail='".$_POST['txt-detail']."'
		,Pro_img='".$Img."'

		 ","where Id='".mysql_real_escape_string($_POST['editdata'])."' and User='".$_SESSION['UsrId']."' ");
		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	}
	$rs=$StrDB->GetData($tb,"where Id='".addslashes($_GET[id])."'");
	$StrDisplay->Title_Form(Product,'2');
		$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
	 $StrDisplay->OpenSelectInput(category,'txt-cat');
 	$StrDB->ListBoxData('product_type','*','where User='.$_SESSION['UsrId'].' order by Pro_type_name asc','Pro_type_id','Pro_type_name','edit',$rs['Pro_type_id']);
  	$StrDisplay->CloseSelectInput();
	$StrDisplay->TxtInputDisable(ProductId,'txt-code',$rs['Pro_id']);
	$StrDisplay->TxtInput(ProductName,'txt-name',$rs['Pro_name']);
 	//$StrDisplay->TxtInput(ProductPriceBegin,'txt-bitprice',$rs[]);
	$StrDisplay->TxtInput(ProductPrice,'txt-price',$rs['Pro_price'],'1');
	$StrDisplay->TxtInput(ProductAmount,'txt-unit',$rs['Pro_unit'],'1');
	for($i=0;$i<=4;$i++):
	$StrDisplay->TxtInputFile(ProductImg,'file[]','file'.$i,"");
	echo "<div id=\"re0\"></div>";
	endfor;

	$StrDisplay->TxtInputArea(ProductDetail,"txt-detail",$rs['Pro_detail'],"750","500","1");
 
	 
	$StrDisplay->Button_Form('2',$_GET[id]);
	$StrDisplay->Close_Form();
	break;
	case 'del':

		 $rs=$StrDB->GetData($tb,"where Id='".$_GET['id']."'");
		   $sqlImg=$StrDB->Query("select ImgName from tb_imgproduct where Pro_id='".$rs['Id']."' ");
   	while ($rs_img1=$StrDB->FetchData($sqlImg)) {	 
		  $StrDisplay->DelFile($rs_img1['ImgName'],'../img_thumb');  
		  $StrDisplay->DelFile($rs_img1['ImgName'],'../img_product');
		  $StrDB->DelData("tb_imgproduct"," where Id='".mysql_real_escape_string($_GET['id'])."' ");  
		}
		$StrDB->DelData($tb," where Id='".mysql_real_escape_string($_GET['id'])."' ");


		$StrDisplay->DelSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
 
	endswitch;
	}else{
		$StrDisplay->Title_Form(Product);
		echo "<div style=\"float:right\"><a class=\"btn btn-small btn btn-info\" href=\"".WebUrl."admin/module/print_product.php\" target=\"_blank\"><i class=\"icon-print\"></i> ออกรายงาน</a></div>";
		echo "<table id=\"TableData\" width=\"100%\"  border=\"1\" cellpadding=\"1\" cellspacing=\"1\"   bordercolor=\"#E9E9E9\"  >";
		echo "<thead>";
		echo "<th width=\"5%\">#</th>";
		echo "<th width=\"10%\">".ProductId."</th>";
		echo "<th width=\"\">".ProductName."</th>";
		echo "<th width=\"10%\">".ProductPrice."</th>";
		echo "<th width=\"10%\">".ProductAmount."</th>";
		echo "<th width=\"15%\">".category."</th>";

		echo "<th width=\"10%\">".Tools."</th>";
		echo "</thead>";
		echo "<tbody>";
		$sql="select * from $tb  where User='".$_SESSION['UsrId']."'  order by Id desc";
		$query=$StrDB->Query($sql);

		while($rs=$StrDB->FetchData($query)) {
		echo "<tr>";
		echo "<td align=\"center\">$i</td>";
		echo "<td>$rs[1]</td>";
		echo "<td><a  href=\"\" rel=\"tooltip\" title=\"$rs[3]\" >$rs[2]</a></td>";
		echo "<td  align=\"center\">$rs[5]</td>";
		echo "<td  align=\"center\">$rs[6]";
	 	echo "</td>";
		echo "<td align=\"center\">";
		   $type=$StrDB->ConName("product_type","Pro_type_id","Pro_type_name",$rs[7]);
		  echo $type;
		echo "</td>";
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
 
