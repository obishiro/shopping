<?php
class LibCart extends Db_Process
{
	public function ShowHomeProduct($condition=null)
	{
		$sql="select product.*,tb_config_office.MMWebName from product inner join 
			tb_config_office on product.User=tb_config_office.User 
			$condition 
		 ";
		$re=$this->Query($sql);
	 
	 	return $re;
	}
	public function ShowNewShop()
	{
		$sql="select tb_user.*,tb_config_office.* from tb_user inner join 
			tb_config_office on tb_user.Id=tb_config_office.User
			where tb_user.UsrType='2'
			  order by tb_user.Id desc";
			 // var_dump($sql);
		$re=$this->Query($sql);
	 
	 	return $re;
	}
	public function ShowMainProductType()
	{
		 $sql="select * from tb_mainshop_type order by MMName asc";
		 $re=$this->Query($sql);
		 $num_m=$this->NumRows($sql) ;
		 if($num_m>0){
		 echo "<ul>";
		
		 while ($rs=$this->FetchData($re)) {
		 
		 echo "<li> <a href=\"".WebUrl."main/category/".$rs['Id']."/".$this->encode_url($rs['MMName'])."\">".$rs['MMName']."</a>";
		  	$sql_sub="select * from tb_submainshop_type where MId='".$rs['Id']."' ";
		  	$re_sub=$this->Query($sql_sub);
		  	$num=$this->NumRows($sql_sub);
		  	if($num>0) {
				echo "<ul>";
				while($rs_sub=$this->FetchData($re_sub)) {
				echo "<li><a href=\"".WebUrl."main/category/".$rs['Id']."/".$rs['MMName']."/".$rs_sub['Id']."/".$this->encode_url($rs_sub['SMName'])."\">".$rs_sub['SMName']."</a></li>";
					 }
				echo "</ul>";
			}
			echo "</li>";
		}
		echo "</ul>";
	}
	}
	public function ShowCategory($Usr,$usershop)
	{
		      	$StrSql_cat=$this->Query("select * from product_type 
		      		where User='".mysql_real_escape_string($Usr)."' 
		      		order by Pro_type_name asc");
              		while($rs_type=$this->FetchData($StrSql_cat)) {
                echo "<li><a href=\"".WebUrl."".$usershop."/category/$rs_type[1]/$rs_type[0]\">$rs_type[1]</a></li>";
   				} 
	}
        public function ShowRandomProduct($Usr,$limit){
            $sql="select * from product where User='".$Usr."' order by rand() limit $limit";
            $re=$this->Query($sql);
            return $re;
        }

        public function ShowProduct($Usr,$category=null)
	{
		if($category==null){
		$sql="select * from product where User='".$Usr."' order by Id desc";
		}else{
		$sql="select * from product where User='".$Usr."' and Pro_type_id='".$category."' order by Id desc";
		}
		$re=$this->Query($sql);
	 
	 	return $re;

	}
function encode_url($url="url"){
  $url=strtolower(str_replace(" ","_",$url));
 // $url=strtolower(preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu','',$url));
   $url=urlencode($url);
  return $url;
}

function decode_url($url="url"){
$url=strtolower(str_replace("_"," ",$url));
$url=urldecode($url);
return $url;
}
public function GetBreadCrumb($url1=null,$url2=null,$url3=null,$url4=null,$url5=null) {
    $array_data=array('','register','contact','search');
    $arr=array_search($url2,$array_data);
    echo "<ul class=\"breadcrumb\">";
      echo "<li><a href=\"".WebUrl."\">".home."</a>";
      if(!empty($url1)) {
        echo "<span class=\"divider\">/</span></li>";
            if($arr==FALSE){
            echo " <li><a href=\"".WebUrl."".$url1."/".$url2."/".$url3."/".$this->encode_url($url4)."\">".$this->decode_url($url4)."</a> ";
            echo "<span class=\"divider\">/</span></li>";
            }else{
             echo " <li><a href=\"".WebUrl."".$url1."/".$this->encode_url($url2)."\">".$this->decode_url($url2)."</a> ";
                echo "<span class=\"divider\">/</span></li>";
            }
            echo "<li class=\"active\">".$this->decode_url($url5)."</li>";
      }
 echo "</ul>";
}
function  ShowSearchProduct($txt,$category=null) {
 
 /*  $sql= " (select product.Id from product     where product.Pro_name like'%".$txt_search."%')
                union
               (select tb_mainshop_type.Id from tb_mainshop_type where  tb_mainshop_type.MMName='%".$txt_search."%' )
                union
              (  select tb_submainshop_type.Id  from tb_submainshop_type where SMName='%".$txt_search."%' )
             
       
       ";*/
 /*   $sql="select A.* from 
(
select product.Id as Pro_id,  product.Pro_name as name from product 
union 
select tb_mainshop_type.Id as MId, tb_mainshop_type.MMName as name from tb_mainshop_type 
union 
select tb_submainshop_type.Id as SId, tb_submainshop_type.SMName as name from tb_submainshop_type 
) as A
where A.name like '%".mysql_real_escape_string($txt_search)."%'";
   //var_dump($sql);
   return $sql;
 */
 if(!empty($category))  {
$con_search=" and ";
     
 } 
     $sql="select P.*,S.SMName  from product P  inner join tb_submainshop_type S on 
         P.Sub_product_type=S.Id
         where P.Pro_name like '%".mysql_real_escape_string($txt)."%' or S.SMName like '%".  mysql_real_escape_string($txt)."%' $con_search "   ;
     //var_dump($sql)  ;
     return $sql;
}
function ShareHomeProduct(){

echo "<div class=\"addthis_toolbox addthis_default_style \" style=\"margin-left:20px;margin-top:20px\">";
echo "<a class=\"addthis_button_preferred_1\"></a>";
echo "<a class=\"addthis_button_preferred_2\"></a>";
echo "<a class=\"addthis_button_preferred_3\"></a>";
echo "<a class=\"addthis_button_preferred_4\"></a>";
echo "<a class=\"addthis_button_compact\"></a>";
echo "<a class=\"addthis_counter addthis_bubble_style\"></a>";
echo "</div>";
echo "<script type=\"text/javascript\">var addthis_config = {\"data_track_addressbar\":false};</script>";
echo "<script type=\"text/javascript\" src=\"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e2bd5c123e4313e\"></script>";

}

function button_loadmore($num,$id){
 
    if($num>2)
{
if($id==1)//when we reach first message posted, no more message to load
{
echo "<div class='morebox'>No more updates to load...";
echo "</div>";
}
else
{
echo "<div id='more$id' class='morebox'>";
echo "<a href='#' class='more' id='$id'>".loadmore."</a>";
echo "</div>";
}
}
}
 
}

?>