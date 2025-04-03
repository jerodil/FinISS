<?php
	require_once 'conn.php';
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$ext = $_POST['ext'];
	$st = $_POST['st'];
	$bgy = $_POST['bgy'];
	$city = $_POST['city'];
	$province = $_POST['province'];
	$region = $_POST['region'];
	$cp = $_POST['cp'];
	$bdate = $_POST['bdate'];
	$age = $_POST['age'];
	$sex = $_POST['sex'];
	$work = $_POST['work'];
	$kita = $_POST['kita'];

	$rep_lname = $_POST['rep_lname'];
	$rep_fname = $_POST['rep_fname'];
	$rep_mname = $_POST['rep_mname'];
	$rep_ext = $_POST['rep_ext'];
	$rep_st = $_POST['rep_st'];
	$rep_bgy = $_POST['rep_bgy'];
	$rep_city = $_POST['rep_city'];
	$rep_prov = $_POST['rep_prov'];
	$rep_region = $_POST['rep_region'];
	$rep_cp = $_POST['rep_cp'];
	$rep_bdate = $_POST['rep_bdate'];
	$rep_rel_bene = $_POST['rep_rel_bene'];
	$rep_rel = $_POST['rep_rel'];
	
	$type_of_assistance = $_POST['type_of_assistance'];
	$toa_med = $_POST['toa_med'];
	$toa_fun = $_POST['toa_fun'];
	$conn->query("INSERT INTO `member` VALUES('','$lastname','$firstname','$middlename',
	'$ext',
	'$st',
	'$bgy',
	'$city',
	'$province',
	'$region',
	'$cp',
	'$bdate',
	'$age',
	'$sex',
	'$work',
	'$kita',
	'$rep_lname',
	'$rep_fname',
	'$rep_mname',
	'$rep_ext',
	'$rep_st',
	'$rep_bgy',
	'$rep_city',
	'$rep_prov',
	'$rep_region',
	'$rep_cp',
	'$rep_bdate',
	'$rep_rel_bene',
	'$rep_rel',
	'$type_of_assistance',
	'$toa_med',
	'$toa_fun'
	)");//or die(mysqli_error());
