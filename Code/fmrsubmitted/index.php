<?php
// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['username'])) {
header('Location: fmr.php');
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login to FMR</title>
  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
  
      #bitslogo
      {
        padding: 5px;
      
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 6px rgba(0, 0, 0, 0.2);
        float: right;
      }
      #logo
      {
        padding: 10px 10px 10px 10px;
        height: 20% ;
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 6px rgba(0, 0, 0, 0.2);

      }
      
  </style>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<header>
      <div id="bits-logo">
      <a href="http://www.bits-pilani.ac.in">
        <img src="images/logo.jpg" alt="bits-logo" id="bitslogo" height="62px" width="199px">
        </a>
      </div>
      <div id="header-title">
        <div id="header-title-banner"><a href="http://www.indianredcross.org"><img alt="Indian Red Cross Soceity" src="images/index_06.png" id="logo"></a></div>
      </div>
      
    </header>
    
  <div class="container">
    <div class="login">
      <h1>Login to First Medical Responders Website</h1>
      <form method="POST" action="loginproc.php" id="tab">
        <p><input type="text" name="username" value = "" placeholder="Username" required></p>
          <p><input type="password" name="password" size="20" placeholder="Password" required></p>
          <p><input type="submit" value="Login"></p>
          
        <!-- <p><input type="text" name="login" value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
       -->
       </form>
    </div>

    <div class="login-help">
      <p>Forgot your password? <a href="retrieval.php">Click here to reset it</a>.</p>
    </div>
  </div>

  <center>
  <div class="about" style="width:auto">
    <p class="authors">
            <span style="font-weight:bold">Created by (Students of BITS Pilani)</span><br />
     <pre> <a href="http://in.linkedin.com/in/guptanubhav">Anubhav Gupta</a>   |   <a href = "http://gyani.net">Gyanendra Mishra</a>   |   <a href = "https://about.me/manitgupta">Manit Gupta</a>   |   <a href = "https://about.me/agrawal.shubham">Shubham Agrawal</a></pre>
    </p>
    <br>
    <p class="nav">
      <nav id="footer-nav">
          <a href="http://www.indianredcross.org">Red Cross Home</a> ||
          <a href="http://www.indianredcross.org/headquarters.htm">Contact</a>
      </nav>
    </p>
  </div>
  </center>
</body>
</html>