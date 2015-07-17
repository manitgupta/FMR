<?php

// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['username'])) {
header('Location: fmr.php');
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Society</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		
		<style>
			#info
			{
				font-size:20px;
				margin-top:330px;
			}
			#fmr
			{
				height:73%;
				width:73%;
				float:left;
			}	
			#tab
			{
				float:right;
				padding-top:30px;
				margin-right:30px;
			}
			#head
			{
				margin-right:150px;
				float:right;

			}
			#img
			{
				height:33%;
				width:33%;
			}
			#credits
			{
				color:white;
				width:auto;
				font-size:14px;
			}
			#footer-nav
			{
				//margin-top:0px;
			}
			#bits-logo
			{
				float:right;
			}
			#bitslogo
			{
				width:163px;
				height:50px;
			}
		</style>
	</head>

	<body>
		<header>
			<div id="bits-logo">
				<img src="images/logo.jpg" alt="bits-logo" id="bitslogo">
			</div>
			<div id="header-title">
				<div id="header-title-banner"><a href="http://www.indianredcross.org"><img alt="Indian Red Cross Soceity" src="images/index_06.png" id="logo"></a></div>
			</div>
			
		</header>
		
		
		<section>
			
			<h3 id="head">LOGIN</h3>
			
			<img alt="fmr" src="images/1.jpg" id="fmr">
			<table border="0"id="tab">
				<form method="POST" action="loginproc.php" id="tab">
					<tr><td>Username</td><td>:</td><td><input type="text" name="username" size="20" placeholder="Username" required></td></tr>
					<tr><td>Password</td><td>:</td><td><input type="password" name="password" size="20" placeholder="Password" required></td></tr>
					<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value="Login"></td>
					</tr>
				</form>
			</table>
			<br>
			<br>
			<p id="info">The First Medical Responders is a unique concept of the Indian Red Cross Society whose pilot programme was launched in Uttarakhand in 2011. An FMR is a person who is certified to provide first aid in emergencies to the community before external help arrives. Training volunteers in the use of first aid skills makes a difference in the quality of services rendered as the FMRs belong to the affected and neighbouring communities and are already near the scene of disaster. They are the first people to arrive at an emergency scene as they are from the same area.<br><br> With the launch of the FMR module in Bhaderwah, Jammu & Kashmir, in September 2013, the Indian Red Cross Society has spread the programme to 18 most disaster prone states of the country. Under the FMR module, volunteers were trained for providing first aid, water, sanitation and hygiene promotion, public health and psychosocial support, search and rescue and management of dead bodies.</p>
			<img alt="fmr" src="images/2.jpg" id="img">
			<img alt="fmr" src="images/3.jpg" id="img">
			<!-- make corresponding changes in css -->
			<a class="twitter-timeline" href="https://twitter.com/IndianRedCross" data-widget-id="608180555553738753"   width="330"
  height="240">Tweets by @IndianRedCross</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</section>
		
		<footer>
			
			<nav id="footer-nav">
				<ul>
					<li><a href="http://www.indianredcross.org">Red Cross Home</a></li>
					<li>|</li>
					<li><a href="http://www.indianredcross.org/headquarters.htm">Contact</a></li>
				</ul>
			</nav>
			<p id="credits">Created by (students of BITS Pilani): Manit Gupta | Anubhav Gupta | Gyanendra Misrha | Shubham Agrawal </p>
		</footer>
	</body>
</html>