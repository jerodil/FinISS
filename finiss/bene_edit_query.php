<?php
$conn = new PDO('mysql:host=localhost;dbname=smsi', 'root', '');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $swo_admin = $_POST['swo_admin'];

    $conn->query("UPDATE `ce_tbl` SET `category` = '$category', `date_assess` = '$date_assess', `ben_lname` = '$ben_lname', `ben_fname` = '$ben_fname', `ben_ext` = '$ben_ext', `ben_sex` = '$ben_sex', 
    `ben_age` = '$ben_age', `ben_reg` = '$ben_reg', `ben_prov` = '$ben_prov', `ben_city` = '$ben_city', `ben_bgy` = '$ben_bgy',`ben_st` = '$ben_st',`rep_lname` = '$rep_lname',`rep_fname` = '$rep_fname',`rep_ext` = '$rep_ext',
    `rep_rel_ben` = '$rep_rel_ben',`other_rel` = '$other_rel',`gis` = '$gis',`pantawid_id` = '$pantawid_id',`just` = '$just',`med_cert_abs` = '$med_cert_abs',`prescript` = '$prescript',`soa` = '$soa',
    `treat_proc` = '$treat_proc',`quotation` = '$quotation',`dis_sum` = '$dis_sum',`lab_req` = '$lab_req',`charge_slip` = '$charge_slip',`funeral_cont` = '$funeral_cont',`death_cert` = '$death_cert',
    `det_sum` = '$det_sum',`ref_let` = '$ref_let',`soc_cas_stud_rep` = '$soc_cas_stud_rep',`val_id` = '$val_id',`other_doc` = '$other_doc',`toa` = '$toa',`toa_medical` = '$toa_medical',`toa_funeral` = '$toa_funeral',
    `toa_financial` = '$toa_financial',`amount` = '$amount',`a_year` = '$a_year',`social_worker` = '$social_worker',`ciu_head` = '$ciu_head',`sdo_id` = '$sdo_id',`swo_admin` = '$swo_admin'
	WHERE `ce_id` = '$_REQUEST[ce_id]'"); //or die(mysqli_error());
    $conn->query($updateQuery);
}?>