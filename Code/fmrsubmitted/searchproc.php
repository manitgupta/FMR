<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

include('database-view-130714.php');

//get all the fields from the form and store it in the variables
$name = mysql_real_escape_string($_POST['name']);
$year = mysql_real_escape_string($_POST['year']);
$district = mysql_real_escape_string($_POST['district']);
$state = mysql_real_escape_string($_POST['state']);

$sql = "SELECT * FROM table_3 WHERE 
name like '%$name%' and 
year_of_training like '%$year%' and
district like '%$district%' and
state like '%$state%'";
$result = mysql_query($sql);

mysql_close();

$clearance =  $_SESSION['clearance'];

$_SESSION['details'] = $sql;

$sn = 1;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<link rel="stylesheet" type = "text/css" href="css/table.css">
		<style>
			#export
			{
				color:blue;
				float:right;
				margin-right:20px;
			}
			
			table
			{	
			font-family:Verdana, Geneva, sans-serif;
			padding:30px;
			margin:10px auto 0px auto;
			font-size:16px;
			box-shadow:none;
			text-shadow:none;
			column-gap:normal;
			border-spacing:0px;
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
			<h1 id="h1"> Information for First Medical Responders </h1>
			
			<p id="export"><a href="export.php">Print this list in the excel file</a></p>
			<br>
			
			<table>
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

				<td><font face="Arial, Helvetica, sans-serif"><?php 
				// echo '<a href =\"view_details.php?id='. $row[sl_no] . '">' . $row["name"] . '</a>'; 
				echo ("<br><a href=\"view_details.php?id=$row[sl_no]\">$row[name]</a>");
				?></font></td>
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

		</div cl>
		
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