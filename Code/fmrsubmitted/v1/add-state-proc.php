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

// Include database connection settings
include('database-edit-232714.php');

$name = $_POST['name'];
$name = mysql_real_escape_string($name);
$state = mysql_real_escape_string($_POST['state']);
$mobile = mysql_real_escape_string($_POST['mobile']);
$email = mysql_real_escape_string($_POST['email']);

$message = "null";

$query = "SELECT * FROM login WHERE state='$state'";
$result = mysql_query($query);

if (mysql_num_rows($result) >= 1) 
{
	$message = "Details of the ".$state." is already present there";
}
else
{
	//convert the state name to lowercase
	$state = strtolower($state);
	//generate random password.
	$password =  rand(134232, 987432);		//134232 and 987432 are just random numbers :P
	//encrypt the password to md5 and save a pass. pass to save in database and password to be displayed
	$pass = md5($password);
	
	//username
	$user = $state;
	
	$clear = 2;				//clearance level
	$district = null;		//district to null
	
	//mysql query string
	$query = "INSERT INTO login(username, password, name, email_id, mobile, clearance, district, state) VALUES ('$user','$pass','$name','$email','$mobile','$clear','$district','$state')";
	//execute query
	$res = mysql_query($query);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>

	<body>
		<header>
			<div id="header-title">
				<div id="header-title-banner"><img alt="Indian Red Cross Soceity" src="images/index_06.jpg" id="logo"> </div>
			</div>
			<nav>
				<ul>
					<li><a href="fmr.php">Home</a></li>
					<li>|</li>
					<li><a href="view-responders.php">View</a></li>
					<li>|</li>
					<?php
						//add option will be visible only when NHQ is logged in.
						if( $clearance == 1 )
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
			</nav>
		</header>
		
		<section>
		<?php
			if($message != "null")
			{
		?>
			<p><?php 
				echo $message; 
			?>
		Please <a href="#">click here</a> to edit the details of this state</p>
		<?php
			}
			else
			{
		?>
			<p> State Successfully created </p>
			<p> Username : <?php echo $user; ?> </p>
			<p> Password : <?php echo $password; ?> </p>
		<?php
			}
		?>
		</section>
		
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