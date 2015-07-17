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

$state = mysql_real_escape_string($_POST['state']);

$sql = "SELECT * FROM login where clearance='2' and state='$state'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

//district number
$number_district = "SELECT * FROM login WHERE clearance='3' and state='$state'";
$result_district = mysql_query($number_district);
$district_num = mysql_num_rows($result_district);

//fmr number
$fmr_query = "SELECT sl_no FROM table_3 WHERE state='$state'";
$fmr_result = mysql_query($fmr_query);
$fmr_number =  mysql_num_rows($fmr_result);

mysql_close();
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
			<h2>Here is the details of the state, <?php echo $state; ?></h2>
			
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
					<td>Number of districts under this state</td>
					<td>:</td>
					<td><?php echo $district_num; ?></td>
				</tr>	
				<tr>
					<td>Number of FMRs present in the state</td>
					<td>:</td>
					<td><?php echo $fmr_number; ?></td>
				</tr>	
			</table>
			
			</p>Here is the list of all the districts under this state.</p>
			
			<form method="post" action="view-district-info.php">
				<select name="district" multiple>
					<?php
						while($row = mysql_fetch_array($result_district))
						{
					?>
					<option value="<?php echo $row['district']; ?>"><?php echo $row['district']; ?></option>
					
					<?php
						}
					?>
				</select>
				<br>
				<br>
				<input type="submit" value="GO">
			</form>
			
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
