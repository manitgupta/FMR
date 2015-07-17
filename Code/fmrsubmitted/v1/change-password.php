<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$message = null;
if (isset($_SESSION['details'])) 
{
	$details = $_SESSION['details'];
	
	if($details == "short_password")
	{
		$message = "Length of the password should of equal to or greater than 6";
	}
	if($details == "different_password")
	{
		$message = "Passwords did not match. Please re-enter.";
	}
	if($details == "incorrect_password")
	{
		$message = "Incorect password. Please enter your old password correctly.";
	}
	$_SESSION['details'] = null;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<style>
		table
		{
			margin-left:30px;
		}
		#alert
		{
			color:red;
		}
		</style>
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
				if($message != null)
				{
			?>
					<p id ="alert"> <?php echo $message; ?> </p>
			<?php
				}
			?>
			<h2>Please enter </h2>
			
			<table border="0">
				<form method="POST" action="change-password-proc.php">
					<tr>
						<td>Old Password</td>
						<td>:</td>
						<td><input type="password" name="opassword" size="25" placeholder="Old Password" required></td>
					</tr>
					<tr>
						<td>New Password</td>
						<td>:</td>
						<td><input type="password" name="password" size="25" placeholder="New Password" required></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td>:</td>
						<td><input type="password" name="cpassword" size="25" placeholder="Confirm Password" required></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="submit" value="Change Password" id="submit"></td>
					</tr>
				</form>
			</table>
				
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