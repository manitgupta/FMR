<?php

/*
	This file is for printing the the list of volunteers to the excel file.
	There is no need to jump from this page as the new tab is not opened. The browser automatically opens the file
*/

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

//include view databse
include('database-view-130714.php');

$filename = "fmr-details";         //File Name	

//check if sql query has been sent
if (!isset($_SESSION['details'])) 
{
	header('Location: fmr.php');
}
else
{
	$sql = $_SESSION['details'];
}

//execute mysql query
$result = mysql_query($sql);

//file format
$file_ending = "xls";

//file headers to be handled by the browser.
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");

/*******Start of Formatting for Excel*******/

//define separator (defines columns in excel & tabs in word)

$sep = "\t"; //tabbed character

//start of printing column names as names of MySQL fields

for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}

print("\n");
//end of printing column names

//start while loop to get data
$sn = 1;
    while($row = mysql_fetch_row($result))
   {
       $schema_insert = "";
       $schema_insert .= "$sn".$sep;
       $sn++;
       for($j=1; $j<mysql_num_fields($result);$j++)
       {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            else if ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
             $schema_insert .= "".$sep;
       }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
 $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";

        print(trim($schema_insert));

       print "\n";
    }	
    
?>