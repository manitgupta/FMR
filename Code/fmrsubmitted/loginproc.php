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

$bad_login_limit = 3;
$lockout_time = 600;


$failed_login = mysql_query("SELECT * FROM login WHERE username = '" . mysql_real_escape_string($_POST['username']) ."'");

$row = mysql_fetch_assoc($failed_login);;
$first_failed_login = $row['first_failed_login'];
$failed_login_count = $row['failed_login_count'];


if(mysql_num_rows($failed_login) == 1 and ($failed_login_count >= $bad_login_limit) && (time() - $first_failed_login < $lockout_time)) {
  header('Location: banned.php');
}
elseif(mysql_num_rows($failed_login) == 1 and mysql_num_rows($login) != 1) {
  if( time() - $first_failed_login > $lockout_time ) {
    $first_failed_login = time();
    $failed_login_count = 1;
    mysql_query("UPDATE login set first_failed_login =".$first_failed_login." WHERE username = '" . mysql_real_escape_string($_POST['username'])  ."'");
    mysql_query("UPDATE login set failed_login_count ='".$failed_login_count."' WHERE username = '" . mysql_real_escape_string($_POST['username']) ."'");
  } 
  else {
    $failed_login_count++;
    mysql_query("UPDATE login set failed_login_count =".$failed_login_count." WHERE username = '" . mysql_real_escape_string($_POST['username']) ."'");
  }
  header('Location: retry.php');
}
elseif (mysql_num_rows($login) == 1) 
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
else{
	header('Location: retry.php');
}

?>