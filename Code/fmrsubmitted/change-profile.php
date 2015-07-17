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
		<title>Change Profile|FMR</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<link rel="stylesheet" href="css/forms.css">
		<style>
		table
		{
			margin-left:auto;
			margin-right: auto;
		}
		</style>
	</head>

	<body>
		<header>
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
			<h1>You can change various details related to your account here.</h1>
			
			<table border="0">
				<form method="POST" action="change-profile-proc.php">
					<tr>
						<td><label for="name" class = "formlabels" style="padding-top:20px">Name</label></td>
						<td>:</td>
						<td><input type="text" name="name" id="name" size="25" placeholder="Name" value="<?php 
							echo $row['name']; ?>" required></td>
					</tr>
					<tr>
						<td><label for="mobile" class = "formlabels" style="padding-top:20px">Mobile</label></td>
						<td>:</td>
						<td><input type="text" id="mobile" name="mobile" size="20" placeholder="Mobile" value="<?php echo $row['mobile']; ?>" required></td>
					</tr>
					<tr>
						<td><label for="email" class = "formlabels" style="padding-top:20px">Email id</label></td>
						<td>:</td>
						<td><input type="text" id="email" name="email" size="25" placeholder="Email id" value="<?php echo $row['email_id']; ?>" required></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="submit" value="Save Changes" id="submit"></td>
					</tr>
				</form>
			</table>
				
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