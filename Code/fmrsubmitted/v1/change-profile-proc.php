<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

include('database-edit-232714.php');

//get all the fields from the form and store it in the variables
$name = mysql_real_escape_string($_POST['name']);
$mobile = mysql_real_escape_string($_POST['mobile']);
$email = mysql_real_escape_string($_POST['email']);

//get username of the session and change the details
$user = $_SESSION['username'];
$update = "UPDATE login SET name = '$name', mobile = '$mobile', email_id = '$email' WHERE username = '$user' ";
mysql_query($update);

mysql_close();

$_SESSION['details'] = "profile";
header('Location: settings.php');
?>

