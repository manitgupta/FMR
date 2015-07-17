<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

include('database-view-130714.php');

$user = $_SESSION['username'];
$query = "SELECT * FROM login WHERE username='$user'";
$result = mysql_query($query);

$row = mysql_fetch_array($result);

$message = null;

if (isset($_SESSION['details'])) 
{
	$details = $_SESSION['details'];
	
	if($details == "profile")
	{
		$message = "Your account details have been successfully changed.";
	}
	if($details == "password")
	{
		$message = "Your password has been successfully changed";
	}
	$_SESSION['details'] = null;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<style>
		#alert
		{
			color:red;
		}
		table{
			margin-left: auto;
			margin-right: auto;
		}
		ul{
			list-style-type: none;
		}
		</style>
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
		
		<div>
			<?php
				if($message != null)
				{
			?>
					<p id ="alert"> <?php echo $message; ?> </p>
			<?php
				}
			?>
			<h1>You can change various details related to your account here.</h1>
			
			<table>
				<tr>
					<td>Name</td>
					<td class="table-space"></td>
					<td><?php echo $row['name']; ?> </td>
				</tr>
				<tr>
					<td>Contact number</td>
					<td class="table-space"></td>
					<td><?php echo $row['mobile']; ?> </td>
				</tr>
				<tr>
					<td>Email id</td>
					<td class="table-space"></td>
					<td><?php echo $row['email_id']; ?> </td>
				</tr>
			</table>
			
			<ul>
				<h2><li class="home-links"><a href="change-profile.php">Change your account details</a></li></h2>
				<h2><li class="home-links"><a href="change-password.php">Change your password</a></li></h2>
			</ul>
				
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