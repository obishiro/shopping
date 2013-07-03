<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="tb_config_web";

switch($_GET['section'])  {
	case 'add':
if($_POST['adddata']) {
		 
	 	$file=$_FILES['file_img']['tmp_name'];
		$file_name=$_FILES['file_img']['name'];
		$file_size=$_FILES['file_img']['size'];
		$file_type=$_FILES['file_img']['type'];
		$array_last=explode(".",$file_name);
		$c=count($array_last)-1;
		$lst=strtolower($array_last[$c]) ;
		$rname=$StrDB->randName(6);
		$newname=$rname.".".$lst;

		@list($width, $height) = @getimagesize($file);;
		if ($width>1000 || $height>250){
		print "<script>";
		print "alert('".ErrImgBanner." 1000 x 200 pixel'); ";
		print "location.href='javascript:history.back();'";
		print "</script>";	
		exit();
		}
	 
			 
		
		 
		copy($file,"../img_banner/".$newname);
 	 	$StrDB->InsertData($tb," '".NULL."'
			,'".$newname."'
			,'3.gif'
			,'48.png'
			,'".$_POST['txt-hmenucolor']."'
			,'".$_POST['txt-menucolor']."'
			,'".$_POST['txt-hvmenucolor']."'
			,'".$_SESSION['UsrId']."'
		 
			");
 	 
  
	 	$StrDisplay->AddSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
 
	}
	break;
	case 'edit':
		if($_POST['editdata']) {
		 
	 	if($_FILES['file_img']['tmp_name']!=0 || $_FILES['file_img']['tmp_name'] !="") {
	 		$rs=$StrDB->GetData("$tb","where User='".$_SESSION['UsrId']."'");
	 		 $StrDisplay->DelFile($rs['Banner'],'img_banner'); 
	 		 $file=$_FILES['file_img']['tmp_name'];
		$file_name=$_FILES['file_img']['name'];
		$file_size=$_FILES['file_img']['size'];
		$file_type=$_FILES['file_img']['type'];
		$array_last=explode(".",$file_name);
		$c=count($array_last)-1;
		$lst=strtolower($array_last[$c]) ;
		$rname=$StrDB->randName(6);
		$newname=$rname.".".$lst;

		@list($width, $height) = @getimagesize($file);;
		if ($width>1000 || $height>250){
		print "<script>";
		print "alert('".ErrImgBanner." 1000 x 200 pixel'); ";
		print "location.href='javascript:history.back();'";
		print "</script>";	
		exit();
		}
		copy($file,"../img_banner/".$newname);

		$StrDB->UpdateData($tb,"  
			Banner='".$newname."'
		 
			,HmenuColor='".$_POST['txt-hmenucolor']."'
			,MenuColor='".$_POST['txt-menucolor']."'
			,HvmenuColor='".$_POST['txt-hvmenucolor']."'"
			," where User='".$_SESSION['UsrId']."'
		 
			");

	 	}else{
	 		$StrDB->UpdateData($tb,"  
			HmenuColor='".$_POST['txt-hmenucolor']."'
			,MenuColor='".$_POST['txt-menucolor']."'
			,HvmenuColor='".$_POST['txt-hvmenucolor']."'"
			," where User='".$_SESSION['UsrId']."'
		 
			");


	 	}

	 	 


		$StrDisplay->EditSuccess();
		 $StrDisplay->GoUrl('3',"index.php?action=".$action);
 
	}
	break;
	case 'editbg':
	$StrDB->UpdateData($tb,"ImgBg='".$_GET['val']."'  ","where User='".$_SESSION['UsrId']."' ");
	$StrDisplay->EditSuccess();
		 $StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
	case 'editmenu':
	$StrDB->UpdateData($tb,"ImgMenu='".$_GET['val']."'  ","where User='".$_SESSION['UsrId']."' ");
	$StrDisplay->EditSuccess();
		 $StrDisplay->GoUrl('3',"index.php?action=".$action);
	break;
}







if($StrDB->NumRows("select Id from $tb where User='".$_SESSION['UsrId']."' ")>"0") {
	$rs=$StrDB->GetData("$tb","where User='".$_SESSION['UsrId']."'");
	$form_type="2";
	$section="edit";
	$Disable="Disable";
	$img="<img src=\"".WebUrl."img_banner/".$rs['Banner']."\" class=\"img-polaroid\" style=\"height:250px\" width=\"1000\">";
	}else{
	$form_type="1";
	$section="add";
	$img="<img src=\"".WebUrl."images/no_image_icon.gif\" class=\"img-polaroid\" >";

	}

$StrDisplay->Open_Form("admin/index.php?action=".$action."&section=".$section);
$StrDisplay->Title_Form(ImgBanner,$form_type);
 
$StrDisplay->TxtInputFile(ImgBanner,'file_img');
echo "<center>".$img."</center>";
$StrDisplay->Title_Form(ImgBg);
echo '<div class="control-group"   >';
$StrDisplay->TxtInputColor(HeadMenuColor,'txt-hmenucolor',$rs['HmenuColor']);
$StrDisplay->TxtInputColor(MenuColor,'txt-menucolor',$rs['MenuColor']);
$StrDisplay->TxtInputColor(MenuHoverColor,'txt-hvmenucolor',$rs['HvmenuColor']);


echo '</div>';
$StrDisplay->Button_Form("$form_type",$_SESSION['UsrId']);
$StrDisplay->Title_Form(ImgMenu);
echo '<div class="control-group"   >';
 	
$allowed_types=array('jpg','jpeg','gif','png');
$dir    ="../img_menu/";
$files1 = scandir($dir);
$total=0; // นับจำนวนรูปทั้งหมด
$pic_path=array();
foreach($files1 as $key=>$value){
	if($key>1){
		$file_parts = explode('.',$value);
		$ext = strtolower(array_pop($file_parts));
		if(in_array($ext,$allowed_types)){
			$pic_path[]=$dir.$value;
			$total++;
			
		}

	}
}
// จำนวนรายการที่ต้องการแสดง แต่ละหน้า
 
	$perPage=$total;
 

// คำนวณจำนวนหน้าทั้งหมด
$num_naviPage=ceil($total/$perPage);

// กำหนดจุดเริ่มต้น และสิ้นสุดของรายการแต่ละหน้าที่จะแสดง
if(!isset($_GET['page'])){
	$s_key=0;
	$e_key=$perPage;	
	$_GET['page']=1;
}else{
	$s_key=($_GET['page']*$perPage)-$perPage;
	$e_key=$perPage*$_GET['page'];
	$e_key=($e_key>$total)?$total:$e_key;
}
/*for($i=1;$i<=$num_naviPage;$i++){
	echo "  || <a href=\"?page=".$i."\">Page $i</a>";	
}
echo "<hr>";*/

// แสดงรายการ

for($indexPicture=$s_key;$indexPicture<$e_key;$indexPicture++){
		$img=explode("/",$pic_path[$indexPicture] );

		echo "<div style=\"padding:15px;float:left;text-align:center\">";
		//echo "<input type=\"radio\" name=\"bt_imgmenu[]\" class=\"validate[required]\"   value=\"".$img['2']."\"/>";
				echo "<img  class=\"img-polaroid\" width=\"16\" style=\"height:16px\" src='".$pic_path[$indexPicture]."' />";
				echo "<br><p><a  onClick=\"return confirm('".rusureUse."')\" href=\"".WebUrl."admin/index.php?action=".$action."&section=editmenu&val=".$img['2']."\" class=\"btn btn-info\">".UseTheme."</a></p>";	
		echo "</div>";
}
echo '   </div>';
$StrDisplay->Title_Form(ImgBg);
echo '<div class="control-group"   >';
 	
$allowed_types=array('jpg','jpeg','gif','png');
$dir    ="../img_bgimages/";
$files1 = scandir($dir);
$total=0; // นับจำนวนรูปทั้งหมด
$pic_path=array();
foreach($files1 as $key=>$value){
	if($key>1){
		$file_parts = explode('.',$value);
		$ext = strtolower(array_pop($file_parts));
		if(in_array($ext,$allowed_types)){
			$pic_path[]=$dir.$value;
			$total++;
			
		}

	}
}
// จำนวนรายการที่ต้องการแสดง แต่ละหน้า
 
	$perPage=$total;
 

// คำนวณจำนวนหน้าทั้งหมด
$num_naviPage=ceil($total/$perPage);

// กำหนดจุดเริ่มต้น และสิ้นสุดของรายการแต่ละหน้าที่จะแสดง
if(!isset($_GET['page'])){
	$s_key=0;
	$e_key=$perPage;	
	$_GET['page']=1;
}else{
	$s_key=($_GET['page']*$perPage)-$perPage;
	$e_key=$perPage*$_GET['page'];
	$e_key=($e_key>$total)?$total:$e_key;
}
/*for($i=1;$i<=$num_naviPage;$i++){
	echo "  || <a href=\"?page=".$i."\">Page $i</a>";	
}
echo "<hr>";*/

// แสดงรายการ

for($indexPicture=$s_key;$indexPicture<$e_key;$indexPicture++){
		$img1=explode("/",$pic_path[$indexPicture] );
	 
		echo "<div style=\"padding:15px;float:left;text-align:center\">";
		//echo "<input type=\"radio\"  name=\"bt_imgbg[]\" value=\"".$img1['2']."\"/>";
				echo "<img src='".$pic_path[$indexPicture]."' width=\"50\" class=\"img-polaroid\" style=\"height:50px\">";	
				echo "<br><p><a  onClick=\"return confirm('".rusureUse."')\" href=\"".WebUrl."admin/index.php?action=".$action."&section=editbg&val=".$img1['2']."\" class=\"btn btn-primary\">".UseTheme."</a></p>";
		echo "</div>";
}
echo '   </div>';


	$StrDisplay->Close_Form();
// แสดงหน้าปัจจุบัน
//echo "<div><br>Page:".$_GET['page']."</div>";
?>