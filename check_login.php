<?php
	session_start();
	include("connect/conn.php");
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		  
	$strSQL = "SELECT * FROM employees WHERE Emp_username = '".$username."' AND Emp_password = '".$password."'";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	
	
	if(!$objResult)
	{
		echo "<script language='javascript'> alert('กรอกข้อมูลไม่ถูกต้อง กรุณาลองใหม่');window.location='login.php';</script>";
	}
	else
	{
			$_SESSION["emp_id"] = $objResult["Emp_id"];
			$_SESSION["emp_username"] = $objResult["Emp_username"];
			$_SESSION["emp_password"] = $objResult["Emp_password"];
			$_SESSION["emp_name"] = $objResult["Emp_name"];
			$_SESSION["emp_pic"] = $objResult["Emp_pic"];
			$_SESSION["Employees_IDAdmin"] = $objResult["Employees_ID"];
			$_SESSION["Emp_permistion"] = $objResult["Emp_permistion"];

			
			
			$_SESSION['LOGIN_ADMIN'] = "adminlogin";

			// $ip_log=get_ip();
			// $myFile = "logfile.txt";
			// $log_date = date('Y-m-d  h:i:s');
			// $fh = fopen($myFile, 'a') or die("can't open file");
			// $stringData = " user login : ".$_SESSION["emp_id"]."  ".$_SESSION["Employees_IDAdmin"]." ".$_SESSION["emp_name"]." DateTime :".$log_date."   IP: ".$ip_log." \r\n" ;
			// fwrite($fh, $stringData);
			// fclose($fh);
			
			header('location: index.php'); 
	}

?>