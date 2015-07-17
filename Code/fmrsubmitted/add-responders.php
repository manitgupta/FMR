<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

if( $clearance != 1 and $clearance !=2 and $clearance !=3)
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
		<link rel="stylesheet" type="text/css" href="css/forms.css">
        
				
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
        <div class="content">
        <h1  style="margin-bottom:5px;">You can add new responders here:</h1>
        <div style="margin-top:0px" class="form_container">
		<div class="form">
			<fieldset>
				<legend>Please Fill The Following</legend>
				<form id = "add-form" method="POST" action="addproc.php">
					<p><label class = "formlabels" for="name">Name:</label><input type="text" required placeholder="Name" name="name" id="name"></input></p>
				    <p><label class = "formlabels" for="age">Age:</label><input type="text" placeholder="Age" name="age" id="age"></input></p>
				    <p><label class = "formlabels" for="sex">Sex:</label><select id="sex" name="sex">
						<option value="" name="sex">Select</option>
						<option value="c1" name="sex">Male</option>
						<option value="c2" name="sex">Female</option>
					</select>
					</p>
				    <p><label class = "formlabels" for="year">Year:</label><input type="text" placeholder="Year of Training" name="year" id="year"></input></p>
				    <p><label class = "formlabels" for="address">Address:</label><input type="text" placeholder="Address" name="address" id="address"></input></p>
				    <p><label class = "formlabels" for="district">District:</label><input type="text" placeholder="District" name="district" id="district"></input></p>
				    <p><label class = "formlabels" for="state">State:</label> <!-- <input type="text" placeholder="State" name="state" id="state"></input> --> 
				    	<select name="state" id="state">
				    		<option value="Select an option">Select a State</option>
						<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
						<option value="Andhra Pradesh">Andhra Pradesh</option>
						<option value="Arunachal Pradesh">Arunachal Pradesh</option>
						<option value="Assam">Assam</option>
						<option value="Bihar">Bihar</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Chhattisgarh">Chhattisgarh</option>
						<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
						<option value="Delhi">Delhi</option>
						<option value="Goa">Goa</option>
						<option value="Gujarat">Gujarat</option>
						<option value="Haryana">Haryana</option>
						<option value="Himachal Pradesh">Himachal Pradesh</option>
						<option value="Jammu and Kashmir">Jammu and Kashmir</option>
						<option value="Jharkhand">Jharkhand</option>
						<option value="Karnataka">Karnataka</option>
						<option value="Kerala">Kerala</option>
						<option value="Lakshadweep">Lakshadweep</option>
						<option value="Madhya Pradesh">Madhya Pradesh</option>
						<option value="Maharashtra">Maharashtra</option>
						<option value="Manipur">Manipur</option>
						<option value="Meghalaya">Meghalaya</option>
						<option value="Mizoram">Mizoram</option>
						<option value="Nagaland">Nagaland</option>
						<option value="Odisha">Odisha</option>
						<option value="Puducherry">Puducherry</option>
						<option value="Punjab">Punjab</option>
						<option value="Rajasthan">Rajasthan</option>
						<option value="Sikkim">Sikkim</option>
						<option value="Tamil Nadu">Tamil Nadu</option>
						<option value="Telangana">Telangana</option>
						<option value="Tripura">Tripura</option>
						<option value="Uttar Pradesh">Uttar Pradesh</option>
						<option value="Uttarakhand">Uttarakhand</option>
						<option value="West Bengal">West Bengal</option>
					</select>
				    </p>
				    <p><label class = "formlabels" for="mobile">Mobile:</label><input type="text" placeholder="Mobile" name="mobile" id="mobile"></input></p>
				    <p><label class = "formlabels" for="email">Email</label><input type="text" placeholder="Email" name="email" id="email"></input></p>
					<p><label class = "formlabels" for="gr">Guardian:</label><input type="text" placeholder="Guardian" name="gr" id="gr"></input></p>
				    <p><label class = "formlabels" for="pres_desig">Present Designation:</label><input type="text" placeholder="Present Designation" name="pres_desig" id="pres_desig"></input></p>
				    <p><label class = "formlabels" for="edu_qual">Educational Qualification:</label><input type="text" placeholder="Educational Qualification" name="edu_qual" id="edu_qual"></input></p>
				    <p><label class = "formlabels" for="prof_qual">Professional Qualification:</label><input type="text" placeholder="Professtional/Technical Qualification" name="prof_qual" id="prof_qual"></input></p>
				    <!-- Check the Maritial Status Field for working, Manit -->
				    <p><label class = "formlabels" for="marit_status">Maritial Status:</label><select id="marit_status" name="marit_status">
						<option value="">Select</option>
						<option value="Married">Married</option>
						<option value="Unmarried">Unmarried</option>
                        <!--Manit forgot to add select end tag--></select>
				    </p>
					<p><label class = "formlabels" for="qual_first_aider">Qualified First Aider:</label><input type="text" placeholder="Qualified First Aider" name="qual_first_aider" id="qual_first_aider"></input></p>
					<p><label class = "formlabels" for="rc_training">RC Training:</label><input type="text" placeholder="RC Training" name="rc_training" id="rc_training"></input></p>
					<p><label class = "formlabels" for="experience">Experience:</label><input type="text" placeholder="Experience" name="experience" id="experience"></input></p>
					
					<input type="submit" name="Insert" value="Insert" id="submit">
				</form>	
			</fieldset>
		</div>
        </div>
        <div class="excel_container" >
			<div id="add-from-excel" >
            <fieldset>
            <legend>Please Upload The Excel File</legend>
			<p> You can even add the details of the volunteers through excel sheet.</p>
			<p> Browse the excel sheet in which the data is stored and then upload it.</p>
				<?php
					if($message != null)
					{
				?>
						<p id ="alert" style="color:red"> <?php echo $message; ?> </p>
				<?php
					}
				?>
				
				<form enctype="multipart/form-data" action="uploadFile.php" method="post">
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                    	<!--<p id="upload">Names file:</p>-->
							<p><input type="file" name="fileToUpload" /></p>
						<input type="submit" value="Upload" />
						
				</form>
				<p><a href="excelSheet/sample.xlsx">Click here</a> to download the sample excel sheet. It contains the format of the excel sheet</p>
				<p><a href ="excelSheet/instruction_manual.pdf">Click here</a> to download the Instruction Manual for uploading Excel Files.</p>
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