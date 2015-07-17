<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

$clearance =  $_SESSION['clearance'];
$add_priv = true;


if( !($clearance == 1 or $clearance == 2 or $clearance ==3) )
{
	header('Location: fmr.php');
}

include('database-edit-232714.php');

$username = $_SESSION['username'];
$query = "SELECT state, district FROM login where username='".$username."'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$user_state = $row['state'];
$user_district = $row['district'];

set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = $_SESSION['fname'];

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

$num = 0;

//check if the format of the uploaded excel file is correct or not
//get all the column headers
$cols = array( str_replace("'", "''", trim($allDataInSheet[1]["A"])), str_replace("'", "''", trim($allDataInSheet[1]["B"])), str_replace("'", "''", trim($allDataInSheet[1]["C"])), str_replace("'", "''", trim($allDataInSheet[1]["D"])), str_replace("'", "''", trim($allDataInSheet[1]["E"])), str_replace("'", "''", trim($allDataInSheet[1]["F"])), str_replace("'", "''", trim($allDataInSheet[1]["G"])), str_replace("'", "''", trim($allDataInSheet[1]["H"])), str_replace("'", "''", trim($allDataInSheet[1]["I"])), str_replace("'", "''", trim($allDataInSheet[1]["J"])), str_replace("'", "''", trim($allDataInSheet[1]["K"])), str_replace("'", "''", trim($allDataInSheet[1]["L"])), str_replace("'", "''", trim($allDataInSheet[1]["M"])), str_replace("'", "''", trim($allDataInSheet[1]["N"])), str_replace("'", "''", trim($allDataInSheet[1]["O"])), str_replace("'", "''", trim($allDataInSheet[1]["P"])), str_replace("'", "''", trim($allDataInSheet[1]["Q"])), );

$j = 0;
if (strtolower($cols[0]) == strtolower("sl_no")) {
	$j = 1;
}


//check each header
if( 
strtolower($cols[$j+0]) == strtolower("Name")
&& strtolower($cols[$j+1]) == strtolower("Age") 
&& strtolower($cols[$j+2]) == strtolower("Sex" )
&& strtolower($cols[$j+3]) == strtolower("Address")
&& strtolower($cols[$j+4]) ==  strtolower("District") 
&& strtolower($cols[$j+5]) == strtolower("State") 
&& strtolower($cols[$j+6]) == strtolower("Year of Training") 
&& strtolower($cols[$j+7]) == strtolower("Mobile") 
&& strtolower($cols[$j+8]) == strtolower("Email") 
&& strtolower($cols[$j+9]) == strtolower("Guardian") 
&& strtolower($cols[$j+10]) == strtolower("Present Designation") 
&& strtolower($cols[$j+11]) == strtolower("Educational Qualification") 
&& strtolower($cols[$j+12]) ==  strtolower("Proff/Tech Qualification") 
&& strtolower($cols[$j+13]) == strtolower("Martial Status") 
&& strtolower($cols[$j+14]) == strtolower("Qualified First Aider") 
&& strtolower($cols[$j+15]) == strtolower("RC Trainings") 
&& strtolower($cols[$j+16]) == strtolower("Experience") )


{
	for($i=2;$i<=$arrayCount;$i++)
	{
		//get the values from the wxcel sheet and save in the variables 
		$name = mysql_real_escape_string(trim($allDataInSheet[$i]["A"]));
		$age = mysql_real_escape_string(trim($allDataInSheet[$i]["B"]));
		$sex = mysql_real_escape_string(trim($allDataInSheet[$i]["C"]));
		$address = mysql_real_escape_string(trim($allDataInSheet[$i]["D"]));
		$district = mysql_real_escape_string(trim($allDataInSheet[$i]["E"]));
		$state = mysql_real_escape_string(trim($allDataInSheet[$i]["F"]));
		$year = mysql_real_escape_string(trim($allDataInSheet[$i]["G"]));
		$mobile = mysql_real_escape_string(trim($allDataInSheet[$i]["H"]));
		$email = mysql_real_escape_string(trim($allDataInSheet[$i]["I"]));
		$guardian = mysql_real_escape_string(trim($allDataInSheet[$i]["J"]));
		$pres_desig = mysql_real_escape_string(trim($allDataInSheet[$i]["K"]));
		$edu_qual = mysql_real_escape_string(trim($allDataInSheet[$i]["L"]));
		$prof_qual = mysql_real_escape_string(trim($allDataInSheet[$i]["M"]));
		$marit_status = mysql_real_escape_string(trim($allDataInSheet[$i]["N"]));
		$qual_first_aider = mysql_real_escape_string(trim($allDataInSheet[$i]["O"]));
		$rc_training = mysql_real_escape_string(trim($allDataInSheet[$i]["P"]));
		$experience = mysql_real_escape_string(trim($allDataInSheet[$i]["Q"]));
		//check if the volunteer is already in the table or not
		$query = "SELECT name FROM table_3 WHERE name = '$name' and address = '$address' and district = '$district' and email = '$email' and mobile = '$mobile' ";
		$sql = mysql_query($query);
		//if the entry is not present in the table
		if(mysql_num_rows($sql) == 0)
		{
			//check if name is null
			if($name != "")
			{	
				if (($clearance == 3 and strtolower($user_district) == strtolower($district) and strtolower($user_state) == strtolower($state)) or  ($clearance == 2 and strtolower($user_state) == strtolower($state)) or $clearance == 1) {
				$username = $_SESSION['username'];
				$query = "INSERT INTO table_3 (name,age,sex,address,mobile,email,guardian,present_designation,edn_qual,prof_techqual,maritial_status,qualified_first_aider,rc_trainings,experience,year_of_training,district,state,last_editted_by) VALUES ('$name','$age','$sex','$address','$mobile','$email','$guardian','$pres_desig','$edu_qual','$prof_qual','$marit_status','$qual_first_aider','$rc_training','$experience','$year','$district','$state', '$username')";
				$insertTable= mysql_query($query);
				$num++;
				}
				else
				{	
					$add_priv = false;
				}
			}
		}
	}

	//start session to define the session variables and then jump to view-responders.php page to display the appropriate code.
	session_start();
	if($add_priv == true){
		$_SESSION['add_priv'] = true;
	}
	else
	{
		$_SESSION['add_priv'] = false;
	}

	if( $num == 0)
	{	
		$_SESSION['details'] = "record-exists";
		header('Location: view-responders.php');
	}
	else
	{
		$_SESSION['details'] = "record-added";
		$_SESSION['count'] = $num;
		header('Location: view-responders.php');
	}
}
else
{
	session_start();
	$_SESSION['details'] = "incorect-format";
	header('Location: add-responders.php');
}

// ?>