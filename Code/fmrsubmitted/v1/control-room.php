<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];
if( $clearance != 1 )
{
	header('Location: fmr.php');
}

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<style>
			section
			{
				padding:20px;
			}
			.div1
			{
				margin-left:100px;
				width:40%;
			}
			.div2
			{
				float:right;
				margin-left:100px;
				width:40%;
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
			<h2>Welcome to the Control room of the FMR, National Headquaters</h2>
			<p>Control is a place where the national headquaters can control the users of various states and districts
			<br>
			You can add users for different states and districts. You can also view information about the states and district users.
			<br>
			Please click on one of the option below</p>
			
				 
				<div class="div1"><a href="add-state.php">Add new state</a></div> 
			
			<!--	<div class="div2"><a href="view-district.php">View district</a></div>  -->
				<div class="div1"><a href="add-district.php">Add new district</a></div>
				<div class="div1"><a href="view-state.php">View states and district users</a></div>
			
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
