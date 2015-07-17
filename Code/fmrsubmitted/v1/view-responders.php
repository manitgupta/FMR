<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

include('database-view-130714.php');
 
if( $clearance == 1 )
{
	$query = "SELECT * FROM table_3 ORDER BY sl_no";
}
else if( $clearance == 2 )
{
	$state = $_SESSION['state'];
	$query = "SELECT * FROM table_3 WHERE state = '$state' ORDER BY sl_no";
}

else if( $clearance == 3 )
{
	$state = $_SESSION['state'];
	$district = $_SESSION['district'];
	$query = "SELECT * FROM table_3 WHERE state = '$state' AND district = $district ORDER BY sl_no";
}
	
$result = mysql_query($query);

$sn = 1;

mysql_close();

$message = null;

if (isset($_SESSION['details'])) 
{
	$details = $_SESSION['details'];
	
	if($details == "record-exists")
	{
		$message = "All the volunteers details are already stored in database.";
	}
	else if($details == "record-added")
	{
		$count = $_SESSION['count'];
		$_SESSION['count'] = null;
		$message = $count . " record(s) have been added to the databse";
	}
	else if($details == "record-deleted")
	{
		$message = "Details of the selected user has been deleted form the database.";
	}
	else if($details == "record-edited")
	{
		$message = "Details of the selected user has been edited in the database.";
	}
	$_SESSION['details'] = null;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<style>
		#alert
		{
			color:red;
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
			<?php
				if($message != null)
				{
			?>
					<p id ="alert"> <?php echo $message; ?> </p>
			<?php
				}
			?>
			
			<h1> Information for First Medical Responders </h1>
			
			<table border="1" cellspacing="7" cellpadding="5">
				<tr>
				<th><font face="Arial, Helvetica, sans-serif"> </font></th>
				<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
				<th><font face="Arial, Helvetica, sans-serif">Age</font></th>
				<th><font face="Arial, Helvetica, sans-serif">Sex</font></th>
				<th><font face="Arial, Helvetica, sans-serif">Address</font></th>
				<th><font face="Arial, Helvetica, sans-serif">District</font></th>
				<th><font face="Arial, Helvetica, sans-serif">State</font></th>
				<th><font face="Arial, Helvetica, sans-serif">Year</font></th>
				<th><font face="Arial, Helvetica, sans-serif">Mobile</font></th>
				<th><font face="Arial, Helvetica, sans-serif">Email</font></th>
				</tr>
				
				<?php

				while ($row = mysql_fetch_assoc($result)) {

				?>

				<tr>
				<td align="center"><font face="Arial, Helvetica, sans-serif"><?php  
					echo $sn;
					$sn++;
					if( $clearance == 1 )
					{
						echo ("<br><a href=\"edit_responders.php?id=$row[sl_no]\"><img src=\"edit.png\" alt=\"Click to edit\"></a>");
						echo ("<a href=\"delete_responders.php?id=$row[sl_no]\"><img src=\"delete.png\" alt=\"Click to delete\"></a>");
					}
					?></font></td>
					
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['name']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['age']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php $sex =  $row['sex'];
					if($sex =="M" || $sex=="m")
						echo "Male";
					else if($sex == "F" || $sex=="f")
						echo "Female";
					else
						echo $sex;
					?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['address']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['district']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['state']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['year_of_training']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['mobile']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php $email = $row['email']; 
					if($email != "Nil")
						echo $email;
					?></font></td>
				</tr>


				<?php
				}
				?>
			
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