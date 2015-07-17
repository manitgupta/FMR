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
			<h2>You can change various details related to your account here.</h2>
			
			<table border="0">
				<form method="POST" action="change-profile-proc.php">
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><input type="text" name="name" size="25" placeholder="Name" value="<?php 
							echo $row['name']; ?>" required></td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td>:</td>
						<td><input type="text" name="mobile" size="20" placeholder="Mobile" value="<?php echo $row['mobile']; ?>" required></td>
					</tr>
					<tr>
						<td>Email id</td>
						<td>:</td>
						<td><input type="text" name="email" size="25" placeholder="Email id" value="<?php echo $row['email_id']; ?>" required></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="submit" value="Save Changes" id="submit"></td>
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