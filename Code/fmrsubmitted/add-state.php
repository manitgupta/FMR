<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

if( $clearance != 1 )
{
	header('Location: fmr.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add State|FMR</title>
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
		
			<div id="details" style="clear:both;">
			<h1>Add New State User</h1>
            <p>
			Please enter the details of the concerned person who would be looking after the working of the Certified First Mediacal Responders Program in his state.
			<br>
			<span id="note">Note: If the state already exists, then the username for the state will not be created again.</span>
			<br>
			
            </p></div>
           
           <div style="margin-top:0px; margin:auto; ">
            <div style="display:inline-table;">
			
            <fieldset style="margin:10px auto 10px auto;  padding-right:30px;padding-left:10px;">
            <legend>Please enter the details of the state level officer</legend>
			
			
				<form method="POST" action="add-state-proc.php">
					    <p><label class = "formlabels" for="name">Name:</label><input type="text" required placeholder="Name" name="name" id="name"></input></p>
					    <p><label class = "formlabels" for="state">State:</label><!-- <input type="text" required placeholder="State" name="state" id="state"></input> --> 
					    <select name="state" id="state">
					    	<option value="Select a State">Select a State</option>
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
					    <p><label class = "formlabels" for="mobile">Mobile:</label><input type="text" required placeholder="Mobile" name="mobile" id="mobile"></input></p>
					    <p><label class = "formlabels" for="email">Email:</label><input type="text" required placeholder="Email" name="email" id="email"></input></p>		
						<input type="submit" name="Insert" value="Create" id="submit">	
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