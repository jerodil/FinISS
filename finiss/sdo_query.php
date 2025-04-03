<?php

$conn = new PDO('mysql:host=localhost;dbname=smsi', 'root', '');

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

	$sql = "INSERT INTO 
	sdo_tbl(sdo_fname,sdo_mname, sdo_lname, sdo_ext, sdo_emp_id, sdo_office, sdo_unit, sdo_pos, sdo_emp_status, year_sdo, cp, ors, dv, rso, rso_ben, conca, fb)
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$mainstmt = $conn->prepare($sql)->execute([
		
		$sdo_fname,
		$sdo_mname,
		$sdo_lname,
		$sdo_ext,
		$sdo_emp_id,
		$sdo_office,
		$sdo_unit,
		$sdo_pos,
		$sdo_emp_status,
		
		$year_sdo,
		$cp,
		$ors,
		$dv,
		$rso,
		$rso_ben,
		$conca,
		$fb
	]);
	
	$sdo_id = $conn->lastInsertId();
