<?php
session_start();
$StrDB= new Db_Process();
$StrDisplay= new Web_Display();
$StrLibCart = new LibCart();
include('common.inc.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$rs_config['MMWebTitle'];?></title>
<meta name="keywords" content="<?=$rs_config['MMWebKeyword'];?>" />
<meta name="description" content="<?=$rs_config['MMWebDetail'];?>" />
<script src="<?php echo WebUrl;?>assets/js/jquery.js" type="text/javascript"></script>
<link href="<?php echo WebUrl;?>template/default/templatemo_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WebUrl;?>assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo WebUrl;?>assets/css/ddsmoothmenu.css" />
<link rel="stylesheet" href="<?php echo WebUrl;?>assets/css/lightbox.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?php echo WebUrl;?>assets/css/styles.css" />
 
<script src="<?php echo WebUrl;?>assets/js/lightbox.js" type="text/javascript"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-tab.js"></script>
 <script src="<?php echo WebUrl;?>assets/js/jquery.jqzoom-core.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo WebUrl;?>assets/css/jquery.jqzoom.css" type="text/css">
 
<style>
	<?php
		$rs_style=$StrDB->GetData("tb_config_web","where User='".$_SESSION['WebUsrId']."' ");
		 
 
    echo "#home {";
   echo "background: url(".WebUrl."img_bgimages/".$rs_style['ImgBg']."".") repeat;";
   echo " }";
 
   echo "#sidebar h3 {
	font-size: 16px;
	padding: 0 0 5px 0;
	margin: 0 0 15px 0;
	color:  ".$rs_style['HmenuColor'].";
	font-weight: bold; 
	background: url(images/sidebar_header_bg.png)  left bottom no-repeat
}";
echo ".sidebar_menu li {
	margin: 0;
	padding: 2px 0 3px 20px;
	background: url(".WebUrl."img_menu/".$rs_style['ImgMenu'].") no-repeat scroll 0px 5px;
	border-bottom: 1px dotted #ccc;
                 line-height:24px;   
}

.sidebar_menu li a {
	font-size: 14px;
	color: ".$rs_style['MenuColor'].";

}";
echo ".sidebar_menu li a:hover {
	font-size: 14px;
	color: ".$rs_style['HvmenuColor'].";

}";
echo "
#templatemo_middle {
	width: 960px;
	height: 250px;
 
	 background: url(".WebUrl."img_banner/".$rs_style['Banner'].") no-repeat 
}
";
    ?>
</style>
<script type="text/javascript">

$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
	
});


</script>
</head>

<body id="home">

