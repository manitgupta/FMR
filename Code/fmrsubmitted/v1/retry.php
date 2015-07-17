<?php

// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['username'])) {
header('Location: home.php');
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
		</header>
		
		<section>
			<article>
				<p id="invalid-login">Sorry invalid username and/or password</p>
			</article>
			<h3>LOGIN</h3>
			<table border="0">
				<form method="POST" action="loginproc.php">
					<tr><td>Username</td><td>:</td><td><input type="text" name="username" size="20" placeholder="username" required></td></tr>
					<tr><td>Password</td><td>:</td><td><input type="password" name="password" size="20"placeholder="password" required></td></tr>
					<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value="Login"></td></tr>
				</form>
			</table>
			<br>
			<br>
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