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
		<title>Add Districts|FMR</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
         <link rel="stylesheet" type="text/css" href="css/forms.css">
		
		<style>
			
			ol li
			{
				padding-top:7px;
				padding-left:10px;
							
			}
			ol
			{
				list-style-type:none;
			}
			#submit
			{
				margin-top:7px;
				margin-left:50px;
			}
			#details
			{
				/*width:300px;
				height:200px;
				float:right;*/
				
				margin-top:10px;
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
		
		<div class="content" style="margin-bottom:10px;" >
		
			<div id="details" style="clear:both;">
			<h1>Add New District User</h1>
			<p>Please enter the details of the concerned person who would be looking after the working of the Certified First Mediacal Responders Program in his district.
			<br>
			<span id="note">Note: If the district already exists, then the username for the state will not be created again.</span>
			<br>
		
			</p></div>
			<div style="margin-top:0px; margin:auto; ">
            <div style="display:inline-table;" >
			
            <fieldset style="margin:10px auto 10px auto;  padding-right:30px;padding-left:10px;">
            <legend>Please enter the details of the district level officer</legend>
			
			
				<form method="POST" action="add-district-proc.php">
					<ol>
					    <li><label class = "formlabels" for="name">Name:</label><input type="text" required placeholder="Name" name="name" id="name"></input></li>
						
						<li id="select-box">
                        <label class = "formlabels" for="state">State:</label>
						<select name="state" id="state">
						
						<?php
							while ($row = mysql_fetch_assoc($result))
							{
						?>
								<option value="<?php echo $row['state']; ?>" name="state"> <?php echo $row['state']; ?>  </option>
						<?php
							}
						?>
						</select></p></li>
						
					    <li>
                        <label class = "formlabels" for="District">District:</label>
                        <input type="text" required placeholder="District" name="district" id="District"></input></li>
					    <li>
                        <label class = "formlabels" for="mobile">Mobile:</label>
                        <input type="text" required placeholder="Mobile" name="mobile" id="mobile"></input></li>
					    <li>
                        <label class = "formlabels" for="email">Email:</label>
                        <input type="text" required placeholder="Email" name="email" id="email"></input></li>
						
						<input type="submit" name="Insert" value="Create" id="submit">
					</ol>	
				</form>
                </fieldset>
		</div>
        </div>
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