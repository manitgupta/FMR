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

include('database-edit-232714.php');

set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = "excelSheet/uploaded_excel_sheet.xlsx";

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
$cols = array( trim($allDataInSheet[1]["A"]), trim($allDataInSheet[1]["B"]), trim($allDataInSheet[1]["C"]), trim($allDataInSheet[1]["D"]), trim($allDataInSheet[1]["E"]), trim($allDataInSheet[1]["F"]), trim($allDataInSheet[1]["G"]), trim($allDataInSheet[1]["H"]), trim($allDataInSheet[1]["I"]), trim($allDataInSheet[1]["J"]), trim($allDataInSheet[1]["K"]), trim($allDataInSheet[1]["L"]), trim($allDataInSheet[1]["M"]), trim($allDataInSheet[1]["N"]), trim($allDataInSheet[1]["O"]), trim($allDataInSheet[1]["P"]), trim($allDataInSheet[1]["Q"]), );

//check each header
if( $cols[0] == "Name" 
&& $cols[1] == "Age" 
&& $cols[2] == "Sex" 
&& $cols[3] == "Address" 
&& $cols[4] == "District" 
&& $cols[5] == "State" 
&& $cols[6] == "Year of Training" 
&& $cols[7] == "Mobile" 
&& $cols[8] == "Email" 
&& $cols[9] == "Guardian" 
&& $cols[10] == "Present Designation" 
&& $cols[11] == "Educational Qualification" 
&& $cols[12] == "Proff/Tech Qualification" 
&& $cols[13] == "Martial Status" 
&& $cols[14] == "Qualified First Aider" 
&& $cols[15] == "RC Trainings" 
&& $cols[16] == "Experience" )
{
	for($i=2;$i<=$arrayCount;$i++)
	{
		//get the values from the wxcel sheet and save in the variables 
		$name = trim($allDataInSheet[$i]["A"]);
		$age = trim($allDataInSheet[$i]["B"]);
		$sex = trim($allDataInSheet[$i]["C"]);
		$address = trim($allDataInSheet[$i]["D"]);
		$district = trim($allDataInSheet[$i]["E"]);
		$state = trim($allDataInSheet[$i]["F"]);
		$year = trim($allDataInSheet[$i]["G"]);
		$mobile = trim($allDataInSheet[$i]["H"]);
		$email = trim($allDataInSheet[$i]["I"]);
		$guardian = trim($allDataInSheet[$i]["J"]);
		$pres_desig = trim($allDataInSheet[$i]["K"]);
		$edu_qual = trim($allDataInSheet[$i]["L"]);
		$prof_qual = trim($allDataInSheet[$i]["M"]);
		$marit_status = trim($allDataInSheet[$i]["N"]);
		$qual_first_aider = trim($allDataInSheet[$i]["O"]);
		$rc_training = trim($allDataInSheet[$i]["P"]);
		$experience = trim($allDataInSheet[$i]["Q"]);
		
		//check if the volunteer is already in the table or not
		$query = "SELECT name FROM table_3 WHERE name = '$name' and address = '$address' and district = '$district' and email = '$email' and mobile = '$mobile' ";
		
		$sql = mysql_query($query);

		//if the entry is not present in the table
		if(mysql_num_rows($sql) == 0) 
		{
			//check if name is null
			if($name != "")
			{
				$query = "INSERT INTO table_3 (name,age,sex,address,mobile,email,guardian,present_designation,edn_qual,prof_techqual,maritial_status,qualified_first_aider,rc_trainings,experience,year_of_training,district,state) VALUES ('$name','$age','$sex','$address','$mobile','$email','$guardian','$pres_desig','$edu_qual','$prof_qual','$marit_status','$qual_first_aider','$rc_training','$experience','$year','$district','$state')";
				
				$insertTable= mysql_query($query);
				$num++;
			}
		} 
	}
	
	//start session to define the session variables and then jump to view-responders.php page to display the appropriate code.
	session_start();
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

?>