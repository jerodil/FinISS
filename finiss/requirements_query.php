<?php
require_once 'conn.php';
$ce_id = $_POST['ce_id'];

function get_target_file($name) {
	global $_FILES;
	if (!isset($_FILES[$name])) return '';

	$upload_folder_gis = "$name/";
	$basename = basename($_FILES[$name]['name'][0]);
	return $upload_folder_gis . $basename;
}

function get_tmp_name($name) {
	global $_FILES;
	if (!isset($_FILES[$name])) return '';
	return $_FILES[$name]['tmp_name'][0];
}

function is_allowed_file_type($tmp_name) {
	$allowed_mime = ['image/png', 'image/jpg', 'image/jpeg'];
	$checker = getimagesize($tmp_name);
	return in_array($checker['mime'], $allowed_mime);
}

function extract_basenames() {
	global $_FILES;

	$basenames = [
		'basename_gis'					=> null,
		'basename_pantawid_id' 			=> null,
		'basename_just' 				=> null,
		'basename_med_cert_abs' 		=> null,
		'basename_prescript' 			=> null,
		'basename_soa' 					=> null,
		'basename_treat_proc' 			=> null,
		'basename_quotation' 			=> null,
		'basename_dis_sum' 				=> null,
		'basename_lab_req' 				=> null,
		'basename_charge_slip' 			=> null,
		'basename_funeral_cont' 		=> null,
		'basename_death_cert' 			=> null,
		'basename_det_sum' 				=> null,
		'basename_ref_let' 				=> null,
		'basename_soc_cas_stud_rep' 	=> null,
		'basename_valid_id' 			=> null,
		'basename_cert_indigency' 		=> null,
		'basename_other_req' 			=> null,
	];

	foreach ($_FILES as $key => $value) {
		$basenames['basename_' . $key] = basename($_FILES[$key]['name'][0]);
	}
	return $basenames;
}

function add_req($conn, $data) {
	extract($data);
	$query = "INSERT INTO `req_tbl` VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";			
					// '$ce_id', 
 					// '$basename', 
 					// '$basename_pantawid_id', 
 					// '$basename_just', 
 					// '$basename_med_cert_abs', 
 					// '$basename_prescript', 
 					// '$basename_soa', 
 					// '$basename_treat_proc', 
 					// '$basename_quotation', 
 					// '$basename_dis_sum',
 					// '$basename_lab_req',
 					// '$basename_charge_slip',
 					// '$basename_funeral_cont',
 					// '$basename_death_cert',
 					// '$basename_det_sum',
 					// '$basename_ref_let',
 					// '$basename_soc_cas_stud_rep',
 					// '$basename_valid_id',
 					// '$basename_cert_indigency',
 					// '$basename_other_req'
 					// )";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('isssssssssssssssssss', 
		$ce_id, 
		$basename_gis,
		$basename_pantawid_id,
		$basename_just,
		$basename_med_cert_abs,
		$basename_prescript,
		$basename_soa,
		$basename_treat_proc,
		$basename_quotation,
		$basename_dis_sum,
		$basename_lab_req,
		$basename_charge_slip,
		$basename_funeral_cont,
		$basename_death_cert,
		$basename_det_sum,
		$basename_ref_let,
		$basename_soc_cas_stud_rep,
		$basename_valid_id,
		$basename_cert_indigency,
		$basename_other_req
	);
	return $stmt->execute();
}


$has_upload_failed = false;

// loop through all uploaded files
foreach($_FILES as $name => $file) {

	// grab target file path and tmp name
	$target_file 	= get_target_file($name);
	$tmp_name 		= get_tmp_name($name);

	// check if uploaded file type is allowed
	if (is_allowed_file_type($tmp_name)) {

		// in case of an error moving uploaded file
		if(!move_uploaded_file($tmp_name, $target_file)) {

			// set upload failed flag to true
			$has_upload_failed = true;
			break;
		}
	}
}

$data = extract_basenames();
$data['ce_id'] = $ce_id;

// adding req to database has failed?
if (!add_req($conn, $data)) {
	throw new Exception($conn->error);
}

echo "Uploaded successfully";

