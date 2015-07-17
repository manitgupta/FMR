<?php

// Inialize session
session_start();
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

include('database-edit-232714.php');
$clearance =  $_SESSION['clearance'];
// if (!isset($_SESSION['username'])) {
// header('Location: index.php');
// }


$state = mysql_real_escape_string($_POST['state']);
$emailbody = $_POST['emailbody'];
$subjectofmail = $_POST['subjectofmail'];
$username = $_SESSION['username'];

$query = "";
if($clearance == 1 and $state != "All"){
$query = "SELECT email FROM table_3 where state='".$state."' and status='Active'";}
elseif($clearance == 1 and $state == "All"){
$query = "SELECT email FROM table_3 where status='Active'";}
elseif($clearance == 2 and $state != "All"){
$user_state = ucwords(str_replace("_", " ", $_SESSION['username']));
$query = "SELECT email FROM table_3 where state = '".$user_state."' and district = '".$state."' and  status='Active'";}
elseif($clearance == 2 and $state == "All"){
$user_state = ucwords(str_replace("_", " ", $_SESSION['username']));
$query = "SELECT email FROM table_3 where state = '".$user_state."' and status='Active'";}
elseif($clearance == 3){
$query = "SELECT email FROM table_3 where district = '"$state."' and status='Active'";}






$result = mysql_query($query);

$num = 0;
while($row = mysql_fetch_assoc($result))
{	
    $message = $emailbody;
    $to= $row['email'];
    if($to != NULL) {
    	contiue;
    }
    $subject= $subjectofmail;
    $from = $username;
    $body= $emailbody;
    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    if (mail($to,$subject,$body,$headers)){
    	$num++;
    }
}

header('Location: email.php');
$_SESSION['mails_sent'] = $num;

?>