<?php
	require_once 'conn.php';
	$sdo_fname = $_POST['sdo_fname'];
	$sdo_mname = $_POST['sdo_mname'];
	$sdo_lname = $_POST['sdo_lname'];
	$sdo_ext = $_POST['sdo_ext'];
	$sdo_emp_id = $_POST['sdo_emp_id'];
	$sdo_office = $_POST['sdo_office'];
	$sdo_unit = $_POST['sdo_unit'];
	$sdo_pos = $_POST['sdo_pos'];
	$sdo_emp_status = $_POST['sdo_emp_status'];
	

	$year_sdo = $_POST['year_sdo'];
	$cp = $_POST['cp'];
	$ors = $_POST['ors'];
	$dv = $_POST['dv'];
	$rso = $_POST['rso'];
	$rso_ben = $_POST['rso_ben'];
	$conca = $_POST['conca'];
	$fb = $_POST['fb'];
	
	$conn->query("UPDATE `sdo_tbl` SET `sdo_fname` = '$sdo_fname', `sdo_mname` = '$sdo_mname', `sdo_lname` = '$sdo_lname', 
	`sdo_ext` = '$sdo_ext', `sdo_emp_id` = '$sdo_emp_id', `sdo_office` = '$sdo_office', `sdo_unit` = '$sdo_unit', `sdo_pos` = '$sdo_pos', `sdo_emp_status` = '$sdo_emp_status', `year_sdo` = '$year_sdo',`cp` = '$cp',`ors` = '$ors',`dv` = '$dv',`rso` = '$rso',`rso_ben` = '$rso_ben',`conca` = '$conca',`fb` = '$fb'
	WHERE `sdo_id` = '$_REQUEST[sdo_id]'"); //or die(mysqli_error());