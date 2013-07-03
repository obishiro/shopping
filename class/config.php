<?php
define("Host", "localhost");
define("UserDB", "root");
define("PassDB", "1234");
define("DBName", "dbshopping");
define("WebUrl", "http://localhost/shopping/");


mysql_connect(Host,UserDB,PassDB) or die (mysql_error());
mysql_select_db(DBName) or die (mysql_error());
mysql_query("SET character_set_client = utf8");                    
mysql_query("SET character_set_connection = utf8");
mysql_query("SET character_set_database = utf8");
mysql_query("SET character_set_results = utf8");
mysql_query("SET character_set_server = utf8");
define("Limit", "20");
 
$i=1;	

 foreach($_POST as $key=>$value){  
        $$key=$value;  
     }  
     foreach($_GET as $key=>$value){  
         $$key=$value;  
     } 

?>