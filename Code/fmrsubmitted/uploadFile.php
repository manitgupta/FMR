<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];

if( $clearance != 1 )
{
	header('Location: fmr.php');
}

//get the name of the file
$filename = $_FILES['fileToUpload']['name'];

//get the extention of the file.
function findexts ($filename) 
 { 
 $filename = strtolower($filename) ; 
 $exts = split("[/\\.]", $filename) ; 
 $n = count($exts)-1; 
 $exts = $exts[$n]; 
 return $exts; 
 } 
 
 //This applies the function to our file  
 $ext = findexts ($_FILES['fileToUpload']['name']) ; 
 
 if($ext == "xlsx" or $ext == "xls")
 {
	move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "excelSheet/uploaded_excel_sheet." . $ext);
	$_SESSION['fname'] = "excelSheet/uploaded_excel_sheet." . $ext;
	header('Location: upload-excel-to-database.php');
}
else
{
	session_start();
	$_SESSION['details'] = "invalid-ext";
	header('Location: add-responders.php');
}
?>