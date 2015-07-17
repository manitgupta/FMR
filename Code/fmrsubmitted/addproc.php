<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

if( !($clearance == 1 or $clearance == 2 or $clearance==3) )
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
	
if($sex =="c1")
	$sex = "M";
else if	($sex == "c2")
	$sex = "F";
else
	$sex = "";

$message = "";
//sl_no is auto increment no need to add sl_no
//query to be done. This will insert data to the table
$username = $_SESSION['username'];
$query = "SELECT state, district FROM login where username='".$username."'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$user_state = $row['state'];
$user_district = $row['district'];

if (($clearance == 3 and strtolower($user_district) == strtolower($district) and strtolower($user_state) == strtolower($state)) or  ($clearance == 2 and strtolower($user_state) == strtolower($state)) or $clearance == 1) {
$query = "INSERT INTO table_3 (name,age,sex,address,mobile,email,guardian,present_designation,edn_qual,prof_techqual,
maritial_status,qualified_first_aider,rc_trainings,experience,year_of_training,district,state) 
VALUES 
('$name','$age','$sex','$address','$mobile','$email','$guardian','$pres_desig','$edu_qual','$prof_qual',
'$marit_status','$qual_first_aider','$rc_training','$experience','$year','$district','$state')";

$res = mysql_query($query);
$message = "Data Updated Succesfully!";


if($res == false)

$message = "Couldn't perform task";

}
else
{

$message  = "You don't have the privelege to update details of " . $state;	

}

//DELETE FROM `table_3` WHERE `sl_no` >271 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Added Responders|FMR</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
	</head>

	<body>
		<header>
			<!-- <div id="header-title">
				<div id="header-title-banner"><img alt="Indian Red Cross Soceity" src="images/index_06.png" id="logo"> </div>
			</div> -->
			<?php
			include('navmenu.php');
			  ?>
			
			<!-- <nav>
				<ul>
					<li><a href="fmr.php">Home</a></li>
					<li>|</li>
					<li><a href="view-responders.php">View</a></li>
					<li>|</li>
					<?php
						// if( $clearance == 1 )
						{
					?>
						<li><a href="add-responders.php">Add</a></li>
						<li>|</li>
					<?php
						}
					?>
					<li><a href="search-responders.php">Search</a></li>
					<li>|</li>
					<li><a href="settings.php">Settings</a></li>
					<li>|</li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav> -->
		</header>
		
		<div class="content">
		
		</p>
			<p> <?php
							echo $message;
							?> 
			</p>

			<p> Click <a href="view-responders.php">here to view the data</a></p>
			<p> Click <a href="add-responders.php">here to add another volunteer into the list</a></p>
		</div>
		
		<footer>
			<nav id="footer-nav">
				<ul>
					<li><a href="http://www.indianredcross.org">Red Cross Home</a></li>
					<li>|</li>
					<li><a href="http://www.indianredcross.org/headquarters.htm">Contact</a></li>
				</ul>
			</nav>
		</footer>
	</body>
</html>