<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];


//add connections to the database
include('database-view-130714.php');

$id = $_GET["id"];      

//get the row which has to edited
$query = "SELECT * from table_3 WHERE sl_no='$id'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

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
		table tr td:first-of-type
		{
			text-transform:capitalize;
			font-weight:bold;
			font-size:18px;
			
		}
		a
		{
			font-size:24px;
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
		<div style="display:inline-table;float:left; margin:auto 20px auto">
        <font face="Arial, Helvetica, sans-serif">
        <br>
		<?php  
		
		if( $clearance == 1 or $clearance == 2)
		{
			
			echo ("<br><a href=\"edit_responders.php?id=$row[sl_no]\">Edit</a><br/><br/>");?>&nbsp;
            <?php
			echo ("<a href=\"delete_responders.php?id=$row[sl_no]\">Delete</a>");
		 }
		?></font>
        </div>
		<table>
		<tr>
			<td>Name</td>
			<td><?php echo $row['name'] ?></td>
		</tr>
		<tr>
			<td>Year of Training:</td>
			<td><?php echo $row['year_of_training'] ?>	</td>
		</tr>
		<tr>
			<td>Age</td>
			<td><?php echo $row['age'] ?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><?php echo $row['address']?></td>
		</tr>
		<tr>
			<td>District</td>
			<td><?php echo $row['district']?></td>
		</tr><tr>
			<td>State</td>
			<td><?php echo $row['state']?></td>
		</tr><tr>
			<td>Year</td>
			<td><?php echo $row['year_of_training']?></td>
		</tr><tr>
			<td>Mobile</td>
			<td><?php echo $row['mobile']?></td>
		</tr><tr>
			<td>Email</td>
			<td><?php echo $row['email']?></td>
		</tr><tr>
			<td>Guardian</td>
			<td><?php echo $row['guardian']?></td>
		</tr><tr>
			<td>Present Designation</td>
			<td><?php echo $row['present_designation']?></td>
		</tr><tr>
			<td>Educational Qualification</td>
			<td><?php echo $row['edn_qual']?></td>
		</tr><tr>
			<td>Professional Qualification</td>
			<td><?php echo $row['prof_techqual']?></td>
		</tr><tr>
			<td>Maritial Status</td>
			<td><?php echo $row['maritial_status']?></td>
		</tr><tr>
			<td>Qualified First Aider</td>
			<td><?php echo $row['qualified_first_aider']?></td>
		</tr><tr>
			<td>RC Training</td>
			<td><?php echo $row['rc_trainings']?></td>
		</tr><tr>
			<td>Experience</td>
			<td><?php echo $row['experience']?></td>	
		</tr><tr>
			<td>Status</td>
			<td><?php echo $row['status']?></td>
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

		