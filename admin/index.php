<?php
session_start();
include("header.php"); 
?>
  

       
      <div  class="container-fluid">
      	<?php
      		if(!$_SESSION['UsrId']) {

      			 if(isset($action)  ) {
        			switch ($action) {
         	          
        		 case 'login':
            
        	 			 $StrDB->Login($_POST['UserName'],$_POST['Password']);
          
           			 break;
          		}
        }else if(!isset($_SESSION['UsrId']) ){
          $StrDisplay->login_form();

       }

      		}else{
      			 if(isset($action)  ) {
        			switch ($action) {
        				
        			case 'logout':
        			$url=$_SESSION['WebUrl'];
             		 $StrDB->Logout();
              		//$StrDisplay->GoUrl('0',''.WebUrl.''.$url.'/index.php');
             		 echo "<meta Http-equiv=\"refresh\"  Content=\"3; Url=".WebUrl."$url/\">";
            		break;
            		default:
            		if(empty($section)) {
            		$arr_action=array('configoffice','theme','sell' ,'login','logout','configshop','configweb');
     		 		$arr=array_search($action,$arr_action);
     			 
  						if($arr==FALSE)	 {  		 	
    					 echo "<div  style=\"float:right\"> <a class=\"btn btn-success\" href=\"".WebUrl."admin/index.php?action=$action&section=add\">".Add."</a></div>"; //ปุ่มเพิ่มข้อมูล
      					echo "<br>"  ;
      				}
      			}
            		 require_once 'module/'.$action.'.php';
            		 break;
        			}
        		}else{
        			$numtheme=$StrDB->NumRows("select User from tb_theme where User='".$_SESSION['UsrId']."' ");
				if($numtheme=="0") {
				$sql=mysql_query("insert into tb_theme values( '".NULL."','1','".$_SESSION['UsrId']."' )");
					}
      			$num=$StrDB->NumRows("select User from tb_config_office where User='".$_SESSION['UsrId']."' ");
      	 
      			if($num=="0") {
      				require_once 'module/configshop.php';
      				$_GET['action']="configshop";
      				}
        		}


      		}
      	?>
  			

      </div>
  
      
       
       
      <br><br>
      <hr>
 
      <footer>
        <p>&copy; <?=WebName ;?> 2012</p>
      </footer>

    </div> 
  </body>
</html>
