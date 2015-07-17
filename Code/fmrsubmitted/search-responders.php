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
$query_state = "SELECT DISTINCT state FROM table_3";
$result_state = mysql_query($query_state);

//select all district
$query_district = "SELECT DISTINCT district FROM table_3";
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
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<link rel="stylesheet" type = "text/css" href="css/forms.css">
	</head>

	<body>
		<header>
			<!-- <div id="header-title">
				<div id="header-title-banner"><img alt="Indian Red Cross Soceity" src="images/index_06.png" id="logo"> </div>
			</div> -->
			<?php 
			include('navmenu.php');
			 ?>
			<!-- <nav>
				<ul>
					<li><a href="cfmr.php">Home</a></li>
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
			<h1>Enter the keyword in the appropriate position</h1>
			<div style="margin-top:0px margin:auto;" >
			<div style="display:inline-table;">
			<fieldset>
				<legend>Please Enter Search Criteria</legend>
				<form method="POST" action="searchproc.php">
						<p><label for="name" class = "formlabels">Name:</label><input type="text" placeholder="Name" id="name" name="name"></input></p>
						<p><label for="year" class = "formlabels">Year of Training:</label><input type="text" id="year" placeholder="Year of training" name="year"></input></p>						
						<?php 
							if( $clearance < 3)
							{
						?>
								<p id="select-box"><label for="district" class = "formlabels">Districts:</label>
								<select name="district" id="district">
									<option value="" name="district"></option>
									<?php
										while ($row = mysql_fetch_assoc($result_district))
										{
									?>
											<option value="<?php echo $row['district']; ?>" name="district"> <?php echo $row['district']; ?>  </option>
									<?php
										}
									?>
								</select></p></p>
						<?php
							}
						?>
						
						<?php
							if( $clearance == 1)
							{
						?>
								<p id="select-box"><label for="state" class = "formlabels">State:</label>
								<select name="state" id="state">
									<option value="" name="state"></option>
									<?php
										while ($row = mysql_fetch_assoc($result_state))
										{
									?>
											<option value="<?php echo $row['state']; ?>" name="state"> <?php echo $row['state']; ?>  </option>
									<?php
										}
									?>
								</select></p>
						<?php
							}
						?>
					</ul>
					<input type="submit" name="Insert" value="Search" id="submit">
					
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