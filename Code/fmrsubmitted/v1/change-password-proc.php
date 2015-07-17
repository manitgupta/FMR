<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

//include the database
include('database-edit-232714.php');

//get all the fields from the form and store it in the variables
$opassword = mysql_real_escape_string($_POST['opassword']);
$opassword = md5($opassword);

$user = $_SESSION['username'];
$check_password = "SELECT * FROM login WHERE username='$user' and password='$opassword'";
$check_password_result = mysql_query($check_password);

if (mysql_num_rows($check_password_result) == 1) 
{
	$password = mysql_real_escape_string($_POST['password']);
	$cpassword = mysql_real_escape_string($_POST['cpassword']);
	
	if(strlen($password) < 6)
	{
		$_SESSION['details'] = "short_password";
		header('Location: change-password.php');
	}

	else if($password == $cpassword)
	{
		//get username of the session and change the details
		
		$pass = md5($password);
		
		$update = "UPDATE login SET password = '$pass' WHERE username = '$user'";
		mysql_query($update);

		mysql_close();
		
		$_SESSION['details'] = "password";
		header('Location: settings.php');
	}
	else
	{
		$_SESSION['details'] = "different_password";
		header('Location: change-password.php');
	}
}
else
{
	$_SESSION['details'] = "incorrect_password";
	header('Location: change-password.php');
}
?>

