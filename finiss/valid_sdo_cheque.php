<?php
	require_once 'conn.php';
	$cheque_no = $_POST['cheque_no'];
	$query = $conn->query("SELECT * FROM `cheque_tbl` WHERE `cheque_no` = '$cheque_no'"); //or die(mysqli_error());
	$validate = $query->num_rows;
	if($validate > 0){
		echo "Success";
	}else{
		echo "Error";
	}