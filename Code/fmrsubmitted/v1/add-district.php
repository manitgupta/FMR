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

// Include database connection settings
include('database-view-130714.php');

//select all states
$query = "SELECT * FROM login WHERE clearance='2'";
$result = mysql_query($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		
		<style>
			ol li
			{
				padding-top:7px;
				padding-left:10px;				
			}
			#submit
			{
				margin-top:7px;
				margin-left:50px;
			}
			#details
			{
				width:300px;
				height:200px;
				float:right;
				padding-top:10px;
				padding-right:10px;
			}
			#note
			{
				color:red;
			}
			table
			{
				float:left;
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
		
			<div id="details">
			Please enter the details of the concerned person who would be looking after the working of the Certified First Mediacal Responders Program in his district.
			<br>
			<span id="note">Note: If the district already exixts, then the username for the state will not be created again.</span>
			<br>
			Please <a>click here</a> to reset the details and password of the existing state.
			</div>
			
			<p>Please enter the details of the district level officer</p>
			
			<table>
				<form method="POST" action="add-district-proc.php">
					<ol>
					    <li><input type="text" required placeholder="Name" name="name"></input></li>
						
						<li id="select-box"><p>State
						<select name="state">
						
						<?php
							while ($row = mysql_fetch_assoc($result))
							{
						?>
								<option value="<?php echo $row['state']; ?>" name="state"> <?php echo $row['state']; ?>  </option>
						<?php
							}
						?>
						</select></p></li>
						
					    <li><input type="text" required placeholder="District" name="district"></input></li>
					    <li><input type="text" required placeholder="Mobile" name="mobile"></input></li>
					    <li><input type="text" required placeholder="Email" name="email"></input></li>
						
						<input type="submit" name="Insert" value="Create" id="submit">
					</ol>	
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