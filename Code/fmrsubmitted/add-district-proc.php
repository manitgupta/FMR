<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

if( !($clearance == 1 or $clearance == 2) )
{
	header('Location: fmr.php');
}

function generateStrongPassword($length = 8, $add_dashes = false, $available_sets = 'luds')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%&*?';

	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}

	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];

	$password = str_shuffle($password);

	if(!$add_dashes)
		return $password;

	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}


// Include database connection settings
include('database-edit-232714.php');

$name = mysql_real_escape_string($_POST['name']);
$state = mysql_real_escape_string($_POST['state']);
$district = mysql_real_escape_string($_POST['district']);
$mobile = mysql_real_escape_string($_POST['mobile']);
$email = mysql_real_escape_string($_POST['email']);

$message = "null";

$query = "SELECT * FROM login WHERE state='$state' and district='$district'";
$result = mysql_query($query);

if (mysql_num_rows($result) >= 1) 
{
	$message = "Details of the ".$district.", ".$state." is already present there";
}
else
{	
	//convert the distict name to lowercase
	$district = ($district);
	//generate random password.
	$password =  generateStrongPassword();
	//encrypt the password to md5 and save a pass. pass to save in database and password to be displayed
	$pass = md5($password);
	
	//username
	$user = split(" ", strtolower($district), 3);
	$user = strtolower(join("_", $user));
	$clear = 3;
	
	$query = "INSERT INTO login(username, password, name, email_id, mobile, clearance, district, state) VALUES ('$user','$pass','$name','$email','$mobile','$clear','$district','$state')";
	
	$res = mysql_query($query);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
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
			</nav> -->
		</header>
		
		<section>
		<?php
			if($message != "null")
			{
		?>
			<p><?php 
				echo $message; 
			?>
			Please <a href="#">click here</a> to edit the details of this district</p>
		<?php
			}
			else
			{
		?>
			<p> District Successfully created </p>
			<p> Username : <?php echo $user; ?> </p>
			<p> Password : <?php echo $password; ?> </p>
		<?php
			}
		?>
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