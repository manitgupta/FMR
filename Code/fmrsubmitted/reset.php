<?php
include('database-edit-232714.php');

if (isset($_SESSION['username'])) {
  header('Location: fmr.php');
}



if(isset($_GET['action']))
{          
    if($_GET['action']=="reset")
    {
        $encrypt = mysql_real_escape_string($_GET['encrypt']);
        $query = "SELECT username FROM login where md5(CONCAT('asgm',CONCAT(email_id,'mgsa')))='".$encrypt."'";
        $result = mysql_query($query);
        $Results = mysql_fetch_array($result);
        if(mysql_num_rows($result) != 0)
        {
          $message = "Welcome " . $Results['username'] . " Please enter a new Password";
        }
        else
        {
          $message = 'Invalid key please try again. <a href="http://fmr-ircs.in/retrieval.php">Forget Password?</a>';
        }
    }
}
elseif(isset($_POST['action']))
{
    
    $encrypt  = mysql_real_escape_string($_POST['action']);
    $password = mysql_real_escape_string($_POST['password']);
    $query = "SELECT username FROM login where md5(CONCAT('asgm',CONCAT(email_id,'mgsa')))='".$encrypt."'";
    $result = mysql_query($query);
    $Results = mysql_fetch_array($result);
    if(mysql_num_rows($result) != 0)
    {
        $query = "update login set password='".md5($password)."' where username='".$Results['username']."'";
        mysql_query($query);
//        echo $query;
        $message = "Your password changed sucessfully <a href=\"index.php\">click here to login</a>.";
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://fmr-ircs.in/retrieval.php">Forget Password?</a>';
      
    }
}
else
{   
    header("location: index.php");
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
        float:right;
      }
      #logo
      {
        padding: 10px 10px 10px 10px;
        
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 6px rgba(0, 0, 0, 0.2);

      }
      #sorry{
      	font: 'Lucida Grande', Arial, sans-serif;
      	font-size: 15px;
  		font-weight: bold;
  		text-shadow: 0 1px white;
      	color: #d41c1c;
      }
  </style>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <script type="text/javascript" language="JavaScript">
function passmatch(theForm)
{	  

    if (theForm.password.value != theForm.password2.value)
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
    if(/[^0-9a-zA-Z]/.test(theForm.password.value)){
      alert("Password Should Contain 1 Special Character");
      return false;
    }
    return true;
}
  </script>  
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
    
  <section class="container">
  <?php if(!isset($_POST['action'])){ ?>
    <div class="login">
      <h1>Enter the new password here</h1>
    <form method="POST" action="reset.php" id="reset" onSubmit="return passmatch(this)">
        <p><input type="password" name="password" value = "" placeholder="Password" required></p>
        <p><input type="password" name="password2" size="20" placeholder="Password" required></p>
        <input name="action" type="hidden" value="<?php echo $encrypt?>"/></p>
        <p><input id="submit" type="submit" value="Reset Password"></p>
   </form>
    </div>`
   <?php } ?>
    <div class="login-help">
      <p><?php echo $message ?></p>
    </div>
  </section>

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