<!-- Sample Navigation menu for the Site-Wide Design : Manit-->
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
   <style>
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
   <title>CSS MenuMaker</title>
</head>
<body >
<header>
      <div id="bits-logo">
      <a href="http://www.bits-pilani.ac.in">
        <img src="images/logo.jpg" alt="bits-logo" id="bitslogo">
        </a>
      </div>
      <div id="header-title">
        <div id="header-title-banner"><a href="http://www.indianredcross.org"><img alt="Indian Red Cross Soceity" src="images/index_06.jpg" id="logo"></a></div>
      </div>
      
    </header>
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

</body>
<html>