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

if( $clearance != 1 )
{
	header('Location: fmr.php');
}

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
			#sex
			{
				margin-top:-15px;
				margin-bottom:-15px;
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
			<p> You can edit responder here:</p>
			
			<table>
				<form method="POST" action="editproc.php?id=<?php echo $row['sl_no'] ?>">
					<ol>
					    <li><input type="text" required placeholder="Name" name="name" value="<?php 
							echo $row['name'] ?>"></input></li>
					    <li><input type="text" placeholder="Age" name="age" value="<?php 
							echo $row['age'] ?>"></input></li>
						
						<?php
							//get sex of the volunteer
							$sex = $row['sex'];
							if($sex == "M" || $sex == "m" || $sex == "male" || $sex == "Male")
								$sex = "M";
							else if($sex == "F" || $sex == "f" || $sex == "female" || $sex == "Female")
								$sex = "F";
							else 
								$sex = "N";
						?>	
					    <li id="sex"><p>Sex
						<select name="sex">
							<option value="" name="sex" <?php 
									if($sex == "N")
									{
								?>
									selected
								<?php
									}
								?>
							 >Select</option>
							<option value="c1" name="sex" <?php 
									if($sex == "M")
									{
								?>
									selected
								<?php
									}
								?>
							>Male</option>
							<option value="c2" name="sex" <?php 
									if($sex == "F")
									{
								?>
									selected
								<?php
									}
								?>
							>Female</option>
						</select>
						</p></li>
						
					    <li><input type="text" placeholder="Year of Training" name="year" value="<?php 
							echo $row['year_of_training'] ?>"></input></li>
					    <li><input type="text" placeholder="Address" name="address" value="<?php 
							echo $row['address'] ?>"></input></li>
					    <li><input type="text" placeholder="District" name="district" value="<?php 
							echo $row['district'] ?>"></input></li>
					    <li><input type="text" placeholder="State" name="state" value="<?php 
							echo $row['state'] ?>"></input></li>
					    <li><input type="text" placeholder="Mobile" name="mobile" value="<?php 
							echo $row['mobile'] ?>"></input></li>
					    <li><input type="text" placeholder="Email" name="email" value="<?php 
							echo $row['email'] ?>"></input></li>
						<li><input type="text" placeholder="Guardian" name="gr" value="<?php 
							echo $row['guardian'] ?>"></input></li>
					    <li><input type="text" placeholder="Present Designation" name="pres_desig" value="<?php 
							echo $row['present_designation'] ?>"></input></li>
					    <li><input type="text" placeholder="Educational Qualification" name="edu_qual" value="<?php 
							echo $row['edn_qual'] ?>"></input></li>
					    <li><input type="text" placeholder="Professtional/Technical Qualification" name="prof_qual" value="<?php 
							echo $row['prof_techqual'] ?>"></input></li>
					    <li><input type="text" placeholder="Maritial Status" name="marit_status" value="<?php 
							echo $row['maritial_status'] ?>"></input></li>
						<li><input type="text" placeholder="Qualified First Aider" name="qual_first_aider" value="<?php 
							echo $row['qualified_first_aider'] ?>"></input></li>
						<li><input type="text" placeholder="RC Training" name="rc_training" value="<?php 
							echo $row['rc_trainings'] ?>"></input></li>
						<li><input type="text" placeholder="Experience" name="experience" value="<?php 
							echo $row['experience'] ?>"></input></li>
						
						<input type="submit" name="Insert" value="Edit" id="submit">
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
