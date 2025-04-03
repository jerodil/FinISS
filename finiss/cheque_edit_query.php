<?php
	require_once 'conn.php';
	$cheque_no = $_POST['cheque_no'];
	$cheque_date = $_POST['cheque_date'];
	
	
	
	
	$conn->query("UPDATE `cheque_tbl` SET `cheque_no` = '$cheque_no', `cheque_date` = '$cheque_date'
	WHERE `cheque_id` = '$_REQUEST[cheque_id]'"); //or die(mysqli_error());