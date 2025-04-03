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
			<li><a href="club.php">Club</a></li>
			<li><a href="sdo.php">SDO</a></li>
            <li class="active"><a href="benelist.php">Beneficiary</a></li>
		
		</ul>
		<br />
		<div class = "col-md-12 well">
			<a class = "btn btn-success" href = "benelist.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<br/>
			<br/>
			<div class = "alert alert-warning">Beneficiary / Update</div>
			<div class = "row">	
				<div class = "col-md-3 ">
				</div>
				<!--<div class = "col-md-2">
				</div>-->
				<div class = "col-md-6">
					<?php
						$acc_query = $conn->query("SELECT * FROM ce_tbl WHERE ce_id = '$_REQUEST[ce_id]'"); //or die(mysqli_error());
						$acc_fetch = $acc_query->fetch_array();
						$ce_id = $acc_fetch['ce_id'];
					?>
					<form method = "POST">
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Beneficiary Information</i></h4>
					<input  id = "ce_id" type = "hidden" value = "<?php echo $acc_fetch['ce_id']?>" class = "form-control" />
                    <div class = "form-group">
						<label>Category</label>
							
							<select name="category" id="category" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$ñuery = "SELECT ce_id, category FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_!ssoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['category']; ?></option>
									
								<?php } ?>
									<option value="New">New</option>
									<option value="Walkin">Walkin</option>
									<option value="Returning">Returning</option> 
                                    <option value="Referral">Referral</option> 
                                    <option value="Offsite">Offsite</option> 
							</select>
							<input type = "hidden" id = "category" value = "<?php echo $g_fetch['ce_id']?>" />
					</div>
						<div class = "form-group">
							<label>Date Assessed</label>
							<input type="date" id = "date_assess" name="date_assess" type = "text" value = "<?php echo $acc_fetch['date_assess']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Beneficiary Lastname</label>
							<input type = "text" id = "ben_lname" name="ben_lname" type = "text" value= "<?php echo $acc_fetch['ben_lname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
                            <label>Beneficiary Firstname</label>
							<input type = "text" id = "ben_fname" name="ben_fname" type = "text" value= "<?php echo $acc_fetch['ben_fname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
                            <label>Beneficiary Middlename</label>
							<input type = "text" id = "ben_mname" name="ben_mname" type = "text" value= "<?php echo $acc_fetch['ben_mname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
                            <label>Beneficiary Ext name</label>
							<input type = "text" id = "ben_ext" name="ben_ext" type = "text" value= "<?php echo $acc_fetch['ben_ext']?>" class = "form-control" />
						</div>
						<div class = "form-group">
						    <label>Sex</label>
                             
								<select name="ben_sex" id="ben_sex" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, ben_sex FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['ben_sex']; ?></option>
									
								<?php } ?>
										<option value="Male">Male</option>
                                        <option value="Female">Female</option>
							</select>
                        </div>
                        <div class = "form-group">
                            <label>Beneficiary Age</label>
							<input type = "text" id = "ben_age" name="ben_age" type = "text" value= "<?php echo $acc_fetch['ben_age']?>" class = "form-control" />
						</div>
						<div class = "form-group">
						    <label>Region</label>
                              
								
                                <select name="ben_reg" id="ben_reg"class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, ben_reg FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['ben_reg']; ?></option>
									
								<?php } ?>
									<option value="National_Capital_Region">National_Capital_Region</option>
							</select>
                        </div>
						
						<div class = "form-group">
						    <label>Province</label>
                                
                                <select name="prov" id="prov" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, ben_prov FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['ben_prov']; ?></option>
									
								<?php } ?>
										<option value="NCR_District_1_Manila">NCR_District_1_Manila</option>
										<option value="NCR_District_2">NCR_District_2</option>
										<option value="NCR_District_3">NCR_District_3</option>
										<option value="NCR_District_4">NCR_District_4</option>
							</select>
                        </div>
						<div class = "form-group">
						    <label>City/Municipality</label>
                                
                                <select name="ben_city" id="ben_city" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, ben_city FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['ben_city']; ?></option>
									
								<?php } ?>
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
                        <div class = "form-group">
                            <label>Barangay</label>
							<input type = "text" id = "ben_bgy" name="ben_bgy" type = "text" value= "<?php echo $acc_fetch['ben_bgy']?>" class = "form-control" />
						</div>
                        <div class = "form-group">
                            <label>House No./Street/Purok</label>
							<input type = "text" id = "ben_st" name="ben_st" type = "text" value= "<?php echo $acc_fetch['ben_st']?>" class = "form-control" />
						</div>
                        <h4 class="text-center bg-success p-1 rounded text-light"><i>Beneficiary Representative Information</i></h4>
                        <div class = "form-group">
                            <label>Representative Lastname</label>
							<input type = "text" id = "rep_lname" name="rep_lname" type = "text" value= "<?php echo $acc_fetch['rep_lname']?>" class = "form-control" />
						</div>
                        <div class = "form-group">
                            <label>Representative Firstname</label>
							<input type = "text" id = "rep_fname" name="rep_fname" type = "text" value= "<?php echo $acc_fetch['rep_fname']?>" class = "form-control" />
						</div>
                        <div class = "form-group">
                            <label>Representative Middlename</label>
							<input type = "text" id = "rep_mname" name="rep_mname" type = "text" value= "<?php echo $acc_fetch['rep_mname']?>" class = "form-control" />
						</div>
                        <div class = "form-group">
                            <label>Representative ext</label>
							<input type = "text" id = "rep_ext" name="rep_ext" type = "text" value= "<?php echo $acc_fetch['rep_ext']?>" class = "form-control" />
						</div>

						<div class = "form-group">
						<label>Relation with Beneficiary</label>
							
							<select name="rep_rel_ben" id="rep_rel_ben" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, rep_rel_ben FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['rep_rel_ben']; ?></option>
									
								<?php } ?>
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
					<div class = "form-group">
                            <label>Other Relationship</label>
							<input type = "text" id = "other_rel" name="other_rel" type = "text" value= "<?php echo $acc_fetch['other_rel']?>" class = "form-control" />
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
                        <div class = "form-group">
                        <h4 class="text-center bg-success p-1 rounded text-light"><i>Acknoledgement Receipt</i></h4>
                        </div>
                        <div class = "form-group">
						    <label>Type of Assistance</label>
							
							<select name="toa" id="toa" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, toa FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['toa']; ?></option>
									
								<?php } ?>
										<option value="Financial_Assistance">Financial_Assistance</option>
                                        <option value="Educational">Educational</option>
                                        <option value="Medical">Medical</option>
                                        <option value="Funeral">Funeral</option>
                                        <option value="Material_Assistance">Material_Assistance</option>
							</select>
					    </div>
                        <div class = "form-group">
						    <label>Medical Assistance</label>
							
							<select name="toa_medical" id="toa_medical" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, toa_medical FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['toa_medical']; ?></option>
									
								<?php } ?>
										<option value="Hospital_Bill">Hospital_Bill</option>
                                        <option value="Medicine">Medicine</option>
                                        <option value="Chemotheraphy">Chemotheraphy</option>
                                        <option value="Dialysis">Dialysis</option>
                                        <option value="Procedures">Procedures</option>
                                        <option value="Laboratory">Laboratory</option>
                                        <option value="Implant">Implant</option>
							</select>
					    </div>
                        <div class = "form-group">
						    <label>Funeral Assistance</label>
							
							<select name="toa_funeral" id="toa_funeral" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, toa_funeral FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['toa_funeral']; ?></option>
									
								<?php } ?>
										<option value="Funeral_Bill">Funeral_Bill</option>
									    <option value="Transfer_of_Cadever">Transfer_of_Cadever</option>
							</select>
					    </div>
                        <div class = "form-group">
						    <label>Financial Assistance</label>
							
							<select name="toa_financial" id="toa_financial" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, toa_financial FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['toa_financial']; ?></option>
									
								<?php } ?>
										<option value="Medical_Assistance">Medical_Assistance</option>
                                        <option value="Financial_Assistance">Financial_Assistance</option>
                                        <option value="Transportation_Assistance">Transportation_Assistance</option>
                                        <option value="Educational_Assistance">Educational_Assistance</option>
                                        <option value="Food_Assistance">Food_Assistance</option>
                                        <option value="Cash_Assistance_for_other_Support_Services">Cash_Assistance_for_other_Support_Services</option>
							</select>
					    </div>
                        <div class = "form-group">
						    <label>Material Assistance</label>
							
							<select name="toa_material" id="toa_material" class="form-control">
								<?php
								//$ceId = $_REQUEST['ce_id'];
								$query = "SELECT ce_id, toa_material FROM ce_tbl WHERE ce_id = $_REQUEST[ce_id]";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['ce_id']; ?>"><?php echo $row['toa_material']; ?></option>
									
								<?php } ?>
									<option value="Family_Food_Packs">Family_Food_Packs</option>
                                    <option value="other_Food_items">other_Food_items</option>
                                    <option value="Hygiene_or_Sleeping_kits">Hygiene_or_Sleeping_kits</option>
                                    <option value="Assistive_Device_and_technologies">Assistive_Device_and_technologies</option>
							</select>
					    </div>
                        <div class = "form-group">
                            <label>Amount</label>
							<input type = "text" id = "amount" name="amount" type = "text" value= "<?php echo $acc_fetch['amount']?>" class = "form-control" />
					    </div>
                        <div class = "form-group">
                            <label>Year</label>
							<input type = "text" id = "a_year" name="a_year" type = "text" value= "<?php echo $acc_fetch['a_year']?>" class = "form-control" />
					    </div>
                        <div class = "form-group">
                            <label>Prepared By: <i>Social Worker</i></label>
							<input type = "text" id = "social_worker" name="social_worker" type = "text" value= "<?php echo $acc_fetch['social_worker']?>" class = "form-control" />
					    </div>
                        <div class = "form-group">
						    <label>Binayaran ni: <i>SDO</i></label>
							
							<select name="sdo_id" id="sdo_id" class="form-control">
								<?php
								
								$query = "SELECT sdo_id, sdo_fname,sdo_lname FROM sdo_tbl";
								$result = $conn->query($query);
								?>
								<?php while ($row = $result->fetch_assoc()) { ?>
									<option value="<?php echo $row['sdo_id']; ?>"><?php echo $row['sdo_fname'].' '.$row['sdo_lname']; ?></option>
								<?php } ?>
							</select>
					    </div>
                       
                        <div class = "form-group">
                            <label>Sinaksihan ni: <i>SWO Admin</i></label>
							<input type = "text" id = "swo_admin" name="swo_admin" type = "text" value= "<?php echo $acc_fetch['swo_admin']?>" class = "form-control" />
					    </div>
						<div id = "loading">
						</div>
						<br />
						<div class = "form-group">
							<button  type = "button" id = "bene_edit" class = "btn btn-warning form-control"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
	<footer class = "navbar navbar-fixed-bottom navbar-inverse">
	<label class = "pull-right">&copy; <?php echo date('Y', strtotime('+8 HOURS'))?> Developed By: <b>RICTMS</b></label>
	</footer>
</body>	
<script src = "js/jquery-3.1.1.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "js/script.js"></script>
<script src = "js/jquery.dataTables.min.js"></script>
<script type = "text/javascript">
	$(document).ready(function(){
		$('#table').DataTable();
		
	})
</script>
</html>