// //upload gis variables
// $upload_folder_gis = "gis/";
// $basename = basename($_FILES['gis']['name'][0]);
// $target_file_gis = $upload_folder_gis . $basename;
// $tmp_name_gis = $_FILES['gis']['tmp_name'][0];
// // upload pantawid_id variables
// $upload_pantawid_id_folder = "pantawid_id/";
// $basename_pantawid_id = basename($_FILES['pantawid_id']['name'][0]);
// $target_file_pantawid_id = $upload_pantawid_id_folder . $basename_pantawid_id;
// $tmp_name_pantawid_id = $_FILES['pantawid_id']['tmp_name'][0];
// // upload just variables
// $upload_just_folder = "just/";
// $basename_just = basename($_FILES['just']['name'][0]);
// $target_file_just = $upload_just_folder . $basename_just;
// $tmp_name_just = $_FILES['just']['tmp_name'][0];
// // upload med_cert_abs variables
// $upload_med_cert_abs_folder = "med_cert_abs/";
// $basename_med_cert_abs = basename($_FILES['med_cert_abs']['name'][0]);
// $target_file_med_cert_abs = $upload_med_cert_abs_folder . $basename_med_cert_abs;
// $tmp_name_med_cert_abs = $_FILES['med_cert_abs']['tmp_name'][0];
// // upload prescript variables
// $upload_prescript_folder = "prescript/";
// $basename_prescript = basename($_FILES['prescript']['name'][0]);
// $target_file_prescript = $upload_prescript_folder . $basename_prescript;
// $tmp_name_prescript = $_FILES['prescript']['tmp_name'][0];
// // upload soa variables
// $upload_soa_folder = "soa/";
// $basename_soa = basename($_FILES['soa']['name'][0]);
// $target_file_soa = $upload_soa_folder . $basename_soa;
// $tmp_name_soa = $_FILES['soa']['tmp_name'][0];
// // upload treat_proc variables
// $upload_treat_proc_folder = "treat_proc/";
// $basename_treat_proc = basename($_FILES['treat_proc']['name'][0]);
// $target_file_treat_proc = $upload_treat_proc_folder . $basename_treat_proc;
// $tmp_name_treat_proc = $_FILES['treat_proc']['tmp_name'][0];
// // upload quotation variables
// $upload_quotation_folder = "quotation/";
// $basename_quotation = basename($_FILES['quotation']['name'][0]);
// $target_file_quotation = $upload_quotation_folder . $basename_quotation;
// $tmp_name_quotation = $_FILES['quotation']['tmp_name'][0];
// // upload dis_sum variables
// $upload_dis_sum_folder = "dis_sum/";
// $basename_dis_sum= basename($_FILES['dis_sum']['name'][0]);
// $target_file_dis_sum = $upload_dis_sum_folder . $basename_dis_sum;
// $tmp_name_dis_sum = $_FILES['dis_sum']['tmp_name'][0];
// // upload lab_req variables
// $upload_lab_req_folder = "lab_req/";
// $basename_lab_req= basename($_FILES['lab_req']['name'][0]);
// $target_file_lab_req = $upload_lab_req_folder . $basename_lab_req;
// $tmp_name_lab_req = $_FILES['lab_req']['tmp_name'][0];
// // upload charge_slip variables
// $upload_charge_slip_folder = "charge_slip/";
// $basename_charge_slip= basename($_FILES['charge_slip']['name'][0]);
// $target_file_charge_slip = $upload_charge_slip_folder . $basename_charge_slip;
// $tmp_name_charge_slip = $_FILES['charge_slip']['tmp_name'][0];
// // upload funeral_cont variables
// $upload_funeral_cont_folder = "funeral_cont/";
// $basename_funeral_cont= basename($_FILES['funeral_cont']['name'][0]);
// $target_file_funeral_cont = $upload_funeral_cont_folder . $basename_funeral_cont;
// $tmp_name_funeral_cont = $_FILES['funeral_cont']['tmp_name'][0];
// // upload death_cert variables
// $upload_death_cert_folder = "death_cert/";
// $basename_death_cert= basename($_FILES['death_cert']['name'][0]);
// $target_file_death_cert = $upload_death_cert_folder . $basename_death_cert;
// $tmp_name_death_cert = $_FILES['death_cert']['tmp_name'][0];
// // upload det_sum variables
// $upload_det_sum_folder = "det_sum/";
// $basename_det_sum= basename($_FILES['det_sum']['name'][0]);
// $target_file_det_sum = $upload_det_sum_folder . $basename_det_sum;
// $tmp_name_det_sum = $_FILES['det_sum']['tmp_name'][0];
// // upload ref_let variables
// $upload_ref_let_folder = "ref_let/";
// $basename_ref_let= basename($_FILES['ref_let']['name'][0]);
// $target_file_ref_let = $upload_ref_let_folder . $basename_ref_let;
// $tmp_name_ref_let = $_FILES['ref_let']['tmp_name'][0];
// // upload soc_cas_stud_rep variables
// $upload_soc_cas_stud_rep_folder = "soc_cas_stud_rep/";
// $basename_soc_cas_stud_rep= basename($_FILES['soc_cas_stud_rep']['name'][0]);
// $target_file_soc_cas_stud_rep= $upload_soc_cas_stud_rep_folder . $basename_soc_cas_stud_rep;
// $tmp_name_soc_cas_stud_rep= $_FILES['soc_cas_stud_rep']['tmp_name'][0];
// // upload valid_id variables
// $upload_valid_id_folder = "valid_id/";
// $basename_valid_id= basename($_FILES['valid_id']['name'][0]);
// $target_file_valid_id= $upload_valid_id_folder . $basename_valid_id;
// $tmp_name_valid_id= $_FILES['valid_id']['tmp_name'][0];
// // upload valid_id variables
// $upload_cert_indigency_folder = "cert_indigency/";
// $basename_cert_indigency= basename($_FILES['cert_indigency']['name'][0]);
// $target_file_cert_indigency= $upload_cert_indigency_folder . $basename_cert_indigency;
// $tmp_name_cert_indigency= $_FILES['cert_indigency']['tmp_name'][0];
// // upload other_req variables
// $upload_other_req_folder = "other_req/";
// $basename_other_req= basename($_FILES['other_req']['name'][0]);
// $target_file_other_req= $upload_other_req_folder . $basename_other_req;
// $tmp_name_other_req= $_FILES['other_req']['tmp_name'][0];

