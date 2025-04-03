<?php
	require_once 'conn.php';
	$sdo_fname = $_POST['sdo_id'];
	$query = $conn->query("SELECT * FROM `sdo_tbl` WHERE `sdo_id` = '$sdo_id'"); //or die(mysqli_error());
	$validate = $query->num_rows;
	if($validate > 0){
		echo "Success";
	}else{
		echo "Error";
	}