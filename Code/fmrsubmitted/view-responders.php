<?php
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];
$sort = 'sl_no';

if(isset($_GET["sort"]))
{
	$sort =$_GET["sort"];
}


// $state = 0;

// if(isset($_GET["state"]))
// {
// 	$state =$_GET["state"];

// }

// if($state==0){
// 	$sort = $sort . " ASC";
// 	$state  = 1;
// }
// else{
// 	$sort = $sort . " DESC";
// 	$state = 0;
// }
// echo $sort";
include('database-view-130714.php');
 
if( $clearance == 1 )
{
	$query = "SELECT * FROM table_3 ORDER BY $sort";
}
else if( $clearance == 2 )
{
	$state = $_SESSION['state'];
	$query = "SELECT * FROM table_3 WHERE state = '$state' ORDER BY $sort";
}

else if( $clearance == 3 )
{
	$state = $_SESSION['state'];
	$district = $_SESSION['district'];
	$query = "SELECT * FROM table_3 WHERE state = '$state' AND district = '$district' ORDER BY $sort";
}
	
$result = mysql_query($query);

$sn = 1;

mysql_close();

$message = null;

if (isset($_SESSION['details'])) 
{
	$details = $_SESSION['details'];
	
	if($details == "record-exists")
	{
		$message = "All the volunteers details are already stored in database.";
	}
	else if($details == "record-added")
	{
		$count = $_SESSION['count'];
		$_SESSION['count'] = null;
		$message = $count . " record(s) have been added to the databse";
	}
	else if($details == "record-deleted")
	{
		$message = "Details of the selected user has been deleted form the database.";
	}
	else if($details == "record-edited")
	{
		$message = "Details of the selected user has been edited in the database.";
	}
	if (isset($_SESSION['add_priv']) and $_SESSION['add_priv'] == false){
		$message = $message . " User tried to add some details of state/district he is not allowed to.";
	}
	if (isset($_SESSION['update_priv']) and $_SESSION['update_priv'] == false){
		$message = "Can't change state/district of fmr to other state/district.";
	}
	if (isset($_SESSION['delete_priv']) and $_SESSION['delete_priv'] == false){
		$message = "Can't delete details of this state/district person.";
	}
	$_SESSION['details'] = null;
	$_SESSION['delete_priv'] = null;
	$_SESSION['add_priv'] = null;
	$_SESSION['update_priv'] = null;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="css/navmenu.css">
	   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	   <script src="script.js"></script>
	   <script type="text/javascript">     //Javascript to fix the navigation bar on top while scrolling.
	   window.onscroll = changePos;
			   function changePos() {
			    var header = document.getElementById("cssmenu");
				var las = document.getElementsByClassName("last");
			    if (window.pageYOffset > 70) {
			        header.style.position = "absolute";
			        header.style.top = pageYOffset + "px";
				header.style.width="100%";
				header.style.zIndex="100";
				las.style.position = "relative";
				/*	las.style.float = "right";*/
			    }
			    else {
			        header.style.position = "relative";
			        header.style.top = "";
			    }
				if (window.pageXOffset >= 0) {
			        header.style.position = "absolute";
			        header.style.left = pageXOffset + "px";
					header.style.width="100%";
					header.style.zIndex="100";
					las.style.position = "relative";
			    } else {
			        header.style.position = "";
			        header.style.left= "";
			    }
			}
   </script>
		   <!-- DataTables CSS -->
		<link rel="stylesheet" type="text/css" href="DataTables-1.10.7/media/css/jquery.dataTables.css">
		  
		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="DataTables-1.10.7/media/js/jquery.js"></script>
		  
		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="DataTables-1.10.7/media/js/jquery.dataTables.js"></script>
		<script>
		    $(document).ready( function () {
		    $('#table_id').DataTable();
		} );
		</script>
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<style>
		@import url(http://fonts.googleapis.com/css?family=Open+Sans:700);
		#alert
		{
			color:red;
		}
		#dash
		{
			color:#b72020;
			list-style-type:none;
			list-style:none;
			line-height:2em;
			font-weight:bold;
			opacity:1;
			font-size:28px;
			font-size:1.5vw;
		}
		</style>
	</head>

	<body>
		<header>
			<div id="bits-logo">
      <a href="http://www.bits-pilani.ac.in">
        <img src="images/logo.jpg" alt="bits-logo" id="bitslogo">
        </a>
      </div>
      <div id="header-title">
        <div id="header-title-banner"><a href="http://www.indianredcross.org"><img alt="Indian Red Cross Soceity" src="images/index_06.jpg" id="logo"></a></div>
      </div>

      <div id='cssmenu'>
<ul>
   <!-- <li class='active'><a href='fmr.php'><span>Home</span></a></li> -->
   <li><span><a href='fmr.php'>Home</a></span></li>
   <li id="dash" >|</li>
   <li><span><a href='view-responders.php'>View Responders</a></span></li><li id="dash" >|</li>
   <?php
         if( $clearance == 1 )
         {
      ?>
         <li><span><a href='add-responders.php'>Add Responders</a></span></li><li id="dash" >|</li>
         <li><span><a href='control-room.php'>Admin Panel</a></span></li><li id="dash" >|</li>
         <li><span><a href='email.php'>Contact FMR's</a></span></li><li id="dash" >|</li>
      <?php
         }
      ?>
      <?php
        if( $clearance == 2 or $clearance ==3)
         {
      ?>
         <li><span><a href='add-responders.php'>Add Responders</a></span></li><li id="dash" >|</li>
         <li><span><a href='email.php'>Contact FMR's</a></span></li><li id="dash" >|</li>
      <?php
         }
      ?>
       
   <li><span><a href="search-responders.php">Search</a></span></li><li id="dash" >|</li>
   <li><span><a href="settings.php">Settings</a></span></li>
   <li class='last'><span><a href='logout.php'>Logout</a></span></li>
</ul>
</div>

		</header>

		<h1> Information for First Medical Responders </h1>
		<!-- <section> -->
		<div class="content">
			<?php
				if($message != null)
				{
			?>
					<p id ="alert"> <?php echo $message; ?> </p>
			<?php
				}
			?>
			<!-- <table border="1" cellspacing="7" cellpadding="5"> -->
			<table id="table_id" class="display">
			<thead>
				<tr class = "head"> <!-- This for to diffrentiate header of table from the data -->
				<!-- GYANI: ADDED SORT -->
				<th><font face="Arial, Helvetica, sans-serif"><a href="?sort= "> </a></font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Name</font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Age</font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Sex </font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Address </font></th>
				<th><font face="Arial, Helvetica, sans-serif"> District </font></th>
				<th><font face="Arial, Helvetica, sans-serif"> State </font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Year </font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Mobile </font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Email </font></th>
				<th><font face="Arial, Helvetica, sans-serif"> Last Edited By </font></th>
				</tr>
			</thead>
			<tbody>	
				<?php

				while ($row = mysql_fetch_assoc($result)) {

				?>

				<tr>
				<td align="center"><font face="Arial, Helvetica, sans-serif"><?php  
					echo $sn;
					$sn++;
					if( $clearance == 1 or $clearance == 2 or $clearance ==3)
					 {
						echo ("<br><a href=\"edit_responders.php?id=$row[sl_no]\"><img src=\"edit.png\" alt=\"Click to edit\"></a>");
						echo ("<a href=\"delete_responders.php?id=$row[sl_no]\"><img src=\"images/delete.png\" alt=\"Click to delete\"></a>");
					 }
					?></font></td>
					
				<td><font face="Arial, Helvetica, sans-serif">

				<?php 
				// echo '<a href =\"view_details.php?id='. $row[sl_no] . '">' . $row["name"] . '</a>'; 
				echo ("<br><a href=\"view_details.php?id=$row[sl_no]\">$row[name]</a>");
				?>
				</font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['age']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php $sex =  $row['sex'];
					if($sex =="M" || $sex=="m")
						echo "Male";
					else if($sex == "F" || $sex=="f")
						echo "Female";
					else
						echo $sex;
					?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['address']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['district']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['state']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['year_of_training']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['mobile']; ?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php $email = $row['email']; 
					if($email != "Nil")
						echo $email;
					?></font></td>
				<td><font face="Arial, Helvetica, sans-serif"><?php echo $row['last_editted_by']; ?></font></td>
				</tr>


				<?php
				}
				?>
			</tbody>
			</table>
		</div>
		<!-- </section> -->
		
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