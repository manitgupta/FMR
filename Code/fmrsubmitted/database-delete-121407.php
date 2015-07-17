<?php

$hostname = 'localhost';        
$dbname   = 'fmrircs_fmr_data'; 

$username = 'fmrircs_fmrDelet';             
$password = 'delete@bits';                
 
mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');
// Select the database
mysql_select_db($dbname) or DIE('Database name is not available!');

?>