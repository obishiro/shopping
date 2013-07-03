<?php
session_start(); 
$StrDB= new Db_Process();
$StrDisplay= new Web_Display();
$StrLibCart = new LibCart();
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title><?=WebName;?></title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 
	<link rel="stylesheet" href="<?php echo WebUrl;?>main_template/default/css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo WebUrl;?>assets/css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
	<link href="<?php echo WebUrl;?>main_template/default/css/skins/red.css" rel="stylesheet" type="text/css" />
 
  	<!--[if IE 6]>
	<link rel="stylesheet" href="<?php echo WebUrl;?>main_template/default/css/ie6.css" type="text/css" media="all" />	
	<![endif]-->
	<link href="<?php echo WebUrl;?>main_template/default/css/dcmegamenu.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo WebUrl;?>main_template/default/css/jquery.jscrollpane.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo WebUrl;?>main_template/default/css/slideshow.css" type="text/css" media="screen" />  
	
	<script src="<?php echo WebUrl;?>assets/js/jquery.js"></script>
	 
	<script src="<?php echo WebUrl;?>main_template/default/js/jquery.jscrollpane.min.js" type="text/javascript"></script>
	<script src="<?php echo WebUrl;?>main_template/default/js/jquery.jcarousel.js" type="text/javascript"></script>
	<script src="<?php echo WebUrl;?>main_template/default/js/functions.js" type="text/javascript"></script>
	<script src="<?php echo WebUrl;?>assets/js/jquery.validationEngine.js" type="text/javascript"></script>
	<script type='text/javascript' src='<?php echo WebUrl;?>main_template/default/js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='<?php echo WebUrl;?>main_template/default/js/jquery.dcmegamenu.1.3.3.js'></script>
   <script type="text/javascript" src="<?php echo WebUrl;?>assets/js/jquery.ddslick.min.js"></script>
   <script type="text/javascript" src="<?php echo WebUrl;?>assets/js/load_more.js"></script>
   <script src="<?php echo WebUrl;?>assets/js/jquery.tabSlideOut.v1.3.js"></script>
       <script type="text/javascript" src="<?php echo WebUrl;?>main_template/default/js/jquery.cycle.js"></script>
        <script type="text/javascript" src="<?php echo WebUrl;?>main_template/default/js/slideshow.js"></script>
        
<script type="text/javascript">
$(document).ready(function($){
 
	$('#mega-menu-8').dcMegaMenu({
		rowItems: '5',
		speed: 'fast',
		effect: 'slide'
	});

$('#demo-htmlselect').ddslick({
    onSelected: function(selectedData){
        //callback function: do something with selectedData;
    }   
});

     $('.slide-out-div').tabSlideOut({
                 tabHandle: '.handle',  //class ที่ใช้เรียกใน div
                 pathToTabImage: 'images/contact_tab.gif', //path ของรูปที่จะแสดง
                 imageHeight: '122px', //ความสูงของรูป
                 imageWidth: '40px', // ความยาวของรูป  
                 tabLocation: 'left', //ด้านที่จะให้แสดง top, right, bottom,  left
                 speed: 300, // ความเร็วในการคลิก tab ออกมา
                 action: 'click', //กำหนดการแสดงโดยใช้ click หรือ hover
                 topPos: '200px', // สามารถจัดตำแหน่งของ tab ได้
                 fixedPosition: true //ให้ตำแหน่งของ tab คงทีหรือไม่ตามจอพอ ถ้าตามจอภาพให้เป็น true                              
             });
 
});
</script>
 </head>
<body>
      <div class="slide-out-div">
            <a class="handle" href="#">Content</a>
            <h3>Contact me</h3>
            <p>tel:
            </p>
            <p>email</p>
        </div>
 <div class="red" >  
<ul id="mega-menu-8" class="mega-menu">
	<li><a href="<?=WebUrl;?>">Home</a></li>
	<li><a href="#"><?=Main_category;?></a>
	<?php $StrLibCart->ShowMainProductType();?>
	</li> 
