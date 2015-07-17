<?php
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

if( !($clearance == 1 or $clearance ==2 or $clearance ==3) ){
	header('Location: fmr.php');
}

//add connections to the database
include('database-view-130714.php');

if( !($clearance == 1 or $clearance ==2 or $clearance ==3) ){
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
		<title>Edit Responders|FMR</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<link rel="stylesheet" href="css/forms.css">
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
        <h1  style="margin-bottom:5px;">You can edit responder's details here:</h1>
        <div style="margin-top:0px; margin:auto; ">	<!-- USE THIS TO CENTRE THE FORMS -->
		<div style="display:inline-table;">
			<fieldset>
			<legend>Please enter details</legend>
			<table>
				<form method="POST" action="editproc.php?id=<?php echo $row['sl_no'] ?>">
					    <p><label class = "formlabels" for="name">Name:</label><input type="text" required placeholder="Name" name="name" value="<?php 
							echo $row['name'] ?>"></input></p>
					    <p><label class = "formlabels" for="age">Age:</label><input type="text" placeholder="Age" name="age" value="<?php 
							echo $row['age'] ?>"></input></p>
						
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
					    <p id="sex"><label class = "formlabels" for="sex">Sex:</label>
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
						</p></p>
						
					    <p><label class = "formlabels" for="year">Year:</label><input type="text" placeholder="Year of Training" name="year" value="<?php 
							echo $row['year_of_training'] ?>"></input></p>
					    <p><label class = "formlabels" for="address">Address:</label><input type="text" placeholder="Address" name="address" value="<?php 
							echo $row['address'] ?>"></input></p>
					    <p><label class = "formlabels" for="district">District:</label><input type="text" placeholder="District" name="district" value="<?php 
							echo $row['district'] ?>"></input></p>
					    <p><label class = "formlabels" for="state">State:</label><input type="text" placeholder="State" name="state" value="<?php 
							echo $row['state'] ?>"></input></p>
					    <p><label class = "formlabels" for="mobile">Mobile:</label><input type="text" placeholder="Mobile" name="mobile" value="<?php 
							echo $row['mobile'] ?>"></input></p>
					    <p><label class = "formlabels" for="email">Email</label><input type="text" placeholder="Email" name="email" value="<?php 
							echo $row['email'] ?>"></input></p>
						<p><label class = "formlabels" for="gr">Guardian:</label><input type="text" placeholder="Guardian" name="gr" value="<?php 
							echo $row['guardian'] ?>"></input></p>
					    <p><label class = "formlabels" for="pres_desig">Present Designation:</label><input type="text" placeholder="Present Designation" name="pres_desig" value="<?php 
							echo $row['present_designation'] ?>"></input></p>
					    <p><label class = "formlabels" for="edu_qual">Educational Qualification:</label><input type="text" placeholder="Educational Qualification" name="edu_qual" value="<?php 
							echo $row['edn_qual'] ?>"></input></p>
					    <p><label class = "formlabels" for="prof_qual">Professional Qualification:</label><input type="text" placeholder="Professtional/Technical Qualification" name="prof_qual" value="<?php 
							echo $row['prof_techqual'] ?>"></input></p>
					    <p><label class = "formlabels" for="marit_status">Maritial Status:</label><input type="text" placeholder="Maritial Status" name="marit_status" value="<?php 
							echo $row['maritial_status'] ?>"></input></p>
						<p><label class = "formlabels" for="qual_first_aider">Qualified First Aider:</label><input type="text" placeholder="Qualified First Aider" name="qual_first_aider" value="<?php 
							echo $row['qualified_first_aider'] ?>"></input></p>
						<p><label class = "formlabels" for="rc_training">RC Training:</label><input type="text" placeholder="RC Training" name="rc_training" value="<?php 
							echo $row['rc_trainings'] ?>"></input></p>
						<p><label class = "formlabels" for="experience">Experience:</label><input type="text" placeholder="Experience" name="experience" value="<?php 
							echo $row['experience'] ?>"></input></p>
						<p><label class = "formlabels" for="status">Status:</label>
						<select name="status">
  							<option value="Active">Active</option>
  							<option value="Inactive">Inactive</option>
						</select>
						<input type="submit" name="Insert" value="Edit" id="submit">
							
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