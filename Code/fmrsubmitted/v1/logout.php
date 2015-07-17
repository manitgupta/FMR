<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['username']);
// Delete all session variables
 session_destroy();

// Jump to login page
//header('Location: index.php');

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
		</header>
		
		<section>
			<p>You have been successfully logged out</p>
			<br>
			<p>Click <a href="index.php" id="new-login">here to login </a></p>
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