<li><a href="<?=WebUrl;?>main/register"><?=Register;?></a></li>
<li><a href="<?=WebUrl;?>main/contact"><?=Contact;?></a></li>
</ul>
</div>
<div class="wrap">
	<div id="wrapper">
		<div id="wrapper-bottom">
			<div class="shell">
				<!-- Header -->
				<div id="header">
					<div class="products-holder">
							<div class="top"></div>
							<div class="middle">													
							 	
                                                                                                                                               
							 	<div class="middle" id="newsletter">
							 	<div class="post">
                                                                                                                                      
                                                                                                                                          <form action="<?=WebUrl;?>main/search" method="POST">
								 <table cellspacing="3" cellpadding="3"><tr>
								 	<td><select id="demo-htmlselect">
								 	    <option selected="selected" 
								 	    data-imagesrc="<?=WebUrl;?>images/check-icon.png" 
								 	    data-description="Description with Facebook" value="0" >Select</option>
                                                                                                                                                                    <?php
                                                                                                                                                                    $sql="select * from tb_mainshop_type order by MMName asc";
                                                                                                                                                                    $re=$StrDB->Query($sql);
                                                                                                                                                                    while ($rs_main=$StrDB->FetchData($re)){
                                                                                                                                                                    echo "<option data-imagesrc=\"".WebUrl."images/".$rs_main['MMImg']."\" data-description=\"".$rs_main['MMDetail']."\">".$rs_main['MMName']."</option>";
                                                                                                                                                                    }
                                                                                                                                                                    ?>
                                                                                                                                                                    </select></td>
								 	<td> <input type="text" class="text-search" name="txt-search"/> </td>
								 	<td>
								 	<div class="submit-button"><input type="submit" value="Search" /></div>
									</td>
								 </tr></table></form>
                                                                                                                                                       <?php
                                                                                                                                                       $StrLibCart->GetBreadCrumb($uri['2'],$uri['3'],$uri['4'],$uri['5'],$uri['7']);
                                                                                                                                                       ?>
                                                                                                                                                            </div>
										<div class="cl"></div>
									 
										<div class="cl">&nbsp;</div>											
									</div></div>
							<div class="bottom"></div></div></div> 

                                                                                                <div id="main">
                                                                                            <div  style="height:25px"></div>
                                                                                                  <?  if(empty($uri['2'])) { ?>
                                    	                                                       <div class="products-holder">
							<div class="top"></div>
							<div class="middle">													
								<div class="label">
									<h3><?=Product;?></h3>								
								</div>	 
								<div class="cl"></div>	
								<br/>        
                                                                                                                                         <?php include("showproduct.php");  ?><div class="cl"></div>
                                                                                                                                            <?php
                                                                                                                                           // $StrLibCart->button_loadmore($num, $rsproduct['Id']);
                                                                                                                                            ?>
                                                                                                                                            
                                                                                                                                  
<!--                                                                                                                                <div id='more<?=$msg_id;?>' class='morebox'><?=loadmore;?></div>-->
                                                                
							</div><div class="bottom"></div>									
                                                                                                                                </div>
					 	<div class="products-holder">
							<div class="top"></div>
							<div class="middle">													
								<div class="label">
									<h3><?=RandomProduct;?></h3>								
								</div>	 
								<div class="cl"></div>	
								<br>
								 
                                                                                                                                                             <!--   <h2>Slide one</h2>-->
                                                                                                                                                                <?php	 $re=$StrLibCart->ShowHomeProduct(" order by rand() LIMIT ".Limit." ");
									  while($rsproduct=$StrDB->FetchData($re)) { 	
									  	$Img=$StrDB->GetData("tb_imgproduct"," where Pro_id='".$rsproduct['Id']."' order by Id asc limit 0,1");
									echo "<div class=\"product\">";																									
									echo "<a title=\"".$rsproduct['Pro_name']."\" href=\"".WebUrl."".$rsproduct['MMWebName']."/view/".$rsproduct['Pro_name']."/".$rsproduct['Id']."\" target=\"_blank\">";
									echo "<img src=\"".WebUrl."img_product/".$Img['ImgName']."\" width=\"200\" style=\"height:150px\"  class=\"img-polaroid\"></a>";
									echo "<div class=\"desc\">";
										echo "<p class=\"name\">".$rsproduct['Pro_name']."</p>";
										//echo "<p>Product id: <span>".$rsproduct['Pro_id']."</span></p>";
									echo "</div>";	
									echo "<div class=\"price-box\">";
										echo "<p><span class=\"price\"> ".number_format($rsproduct['Pro_price'])."</sup></span></p>";
										echo "<p class=\"per-peace\">Per Peace</p>";
									echo "</div>";
                                                                                                                                                                            
									echo "<div class=\"cl\"></div>	";	

								echo "</div>";

                                                                                                                                            }
								?>
                                                                                                                                        
 
								<div class="cl"></div>
								 
							</div>

							<div class="bottom"></div>									
                                                                                                                                </div>
					 	
							 <div class="products-holder">
							<div class="top"></div>
							<div class="middle">													
								<div class="label">
									<h3><?=NewShop;?></h3>									
								</div>
								<div class="cl"></div>	
							 	<div class="middle" id="newsletter">
							 	<div class="post">
									 <?php	 $re=$StrLibCart->ShowNewShop();
									  while($rsshop=$StrDB->FetchData($re)) { 
									  	if($rsshop['ImgShop']=="") {
									  		$img="shop-icon.png";
									  	}else{
									  		$img=$rsshop['ImgShop'];

									  	}
									  	echo "<div class=\"product\">";																									
									echo "<a title=\"".$rsshop['MMNameTh']."\" href=\"".WebUrl."".$rsshop['MMWebName']."\" target=\"_blank\">";
									echo "<p style=\"padding-left:20px;font-weight:bold;font-size:16px;\">".$rsshop['MMNameTh']."</p>";
									echo "<img src=\"".WebUrl."img_shop/".$img."\" width=\"200\" style=\"height:150px\"  class=\"img-polaroid\"></a>";
									echo "<div class=\"desc\">";
										echo "<p style=\"margin-top:-25px;color:#787373\"> ".$rsshop['MMWebDetail']."</p>";
									echo "</div>";	
									 
									echo "<div class=\"cl\"></div>	";																													
								echo "</div>";

									  }
									  ?>
								</div>
										<div class="cl"></div>
									 
										<div class="cl">&nbsp;</div>											
									</div>		
								 
							 
								<div class="cl"></div>
							</div>
							<div class="bottom"></div>									
                                                                                                                                </div>

                                                                                                                                  <?php
                                                                                                                                }else{

							if(isset($uri['3']) && isset($uri['6'])) { ?>
							 <div class="products-holder">
							<div class="top"></div>
							<div class="middle">													
								<div class="label">
								<h3><?=$StrLibCart->decode_url($uri['7']);?></h3>									
								</div>
								<div class="cl"></div>	
							 	<div class="middle" id="newsletter">
							 	<div class="post">
							 <?php	 $re=$StrLibCart->ShowHomeProduct("where product.Sub_product_type='".mysql_real_escape_string($uri['6'])."' order by product.Id desc");
									  while($rsproduct=$StrDB->FetchData($re)) { 	
									  	$Img=$StrDB->GetData("tb_imgproduct"," where Pro_id='".$rsproduct['Id']."' order by Id asc limit 0,1");
									echo "<div class=\"product\">";																									
									echo "<a title=\"".$rsproduct['Pro_name']."\" href=\"".WebUrl."".$rsproduct['MMWebName']."/view/".$rsproduct['Pro_name']."/".$rsproduct['Id']."\" target=\"_blank\">";
									echo "<img src=\"".WebUrl."img_product/".$Img['ImgName']."\" width=\"200\" style=\"height:150px\"  class=\"img-polaroid\"></a>";
									echo "<div class=\"desc\">";
										echo "<p class=\"name\">".$rsproduct['Pro_name']."</p>";
										//echo "<p>Product id: <span>".$rsproduct['Pro_id']."</span></p>";
									echo "</div>";	
									echo "<div class=\"price-box\">";
										echo "<p><span class=\"price\"> ".number_format($rsproduct['Pro_price'])."</sup></span></p>";
										echo "<p class=\"per-peace\">Per Peace</p>";
									echo "</div>";
									echo "<div class=\"cl\"></div>	";																													
								echo "</div>";
							}
								?>
								</div>
										<div class="cl"></div>
									 
										<div class="cl">&nbsp;</div>											
									</div>		
								 
							 
								<div class="cl"></div>
							</div>
							<div class="bottom"></div>									
						</div>

							<?}else if (isset($uri['3']) && empty($uri['6'])) {
                                                            
                                                                                                                             switch ($uri['3']):
                                                                                                                                 case 'search': ?>
                                                                                                                             <div class="products-holder">
							<div class="top"></div>
							<div class="middle">	
                                                                                                                               
								<div class="label">
								<h3><?=Search;?></h3>									
								</div>
								<div class="cl"></div>	
							 	<div class="middle" id="newsletter">
							 	<div class="post">
                                                                                                                                                 <?php	 $sql=$StrLibCart->ShowSearchProduct($_POST['txt-search']);
                                                                                                                                 
                                                                                                                                                                if($StrDB->NumRows($sql)>0) {
                                                                                                                                                                    $re=$StrDB->Query($sql);
                                                                                                                                                                    while($rsproduct=$StrDB->FetchData($re)) { 	
									
                                                                                                                                                              $Img=$StrDB->GetData("tb_imgproduct"," where Pro_id='".$rsproduct['Id']."' order by Id asc limit 0,1");
									echo "<div class=\"product\">";																									
									echo "<a title=\"".$rsproduct['Pro_name']."\" href=\"".WebUrl."".$rsproduct['MMWebName']."/view/".$rsproduct['Pro_name']."/".$rsproduct['Id']."\" target=\"_blank\">";
									echo "<img src=\"".WebUrl."img_product/".$Img['ImgName']."\" width=\"200\" style=\"height:150px\"  class=\"img-polaroid\"></a>";
									echo "<div class=\"desc\">";
										echo "<p class=\"name\">".$rsproduct['Pro_name']."</p>";
										//echo "<p>Product id: <span>".$rsproduct['Id']."</span></p>";
									echo "</div>";	
									echo "<div class=\"price-box\">";
										echo "<p><span class=\"price\"> ".number_format($rsproduct['Pro_price'])."</sup></span></p>";
										echo "<p class=\"per-peace\">Per Peace</p>";
									echo "</div>";
									echo "<div class=\"cl\"></div>	";																													
								echo "</div>";
                                                                                                                                                                    }  
                                                                                                                                                                }else{ echo "No Item";}
									/*  
							 
                                                                                                                                        }*/
								?>
								</div>
										<div class="cl"></div>
									 
										<div class="cl">&nbsp;</div>											
									</div>		
								 
							 
								<div class="cl"></div>
							</div>
							<div class="bottom"></div>									
                                                                                                                    </div>
                                                                                                                                     
                                                                                                                                     <?     break;
                                                                                                                                 case 'register': ?>
         <div class="products-holder">
							<div class="top"></div>
							<div class="middle">	
                                                                                                                               
								<div class="label">
								<h3>
                                                                                                                                            <?=Register;?>                                                                                                                                           
                                                                                                                                          
                                                                                                                                            </h3>									
								</div>
								<div class="cl"></div>	
							 	<div class="middle" id="newsletter">
							 	<div class="post">
                                                                                                                                                   <?php
							 		if($_POST['bt-regis']) {?>
							 		<div style="float:right;padding:10px;background-color:#7BD68A;color:#FFF;width:250px" >
							 			<?php
							 				$StrDB->InsertData("tb_user","
							 					'".NUll."',
							 					'".mysql_escape_string($_POST['txt-name'])."',
							 					'".mysql_escape_string($_POST['txt-lname'])."',
							 					'".mysql_escape_string($_POST['email2'])."',
							 					'".md5(mysql_escape_string($_POST['txt-pass']))."',
							 					'".mysql_escape_string($_POST['txt-tel'])."',
							 					'2'
							 					");
							 				$StrDisplay->AddSuccess();
											$StrDisplay->GoUrl('3',"index.php");
										}
                                                                                                                                                                                    echo "</div>";
							 			?>
							 			<p><span><?=RuleRegister1;?></span></p>
											<p><span><?=RuleRegister2;?></span></p>
											<p><span><?=RuleRegister3;?></span></p>
											<p><span><?=RuleRegister4;?></span></p>
											<p><span><?=RuleRegister5;?></span></p>
										<form action="" method="post" class="formular">
										<p class="title_form_register"><?=MemberName;?></p>
										<div class="field-holder"><input type="text"   name="txt-name"  class="validate[required]"/></div>
										<p class="title_form_register"><?=MemberLastName;?></p>
											<div class="field-holder"><input type="text"  name="txt-lname"  class="validate[required]"/></div>
										<p  class="title_form_register"><?=Email;?></p>	
											<div class="field-holder"><input class="validate[required,custom[email]] text-input" type="text" name="email" id="email"  /></div>
										<p class="title_form_register"><?=EmailAgain;?></p>	
											<div class="field-holder"><input class="validate[required,confirm[email]]] text-input" type="text" name="email2"  /></div>
										<p class="title_form_register"><?=txt_tel;?></p>
											<div class="field-holder"><input type="text" name="txt-tel" class="validate[required]"/></div>
										<p class="title_form_register"><?=TextPassLogin;?></p>
											<div class="field-holder"><input   name="txt-pass" id="txt-pass" type="text"  class="validate[required,length[6,11]] text-input"/></div>
										<input type="hidden" name="bt-regis" value="1" />
											<div class="submit-button"><input type="submit" value="<?=Register;?>" /></div>
										</form>

								</div>
								<div class="cl"></div>
								<div class="cl">&nbsp;</div>											
								</div>		
								 <div class="cl"></div>
							</div>
							<div class="bottom"></div>									
                                                                                                                    </div>
                                                                                                                             <?        break;
                                                                                                                                 default :
                                                                                                                                     
                                                                                                                             
                                                            
                                                            
                                                                                                                            ?>
                                                                                                                                 
							<!-- begin -->	
                                                                                                                            <div class="products-holder">
							<div class="top"></div>
							<div class="middle">	
                                                                                                                               
								<div class="label">
								<h3>
                                                                                                                                            <?                                                                                                                                 
                                                                                                                                            echo $StrLibCart->decode_url($uri['5']);
                                                                                                                                            
                                                                                                                                            ?>
                                                                                                                                            </h3>									
								</div>
								<div class="cl"></div>	
							 	<div class="middle" id="newsletter">
							 	<div class="post">
                                                                                                                                                 <?php	 $re=$StrLibCart->ShowHomeProduct("where product.Main_product_type='".mysql_real_escape_string($uri['4'])."' ");
									  while($rsproduct=$StrDB->FetchData($re)) { 	
									  	$Img=$StrDB->GetData("tb_imgproduct"," where Pro_id='".$rsproduct['Id']."' order by Id asc limit 0,1");
									echo "<div class=\"product\">";																									
									echo "<a title=\"".$rsproduct['Pro_name']."\" href=\"".WebUrl."".$rsproduct['MMWebName']."/view/".$rsproduct['Pro_name']."/".$rsproduct['Id']."\" target=\"_blank\">";
									echo "<img src=\"".WebUrl."img_product/".$Img['ImgName']."\" width=\"200\" style=\"height:150px\"  class=\"img-polaroid\"></a>";
									echo "<div class=\"desc\">";
										echo "<p class=\"name\">".$rsproduct['Pro_name']."</p>";
										//echo "<p>Product id: <span>".$rsproduct['Pro_id']."</span></p>";
									echo "</div>";	
									echo "<div class=\"price-box\">";
										echo "<p><span class=\"price\"> ".number_format($rsproduct['Pro_price'])."</sup></span></p>";
										echo "<p class=\"per-peace\">Per Peace</p>";
									echo "</div>";
									echo "<div class=\"cl\"></div>	";																													
								echo "</div>";
							 
                                                                                                                                        }
								?>
								</div>
										<div class="cl"></div>
									 
										<div class="cl">&nbsp;</div>											
									</div>		
								 
							 
								<div class="cl"></div>
							</div>
							<div class="bottom"></div>									
						</div>
                                                                                                        
                                                                                                                        <!-- end-->
                                                                            			<?
                                                                                                        break;
                                                                                                endswitch;
                                                                          }

                                                                                                            }
                                                                                          
					?>

				
					<div id="content">
										
					 


						<div class="bottom-strip">
							<div class="box-holder left">
								<div class="box">
									<div class="top"></div>										
									<div class="label">
										<h3>Fan pages</h3>																			
									</div>
									<div class="middle">
										<div class="text-widget">
										 <p>Fanpages</p>
										 	</div>	
										<a class="read-more" title="Read More" href="#">Read More</a>
									</div>	
									<div class="bottom"></div>									
								</div>
							</div>
							<div class="box-holder middle">
								<div class="box">
									<div class="top"></div>									
									<div class="label">									
										<h3>Newsletter</h3>																		
									</div>
									<div class="middle" id="newsletter">
										<div class="post">
											<p><span>Subscribe to our newsletter</span></p>
											<p>Praesent et ultrices turpis. Donec at est vel neque dictum aliquet.</p>
										</div>
										<div class="cl"></div>
										<form action="" method="post">
											<div class="field-holder"><input type="text" class="field" value="Your Email" title="Your Email" /></div>
											<div class="field-holder"><input type="text" class="field" value="Your Name" title="Your Name" /></div>
											<div class="submit-button"><input type="submit" value="Subscribe" /></div>
										</form>
										<div class="cl">&nbsp;</div>											
									</div>
									<div class="bottom"></div>
								</div>
							</div>
							<div class="box-holder right">
								<div class="box">
									<div class="top"></div>										
									<div class="label">										
										<h3>Latest Posts</h3>																				
									</div>
									<div class="middle post-short">
										<div class="post">
											<p><span>Aenean placerat</span></p>
											<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae tellus t turpisporttitor pulvinar ...</p>
											<a class="comments" href="#" title="comments">comments</a>
										</div>
										<div class="date-box">
											<p class="date">05.26</p>
											<p>2011</p>
										</div>
										<div class="cl"></div>
									</div>	
									<div class="bottom"></div>									
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<!-- END Bottom Strip -->
					</div>
					<!-- END Content -->
				</div>
				<!-- END Main -->
			</div>
		</div>
		<div id="footer-push"></div>
	</div>
	<!-- END Wrapper -->
	<!-- Footer -->
	<div id="footer">
		<div class="shell">
			<a class="footer-logo" href="http://css-free-templates.com/" title="Home"><img src="<?php echo WebUrl;?>main_template/default/css/images/logo-footer.png" alt="Logo" /></a>
			<p id="bottom-nav"><a title="Home" href="#">Home</a><a title="Sales" href="#">Sales</a><a title="Catalog" href="#">Catalog</a><a title="Blog" href="#">Blog</a><a title="About Us" href="#">About Us</a><a title="Design by: CSS Free Templates" href="http://css-free-templates.com/">Design by: CSS Free Templates</a></p>
			<div class="cl"></div>
		</div>
	</div>
	<!-- END Footer -->
</body>
</html>