<?php
// Inialize session
session_start();

$clearance =  $_SESSION['clearance'];
if( $clearance != 1 and $clearance!=2 and $clearance!=3 )
{
	header('Location: fmr.php');
}

$num = false;
if(isset($_SESSION['mails_sent'])){
	$num = $_SESSION['mails_sent'];
}
$_SESSION['mails_sent'] = NULL;

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

// Include database connection settings
include('database-view-130714.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FMR | Indian Red Cross Soceity</title>
		<link rel="stylesheet" type="text/css" href="css/view-styles.css">
         <link rel="stylesheet" type="text/css" href="css/forms.css">
		
		<style>
		</style>
       </head>
       
<body>
		<header>
		<?php 
		include('navmenu.php');
		 ?>
         </header>
		
		<div class="content" style="margin-bottom:10px;" >
        <h1>Contact FMR via E-mail</h1>
        <?php if($num != false) { ?>
        <h3><?php echo $num ?> emails were sent </h3>
        <?php } else{ ?>
        <h3> This is a slow process. It will take time. Please don't press back or refresh.</h3>
        <?php }?>
        <div style="margin-top:0px; margin:auto; ">
            <div style="display:inline-table;" >
       
		<form action="emailproc.php" class="email" method="POST">
		<?php if($clearance ==1){ ?>
		<p><label class = "formlabels" for="state">Send To FMR's Of The State</label><select name="state" id="state">
		<option value="All">All</option>
		<?php } ?>
		<?php if($clearance ==2 or $clerance ==3){ ?>
		<p><label class = "formlabels" for="state">Send To FMR's Of District</label><select name="state" id="state">
		<option value="All">All</option>
		<?php } ?>
			<?php
			$sql = "";
			if($clearance ==1) {
			$sql = "SELECT DISTINCT state FROM table_3 ORDER BY STATE";}
			if($clearance ==2) {
			$sql = "SELECT DISTINCT district as state FROM table_3 where state='".ucwords(str_replace("_", " ", $_SESSION['username']))."' ORDER BY STATE";
			}
			if($clearance == 3){
			$sql = "SELECT DISTINCT district as state FROM table_3 where district='".ucwords(str_replace("_", " ", $_SESSION['username']))."'";
			?><select name="state" id="state"><?php
			}
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result))
					{
			?>
			<option value="<?php echo $row['state']; ?>"><?php echo $row['state']; ?></option>
				
					
		<?php
					}
		?>
		</select>
		</p>

		<!--<p><label class = "formlabels" for="subject">Subject of The Email</label>--><input name="subjectofmail" id="subject" type="text" placeholder = "Enter Subject"  style="float:left; width:92%; margin-left:20px; ">
		</p>
        <!--<p><label class = "formlabels" for="content">Content Of The Email:</label></p>-->
        <br>
		<p><textarea name="emailbody" id="content" cols="110" rows="10" class="emailbody" placeholder = "Enter the email...." ></textarea>
		</p>
        
		<p><input type="submit"></p>
	</form>
    </div>
    </div>
    </div>
    
    <footer>
    
			<nav id="footer-nav">
				<ul>
                
					<li><a href="http://www.indianredcross.org">Red Cross Home</a></li>
					<li style="color:#b72020">|</li>
					<li><a href="http://www.indianredcross.org/headquarters.htm">Contact</a></li>
				</ul>
			</nav>
		</footer>
</body>
</html>