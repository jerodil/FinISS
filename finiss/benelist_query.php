<?php

$conn = new PDO('mysql:host=localhost;dbname=smsi', 'root', '');
  
    $category = $_POST['category'];
    $date_assess = $_POST['date_assess'];
    $ben_lname = $_POST['ben_lname'];
    $ben_fname = $_POST['ben_fname'];
    $ben_mname = $_POST['ben_mname'];
    $ben_ext = $_POST['ben_ext'];
    $ben_sex = $_POST['ben_sex'];
    $ben_age = $_POST['ben_age'];
    $ben_reg = $_POST['ben_reg'];
    $ben_prov = $_POST['ben_prov'];
    $ben_city = $_POST['ben_city'];
    $ben_bgy = $_POST['ben_bgy'];
    $ben_st = $_POST['ben_st'];
    
    $rep_lname = $_POST['rep_lname'];
    $rep_fname = $_POST['rep_fname'];
    $rep_mname = $_POST['rep_mname'];
    $rep_ext = $_POST['rep_ext'];
    $rep_rel_ben = $_POST['rep_rel_ben'];
    $other_rel = $_POST['other_rel'];
    //$doc = $_POST['doc'];
    $gis = $_POST['gis'];
    $pantawid_id = $_POST['pantawid_id'];
    $just = $_POST['just'];
    $med_cert_abs = $_POST['med_cert_abs'];
    $prescript = $_POST['prescript'];
    $soa = $_POST['soa'];
    $treat_proc = $_POST['treat_proc'];
    $quotation = $_POST['quotation'];
    $dis_sum = $_POST['dis_sum'];
    $lab_req = $_POST['lab_req'];
    $charge_slip = $_POST['charge_slip'];
    $funeral_cont = $_POST['funeral_cont'];
    $death_cert = $_POST['death_cert'];
    $det_sum = $_POST['det_sum'];
    $ref_let = $_POST['ref_let'];
    $soc_cas_stud_rep = $_POST['soc_cas_stud_rep'];
    $val_id = $_POST['val_id'];
    $other_doc = $_POST['other_doc'];
    $toa = $_POST['toa'];
    $toa_medical = $_POST['toa_medical'];
    $toa_funeral = $_POST['toa_funeral'];
    $toa_financial = $_POST['toa_financial'];
    $toa_material = $_POST['toa_material'];
    $amount = $_POST['amount'];
    $a_year = $_POST['a_year'];
    $social_worker = $_POST['social_worker'];
    $ciu_head = $_POST['ciu_head'];
    $sdo_id = $_POST['sdo_id'];
    $ca_id = $_POST['ca_id'];
	$swo_admin = $_POST['swo_admin'];

	$sql = "INSERT INTO 
	ce_tbl(category, date_assess, ben_lname, ben_fname, ben_mname, ben_ext, ben_sex, ben_age, ben_reg, ben_prov, ben_city, ben_bgy, ben_st, rep_lname, rep_fname, rep_mname, rep_ext, rep_rel_ben, other_rel, gis, pantawid_id, just, med_cert_abs, prescript, soa, treat_proc, quotation, dis_sum, lab_req, charge_slip, funeral_cont, death_cert, det_sum, ref_let, soc_cas_stud_rep, val_id, other_doc, toa, toa_medical, toa_funeral, toa_financial, toa_material, amount, a_year, social_worker, ciu_head, sdo_id, ca_id, swo_admin)
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$mainstmt = $conn->prepare($sql)->execute([
		$category,
        $date_assess,
        $ben_lname,
        $ben_fname,
        $ben_mname,
        $ben_ext,
        $ben_sex,
        $ben_age,
        $ben_reg,
        $ben_prov,
        $ben_city,
        $ben_bgy,
        $ben_st,
        $rep_lname,
        $rep_fname,
        $rep_mname,
        $rep_ext,
        $rep_rel_ben,
        $other_rel,
        //$doc,
        $gis,
        $pantawid_id,
        $just,
        $med_cert_abs,
        $prescript,
        $soa,
        $treat_proc,
        $quotation,
        $dis_sum,
        $lab_req,
        $charge_slip,
        $funeral_cont,
        $death_cert,
        $det_sum,
        $ref_let,
        $soc_cas_stud_rep,
        $val_id,
        $other_doc,
        $toa,
        $toa_medical,
        $toa_funeral,
        $toa_financial,
        $toa_material,
        $amount,
        $a_year,
        $social_worker,
        $ciu_head,
        $sdo_id,
        $ca_id,
        $swo_admin

		
	]);

	$ce_id = $conn->lastInsertId();
