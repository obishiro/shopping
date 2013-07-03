<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (empty( $_SESSION['Usr'] )) {
$StrDisplay->GoUrl('0','index.html');
		exit;
} 
$tb="tb_config_theme";
switch ($_GET['section']) {
	case 'edit':
		$StrDB->UpdateData("tb_theme","ThemeId='".mysql_real_escape_string($_GET['id'])."' ","where User='".$_SESSION['UsrId']."'");
		$StrDisplay->EditSuccess();
		$StrDisplay->GoUrl('3',"index.php?action=".$action);
		
		break;
	
 
}
echo "<br><br><div class=\"alert alert-success\"><span class=\"label label-warning\">".Theme."</span>&nbsp;&nbsp;
<span style=\"font-weight:bold\">".YourTheme."</span></div>";
$sql_yourtheme="select tb_theme.Id,$tb.* from tb_theme inner join $tb on tb_theme.ThemeId=$tb.Id where tb_theme.User='".$_SESSION['UsrId']."' ";
$q=$StrDB->Query($sql_yourtheme);
$rst=$StrDB->FetchData($q);
 	echo "<div class=\"row\">";
  echo "<li style=\"list-style:none\" class=\"span4\">";
     echo "<div class=\"thumbnail\">";
 
      echo "<a href=\"#\" class=\"thumbnail\">";
      echo "<img  src=\"".WebUrl."template/$rst[ThemePath]/$rst[ThemeImg]\"  ></a>";
    
      echo "<h3>$rst[ThemeName]</h3>";
     echo " <p>Thumbnail caption...</p>";
    // echo "<a class=\"btn btn-primary\" onClick=\"return confirm('".rusureUse."')\"  href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[0]\" >".UseTheme."</a>";
    echo "</div>";
  echo "</li>";
  echo "</div><br>";

echo "<div class=\"alert alert-info\"><span class=\"label label-info\">".AllTheme."</span>&nbsp;&nbsp;
<span style=\"font-weight:bold\">".ChooseTheme."</span></div>";
		$sql="select * from $tb    order by Id desc";
		$query=$StrDB->Query($sql);
		echo "<ul class=\"thumbnails\">";
 		while($rs=$StrDB->FetchData($query)) {
   
  echo "<li class=\"span4\">";
 
    echo "<div class=\"thumbnail\">";
 
      echo "<a href=\"#\" class=\"thumbnail\">";
      echo "<img  src=\"".WebUrl."template/$rs[ThemePath]/$rs[ThemeImg]\"  ></a>";
    
      echo "<h3>$rs[ThemeName]</h3>";
     echo " <p>Thumbnail caption...</p>";
     echo "<a  class=\"btn btn-primary\" onClick=\"return confirm('".rusureUse."')\"  href=\"".WebUrl."admin/index.php?action=$_GET[action]&section=edit&id=$rs[0]\" >".UseTheme."</a>";
    echo "</div>";
  echo "</li>";
  
			 

		}
		echo "</ul>";

?>