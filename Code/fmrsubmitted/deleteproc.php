<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

if( !($clearance == 1 or $clearance == 2 or $clearance=3) )
{
	header('Location: cfmr.php');
}

include('database-delete-121407.php');

$username = $_SESSION['username'];
$query = "SELECT state, district FROM login where username='".$username."'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$user_state = $row['state'];
$user_district = $row['district'];

$id = mysql_real_escape_string($_GET["id"]); 


$query = "SELECT state from table_3 where sl_no=$id";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$state = $row['state'];


$_SESSION['delete_priv'] = false;
$delete = "DELETE FROM table_3 WHERE sl_no=$id";

if (($clearance == 3 and strtolower($user_district) == strtolower($district) and strtolower($user_state) == strtolower($state)) or  ($clearance == 2 and strtolower($user_state) == strtolower($state)) or $clearance == 1) {
	mysql_query($delete);
	$_SESSION['delete_priv'] = true;
}

mysql_close();

//start session to define the session variables and then jump to view-responders.php page to display the appropriate code.
session_start();
$_SESSION['details'] = "record-deleted";
header('Location: view-responders.php');

?>