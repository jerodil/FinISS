<!DOCTYPE HTML>
<?php
	require_once 'session.php';
	require_once 'account_name.php';
?>
<html lang = "eng">
	<head>
		<meta charset =  "UTF-8">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel="icon" href="images/dswd.png" sizes="32x32" />
  		<link rel="icon" href="images/dswd.png" sizes="192x192" />
  		<link rel="apple-touch-icon-precomposed" href="images/dswd.png" />
 		<meta name="msapplication-TileImage" content="images/dswd.png" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<title>FinISS</title>
	</head>
<body class = "alert-info">
	<nav class  = "navbar navbar-inverse">
		<div class = "container-fluid">
			<div class = "navbar-header">
				<a class = "navbar-brand">Financial Support Information System</a>
			</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a><span class = "glyphicon glyphicon-user"></span> <?php echo $acc_name?></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
		</div>
	</nav>
	<div class = "container-fluid">
		<ul class="nav nav-pills">
			<li><a href="home.php">Home</a></li>
			<li><a href="account.php">Account</a></li>
			<li><a href="member.php">Member</a></li>
			<li><a href="club.php">Program</a></li>
			<li><a href="sdo.php">SDO</a></li>
            <li class="active"><a href="benelist.php">Beneficiary</a></li>
		
		</ul>
		<br />
		<div class = "col-md-12 well">
			<button type = "button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Add Beneficiary</button>
			<br/>
			<br/>
			<div class = "alert alert-info">
				<table id = "table" class = "table-bordered">
					<thead>
						<tr>
							<th>First Name</th>
                            <th>Middlename</th>
							<th>Last Name</th>
                            <th>Ext</th>
							<th>Type of Assistance</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = $conn->query("SELECT * FROM `ce_tbl`") ;//or die(mysqli_error());
							while($f_query = $query->fetch_array()){
						?>
						<tr>
							<td><?php echo $f_query['ben_lname']?></td>
							<td><?php echo ($f_query['ben_fname'])?></td>
                            <td><?php echo ($f_query['ben_mname'])?></td>
                            <td><?php echo ($f_query['ben_ext'])?></td>
							<td><?php echo ($f_query['toa'])?></td>
							<td><?php echo ($f_query['status_bene'])?></td>
							<td><center><a href = "assess_member.php?ce_id=<?php echo $f_query['ce_id']?>" data-toggle="tooltip" data-placement="top" title="Requirements List" class = "btn btn-success" ><span class = "glyphicon 	glyphicon glyphicon-ok"></span> Assess Beneficiary </a> | <a href = "req.php?ce_id=<?php echo $f_query['ce_id']?>" data-toggle="tooltip" data-placement="top" title="Requirements List" class = "btn btn-info" ><span class = "glyphicon glyphicon-eye-open"></span>  Requirements List</a> | <a href = "bene_edit.php?ce_id=<?php echo $f_query['ce_id']?>"  data-toggle="tooltip" data-placement="top" title="Update Beneficiary Details" class = "btn btn-warning" disabled><span class = "glyphicon glyphicon-edit"></span>  Update</a> | <a  href = "delete_admin.php?admin_id=<?php echo $f_query['sdo_id']?>"   data-toggle="tooltip" data-placement="top" title="Remove" class = "btn btn-danger" disabled><span class = "glyphicon glyphicon-trash"></span> Delete</a></center></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Certificate of Eligibility Encoding</h4>
			</div>
			<div class="modal-body">
				<form method = "POST" enctype = "multipart/form-data"id="formSubmit">
					<h4 class="text-center bg-success p-1 rounded text-light">Select Category</h4>
					<div class="row"><!--row-->
					<div class="col-md-6 mb-6">
								<label>Select Category</label>
								<select class="form-control" name="category" id="category">
									<option selected="selected">Select Category</option>
									<option value="New">New</option>
									<option value="Returning">Returning</option>
									<option value="Walkin">Walkin</option>
									<option value="Referral">Referral</option>
									<option value="Offsite">Offsite</option>
								</select>
						</div>
						
						<div class="col-md-6 mb-6">
								<label>Date Assess</label>
								<input type = "date" class = "form-control" name="date_assess" id = "date_assess"/>
							</div>
					</div><!--row-->
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Beneficiary Information</i></h4>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
								<label>Lastname</label>
								<input type = "text" class = "form-control" name="ben_lname" id = "ben_lname"/>
							</div>
						<div class="col-md-6 mb-6">
							<label>Firstname</label>
							<input type = "text" class = "form-control" name="ben_fname" id = "ben_fname"/>
						</div>
					</div>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
							<label>Middlename</label>
							<input type = "text" class = "form-control" name="ben_mname" id = "ben_mname"/>
						</div>
						<div class="col-md-6 mb-6">
							<label>ext</label>
							<input type = "text" class = "form-control" name="ben_ext" id = "ben_ext"/>
						</div>
					</div>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
							<label>Sex</label>
							<select class="form-control" name="ben_sex" name="ben_sex" id="ben_sex">
								<option selected="selected">Select Sex</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class="col-md-6 mb-6">
							<label>Age</label>
							<input type = "text" class = "form-control" name="ben_age" id = "ben_age"/>
						</div>
					</div>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
								<label>Region</label>
								<select class="form-control" name="ben_reg" id="ben_reg">
									<option selected="selected">Select Region</option>
									<option value="NCR">National Capital Region</option>
								</select>
						</div>
								<div class="col-md-6 mb-6">
								<label>Province</label>
									<select class="form-control" name="ben_prov" id="ben_prov">
										<option selected="selected">Select Province</option>
										<option value="NCR_District_1_Manila">NCR_District_1_Manila</option>
										<option value="NCR_District_2">NCR_District_2</option>
										<option value="NCR_District_3">NCR_District_3</option>
										<option value="NCR_District_4">NCR_District_4</option>
									</select>
						</div>
					</div>
						<div class="row"><!--row-->
							<div class="col-md-6 mb-6">
								<label>City</label>
									<select class="form-control" name="ben_city" id="ben_city">
										<option selected="selected">Select City</option>
										<option value="Caloocan">Caloocan</option>
										<option value="Las_Pinas">Las_Pinas</option>
										<option value="Makati">Makati</option>
										<option value="Malabon">Malabon</option>
										<option value="Mandaluyong">Mandaluyong</option>
										<option value="Manila">Manila</option>
										<option value="Marikina">Marikina</option>
										<option value="Muntinlupa">Muntinlupa</option>
										<option value="Navotas">Navotas</option>
										<option value="Paranaque">Paranaque</option>
										<option value="Pasay">Pasay</option>
										<option value="Pasig">Pasig</option>
										<option value="Quezon">Quezon</option>
										<option value="San_Juan">San_Juan</option>
										<option value="Taguig">Taguig</option>
										<option value="Valenzuela">Valenzuela</option>
										<option value="Pateros">Pateros</option>
									</select>
							</div>
							<div class="col-md-6 mb-6">
								<label>Address Barangay</label>
								<input type = "text" class = "form-control" name="ben_bgy" id = "ben_bgy"/>
							</div>
						</div>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
							<label>House No./Street/Purok</label>
							<input type = "text" class = "form-control" name="ben_st" id = "ben_st"/>
						</div>
						
					</div>
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Beneficiary Representative Information</i></h4>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
								<label>Representative Lastname</label>
								<input type = "text" class = "form-control" mame="rep_lname" id = "rep_lname"/>
							</div>
						<div class="col-md-6 mb-6">
							<label>Representative Firstname</label>
							<input type = "text" class = "form-control" namne="rep_fname" id = "rep_fname"/>
						</div>
					</div>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
							<label>Representative Middlename</label>
							<input type = "text" class = "form-control" namne="rep_mname" id = "rep_mname"/>
						</div>
						<div class="col-md-6 mb-6">
							<label>Representative ext</label>
							<input type = "text" class = "form-control" namne="rep_ext" id = "rep_ext"/>
						</div>
					</div>
					<div class="row"><!--row-->
						<div class="col-md-6 mb-6">
								<label>Relation with Beneficiary</label>
								<select class="form-control" name="rep_rel_ben" id="rep_rel_ben">
									<option selected="selected">Select Beneficiary Relationship</option>
										<option value="Grandmother">Grandmother</option>
										<option value="Grandfather">Grandfather</option>
										<option value="Aunt">Aunt</option>
										<option value="Uncle">Uncle</option>
										<option value="Grand_Aunt">Grand_Aunt</option>
										<option value="Grand_Uncle">Grand_Uncle</option>
										<option value="Cousin">Cousin</option>
										<option value="Sister">Sister</option>
										<option value="Brother">Brother</option>
										<option value="Step-father">Step-father</option>
										<option value="Step-mother">Step-mother</option>
										<option value="Father">Father</option>
										<option value="Mother">Mother</option>
										<option value="Nanny">Nanny</option>
										<option value="Family-friend">Family-friend</option>
										
								</select>
							</div>
							<div class="col-md-6 mb-6">
								<label>Other Relationship</label>
								<input type = "text" class = "form-control" name="other_rel" id = "other_rel"/>
							</div>
					</div>
					
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Records of the case such as the following are Confidentially filed at the CRSIS INTERVENTION DIVISION</i></h4>
					
					<div class="col-md-6 mb-6">
							<input type="checkbox" class="form-check-input" name="gis[]" value="GIS">
							<label>General Intake Sheet</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="pantawid_id[]" value="4PS DSWD ID">
							<label>4PS DSWD ID</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="just[]" value="Justification">
							<label>Justification</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="med_cert_abs[]" value="Medical Certificate/Abstract">
							<label>Medical Certificate/Abstract</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="prescript[]" value="Prescription">
							<label>Prescription</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="soa[]" value="Statement of Account">
							<label>Statement of Account</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="treat_proc[]" value="Treatment Protocol">
							<label>Treatment Protocol</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="quotation[]" value="Quotation">
							<label>Quotation</label>
							<br/>
						</div>
						<div class="col-md-6 mb-6">
							<input type="checkbox" class="form-check-input" name="dis_sum[]" value="Discharge Summary">
							<label>Discharge Summary</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="lab_req[]" value="Laboratory Request">
							<label>Laboratory Request</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="charge_slip[]" value="Charge Slip">
							<label>Charge Slip</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="funeral_cont[]" value="Funeral Contract">
							<label>Funeral Contract</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="death_cert[]" value="Death Certificate">
							<label>Death Certificate</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="det_sum[]" value="Death Summary">
							<label>Death Summary</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="ref_let[]" value="Referral Letter">
							<label>Referral Letter</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="soc_cas_stud_rep[]" value="Social Case Study Report">
							<label>Social Case Study Report</label>
							<br/>
						</div>
					<div class="row">
						<div class="col-md-6 mb-6">
							<label>Valid ID Presented</label>
							<input type = "text" class = "form-control" name="val_id" id = "val_id"/>
						</div>
						<div class="col-md-6 mb-6">
							<label>Other Documents Presented</label>
							<input type = "text" class = "form-control" name="other_doc" id = "other_doc"/>
						</div>
					</div>
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Acknoledgement Receipt</i></h4>
					<div class="row">
						<div class="col-md-6 mb-6">
							<label>Type of Assistance</label>
							<select class="form-control" name="toa" id="toa">
								<option selected="selected">Select Type of Assistance</option>
								<option value="Financial_Assistance">Financial_Assistance</option>
								<option value="Educational">Educational</option>
								<option value="Medical">Medical</option>
								<option value="Funeral">Funeral</option>
								<option value="Material_Assistance">Material_Assistance</option>
							</select>
						</div>
							<div class = "col-md-6 mb-6" id="med" style="display:none">
							<label>Medical</label>
								<select class="form-control" name="toa_medical" id="toa_medical">
									<option disabled selected>-- Select Assistance --</option>				
									<option value="Hospital_Bill">Hospital_Bill</option>
									<option value="Medicine">Medicine</option>
									<option value="Chemotheraphy">Chemotheraphy</option>
									<option value="Dialysis">Dialysis</option>
									<option value="Procedures">Procedures</option>
									<option value="Laboratory">Laboratory</option>
									<option value="Implant">Implant</option>
								</select>	
						</div>
						<div class = "col-md-6 mb-6" id="fun" style="display:none">
							<label>Funeral</label>
								<select class="form-control" name="toa_funeral" id="toa_funeral">
									<option disabled selected>-- Select Assistance --</option>				
									<option value="Funeral_Bill">Funeral_Bill</option>
									<option value="Transfer_of_Cadever">Transfer_of_Cadever</option>
								</select>	
						</div>
						<div class = "col-md-6 mb-6" id="fin" style="display:none">
							<label>Financial Assistance</label>
								<select class="form-control" name="toa_financial" id="toa_financial">
									<option disabled selected>-- Select Assistance --</option>				
									<option value="Medical_Assistance">Medical_Assistance</option>
									<option value="Financial_Assistance">Financial_Assistance</option>
									<option value="Transportation_Assistance">Transportation_Assistance</option>
									<option value="Educational_Assistance">Educational_Assistance</option>
									<option value="Food_Assistance">Food_Assistance</option>
									<option value="Cash_Assistance_for_other_Support_Services">Cash_Assistance_for_other_Support_Services</option>
								</select>	
						</div>
						<div class = "col-md-6 mb-6" id="mat" style="display:none">
							<label>Material Assistance</label>
								<select class="form-control" name="toa_material" id="toa_material">
									<option disabled selected>-- Select Assistance --</option>				
									<option value="Family_Food_Packs">Family_Food_Packs</option>
									<option value="other_Food_items">other_Food_items</option>
									<option value="Hygiene_or_Sleeping_kits">Hygiene_or_Sleeping_kits</option>
									<option value="Assistive_Device_and_technologies">Assistive_Device_and_technologies</option>
								</select>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-6">
								<label>Amount</label>
								<input type="number" class = "form-control" name="amount" id="amount" min="1" max="100000">
								<!--<input type = "text" class = "form-control" name="amount" id = "amount"/>-->
						</div>
						<div class="col-md-6 mb-6">
								<label>Year</label>
								<input type = "text" class = "form-control" name="a_year" id = "a_year"/>
						</div>

					</div>
					<div class="row">
						<div class="col-md-6 mb-6">
								<label>Prepared By: <i>Social Worker</i></label>
								<input type = "text" class = "form-control" name="social_worker" id = "social_worker" style='text-transform:uppercase'/>
						</div>
						<div class="col-md-6 mb-6">
								<label>Approving Officer <i>CIU/CID/CIS/SWTL</i></label>
								<input type = "text" class = "form-control" name="ciu_head" id = "ciu_head" style='text-transform:uppercase'/>
						</div>
						<div class="col-md-6 mb-6">
							<label>Binayaran ni: <i>SDO</i></label>
							<select class="form-control" name="sdo_id" id="sdo_id" style='text-transform:uppercase'>
							<?php
							$qquery = $conn->query("SELECT * FROM `sdo_tbl`") or die(mysqli_error());
							while ($c_query = $qquery->fetch_array()) {
							?>
								<option value="<?=$c_query['sdo_id']?>"><?=$c_query['sdo_fname']?><?=$c_query['sdo_lname']?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-md-6 mb-6">
							<label>Fund Source : ( DV Number / ORS Number)</label>
							<select class="form-control" name="ca_id" id="ca_id" style='text-transform:uppercase'>
							<?php
							$qquery = $conn->query("SELECT * FROM `ca_tbl`") or die(mysqli_error());
							while ($c_query = $qquery->fetch_array()) {
							?>
								<option value="<?=$c_query['ca_id']?>"><?=$c_query['dv_num']?><?=$c_query['ors_num']?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-md-6 mb-6">
								<label>Sinaksihan ni: <i>SWO Admin</i></label>
								<input type = "text" class = "form-control" name="swo_admin" id = "swo_admin"/>
						</div>
					</div>
				</div>

				<div id = "loading">
						
				</div>
			
			<div class="modal-footer">
				<button type="button" id= "save_ce" class="btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Save</button>
			</div>
			</form>
		</div>
	</div>
	</div>
	<footer class = "navbar navbar-fixed-bottom navbar-inverse">
	<label class = "pull-right">&copy; <?php echo date('Y', strtotime('+8 HOURS'))?> Developed By: <b>RITCMS</b></label>
	</footer>
</body>	
<script src = "js/jquery-3.1.1.js"></script>


<script src = "js/bootstrap.js"></script>
<script src = "js/script.js"></script>
<script src = "js/jquery.dataTables.min.js"></script>

<script type = "text/javascript">
	
	$(document).ready(function(){
		$('#table').DataTable();
		$('#toa').change(function () {
                if ($(this).val() == 'Medical') {
                    $('#med').show();
                } else {
                    $('#med').hide();
                }
            });
			$('#toa').change(function () {
                if ($(this).val() == 'Funeral') {
                    $('#fun').show();
                } else {
                    $('#fun').hide();
                }
            });
			$('#toa').change(function () {
                if ($(this).val() == 'Financial_Assistance') {
                    $('#fin').show();
                } else {
                    $('#fin').hide();
                }
            });
			$('#toa').change(function () {
                if ($(this).val() == 'Material_Assistance') {
                    $('#mat').show();
                } else {
                    $('#mat').hide();
                }
            });
	})
</script>
</html>
