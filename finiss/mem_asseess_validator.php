<?php

	require_once 'conn.php';
	if(isset($_POST['save_assess'])){
	$mem1_fname = $_POST['mem1_fname'];
	$mem1_mname = $_POST['mem1_mname'];
	$mem1_lname = $_POST['mem1_lname'];
	$query = $conn->query("SELECT * FROM assess_tbl WHERE mem1_fname = '$mem1_fname' && mem1_mname = '$mem1_mname' && mem1_lname = '$mem1_lname'"); //or die(mysqli_error());
	$validate = $query->num_rows;
	if($validate > 0){
		echo "Success";
	}else{
		echo "Error";
	}
}