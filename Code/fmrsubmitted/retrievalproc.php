<?php

// Inialize session
session_start();


include('database-edit-232714.php');

// if (!isset($_SESSION['username'])) {
// header('Location: index.php');
// }


$email = mysql_real_escape_string($_POST['email']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
{
    $message =  "Invalid email address please type a valid email!!";
}
else
{
    $query = "SELECT username FROM login where email_id='".$email."'";
    $result = mysql_query($query);
    $Results = mysql_fetch_array($result);

    if(mysql_num_rows($result) != 0)
    {   
        $encrypt = md5('asgm' . $email . 'mgsa');
        $message = "Your password reset link send to your e-mail address.";
        $to= $email;
        $subject="Password Retrieval For FMR";
        $from = 'FMR';
        $body='Hi, <br/> <br/>Your Username is '.$Results['username'].' <br><br>Click <a href="http://fmr-ircs.in/reset.php?encrypt='.$encrypt.'&action=reset">here</a> to reset your password <br/> <br/>--<br>BITS PILANI';
        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
        if (mail($to,$subject,$body,$headers)){
            header('Location: retresult.php');
        }
    }
    else
    {
        header('Location: retnoaccount.php');
    }
    }

?>