<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

if( $clearance != 1 )
{
	header('Location: fmr.php');
}

//add connections to the database
include('database-view-130714.php');

$id = mysql_real_escape_string($_GET["id"]);      

//get the row which has to edited
$query = "SELECT * from table_3 WHERE sl_no='$id'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$id = $_GET["id"]; 

mysql_close();
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
			
			<table border="1" cellspacing="7" cellpadding="5">
				<tr>
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
				<tr>
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
			</table>
			
			<p>Are you sure you want to delete the volunteer
				<?php  
				echo $row['name'] ;
				?>?</p>
			<a href="deleteproc.php?id=<?php echo $id?>">Yes</a>
			<a href="view-responders.php">No</a>
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