<div id="templatemo_wrapper">
	 <div id="templatemo_header">
 
        
        <div id="header_right">
    
            <div class="cleaner"></div>
       
         </div>  
    </div>  
    
    <div id="templatemo_menu" class="ddsmoothmenu">
         
        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->
    
   <!-- END of middle -->
    
    <div id="templatemo_main_top"></div>
    <div id="templatemo_main">
    <div id="templatemo_middle">
        
    </div> 
        
        <div id="sidebar">
          <!--<h3 >เมนูหลัก</h3>-->
            <ul class="sidebar_menu">
              <li><a href="<?php echo WebUrl;?><?php echo $uri['0'];?>/"><?=home;?></a></li>
              <li><a href="<?php echo WebUrl;?><?php echo $uri['0'];?>/order"><?=HowToBuy;?></a></li>
              <li><a href="<?php echo WebUrl;?><?php echo $uri['0'];?>/sendproduct"><?=HowtoSendproduct;?></a></li>
              <li><a href="<?php echo WebUrl;?><?php echo $uri['0'];?>/contact"><?=Contact;?></a></li>
              <li><a href="<?php echo WebUrl;?><?php echo $uri['0'];?>/login"><?=login;?></a></li>
            </ul>
       
        	<h3 ><?=category;?></h3>

            <ul class="sidebar_menu" >
            <?php
      	$StrLibCart->ShowCategory($_SESSION['WebUsrId'],$uri['0']);
             ?>	
                  <h3 ><?=Member;?></h3>
            <? if(!$_SESSION['Usr_Customer']) { ?>
             <form class="form-signin" method="POST" action="<?php echo WebUrl;?><?php echo $uri['0'];?>/user_login">
        
        <input type="text" name="txt-username" class="input-block-level" placeholder="<?=TextEmailLogin;?>">
        <input type="password" name="txt-password" class="input-block-level" placeholder="<?=TextPassLogin;?>">
   
        <button class="btn btn-mini btn-primary" type="submit"><i class="icon-user icon-white"></i> <?=login;?></button>
              <a style="color:#fff" href="<?php echo WebUrl;?><?php echo $uri['0'];?>/register" class="btn btn-mini btn-warning">
          <i class="icon-envelope icon-white"></i> <?=Register;?>
        </a> 
      </form>
      <? }else{ 
              echo " <ul class=\"sidebar_menu\">";
              echo "<li><a href=\"".WebUrl."#\"> คุณ $_SESSION[UsrName]</a></li>";
              echo "<li><a href=\"".WebUrl."$uri[0]/editmember/$_SESSION[UsrId]\">แก้ไขข้อมูลส่วนตัว</a></li>";
              echo "<li><a href=\"".WebUrl."$uri[0]/addtocart\">ตะกร้าสินค้า</a></li>";
            
              echo "<li><a href=\"".WebUrl."$uri[0]/cart\">แจ้งการสั่งซื้อสินค้า</a></li>";
                 echo "<li><a href=\"".WebUrl."$uri[0]/logout\">".logout."</a></li>";
               echo "</ul>";
            } ?>
       
           </ul>
 
                      <h3><?=RandomProduct;?></h3>
             <div  >
                 <ul class="thumbnails">
                     
                 <?php
                 $reRandom=$StrLibCart->ShowRandomProduct($_SESSION['WebUsrId'],"5");
                   while($rsRandom=$StrDB->FetchData($reRandom)) { 
                       $Img=$StrDB->GetData("tb_imgproduct"," where Pro_id='".$rsRandom['Id']."' order by Id asc limit 0,1");
					
                     echo "<li  class=\"span3\">";
                   	echo "<a style=\" text-decoration: none; \" class=\"thumbnail\" href=\"".WebUrl."".$rs_config['MMWebName']."/view/$rsRandom[2]/$rsRandom[0]\">";
     	 echo "<img src=\"".WebUrl."img_product/".$Img['ImgName']."\" width=\"180\" style=\"height:185px\" class=\"img-polaroid\">";
                      echo "<h6>".$rsRandom['Pro_name']."</h6>";
                        echo "<p>".ProductPrice." <span style=\"font-size:18px\" class=\"label label-warning\">".number_format($rsRandom['Pro_price'])."</span> ".Currency."</p>";
     	     echo "<p><button class=\"btn btn-info\" >";
     	   echo "<i class=\"icon-white icon-zoom-in\"></i>".View_Product."</button>&nbsp;<button class=\"btn btn-danger\" >";
     	   echo "<i class=\"icon-white icon-eye-open\"></i> ".View_Count." (".number_format($rsRandom['Product_view']).")</button>";
     	echo "</p>";
    	echo "</a></li>";
                   }
                 ?>
                        
                 </ul>
             </div>
 
        </div> <!-- END of sidebar -->
        
        <div id="content">
        
		<?php
		if(empty($uri['1'])){
		//<!-- Show Product -->
		echo "<h3>".Title_Product."</h3>";
		echo "<ul class=\"thumbnails\">";
			
			 	 $re=$StrLibCart->ShowProduct($_SESSION['WebUsrId']);
				  while($rsproduct=$StrDB->FetchData($re)) { 
				  		$Img=$StrDB->GetData("tb_imgproduct"," where Pro_id='".$rsproduct['Id']."' order by Id asc limit 0,1");
					echo "<li class=\"span3\">";
   						echo "<a style=\" text-decoration: none; \" class=\"thumbnail\" href=\"".WebUrl."".$rs_config['MMWebName']."/view/$rsproduct[2]/$rsproduct[0]\">";
     					echo "<img src=\"".WebUrl."img_product/".$Img['ImgName']."\" width=\"200\" style=\"height:180px\" class=\"img-polaroid\">";
      					echo "<h6>".$rsproduct['Pro_name']."</h6>";
      					echo "<p>".ProductPrice." <span style=\"font-size:18px\" class=\"label label-warning\">".number_format($rsproduct['Pro_price'])."</span> ".Currency."</p>";
     				 	echo "<p><button class=\"btn btn-info\" >";
     				 	echo "<i class=\"icon-white icon-zoom-in\"></i>".View_Product."</button>&nbsp;<button class=\"btn btn-danger\" >";
                                                                                          echo "<i class=\"icon-white icon-eye-open\"></i> ".View_Count." (".number_format($rsproduct['Product_view']).")</button>";
     				 	echo "</p>";
    					echo "</a>";
  					echo "</li>";
				   }
		echo "</ul>";
		//<!-- End of Product -->
                    
		}else{
			switch($uri['1']):
                    case 'category':
                $Sql_product=$StrDB->Query("select * from product where Pro_type_id='".mysql_real_escape_string($uri['3'])."' ");
                  
                   $i=1;
                    while($rs_product=$StrDB->FetchData($Sql_product)) {
        	         if($i%3=="0") {
                    $class="col col_14 product_gallery no_margin_right";
                }else{
                    $class="col col_14 product_gallery";
                }
                echo "<div class=\"$class\">";
                 echo "<a href=\"".WebUrl."".$rs_config['MMWebName']."/view/$rs_product[2]/$rs_product[0]\" ><img src=\"".WebUrl."img_product/$rs_product[Pro_img]\" width=\"200\"  style=\"height:220px\"  class=\"img-polaroid\"  alt=\"$rs_product[Pro_name]\" /></a>";
              echo " <h3>$rs_product[Pro_name]</h3>";
               echo "<p class=\"product_price\">ราคา : $rs_product[Pro_price] บาท</p>";
               echo " <a href=\"".WebUrl."".$rs_config['MMWebName']."/view/$rs_product[2]/$rs_product[0]\" class=\"add_to_cart\">ซื้อสินค้า</a>";
              echo "</div>  ";
              $i++;
                }
                break;
                case 'view':
                 $rs_product=$StrDB->GetData("product"," where Id='".mysql_real_escape_string($uri['3'])."' ");

                echo "<h2>".ProductDetail."</h2>";
       
              //  include ("btshare.php");
 
                echo "<div class=\"col col_13\">";

           /* echo "<a href=\"".WebUrl."img_product/$rs_product[Pro_img]\" title=\"$rs_product[Pro_name]\">
            <img src=\"".WebUrl."img_thumb/$rs_product[Pro_img]\" 
            width=\"200\"  class=\"img-polaroid\"  style=\"height:220px\" 
              alt=\"$rs_product[Pro_name]\" /></a>";*/

 	//echo "<div class=\"clearfix\" id=\"content\" style=\"  height:500px;width:500px;\" >";
    echo "<div class=\"clearfix\" style=\"margin-left:50px\">";
    $sqlImg=$StrDB->Query("select ImgName from tb_imgproduct where Pro_id='".mysql_escape_string($uri['3'])."' order by Id asc limit 0,1");
   	while ($rs_img1=$StrDB->FetchData($sqlImg)) {	 
    
    echo "<a href=\"".WebUrl."img_product/".$rs_img1['ImgName']."\" class=\"jqzoom\" rel='gal1'  title=\"".$rs_product['Pro_name']."\" >";
     echo "<img src=\"".WebUrl."img_thumb/".$rs_img1['ImgName']."\" width=\"150\" style=\"height:170px\"  title=\"".$rs_product['Pro_name']."\" 
      class=\"img-polaroid\" >";
     echo "</a> ";
 }
     echo "</div>	<br/>";
      echo "<div class=\"clearfix\" >";
		echo "<ul id=\"thumblist\" class=\"clearfix\" >";
		//echo "<li><a class=\"zoomThumbActive\" href='javascript:void(0);' rel=\"{gallery: 'gal1', smallimage: '".WebUrl."img_thumb/N7SNYK.jpg',largeimage: '".WebUrl."img_product/N7SNYK.jpg'}\"><img src='".WebUrl."img_product/N7SNYK.jpg' ></a></li>";
    $sqlImg=$StrDB->Query("select ImgName from tb_imgproduct where Pro_id='".mysql_escape_string($uri['3'])."' order by Id asc limit 0,5");
   	while ($rs_img1=$StrDB->FetchData($sqlImg)) {	 
		echo "<li><a  href='javascript:void(0);' rel=\"{gallery: 'gal1', smallimage: '".WebUrl."img_thumb/".$rs_img1['ImgName']."',largeimage: '".WebUrl."img_product/".$rs_img1['ImgName']."'}\"><img class=\"img-polaroid\"  src='".WebUrl."img_thumb/".$rs_img1['ImgName']."' width=\"60\" height=\"70\" ></a></li>";
	}
	echo "</ul>";
	echo "</div>";
	//echo "</div>";
    	 














            echo "</div>";
            echo "<div class=\"col col_13 no_margin_right\">";
                echo "<form action=\"".WebUrl."$uri[0]/addtocart\" method=\"POST\">";
               echo " <table>";
               echo "<tr><td height=\"30\">".ProductId."</td> <td>$rs_product[Pro_id]</td></tr>";
               echo "<tr><td height=\"30\">".ProductName."</td> <td>$rs_product[Pro_name]</td></tr>";
               echo "<tr>  <td height=\"30\" width=\"160\">".ProductPrice."</td><td>".number_format($rs_product[Pro_price])." ".Currency."</td> </tr>";
                if($rs_product[Pro_unit]>0) {
                echo "<tr> <td height=\"30\">".Product_Status.":</td><td>".Instock."</td> </tr>";
          
                 echo "<tr><td height=\"30\">".ProductAmount."</td><td>
                 <input type=\"text\" name=\"num_product\" value=\"1\" style=\"width: 20px; text-align: right\" /></td></tr>";
               }else{
                   echo "<tr> <td height=\"30\">".Status.":</td><td style=\"color:red\">".Outof_stock."</td> </tr>";

               }

                echo "</table>";
                echo "<div class=\"cleaner h20\"></div>";
               
            if($_SESSION['Usr_Customer']) { 
                     if($rs_product[Pro_unit]>0) {
                echo "<input type=\"submit\"class=\" btn btn-primary \" style=\"color:#fff\" value=\"".Addtocart."\">";
                echo "<input type=\"hidden\" name=\"cartid\" value=\"$rs_product[Id]\" ></form>";
 
              }else{
                  echo "<a href=\"$uri[0]\" class=\"btn btn-danger\" style=\"color:#fff\">".Outof_stock."</a>";
              }
             }else{
                echo "<a href=\"$uri[0]\" class=\"btn btn-danger\" style=\"color:#fff\">".Pls_login."</a>";
              }
                
                echo " </div>";
            echo "<div class=\"cleaner h30\"></div>";
            echo "<div class=\"tabbable\" > ";
                echo "<ul class=\"nav nav-tabs\">";
                 echo " <li class=\"active\"><a href=\"#tab1\" data-toggle=\"tab\">".OthDetail."</a></li>";
                 echo " <li><a href=\"#tab2\" data-toggle=\"tab\">".Comment."</a></li>";
                echo "</ul>";
                echo "<div class=\"tab-content\">";
                 echo " <div class=\"tab-pane active\" id=\"tab1\">";
            echo "<p> $rs_product[Pro_detail]</p>   ";
                echo "  </div>";
                echo "  <div class=\"tab-pane\" id=\"tab2\">";
                 echo "   <p>Howdy, I'm in Section 2.</p>";
                 echo " </div>";
                echo "</div>";
             echo " </div>";
                    
            
            
            echo "<div class=\"cleaner h50\"></div>"; 

 
            echo "<h4>".MoreProduct."</h4>";
             $Sql_product=$StrDB->Query("select * from product where User='".$_SESSION['WebUsrId']."' order by rand() limit 6 ");
            echo "<ul class=\"thumbnails\">";
               while($rsproduct=$StrDB->FetchData($Sql_product)) {
             
        $Img=$StrDB->GetData("tb_imgproduct"," where Pro_id='".$rsproduct['Id']."' order by Id asc limit 0,1");
					echo "<li class=\"span3\">";
   						echo "<a style=\" text-decoration: none; \" class=\"thumbnail\" href=\"".WebUrl."".$rs_config['MMWebName']."/view/$rsproduct[2]/$rsproduct[0]\">";
     					echo "<img src=\"".WebUrl."img_product/".$Img['ImgName']."\" width=\"200\" style=\"height:180px\" class=\"img-polaroid\">";
      					echo "<h6>".$rsproduct['Pro_name']."</h6>";
      					echo "<p>".ProductPrice." <span style=\"font-size:18px\" class=\"label label-warning\">".number_format($rsproduct['Pro_price'])."</span> ".Currency."</p>";
     				 	echo "<p><button class=\"btn btn-info\" >";
     				 	echo "<i class=\"icon-white icon-zoom-in\"></i>".View_Product."</button>&nbsp;<button class=\"btn btn-danger\" >";
     	   echo "<i class=\"icon-white icon-eye-open\"></i> ".View_Count." (".number_format($rsproduct['Product_view']).")</button>";
     				 	echo "</p>";
    					echo "</a>";
  					echo "</li>";
                }
             echo "</ul>";

                echo "<a href=\"#\" class=\"more float_r\">View all</a>";
                 echo "<div class=\"cleaner\"></div>";
                break;
                case 'addtocart':
                if(isset($_POST["cartid"])){#Add to cart
                  if($_POST)
$cid=$_POST["cartid"];
 $rs_showpd=$StrDB->GetData("product","where  Id=".mysql_real_escape_string($cid)."");
 if($_POST['num_product']>$rs_showpd['Pro_unit']) {
  echo "<script>
  alert('".Instock." $rs_showpd[Pro_unit] ".Item."  ".PlsChooseAgain."');
  window.location='".WebUrl."$uri[0]/view/$rs_showpd[Pro_name]/$cid';
  </script>";#Redirect ไปยังหน้าตระกร้าสินค้าทุกครั้ง

 }else{
$_SESSION["cartcount"]++;
$cartcount=$_SESSION["cartcount"];
$CItemCount="cart$cartcount";
$CartStatus="";#เอาไว้เก็บสถานะสินค้าว่าลูกค้าเลือกซ้ำหรือไม่

if(count($_SESSION["cartNumber"])!=0 ){
  foreach($_SESSION["cartNumber"] as $RecCart){
    if($_SESSION[$RecCart][0]==$cid){#หากสินค้าซ้ำกับของเดิม(โดยตรวจสอบจาก ID ของสินค้า)
      $_SESSION[$RecCart][1]+=$_POST['num_product'];#เพิ่มจำนวนสินค้า
      $CartStatus="double";#เปลี่ยนสถานะ
    }
  }
}
  if($CartStatus==""){#สถานะเป็นค่าว่าง แสดงว่าสินค้าไม่ซ้ำกับของเดิม
    $_SESSION[$CItemCount][0]=$cid;
    $_SESSION[$CItemCount][1]=$_POST['num_product'];
    $_SESSION[$CItemCount][2]=$rs_showpd["Pro_price"];
    $_SESSION["cartNumber"][$cartcount]=$CItemCount;#ตำแหน่งของแต่ละเรคคอร์ดของสินค้า
  } 
}
}
 ##################################################################
$del=$uri['3'];
if(isset($del)){#ต้องการจะลบสินค้า
  $RecDel=$del;
  foreach($_SESSION["cartNumber"] as $RecCart){#วนไปจนกว่าจะเจอแถวของสินค้าที่เลือกลบ
    if($RecCart==$RecDel){
      $CNum =preg_replace("/[^0-9]/", '', $RecCart);  // คัดเอาเฉพาะตัวเลข เช่น cart1 จะได้ ค่า 1 เป็นต้น
            unset($_SESSION['cartNumber'][$CNum]); // unset แถวที่เก็บสินค้าที่ต้องการลบ
    }
  unset($_SESSION[$RecDel]);#unset  ข้อมูลสินค้าที่เก็บไว้ทั้งหมด
  }
}
##################################################################
if(isset($_POST["bt_edit"])){#ต้องการแก้ไขจำนวนสินค้า
 
  $pdid=$_POST["pd_id"];#รหัสของสินค้าทั้งหมด(จัดเก็บไว้ในรูป Array)

  $cartRows =$_POST["cartRows"];#จำนวน Record ของแถวทั้งหมดของสินค้า(จัดเก็บไว้ในรูป Array)
  $pamount=$_POST["pd_amount"];#จำนวน Record ของสินค้า(จัดเก็บไว้ในรูป Array)
  for($i=0;$i<=(count($cartRows)-1);$i++){#วนลูปไปทีละแถวเพื่ออัพเดทจำนวนสินค้า
    if($pamount[$i]>0){#เอาเฉพาะจำนวนสินค้าที่มากกว่า0
      $rs_record=$StrDB->GetData("product"," WHERE Id=".$pdid[$i]."");
         if($_POST['pd_amount'][$i]>$rs_record['Pro_unit']) {
 echo "<script>
  alert('".Instock." $rs_record[Pro_unit] ".Item."  ".PlsChooseAgain."');
  window.location='".WebUrl."$uri[0]/addtocart';
  </script>";#Redirect ไปยังหน้าตระกร้าสินค้าทุกครั้ง

 }else{
        $_SESSION[$cartRows[$i]][1] = $pamount[$i] ;  #เซตจำนวนสินค้าใหม่ให้มีค่าเท่ากับจำนวนที่ลูกค้าระบุ
       }
    }
  }
}
//echo "<script>window.location='$uri[0]?action=addtocart.php';</script>";#Redirect ไปยังหน้าตระกร้าสินค้าทุกครั้ง
 ?>
   <form name="feditcart" method="post" action="<?=WebUrl;?><?=$uri['0'];?>/addtocart">
               <table width="100%"  id="tbcart"  background="#CCC" cellpadding="1" cellspacing="1" style="border:#E5E5E5 solid 1px;font-size:13px">
          <tr bgcolor="#FF0099" style="color:#fff">
            <td width="5%"><strong></strong></td>
            <td width="50%" height="32"><strong><?=ProductName;?></strong></td>
           
            <td width="13%" align="center"><strong><?=ProductPrice;?></strong></td>
             <td width="13%" align="center"><strong><?=Amount;?></strong></td>
 
            <td width="12%" align="center"><strong><?=Total;?></strong></td>
            <td width="9%" align="center"><strong><?=Del;?></strong></td>
          </tr>
          <? 
  if(count($_SESSION["cartNumber"])>0){#จำนวนข้อมูลที่มีอยู่หากมากกว่า0
  $i=1;
  foreach($_SESSION["cartNumber"] as $RowCount){#วนลูปดึงข้อมูลสินค้าออกมาให้ครบตามจำนวนข้อมูลที่มีอยู่
  
  $rs_showpd=$StrDB->GetData("product","WHERE Id=".$_SESSION[$RowCount][0]."");
  //  $rs_showpd=$conn->Execute("SELECT* FROM tb_product WHERE pd_id=".$_SESSION[$RowCount][0]."");
  
  ?>
          <tr>
            <td align="center" height="23"><?=$i;?></td>
            <td height="23"><?=$rs_showpd["Pro_name"];?>
              <input type="hidden" name="cartRows[]" id="cartRows[]" value="<?=$RowCount?>" />
              <input type="hidden" name="pd_id[]" id="pd_id[]" value="<?=$rs_showpd["Id"]#รหัสสินค้า?>" /></td>
           
           <td align="center"><?=number_format($_SESSION[$RowCount][2]);?> </td>
            <td align="center"><input type="text" name="pd_amount[]" style="width:20px" value="<?=$_SESSION[$RowCount][1];?>"></td>
     
            <td align="center"><? $TotalPriceAmount=$_SESSION[$RowCount][2]*$_SESSION[$RowCount][1]; ?>
            <?=number_format($TotalPriceAmount,2,".",",");?>
        
        
            </td>
            <td align="center"><a href="<?=WebUrl;?><?=$uri[0];?>/addtocart/del/<?=$RowCount?>"><i class="icon-remove"></i></a></td>
          </tr>
          <?
    $TotalAmount+=$_SESSION[$RowCount][1];#คำนวณหาจำนวนสินค้าทั้งหมด
    $TotalPriceProduct+=$TotalPriceAmount;#คำนวณหาราคาสินค้าทั้งหมด
    $TotalPrice= $TotalPriceProduct+$pay_send;
    $i++;
    } 
    ?>
             
          <tr>
            <td height="23" align="right"><strong> <?=Total;?></strong></td>
            <td align="center"><strong>
           
              </strong></td>
            <td align="center"><strong>
           
              </strong></td>
            <td align="center"><strong>
               <?= $TotalAmount?>
              </strong></td>
            <td align="center"   ><strong>
          <?= number_format($TotalPrice,2,".",",")?>
          <?php $_SESSION['TotalPrice']=$TotalPrice;?>
             <!-- <input type="submit" name="bt_edit" id="bt_edit" value="ปรับ" class="btn btn-warning"/>-->
            </strong></td>
            <td align="center"><strong>
       <input type="submit" name="bt_edit" id="bt_edit" value="<?=Update;?>" class="btn btn-primary"/> 
            </strong></td>
          </tr>
          
          <tr>
            <td height="23" colspan="7" align="center">
          <a href="<?=WebUrl;?><?=$uri['0'];?>/confirm_order" class="btn btn-success"  style="color:#fff" ><?=OrderComplete;?></a></td>
          </tr>
      <? } else { ?>
          <tr>
            <td height="23" colspan="7" align="center"><strong><?=NoproductInCart;?></strong></td>
          </tr>
          <? }  ?>
        </table>
        <?
                     echo "<div style=\"float:right; width: 215px; margin-top: 20px;\">";
                    
                      //   echo "<div class=\"checkout\"><a href=\"checkout.html\" class=\"more\">Proceed to Checkout</a></div>";
                      echo "   <div class=\"cleaner h20\"></div>";
                     echo "    <div class=\"continueshopping\"><a href=\"".WebUrl."$uri[0]\" class=\"more\">เลือกสินค้าต่อ</a></div>";
                        
                    echo " </div>";
                break;
                case 'confirm_order':
                  if(count($_SESSION["cartNumber"])>0){#จำนวนข้อมูลที่มีอยู่หากมากกว่า0
      
        $Order_key=$StrDB->randName(5);
        $StrDB->InsertData("order_product"," '".NULL."'
          ,'".$Order_key."'
          ,'".$_SESSION['UsrId']."'
          ,'".date("Y-m-d")."'
          ,'".$_SESSION['TotalPrice']."'
          ,'".NULL."'
          ,'0'
          ,'0'
          ,'".NULL."' ,'".NULL."'  ,'".NULL."' ,'".NULL."','".$_SESSION['WebUsrId']."' ");
    
         $rs=$StrDB->GetData("order_product","order by Order_id desc limit 0,1");
  foreach($_SESSION["cartNumber"] as $RowCount){#วนลูปดึงข้อมูลสินค้าออกมาให้ครบตามจำนวนข้อมูลที่มีอยู่
    $rs_showpd=$StrDB->GetData("product","WHERE Id=".$_SESSION[$RowCount][0]."");
         $TotalPriceProduct=$_SESSION[$RowCount][1]*$rs_showpd[Pro_price];
           // $TotalPriceProduct+=$TotalPriceAmount;#คำนวณหาราคาสินค้าทั้งหมด
    $TotalPrice= $TotalPriceProduct+$pay_send;
        $StrDB->InsertData("order_detail","  '".NULL."' 
          ,'".$rs['Order_id']."'
          ,'".$rs_showpd[Pro_id]."'
          ,'".$rs_showpd[Pro_name]."'
          ,'".$_SESSION[$RowCount][1]."'
          ,'".$rs_showpd[Pro_price]."'
          ,'".$TotalPrice."'
         ");
        $Unit=$rs_showpd[Pro_unit]-$_SESSION[$RowCount][1];
        $StrDB->UpdateData("product","Pro_unit='".$Unit."' ","where Id='".$_SESSION[$RowCount][0]."' ");
            $CNum =preg_replace("/[^0-9]/", '', $RowCount);  // คัดเอาเฉพาะตัวเลข เช่น cart1 จะได้ ค่า 1 เป็นต้น
            unset($_SESSION['cartNumber'][$CNum]); 
       }
       $StrDisplay->AddSuccess();
        echo "<meta Http-equiv=\"refresh\"  Content=\"3; Url=".WebUrl."$uri[0]/cart\">"; 
    }
  
                break;
                case 'register':
                if($_POST['adddata']) {
                  $StrDB->InsertData("customer"," '','".$_POST['txt-usr']."'
      ,'".$_POST['txt-pwd']."' 
      ,'".$_POST['txt-name']."'
      ,'".$_POST['txt-surname']."'
      ,'".$_POST['txt-address']."'
      ,'".$_POST['txt-tel']."' 
      ,'".$_POST['txt-email']."' ,'".$_SESSION['WebUsrId']."'
      " );
    $StrDisplay->AddSuccess();
 echo "<meta Http-equiv=\"refresh\"  Content=\"3; Url=".WebUrl."$uri[0]\">";

                }
                $StrDisplay->Title_Form(Register,3);
                $StrDisplay->Open_Form("".WebUrl."$uri[0]/register");
                $StrDisplay->TxtInput(MemberName,"txt-name");
                 $StrDisplay->TxtInput(MemberLastName,"txt-surname");
                   $StrDisplay->TxtInputArea(txt_addr,"txt-address","","250","100","");
                     $StrDisplay->TxtInput(txt_tel,"txt-tel");
                       $StrDisplay->TxtInput(txt_email,"txt-email");
                         $StrDisplay->TxtInput("Username","txt-usr");
                           $StrDisplay->TxtInputPassword("Password","txt-pwd");

                       $StrDisplay->Button_Form(1);
                        $StrDisplay->Close_Form();

                break;
                      case 'editmember':
                if($_POST['editdata']) {
                  $StrDB->UpdateData("customer"," Cus_usr='".$_POST['txt-usr']."'
      ,Cus_pwd='".$_POST['txt-pwd']."' 
      ,Cus_name='".$_POST['txt-name']."'
      ,Cus_surname='".$_POST['txt-surname']."'
      ,Cus_address='".$_POST['txt-address']."'
      ,Cus_tel='".$_POST['txt-tel']."' 
      ,Cus_email='".$_POST['txt-email']."' 
      ","where Cus_id='".$_POST['editdata']."' and User='".$_SESSION['WebUsrId']."' " );
    $StrDisplay->AddSuccess();
 echo "<meta Http-equiv=\"refresh\"  Content=\"3; Url=".WebUrl."$uri[0]\">";

                }
                $rs=$StrDB->GetData("customer","where Cus_id='".$_SESSION['UsrId']."'");
                $StrDisplay->Title_Form("สมาชิก",2);
                $StrDisplay->Open_Form("".WebUrl."$uri[0]/editmember");
                $StrDisplay->TxtInput("ชื่อ","txt-name",$rs['Cus_name']);
                 $StrDisplay->TxtInput("นามสกุล","txt-surname",$rs['Cus_surname']);
                   $StrDisplay->TxtInputArea("ที่อยู่","txt-address",$rs['Cus_address'],"250","100","");
                     $StrDisplay->TxtInput("เบอร์โทร","txt-tel",$rs['Cus_tel']);
                       $StrDisplay->TxtInput("อีเมล์","txt-email",$rs['Cus_email']);
                         $StrDisplay->TxtInput("Username","txt-usr",$rs['Cus_usr']);
                           $StrDisplay->TxtInputPassword("Password","txt-pwd",$rs['Cus_pwd']);

                       $StrDisplay->Button_Form(2,$_GET['id']);
                        $StrDisplay->Close_Form();

                break;
                case 'cart':
                  $tb="order_product";
                if(isset($_GET['section'])) {
                   $StrDB->UpdateData($tb,"Order_status='1' ","where Order_id='".addslashes($_GET['id'])."' ");
                   $StrDisplay->AddSuccess();
                   echo "<meta Http-equiv=\"refresh\"  Content=\"0; Url=".WebUrl."$uri[0]/cart\">";
                }
              
                $StrDisplay->Title_Form("รายการสั่งซื้อสินค้า",3);
                echo "<table class=\"table table-hover\" width=\"100%\"  border=\"1\" cellpadding=\"1\" cellspacing=\"1\"   bordercolor=\"#E9E9E9\"  style=\"font-size:12px\">";
    echo "<thead>";
    echo "<th style=\"background:#0870B2;color:#fff\" width=\"5%\">#</th>";
    echo "<th style=\"background:#0870B2;color:#fff\"  width=\"10%\">รหัส</th>";
    echo "<th  style=\"background:#0870B2;color:#fff\" width=\"\">ชื่อผู้สั่งสินค้า</th>";
    echo "<th style=\"background:#0870B2;color:#fff\"  width=\"15%\">ราคาสินค้า</th>";
    echo "<th style=\"background:#0870B2;color:#fff\"  width=\"15%\">วันที่สั่งซื้อ</th>";
    echo "<th  style=\"background:#0870B2;color:#fff\" width=\"12%\">จ่ายผ่าน</th>";
    echo "<th  style=\"background:#0870B2;color:#fff\" width=\"12%\">สถานะ</th>";
  
 
    echo "</thead>";
    echo "<tbody>";
    $sql="select $tb.*,customer.Cus_name,customer.Cus_surname
      from $tb inner join customer   on $tb.Cus_id=customer.Cus_id
      where $tb.Cus_id='".$_SESSION['UsrId']."'
       order by $tb.Id desc";
     //  var_dump($sql);
       $i=1;
    $query=$StrDB->Query($sql);
    $num=$StrDB->NumRows($sql);
    if($num>0) {
    while($rs=$StrDB->FetchData($query)) {
    echo "<tr>";
    echo "<td align=\"center\">$i</td>";
    echo "<td>$rs[1]</td>";
    echo "<td>$rs[Cus_name] $rs[Cus_surname]</td>";
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
      //case '0':echo "<a href=\"".WebUrl."$uri[0]?action=$_GET[action]&section=confirm&id=$rs[Order_id]\" class=\"btn btn-small btn-danger\" style=\"color:#fff\" onClick=\"return confirm('ยืนยันการแจ้งชำระเงิน!')\">ยังไมแจ้ง !</a>";break;
       case '0':echo "<a href=\"".WebUrl."$uri[0]/form_confirm_order/$rs[Order_id]\" class=\"btn btn-small btn-danger\" style=\"color:#fff\" >ยังไมแจ้ง !</a>";break;
      
     case '1':
        echo "<a href=\"#\"  class=\"btn btn-small btn-primary\" style=\"color:#fff\">จ่ายแล้ว !</a>";    
        break;
    case '2':
      echo "<a href=\"#\"  class=\"btn btn-small btn-success\" style=\"color:#fff\">ยืนยันแล้ว !</a>";    
        break;

          }
    echo "</td>";
    

    echo "</tr>";
      $i++;
 
    }
       }else{
      echo "<tr><td colspan=\"7\" align=\"center\">ไม่พบข้อมูล</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
                break;
                case 'user_login':
                $StrDB->user_login($_POST['txt-username'],$_POST['txt-password']);
                break;
                case 'logout':
                  $StrDB->Logout();
                echo "<meta Http-equiv=\"refresh\"  Content=\"0; Url=".WebUrl."$uri[0]\">";
                break;
                case 'addtopic':
                if($_POST['adddata']) {
                  switch ($_SESSION['UsrType']) {
                    case 'user':  $user=$_SESSION['UsrId'];
                      break;                    
                    case 'admin': $user=$_SESSION['AdminId'];            
                      break;
                  }
                  $StrDB->InsertData("webboard"," ''
                    ,'".$_POST['txt-name']."'
                    ,'".$_POST['txt-detail']."'
                    ,'".$_SESSION['UsrType']."'
                    ,'".$user."'
                    ,'".date("Y-m-d")."','0'
 
      " );
    $StrDisplay->AddSuccess();
    echo "<meta Http-equiv=\"refresh\"  Content=\"3; Url=".WebUrl."$uri[0]\">";

                }
                $StrDisplay->Title_Form("หัวข้อกระทู้",1);
                $StrDisplay->Open_Form("".WebUrl."$uri[0]/addtopic");
                $StrDisplay->TxtInput("หัวข้อกระทู้","txt-name");
                $StrDisplay->TxtInputArea("รายละเอียด","txt-detail");
                $StrDisplay->Button_Form(1);
                $StrDisplay->Close_Form();             
                break;
      case 'viewtopic':
   
   $rs=$StrDB->GetData("webboard"," where Id='".$_GET['id']."' ");
   $StrDB->UpdateData("webboard","View= View +1","Where Id='".$_GET['id']."' ");
      switch ($rs[UsrType]) {
              case 'user':  
                    $getname=$StrDB->GetData("customer","where Cus_id='".$rs['UsrName']."' ");
                    $user=$getname['Cus_name']." ".$getname['Cus_surname'] ;
                      break;                    
                    case 'admin': $user="ผู้ดูแลระบบ";            
                      break;
                  }
                  echo "<div style=\"border-bottom:2px solid #33CC33;color:#FF0099\"><h4>$rs[TopicName]</h4></div>";
                  echo "<div class=\"head_topic\">$rs[TopicDetail]</div>";
                  $sql=$StrDB->Query("select * from replay_webboard where TopicId='".$_GET[id]."' order by Id desc");
                  while($rs_topic=$StrDB->FetchData($sql)) {
                  echo "<div class=\"sub_topic\">$rs_topic[TopicDetail]";
                  echo "<div style=\"background:#FFCCCC;padding:1px;font-size:11px\">  &nbsp;ตอบโดย : $user &nbsp;&nbsp; วันที่ตอบ : ".$StrDisplay->DateTh($rs_topic['TopicDate'])."&nbsp; เวลา $rs_topic[TopicTime]</div>";
                  echo "</div>";
                }
                   
                    if($_SESSION['Usr_Customer'] || $_SESSION['AdminId']) { 
                       if($_POST['adddata']) {
                  switch ($_SESSION['UsrType']) {
                    case 'user':  $user=$_SESSION['UsrId'];
                      break;                    
                    case 'admin': $user=$_SESSION['AdminId'];            
                      break;
                  }
                  $StrDB->InsertData("replay_webboard"," ''
                    ,'".$_POST['txt-id']."'
                    ,'".$_POST['txt-detail']."'
                    ,'".$_SESSION['UsrType']."'
                    ,'".$user."'
                    ,'".date("Y-m-d")."'
                    ,'".date("H:i:s")."'

      " );
         $StrDisplay->AddSuccess();
         echo "<br>";
        echo "<meta Http-equiv=\"refresh\"  Content=\"3; Url=".WebUrl."$uri[0]?action=viewtopic&id=".$_POST['txt-id']."\">";
          }
                        
                        $StrDisplay->Open_Form("".WebUrl."$uri[0]/viewtopic/$_GET[id]");
                       $StrDisplay->TxtInputArea("ตอบกระทู้","txt-detail");
                       $StrDisplay->TxtHidden("txt-id",$_GET['id']);
                         $StrDisplay->Button_Form(1);
                        $StrDisplay->Close_Form();   
                      }

      break;
      case 'contact':
      echo "<div class=\"head_topic\">";
      echo "<div style=\"background:#FFCCCC;padding:1px;font-size:12px\">&nbsp;ติดต่อเรา</div>";
      echo "<h4>ร้านขายเสื้อผ้า - รองเท้าแฟชั่น </h4>";
      echo "<p>ที่ตั้ง เขตจตุจักร กรุงเทพ</p>";
echo "<p>คุณชัชฎา จูฑะรักษ์ 
โทร:089 777 6986</p>";
echo "<p>email: trophy111@hotmail.com</p>";
echo "<p>บัญชี ธ.กรุงไทย เลขที่บัญชี 0891016295</p></div>";

      break;
            case 'order':
      echo "<div class=\"head_topic\">";
      echo "<div style=\"background:#FFCCCC;padding:1px;font-size:12px\">&nbsp;วิธีการสั่งซื้อ</div>";
      //echo "<br><img src=\"".WebUrl."images/order.jpg\" border=\"0\">";
      echo " </div>";
      break;
                  case 'sendproduct':
      echo "<div class=\"head_topic\">";
      echo "<div style=\"background:#FFCCCC;padding:1px;font-size:12px\">&nbsp;วิธีการจัดส่งสินค้า</div>";
     // echo "<img src=\"".WebUrl."images/sendproduct.jpg\" border=\"0\">";
      echo " </div>";
      break;
      case 'form_confirm_order':
      if($_POST['adddata']) {

        foreach ($_POST['txt-bank'] as $key ) {
       $file=$StrDB->UploadFile("img_bill");
        $StrDB->UpdateData("order_product","  
        
          Order_date='".date("Y-m-d")."'
          ,Order_total='".$_POST['txt-total']."'
          ,Acc_id='".$key."'
          ,Order_status='2',file_recive='".$file."'
           ","where Order_id='".$_POST['id']."' ");
      }
        $StrDisplay->AddSuccess();
        echo "<meta Http-equiv=\"refresh\"  Content=\"3; Url=".WebUrl."$uri[0]\">"; 
      }
       $rs_usr=$StrDB->GetData("customer","where Cus_id='".$_SESSION[UsrId]."'");
      $StrDisplay->Title_Form("แจ้งการสั่งซื้อสินค้า รหัส ".$_GET['id']." ",3);
                $StrDisplay->Open_Form("".WebUrl."$uri[0]/form_confirm_order/".$_GET['id']."");
                $StrDisplay->TxtInputDisable("ชื่อ","txt-name",$rs_usr['Cus_name']);
                $StrDisplay->TxtInputDisable("นามสกุล","txt-surname",$rs_usr[Cus_surname]);
            //       $StrDisplay->TxtInputArea("ที่อยู่","txt-address",$rs_usr[Cus_address]);
                     $StrDisplay->TxtInputDisable("เบอร์โทร","txt-tel",$rs_usr[Cus_tel]);
                       $StrDisplay->TxtInputDisable("อีเมล์","txt-email",$rs_usr[Cus_email]);

                          $StrDisplay->Title_Form("การชำระเงิน",3);
                        $sql=$StrDB->Query("select * from account");
                        while($rs=$StrDB->FetchData($sql)) {
                          $Txt="เลขที่ " .$rs[Acc_no]."/ ชื่อบัญชี".$rs[Acc_name]."  / ธนาคาร".$rs[Acc_bank]." / สาขา".$rs[Acc_branch]."</p>";
                        $StrDisplay->TxtInputRadio("บัญชี","txt-bank[]",$Txt,$rs[Id]);
                        }
                       $StrDisplay->TxtInputDisable("จำนวนเงินทั้งสิ้น","txt-total",$_SESSION['TotalPrice']);
                        // $StrDisplay->TxtInput("จำนวนเงินทั้งสิ้น","txt-total");
                        $StrDisplay->TxtInputFile("เอกสารแนบ","file");
                        $StrDisplay->TxtHidden("id",$_GET['id']);
                       $StrDisplay->Button_Form(1);
                        $StrDisplay->Close_Form();
      break;

           endswitch;
       }

		?>


         </div>   <!-- END of content -->
        <div class="cleaner"></div>
    </div> <!-- END of main -->
    
    <div id="templatemo_footer">
     
        
        <div class="cleaner h40"></div>
		<center>
			Copyright © 2013  
		</center>
    </div> <!-- END of footer -->   
   
</div>

</body>
</html>