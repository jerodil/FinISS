<?php

$conn = new PDO('mysql:host=localhost;dbname=smsi', 'root', '');

	$sdo_id = $_POST['sdo_id'];
	$cheque_no = $_POST['cheque_no'];
	$cheque_date = $_POST['cheque_date'];
	$ca_id = $_POST['ca_id'];
	
	
	$sql = "INSERT INTO 
	cheque_tbl(sdo_id, cheque_no, cheque_date,ca_id)
	VALUES (?,?,?,?)";
	$mainstmt = $conn->prepare($sql)->execute([
		
		$sdo_id,
		$cheque_no,
		$cheque_date,
		$ca_id
		
	]);
	
	$cheque_id = $conn->lastInsertId();