// $checker_gis = '';
// $checker_pantawid_id = '';
// $checker_just = '';
// $checker_med_cert_abs = '';
// $checker_prescript = '';
// $checker_soa = '';
// $checker_treat_proc = '';
// $checker_quotation = '';
// $checker_dis_sum = '';
// $checker_lab_req = '';
// $checker_charge_slip = '';
// $checker_funeral_cont = '';
// $checker_death_cert = '';
// $checker_det_sum = '';
// $checker_ref_let = '';
// $checker_soc_cas_stud_rep = '';
// $checker_valid_id = '';
// $checker_cert_indigency = '';
// $checker_other_req = '';
var_dump($_FILES);
// foreach ($_FILES as $name => $file) {
// 	if ()
// }

// if (!empty($tmp_name_gis)  && !empty($tmp_name_pantawid_id) && !empty($tmp_name_just) && !empty($tmp_name_med_cert_abs) && !empty($tmp_name_prescript) && !empty($tmp_name_soa) && !empty($tmp_name_treat_proc) && !empty($tmp_name_quotation) && !empty($tmp_name_dis_sum) && !empty($tmp_name_lab_req) && !empty($tmp_name_charge_slip) && !empty($tmp_name_funeral_cont) && !empty($tmp_name_death_cert) && !empty($tmp_name_det_sum) && !empty($tmp_name_ref_let) && !empty($tmp_name_soc_cas_stud_rep) && !empty($tmp_name_valid_id) && !empty($tmp_name_cert_indigency) && !empty($tmp_name_other_req)) {
// 	$checker_gis = getimagesize($tmp_name_gis);
// 	$checker_pantawid_id = getimagesize($tmp_name_pantawid_id);
// 	$checker_just = getimagesize($tmp_name_just);
// 	$checker_med_cert_abs = getimagesize($tmp_name_med_cert_abs);
// 	$checker_prescript = getimagesize($tmp_name_prescript);
// 	$checker_soa = getimagesize($tmp_name_soa);
// 	$checker_treat_proc = getimagesize($tmp_name_treat_proc);
// 	$checker_quotation = getimagesize($tmp_name_quotation);
// 	$checker_dis_sum = getimagesize($tmp_name_dis_sum);
// 	$checker_lab_req = getimagesize($tmp_name_lab_req);
// 	$checker_charge_slip = getimagesize($tmp_name_charge_slip);
// 	$checker_funeral_cont = getimagesize($tmp_name_funeral_cont);
// 	$checker_death_cert = getimagesize($tmp_name_death_cert);
// 	$checker_det_sum = getimagesize($tmp_name_det_sum);
// 	$checker_ref_let = getimagesize($tmp_name_ref_let);
// 	$checker_soc_cas_stud_rep = getimagesize($tmp_name_soc_cas_stud_rep);
// 	$checker_valid_id = getimagesize($tmp_name_valid_id);
// 	$checker_cert_indigency = getimagesize($tmp_name_cert_indigency);
// 	$checker_other_req = getimagesize($tmp_name_other_req);
	
