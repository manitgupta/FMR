<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];

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
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
	</head>

	<body>
		<header>
			<div id="header-title">
				<div id="header-title-banner"><img alt="Indian Red Cross Soceity" src="images/index_06.png" id="logo"> </div>
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
			<h2>Welcome to First Medical Responder</h2>
			<p>Select one of the option</p>
			
			<ul>
				<li class="home-links"><a href="view-responders.php">View First Medical Responders</a></li>
				
				<?php
					if( $clearance == 1 )
					{
				?>
					<li class="home-links"><a href="add-responders.php">Add new Responders</a></li>
				<?php
					}
				
				?>
				
				<li class="home-links"><a href="search-responders.php">Search</a></li>
				
				<?php
					if( $clearance == 1 )
					{
				?>
					<li class="home-links"><a href="control-room.php">Control Room</a></li>
				<?php
					}
				?>
				
				<li class="home-links"><a href="settings.php">Settings</a></li>
				<li class="home-links"><a href="logout.php">Logout</a></li>
			</ul>
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