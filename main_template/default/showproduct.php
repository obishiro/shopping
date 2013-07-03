<?php
session_start();

 echo "<div id=\"loadmore_product\">";
$re=$StrLibCart->ShowHomeProduct(" $loadmore order by product.Id desc LIMIT ".Limit." ");
 $num=$StrDB->NumRows("select * from product");
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
//echo "<p class=\"per-peace\">Per Peace</p>";
echo "</div>";
//  $StrLibCart->ShareHomeProduct();
echo "<div class=\"cl\"></div>	";	
echo "</div>";
}
echo "</div>" ;

?>
