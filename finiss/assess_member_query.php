<?php

$conn = new PDO('mysql:host=localhost;dbname=smsi', 'root', '');

	$bene_cat = $_POST['bene_cat'];
	$bene_sub_cat = $_POST['bene_sub_cat'];
	$other_cat = $_POST['other_cat'];
	$assess = $_POST['assess'];
    //member1 fam
	$mem1_fname = $_POST['mem1_fname'];
	$mem1_mname = $_POST['mem1_mname'];
	$mem1_lname = $_POST['mem1_lname'];
	$mem1_ext = $_POST['mem1_ext'];
	$mem1_rel_bene = $_POST['mem1_rel_bene'];
	$mem1_age = $_POST['mem1_age'];
	$mem1_work = $_POST['mem1_work'];
    $mem1_kita = $_POST['mem1_kita'];
    //member2 fam
	$mem2_fname = $_POST['mem2_fname'];
    $mem2_mname = $_POST['mem2_mname'];
	$mem2_lname = $_POST['mem2_lname'];
	$mem2_ext = $_POST['mem2_ext'];
	$mem2_rel_bene = $_POST['mem2_rel_bene'];
	$mem2_age = $_POST['mem2_age'];
	$mem2_work = $_POST['mem2_work'];
	$mem2_kita = $_POST['mem2_kita'];
    //member3 fam
	$mem3_fname = $_POST['mem3_fname'];
	$mem3_mname = $_POST['mem3_mname'];
	$mem3_lname = $_POST['mem3_lname'];
	$mem3_ext = $_POST['mem3_ext'];
	$mem3_rel_bene = $_POST['mem3_rel_bene'];
	$mem3_age = $_POST['mem3_age'];
	$mem3_work = $_POST['mem3_work'];
	$mem3_kita = $_POST['mem3_kita'];
    //toa
	$toa = $_POST['toa'];
	$toa_medical = $_POST['toa_medical'];
	$toa_funeral = $_POST['toa_funeral'];
	$toa_financial = $_POST['toa_financial'];
    $toa_material = $_POST['toa_material'];
    $pur = $_POST['pur'];
    $amount = $_POST['amount'];
    $moa = $_POST['moa'];
    $fund_source = $_POST['fund_source'];
    $social_worker = $_POST['social_worker'];
    $ciu_head = $_POST['ciu_head'];
	$ce_id = $_POST['ce_id'];
	// //$status= $_POST['status'];
	// $conn->query("INSERT INTO `assess_tbl` VALUES('','$bene_cat','$bene_sub_cat','$other_cat','$assess','$mem1_fname','$mem1_mname','$mem1_lname','$mem1_ext','$mem1_rel_bene','$mem1_age','$mem1_work','$mem1_kita','$mem2_fname','$mem2_mname','$mem2_lname','$mem2_ext','$mem2_rel_bene','$mem2_age','$mem2_work','$mem2_kita','$mem3_fname','$mem3_mname','$mem3_lname','$mem3_ext','$mem3_rel_bene','$mem3_age','$mem3_work',
	// '$mem3_kita',
	// '$toa',
	// '$toa_medical',
	// '$toa_funeral',
    // '$toa_financial',
    // '$toa_material',
    // '$pur',
    // '$amount',
    // '$moa',
    // '$fund_source',
    // '$social_worker',
    // '$ciu_head'
	// )");//or die(mysqli_error());
	$sql = "INSERT INTO 
	assess_tbl(bene_cat,bene_sub_cat, other_cat, assess, mem1_fname, mem1_mname, mem1_lname, mem1_ext, mem1_rel_bene, mem1_age, mem1_work, mem1_kita, mem2_fname, mem2_mname, mem2_lname, mem2_ext, mem2_rel_bene, mem2_age, mem2_work, mem2_kita, mem3_fname, mem3_mname, mem3_lname, mem3_ext, mem3_rel_bene, mem3_age, mem3_work, mem3_kita, toa, toa_medical, toa_funeral, toa_financial, toa_material, pur, amount, moa, fund_source, social_worker, ciu_head, ce_id)
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$mainstmt = $conn->prepare($sql)->execute([
		
		$bene_cat,
		$bene_sub_cat,
		$other_cat,
		$assess,
		$mem1_fname,
		$mem1_mname,
		$mem1_lname,
		$mem1_ext,
		$mem1_rel_bene,
		$mem1_age,
		$mem1_work,
		$mem1_kita,
		$mem2_fname,
		$mem2_mname,
		$mem2_lname,
		$mem2_ext,
		$mem2_rel_bene,
		$mem2_age,
		$mem2_work,
		$mem2_kita,
		$mem3_fname,
		$mem3_mname,
		$mem3_lname,
		$mem3_ext,
		$mem3_rel_bene,
		$mem3_age,
		$mem3_work,
	 	$mem3_kita,
		$toa,
	 	$toa_medical,
	 	$toa_funeral,
     	$toa_financial,
     	$toa_material,
     	$pur,
     	$amount,
     	$moa,
     	$fund_source,
     	$social_worker,
     	$ciu_head,
		$ce_id
	]);
	
	$ass_id = $conn->lastInsertId();
