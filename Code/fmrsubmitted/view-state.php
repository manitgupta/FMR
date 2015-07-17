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

include('database-view-130714.php');

$sql = "SELECT DISTINCT state FROM login where clearance='2'";
$result = mysql_query($sql);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<style>
			section
			{
				padding:20px;
			}
			form
			{
				margin-left:5%;
			}
			select {
						margin: 5px;
					  	padding: 0 10px;
						width: 300px;
						height: 60px;
						color: #404040;
						background: white;
						border: 1px solid;
						border-color: #c4c4c4 #d1d1d1 #d4d4d4;
						border-radius: 2px;
						outline: 5px solid #eff4f7;
						-moz-outline-radius: 3px;
						-webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
						box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
						-ms-box-sizing:content-box;
						-moz-box-sizing:content-box;
						-webkit-box-sizing:content-box; 
						box-sizing:content-box;
						text-transform:capitalize;
						font-weight:bold;
						font-size:18px;
					}
			select:focus{
				border-color: #7dc9e2;
			  	outline-color: #dceefc;
			  	outline-offset: 0;
			}
		</style>
	</head>

	<body>
		<header>
			<?php 
			include('navmenu.php');
		 	?>
			<!-- <div id="header-title">
				<div id="header-title-banner"><img alt="Indian Red Cross Soceity" src="images/index_06.png" id="logo"> </div>
			</div>
			<nav>
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
			<h1>You can view the data of various states here.</h1>
			<p> Please click of the state for which you want the information<p>
			<p> If you want to view the information about the districts. Please select the state in which the district is present and then select the district.</p>
			
			<form method="post" action="view-state-info.php">
				<select name="state" multiple>
					<?php
						while($row = mysql_fetch_array($result))
						{
					?>
					<option value="<?php echo $row['state']; ?>"><?php echo $row['state']; ?></option>
				
					
					<?php
						}
					?>
				</select>
				<br>
				<br>
				<input type="submit" value="GO">
			</form>
			
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
