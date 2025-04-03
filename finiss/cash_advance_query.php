<?php

$conn = new PDO('mysql:host=localhost;dbname=smsi', 'root', '');

	$sdo_id = $_POST['sdo_id'];
	$noca = $_POST['noca'];
	$amount_ca = $_POST['amount_ca'];
	$responsible_center = $_POST['responsible_center'];
	$ors_num = $_POST['ors_num'];
	$dv_num = $_POST['dv_num'];
	$uacs_object_num = $_POST['uacs_object_num'];
	

	$sql = "INSERT INTO 
	ca_tbl(sdo_id, noca, amount_ca,responsible_center, ors_num, dv_num, uacs_object_num)
	VALUES (?,?,?,?,?,?,?)";
	$mainstmt = $conn->prepare($sql)->execute([
		
		$sdo_id,
		$noca,
		$amount_ca,
		$responsible_center,
		$ors_num,
		$dv_num,
		$uacs_object_num
		
		
	]);
	
	$ca_id = $conn->lastInsertId();
