<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];
if( $clearance != 1 )
{
	header('Location: cfmr.php');
}

include('database-delete-121407.php');

$id = mysql_real_escape_string($_GET["id"]); 

$delete = "DELETE FROM table_3 WHERE sl_no=$id";
mysql_query($delete);

mysql_close();

//start session to define the session variables and then jump to view-responders.php page to display the appropriate code.
session_start();

$_SESSION['details'] = "record-deleted";
header('Location: view-responders.php');

?>