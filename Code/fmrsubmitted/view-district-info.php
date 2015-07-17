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

$district = mysql_real_escape_string($_POST['district']);

$sql = "SELECT * FROM login where clearance='3' and district='$district'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

//fmr number
$fmr_query = "SELECT sl_no FROM table_3 WHERE district='$district'";
$fmr_result = mysql_query($fmr_query);
$fmr_number =  mysql_num_rows($fmr_result);

mysql_close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<style>
			table{
				margin-right: auto;
				margin-left: auto;
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
			<h1>Here is the details of the district, <?php echo $district; ?></h1>
			
			<table>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td><?php echo $row['name']; ?></td>
				</tr>
				<tr>
					<td>Mobile no.</td>
					<td>:</td>
					<td><?php echo $row['mobile']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $row['email_id']; ?></td>
				</tr>	
				<tr>
					<td>Number of FMRs present in the state</td>
					<td>:</td>
					<td><?php echo $fmr_number; ?></td>
				</tr>	
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
