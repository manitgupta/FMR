<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

// Inialize session
session_start();

// Include database connection settings
include('database-edit-232714.php');

// Retrieve username and password from database according to user's input
$login = mysql_query("SELECT * FROM login WHERE (username = '" . mysql_real_escape_string($_POST['username']) . "') and (password = '" . mysql_real_escape_string(md5($_POST['password'])) . "')");

// Check username and password match
if (mysql_num_rows($login) == 1) 
{
	// Set username session variable
	$_SESSION['username'] = $_POST['username'];
	
	// set the clearance of the session too
	//get the row from the login
	$row = mysql_fetch_assoc($login);
	//set the seesion clearance to the row clearance
	$_SESSION['clearance'] = $row['clearance'];
	
	//set the state and district of the session also
	if( $row['clearance'] == 2 || $row['clearance'] == 3 )
	{
		$_SESSION['state'] = $row['state'];
	}
	
	if( $row['clearance'] == 3 )
	{
		$_SESSION['district'] = $row['district'];
	}
	
	// Jump to secured page
	header('Location: fmr.php');
}
else 
{
	// Jump to login page
	header('Location: retry.php');
}

?>