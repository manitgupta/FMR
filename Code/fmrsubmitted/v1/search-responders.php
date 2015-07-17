<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

// Include database connection settings
include('database-view-130714.php');

//select all states
$query_state = "SELECT * FROM login WHERE clearance='2'";
$result_state = mysql_query($query_state);

//select all district
$query_district = "SELECT * FROM login WHERE clearance='3'";
$result_district = mysql_query($query_district);


if($clearance == 2)
{
	//if user is of state level, select districts within a state and change the query
	$state = $_SESSION['state'];
	$query_district = "SELECT * FROM login WHERE clearance='3' AND state='$state'";
	$result_district = mysql_query($query_district);
}

$sn = 1;
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
					<li><a href="cfmr.php">Home</a></li>
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
			<h3>Enter the keyword in the appropriate position</h3>
			<table>
				<form method="POST" action="searchproc.php">
					<ul>
						<li><input type="text" placeholder="Name" name="name"></input></li>
						<li><input type="text" placeholder="Year of training" name="year"></input></li>
						
						<?php 
							if( $clearance < 3)
							{
						?>
								<li id="select-box"><p>District
								<select name="district">
									<option value="" name="district"></option>
									<?php
										while ($row = mysql_fetch_assoc($result_district))
										{
									?>
											<option value="<?php echo $row['district']; ?>" name="district"> <?php echo $row['district']; ?>  </option>
									<?php
										}
									?>
								</select></p></li>
						<?php
							}
						?>
						
						<?php
							if( $clearance == 1)
							{
						?>
								<li id="select-box"><p>State
								<select name="state">
									<option value="" name="state"></option>
									<?php
										while ($row = mysql_fetch_assoc($result_state))
										{
									?>
											<option value="<?php echo $row['state']; ?>" name="state"> <?php echo $row['state']; ?>  </option>
									<?php
										}
									?>
								</select></p></li>
						<?php
							}
						?>
					</ul>
					<input type="submit" name="Insert" value="Search" id="submit">
					
				</form>
			</table>
		</section>
		
		<footer>
			<nav id="footer-nav">
				<ul>
					<li><a href="http://www.indianredcross.org">Red Cross Home</a></li>
					<li>|</li>
					<li><a href="about.php">About</a></li>
					<li>|</li>
					<li><a href="http://www.indianredcross.org/headquarters.htm">Contact</a></li>
				</ul>
			</nav>
		</footer>
	</body>
</html>