// 	// If its an image, check if the image mime is what you needed such as jpg, png, jpeg etc.
// 	$allowed_mime = ['image/png', 'image/jpg', 'image/jpeg'];
// 	if ($checker_gis !== false && $checker_pantawid_id !== false && $checker_just !== false && $checker_med_cert_abs !== false && $checker_prescript !== false && $checker_soa !== false && $checker_treat_proc !== false && $checker_quotation !== false && $checker_dis_sum !== false && $checker_lab_req !== false && $checker_charge_slip !== false && $checker_funeral_cont !== false && $checker_death_cert !== false && $checker_det_sum !== false && $checker_ref_let !== false && $checker_soc_cas_stud_rep !== false && $checker_valid_id !== false && $checker_cert_indigency !== false && $checker_other_req !== false) {
// 		// if its in the allowed mime type
// 		if (in_array($checker_gis['mime'], $allowed_mime) && in_array($checker_pantawid_id['mime'], $allowed_mime) && in_array($checker_just['mime'], $allowed_mime) && in_array($checker_med_cert_abs['mime'], $allowed_mime) && in_array($checker_prescript['mime'], $allowed_mime) && in_array($checker_soa['mime'], $allowed_mime) && in_array($checker_treat_proc['mime'], $allowed_mime) && in_array($checker_quotation['mime'], $allowed_mime) && in_array($checker_dis_sum['mime'], $allowed_mime) && in_array($checker_lab_req['mime'], $allowed_mime) && in_array($checker_charge_slip['mime'], $allowed_mime) && in_array($checker_funeral_cont['mime'], $allowed_mime) && in_array($checker_death_cert['mime'], $allowed_mime) && in_array($checker_det_sum['mime'], $allowed_mime) && in_array($checker_ref_let['mime'], $allowed_mime) && in_array($checker_soc_cas_stud_rep['mime'], $allowed_mime) && in_array($checker_valid_id['mime'], $allowed_mime) && in_array($checker_cert_indigency['mime'], $allowed_mime) && in_array($checker_other_req['mime'], $allowed_mime)) {
// 			// move to destination folder if saving of the filename was successful
// 			if (move_uploaded_file($_FILES['gis']['tmp_name'][0], $target_file_gis) && move_uploaded_file($_FILES['pantawid_id']['tmp_name'][0], $target_file_pantawid_id) && move_uploaded_file($_FILES['just']['tmp_name'][0], $target_file_just)
//              && move_uploaded_file($_FILES['med_cert_abs']['tmp_name'][0], $target_file_med_cert_abs) && move_uploaded_file($_FILES['prescript']['tmp_name'][0], $target_file_prescript) && move_uploaded_file($_FILES['soa']['tmp_name'][0], $target_file_soa) 
//              && move_uploaded_file($_FILES['treat_proc']['tmp_name'][0], $target_file_treat_proc) && move_uploaded_file($_FILES['quotation']['tmp_name'][0], $target_file_quotation) && move_uploaded_file($_FILES['dis_sum']['tmp_name'][0], $target_file_dis_sum)
//              && move_uploaded_file($_FILES['lab_req']['tmp_name'][0], $target_file_lab_req) && move_uploaded_file($_FILES['charge_slip']['tmp_name'][0], $target_file_charge_slip) && move_uploaded_file($_FILES['funeral_cont']['tmp_name'][0], $target_file_funeral_cont) 
//              && move_uploaded_file($_FILES['death_cert']['tmp_name'][0], $target_file_death_cert) && move_uploaded_file($_FILES['det_sum']['tmp_name'][0], $target_file_det_sum)  && move_uploaded_file($_FILES['ref_let']['tmp_name'][0], $target_file_ref_let) 
//              && move_uploaded_file($_FILES['soc_cas_stud_rep']['tmp_name'][0], $target_file_soc_cas_stud_rep) && move_uploaded_file($_FILES['valid_id']['tmp_name'][0], $target_file_valid_id) && move_uploaded_file($_FILES['cert_indigency']['tmp_name'][0], $target_file_cert_indigency) 
//              && move_uploaded_file($_FILES['other_req']['tmp_name'][0], $target_file_other_req)) {
// 				$query = $conn->query("INSERT INTO `req_tbl` VALUES
// 					('',
// 					'$ce_id', 
// 					'$basename', 
// 					'$basename_pantawid_id', 
// 					'$basename_just', 
// 					'$basename_med_cert_abs', 
// 					'$basename_prescript', 
// 					'$basename_soa', 
// 					'$basename_treat_proc', 
// 					'$basename_quotation', 
// 					'$basename_dis_sum',
// 					'$basename_lab_req',
// 					'$basename_charge_slip',
// 					'$basename_funeral_cont',
// 					'$basename_death_cert',
// 					'$basename_det_sum',
// 					'$basename_ref_let',
// 					'$basename_soc_cas_stud_rep',
// 					'$basename_valid_id',
// 					'$basename_cert_indigency',
// 					'$basename_other_req'
// 					)");
// 				if ($query) {
// 					echo "Uploaded successfully";
// 				} else {
// 					die(mysqli_error($conn));
// 				}
// 			}
// 		} else {
// 			echo 'Only allowed mime types are png, jpg and jpeg';
// 		}
// 	} else {
// 		echo 'Please upload image only';
// 	}
// }

?>
