<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
        <link rel="stylesheet" type="text/css" href="css/buttons.css">
        <style type="text/css" >
		
		.content
		{
			height:calc(100%-190px);
		}
		.content h1,.content h2
		{
			font-family:'Open Sans', sans-serif;
			font-weight: bold;
			
			
		}
		</style>
	</head>

	<body>
		<header >
			<?php //Nav Menu is currently is a part of the header inside each php page, it is better to shift entire header, confirm with Anubhav
			include('navmenu.php'); //Added Navigation bar, css:navmenu.css Manit
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
		
				<div class="content" >
               
                
			<h1 align="center">WELCOME TO FIRST MEDICAL RESPONDER'S WEBSITE</h1>
			<!--<h2 >Select One Of The Tabs</h2>-->
			<!-- <button class="navigation">Home <img src="images/delete.png" alt=""></button> -->
           
            
            <!-- <!-------Buttons@Anubhav------ -->
 			<div  class="button_container" >
            <a href="view-responders.php">
            <button class="buttons" id="view"><span><img src="images/view.png"><br>
            View FMR's</span><span></span></button>
            </a>
            <?php
					if( $clearance == 1 or  $clearance == 2 or $clearance == 3 )
					{
				?>
            <a href="add-responders.php">
            <button class="buttons" id="add"><span><img src="images/add.png" ><br>
			Add New Responders</span><span> </span></button>
            </a>
            <?php
					}
				
				?>
                
                
                <a href="search-responders.php"><button class="buttons" id="search"><span><img src="images/search.png"><br>Search</span><span> </span></button></a></li>
                
            
            <?php
					if( $clearance == 1 )
					{
				?>
					<a href="control-room.php"><button class="buttons" id="control"><span><img src="images/control.png"><br>Admin Panel
                    </span><span>  </span></button> </a>
				<?php
					}
				?>
				
				<a href="settings.php"><button class="buttons" id="settings"><span><img src="images/settings.png"><br>Settings</span><span> </span></button></a></li>
                <?php
					if( $clearance == 1 or $clearance == 3 or $clearance == 2)
					{
				?>
				<a href="email.php"><button class="buttons"><span><img src="images/contact.png"><br>Contact FMR's</span><span> </span></button></a>
                <?php
					}
					else
					{
				?>
                <a href="logout.php"><button class="buttons"><span><img src="images/home.png"><br>Logout</span><span> </span></button></a>
                <?php
					}
				?>
                
                <!-------End Of Buttons@AbG------->
               
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