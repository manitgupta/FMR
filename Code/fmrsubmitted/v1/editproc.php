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
	header('Location: fmr.php');
}

include('database-edit-232714.php');

//get all the fields from the form and store it in the variables
$name = mysql_real_escape_string($_POST['name']);
$age = mysql_real_escape_string($_POST['age']);
$sex = mysql_real_escape_string($_POST['sex']);
$year = mysql_real_escape_string($_POST['year']);
$address = mysql_real_escape_string($_POST['address']);
$district = mysql_real_escape_string($_POST['district']);
$state = mysql_real_escape_string($_POST['state']);
$mobile = mysql_real_escape_string($_POST['mobile']);
$email = mysql_real_escape_string($_POST['email']);
$guardian = mysql_real_escape_string($_POST['gr']);
$pres_desig = mysql_real_escape_string($_POST['pres_desig']);
$edu_qual = mysql_real_escape_string($_POST['edu_qual']);
$prof_qual = mysql_real_escape_string($_POST['prof_qual']);
$marit_status = mysql_real_escape_string($_POST['marit_status']);
$qual_first_aider = mysql_real_escape_string($_POST['qual_first_aider']);
$rc_training = mysql_real_escape_string($_POST['rc_training']);
$experience = mysql_real_escape_string($_POST['experience']);

$id = mysql_real_escape_string($_GET["id"]);

if($sex =="c1")
	$sex = "M";
else if	($sex == "c2")
	$sex = "F";
else
	$sex = "";

//rc_trainings = = '$rc_training',
$update = "UPDATE table_3 SET 
name = '$name',
age = '$age',
sex = '$sex',
address = '$address',
email = '$email',
guardian = '$guardian',
present_designation = '$pres_desig',
edn_qual = '$edu_qual',
prof_techqual = '$prof_qual',
maritial_status = '$marit_status',
qualified_first_aider = '$qual_first_aider',
rc_trainings = '$rc_training',
experience = '$experience',
year_of_training = '$year',
district = '$district',
state = '$state'
WHERE sl_no = '$id' ";

$result = mysql_query($update);

mysql_close();

//start session to define the session variables and then jump to view-responders.php page to display the appropriate code.
session_start();

$_SESSION['details'] = "record-edited";
header('Location: view-responders.php');
	
?>