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
			<a class = "btn btn-success" href = "member.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<br/>
			<br/>
			<div class = "alert alert-warning">Member / Assess</div>
			<form method = "POST">
            <div class = "row">	
                <h3 class="text-center bg-info p-1 rounded text-light"><i>Beneficiary Category</i></h3>
				<div class = "col-md-4 mb-4">
							<label>Target Sector</label>
							<select class="form-control" name="bene_cat" id="bene_cat" value= "">
								<option selected="selected">Select Target Sector</option>
								<option value="FHONA">FHONA</option>
								<option value="WEDC">WEDC</option>
								<option value="YOUTH">YOUTH</option>
								<option value="PWD">PWD</option>
								<option value="SC">SC</option>
								<option value="PLHIV">PLHIV</option>
							</select>
							
				</div>
				<div class = "col-md-4 mb-4">
						<label>Specity Sub-Category:</label>
						<select class="form-control" name="bene_sub_cat" id="bene_sub_cat" value= "">
								<option selected="selected">Select Sub-Category</option>
								<option value="Solo_Parents">Solo_Parents</option>
								<option value="Indigenous_People">Indigenous_People</option>
								<option value="Recovering_Person_who_used_drugs">Recovering_Person_who_used_drugs</option>
								<option value="4PS_DSWD_Beneficiary">4PS_DSWD_Beneficiary</option>
								<option value="Street_Dwellers">Street_Dwellers</option>
								<option value="Psychosocial_Mental_Learning_Disability">Psychosocial_Mental_Learning_Disability</option>
								<option value="others">others:</option>
							</select>
				</div>
				<div class = "col-md-4 mb-4" id="cat" style="display: none">
						<label >Other Category</label>
						<input type = "text" id="other_cat" type = "text" value= "" class = "form-control" />
				</div>
            </div>
			<div class = "row">	
			<h3 class="text-center bg-info p-1 rounded text-light"><i>Social Worker Assessment</i></h3>
				<div class = "col-md-4 mb-4">
						<label >Assessment</label>
						<input type = "text" id="assess" type = "text" value= "" class = "form-control" />
				</div>
			</div>
			<div class = "row">
			<h3 class="text-center bg-info p-1 rounded text-light">KOMPOSISYON NG PAMILYA NG BENEPISYARYO <i>(Beneficiary's Family Composition)</i></h3>
			<h4 class="text-center bg-success p-1 rounded text-light">First Member <i>(Indicate Immediate Family Members)</i></h4>		
					<div class = "col-md-3 mb-3">
						<label>Firstname</label>
						<input type = "text" id="mem1_fname" type = "text" value= "" class = "form-control" />
					</div>
					<div class = "col-md-3 mb-3">
							<label>Middlename</label>
							<input type = "text" id="mem1_mname"  value = "" class = "form-control" />
							
						</div>
					<div class = "col-md-3 mb-3">
							<label>Lastname</label>
							<input type = "text" id = "mem1_lname" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Ext Name</label>
							<input type = "text" id = "mem1_ext" type = "text" value= "" class = "form-control" />
						</div>

			</div>
			<div class = "row">
					<div class = "col-md-3 mb-3">
					<label>Relation with Beneficiary</label>
							<select class="form-control" name="mem1_rel_bene" id="mem1_rel_bene">
							 	<option disabled selected>-- Select Member --</option>				
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
					<div class = "col-md-3 mb-3">
							<label>Age</label>
							<input type = "text" id="mem1_age"  value = "" class = "form-control" />
							
						</div>
					<div class = "col-md-3 mb-3">
							<label>Work</label>
							<input type = "text" id="mem1_work" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Buwanang Kita</label>
							<input type = "text" id="mem1_kita" type = "text" value= "" class = "form-control" />
						</div>

			</div>
			<div class = "row">
			
			<h4 class="text-center bg-success p-1 rounded text-light">Second Member <i>(Indicate Immediate Family Members)</i></h4>		
					<div class = "col-md-3 mb-3">
						<label>Firstname</label>
						<input type = "text" id="mem2_fname" type = "text" value= "" class = "form-control" />
					</div>
					<div class = "col-md-3 mb-3">
							<label>Middlename</label>
							<input type = "text"  id="mem2_mname" value = "" class = "form-control" />
							
						</div>
					<div class = "col-md-3 mb-3">
							<label>Lastname</label>
							<input type = "text" id="mem2_lname" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Ext Name</label>
							<input type = "text" id="mem2_ext" type = "text" value= "" class = "form-control" />
						</div>

			</div>
			<div class = "row">
					<div class = "col-md-3 mb-3">
					<label>Relation with Beneficiary</label>
							<select class="form-control" name="mem2_rel_bene" id="mem2_rel_bene">
							 	<option disabled selected>-- Select Member --</option>				
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
					<div class = "col-md-3 mb-3">
							<label>Age</label>
							<input type = "text" id="mem2_age"  value = "" class = "form-control" />
							
						</div>
					<div class = "col-md-3 mb-3">
							<label>Work</label>
							<input type = "text" id="mem2_work" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Buwanang Kita</label>
							<input type = "text" id="mem2_kita" type = "text" value= "" class = "form-control" />
						</div>

			</div>

			<div class = "row">
			
			<h4 class="text-center bg-success p-1 rounded text-light">Third Member <i>(Indicate Immediate Family Members)</i></h4>		
					<div class = "col-md-3 mb-3">
						<label>Firstname</label>
						<input type = "text" id="mem3_fname" type = "text" value= "" class = "form-control" />
					</div>
					<div class = "col-md-3 mb-3">
							<label>Middlename</label>
							<input type = "text" id="mem3_mname"  value = "" class = "form-control" />
							
						</div>
					<div class = "col-md-3 mb-3">
							<label>Lastname</label>
							<input type = "text" id="mem3_lname" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Ext Name</label>
							<input type = "text" id="mem3_ext" type = "text" value= "" class = "form-control" />
						</div>

			</div>
			<div class = "row">
					<div class = "col-md-3 mb-3">
					<label>Relation with Beneficiary</label>
							<select class="form-control" name="mem3_rel_bene" id="mem3_rel_bene">
							 	<option disabled selected>-- Select Member --</option>				
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
					<div class = "col-md-3 mb-3">
							<label>Age</label>
							<input type = "text" id="mem3_age"  value = "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Work</label>
							<input type = "text" id="mem3_work" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Buwanang Kita</label>
							<input type = "text" id="mem3_kita" type = "text" value= "" class = "form-control" />
						</div>
			</div>
			<div class = "row">	
			<h3 class="text-center bg-info p-1 rounded text-light"><i>Type of Assistance</i></h3>
					<div class = "col-md-6 mb-6">
						<label>Assistance</label>
							<select class="form-control" name="toa" id="toa">
							 	<option disabled selected>-- Select Assistance --</option>				
								<option value="Medical">Medical</option>
								<option value="Funeral">Funeral</option>
								<option value="Financial_Assistance">Financial_Assistance</option>
								<option value="Material_Assistance">Material_Assistance</option>
								<option value="Psychosocial">Psychosocial</option>
								<option value="Referral_Service">Referral_Service</option>
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
			<div class = "row">	
					<div class = "col-md-3 mb-3">
							<label>Purpose</label>
							<input type = "text" id ="pur"  value = "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Amount of Assistance</label>
							<input type = "text" id="amount" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Mode of Assistance</label>
							<input type = "text" id="moa" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-3 mb-3">
							<label>Fund Source</label>
							<input type = "text" id="fund_source" type = "text" value= "" class = "form-control" />
						</div>
			</div>
			<div class = "row">	
			<h3 class="text-center bg-info p-1 rounded text-light">Recommending Approval</h3>	
					<div class = "col-md-6 mb-6">
							<label>Interviewed by: </label>
							<input type = "text" id="social_worker" type = "text" value= "" class = "form-control" />
						</div>
					<div class = "col-md-6 mb-6">
							<label>Reviewed and  & Approved by:</label>
							<input type = "text" id="ciu_head" type = "text" value= "" class = "form-control" />
						</div>
			</div>
            <div class = "row">	
						<div id = "loading">
						</div>
						<br />
						<div class = "col-md-2">
							<div class = "form-group">
								<button  type = "button" id="save_assess" class = "btn btn-primary form-control"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
							</div>	
						</div>
			</div>
                </form>
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
		$('#bene_sub_cat').change(function () {
                if ($(this).val() == 'others') {
                    $('#cat').show();
                } else {
                    $('#cat').hide();
                }
            });
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