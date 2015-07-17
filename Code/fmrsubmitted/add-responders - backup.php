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

$message = null;

if (isset($_SESSION['details'])) 
{
	$details = $_SESSION['details'];
	
	if($details == "invalid-ext")
	{
		$message = "Invalid file extension. Please upload only files with extention .xlsx";
	}
	if($details == "incorect-format")
	{
		$message = "Format of the excel sheet is incorrect. Please upload the data in proper format.";
	}
	$_SESSION['details'] = null;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Add Responders</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		
		<style>

			h1{
				text-align: left;
			}
			ol li
			{
				padding-top:7px;
				padding-left:10px;				
			}
			#form
			{
				border-right: groove;
			}
			#add-form
			{
				float:left;
			}
			#add-from-excel
			{
				padding:10px;
				width:400px;
				margin-right:25px;
				margin-top:50px;
				float:right;
			}
			#upload
			{
				color:blue;
			}
			#alert
			{
				color:red;
			}
		</style>
	</head>

	<body>
		<header>
			<?php 
			include('navmenu.php');
			 ?>
			<!-- <nav>
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
		
		<section>
		
			<div id="add-from-excel">
				<p> You can even add the details of the volunteers through excel sheet.</p>
				<p> Browse the excel sheet in which the data is stored and then upload it.</p>
				<?php
					if($message != null)
					{
				?>
						<p id ="alert"> <?php echo $message; ?> </p>
				<?php
					}
				?>
				
				<form enctype="multipart/form-data" action="uploadFile.php" method="post">
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
					<table>
						<tr>
							<td id="upload">Names file:</td>
							<td><input type="file" name="fileToUpload" /></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td><input type="submit" value="Upload" /></td>
						</tr>
					</table>
				</form>
				<p><a href="excelSheet/sample.xlsx">Click here</a> to download the sample excel sheet. It contains the format of the excel sheet</p>
			</div>
			<div id="form">
				<h2>You can add new responders here:</h1>
				<!-- <table id="add-form"> -->
					<form id = "add-form" method="POST" action="addproc.php">
						<ol>
						    <li><input type="text" required placeholder="Name" name="name"></input></li>
						    <li><input type="text" placeholder="Age" name="age"></input></li>
						    <li id="select-box"><p>Sex
							<select name="sex">
								<option value="" name="sex">Select</option>
								<option value="c1" name="sex">Male</option>
								<option value="c2" name="sex">Female</option>
							</select>
							</p></li>
						    <li><input type="text" placeholder="Year of Training" name="year"></input></li>
						    <li><input type="text" placeholder="Address" name="address"></input></li>
						    <li><input type="text" placeholder="District" name="district"></input></li>
						    <li><input type="text" placeholder="State" name="state"></input></li>
						    <li><input type="text" placeholder="Mobile" name="mobile"></input></li>
						    <li><input type="text" placeholder="Email" name="email"></input></li>
							<li><input type="text" placeholder="Guardian" name="gr"></input></li>
						    <li><input type="text" placeholder="Present Designation" name="pres_desig"></input></li>
						    <li><input type="text" placeholder="Educational Qualification" name="edu_qual"></input></li>
						    <li><input type="text" placeholder="Professtional/Technical Qualification" name="prof_qual"></input></li>
						    <li><input type="text" placeholder="Maritial Status" name="marit_status"></input></li>
							<li><input type="text" placeholder="Qualified First Aider" name="qual_first_aider"></input></li>
							<li><input type="text" placeholder="RC Training" name="rc_training"></input></li>
							<li><input type="text" placeholder="Experience" name="experience"></input></li>
							
							<input type="submit" name="Insert" value="Insert" id="submit">
						</ol>	
					</form>
				<!-- </table>	 -->
			</div>
			
			
			
			
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