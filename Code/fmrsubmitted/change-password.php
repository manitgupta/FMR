<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$message = null;
if (isset($_SESSION['details'])) 
{
	$details = $_SESSION['details'];
	
	if($details == "short_password")
	{
		$message = "Length of the password should of equal to or greater than 6";
	}
	if($details == "different_password")
	{
		$message = "Passwords did not match. Please re-enter.";
	}
	if($details == "incorrect_password")
	{
		$message = "Incorect password. Please enter your old password correctly.";
	}
	$_SESSION['details'] = null;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Change Password|FMR</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<link rel="stylesheet" href="css/forms.css">
		<style>
		table
		{
			margin-left:auto;
			margin-right: auto;
		}
		#alert
		{
			color:red;
		}
		</style>
	</head>
	  <script type="text/javascript" language="JavaScript">
function passmatch(theForm)
{	  
    if (theForm.password.value == theForm.opassword.value)
    {
        alert("New Password Can't Be Same As Old Password.");
        return false;
    }
    if (theForm.password.value != theForm.cpassword.value)
    {
        alert("Passwords do not match.");
        return false;
    }
    if(theForm.password.value.length < 8){
      alert("Password should atleast be 8 character long.");
      return false;
    }
    if(!/\d/.test(theForm.password.value)){
      alert("Password Should Contain A Digit");
      return false;
    }
    if(!/[a-z]/.test(theForm.password.value)){
      alert("Password Should a lower case character");
      return false;
    }
    if(!/[A-Z]/.test(theForm.password.value)){
      alert("Password Should an upper case character");
      return false;
    }
    if(!/[^0-9a-zA-Z]/.test(theForm.password.value)){
      alert("Password Should Contain 1 Special Character");
      return false;
    }
    return true;
}
  </script>  
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
		
		<div>
			<?php
				if($message != null)
				{
			?>
					<p id ="alert"> <?php echo $message; ?> </p>
			<?php
				}
			?>
			<h1>Please Enter The New Password</h1>
			
			<table border="0">
				<form method="POST" action="change-password-proc.php" onSubmit="return passmatch(this)">
					<tr>
						<td>Old Password</td>
						<td>:</td>
						<td><input type="password" name="opassword" size="25" placeholder="Old Password" required></td>
					</tr>
					<tr>
						<td>New Password</td>
						<td>:</td>
						<td><input type="password" name="password" size="25" placeholder="New Password" required></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td>:</td>
						<td><input type="password" name="cpassword" size="25" placeholder="Confirm Password" required></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="submit" value="Change Password" id="submit"></td>
					</tr>
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