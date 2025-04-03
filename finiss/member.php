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
			<li class="active"><a href="member.php">Member</a></li>
			<li><a href="club.php">Program</a></li>
			<li><a href="sdo.php">SDO</a></li>
			<li><a href="benelist.php">Beneficiary</a></li>
			
		</ul>
		<br />
		<div class = "col-md-12 well">
			<button type = "button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Add new</button>
			<br/>
			<br/>
			<div class = "alert alert-info">
				<table id = "table" class = "table-bordered">
					<thead>
						<tr>
							<th>Firstname</th>
							<th>Middlename</th>
							<th>Lastname</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = $conn->query("SELECT * FROM member"); //or die(mysqli_error());
							while($f_query = $query->fetch_array()){
						?>
						<tr>
							<td><?php echo $f_query['firstname']?></td>
							<td><?php echo $f_query['middlename']?></td>
							<td><?php echo $f_query['lastname']?></td>
							<td><?php echo $f_query['status']?></td>
							<td><center><a href = "assess_member.php?mem_id=<?php echo $f_query['mem_id']?>" class = "btn btn-success"><span class = "glyphicon glyphicon-check"></span>  Assess</a> | <a href = "member_edit.php?mem_id=<?php echo $f_query['mem_id']?>" class = "btn btn-warning"><span class = "glyphicon glyphicon-edit"></span>  Update</a> | <a  href = "delete_member.php?mem_id=<?php echo $f_query['mem_id']?>" class = "btn btn-danger"><span class = "glyphicon glyphicon-trash"></span> Delete</a></center></td>
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
				<h4 class="modal-title" id="myModalLabel">Beneficiary Registration</h4>
			</div>
			<div class="modal-body">
				<form method = "POST" enctype = "multipart/form-data">
				<h4 class="text-center bg-success p-1 rounded text-light"><i>Beneficiary Information</i></h4>
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Lastname</label>
						<input type = "text" class = "form-control" id = "lastname"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Firstname</label>
						<input type = "text" class = "form-control" id = "firstname"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Middlename</label>
						<input type = "text" class = "form-control" id = "middlename"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Ext Name</label>
						<input type = "text" class = "form-control" id = "ext"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>House No./Street/Purok</label>
						<input type = "text" class = "form-control" id = "st"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Address Barangay</label>
						<input type = "text" class = "form-control" id = "bgy"/>
					</div>		
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
					<label>City</label>
						<select class="form-control" name="city" id="city">
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
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Province</label>
						<select class="form-control" name="province" id="province">
							<option selected="selected">Select Province</option>
							<option value="NCR_District_1_Manila">NCR_District_1_Manila</option>
							<option value="NCR_District_2">NCR_District_2</option>
							<option value="NCR_District_3">NCR_District_3</option>
							<option value="NCR_District_4">NCR_District_4</option>
						</select>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Region</label>
						<select class="form-control" name="region" id="region">
							<option selected="selected">Select Region</option>
							<option value="NCR">National Capital Region</option>
						</select>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Cellphone Number</label>
						<input type = "text" class = "form-control" id = "cp"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Birthdate</label>
						<input type = "date" class = "form-control" id = "bdate"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Age</label>
						<input type = "text" class = "form-control" id = "age"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Sex</label>
						<select class="form-control" name="sex" id="sex">
							<option selected="selected">Select Sex</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div class="col-md-6 mb-6">
						<label>Trabaho</label>
						<input type = "text" class = "form-control" id = "work"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Buwanang kita</label>
						<input type = "text" class = "form-control" id = "kita"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Type of Assistance</label>
						<select class="form-control" name="type_of_assistance" id="type_of_assistance">
							<option selected="selected">Select Type of Assistance</option>
							<option value="Financial">Financial</option>
							<option value="Educational">Educational</option>
							<option value="Medical">Medical</option>
							<option value="Burial">Burial</option>
							<option value="Transportation">Transportation</option>
						</select>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6"  style="display: none" id="med">
						<label>For Medical Assistance</label>
						<select class="form-control" name="toa_med" id="toa_med">
							<option selected="selected">Select Type of Assistance</option>
							<option value="Hospital_Bill">Hospital_Bill</option>
							<option value="Medicine">Medicine</option>
							<option value="Chemotheraphy">Chemotheraphy</option>
							<option value="Dialysis">Dialysis</option>
							<option value="Procedures">Procedures</option>
							<option value="Laboratory">Laboratory</option>
							<option value="Implant">Implant</option>
						</select>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6" style="display: none" id="fun">
						<label>For Funeral</label>
						<select class="form-control" name="toa_fun" id="toa_fun">
							<option selected="selected">Select Type of Assistance</option>
							<option value="Funeral_Bill">Funeral_Bill</option>
							<option value="Transfer_of_Cadever">Transfer_of_Cadever</option>
						</select>
					</div>
					</div><!--row-->
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Representative Information</i></h4>
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Lastname</label>
						<input type = "text" class = "form-control" id = "rep_lname"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Firstname</label>
						<input type = "text" class = "form-control" id = "rep_fname"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Middlename</label>
						<input type = "text" class = "form-control" id = "rep_mname"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Ext Name</label>
						<input type = "text" class = "form-control" id = "rep_ext"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>House No./Street/Purok</label>
						<input type = "text" class = "form-control" id = "rep_st"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Address Barangay</label>
						<input type = "text" class = "form-control" id = "rep_bgy"/>
					</div>		
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
					<label>City</label>
						<select class="form-control" name="rep_city" id="rep_city">
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
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Province</label>
						<select class="form-control" name="rep_prov" id="rep_prov">
							<option selected="selected">Select Province</option>
							<option value="NCR_District_1_Manila">NCR_District_1_Manila</option>
							<option value="NCR_District_2">NCR_District_2</option>
							<option value="NCR_District_3">NCR_District_3</option>
							<option value="NCR_District_4">NCR_District_4</option>
						</select>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Region</label>
						<select class="form-control" name="rep_region" id="rep_region">
							<option selected="selected">Select Region</option>
							<option value="NCR">National Capital Region</option>
						</select>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Cellphone Number</label>
						<input type = "text" class = "form-control" id = "rep_cp"/>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Birthdate</label>
						<input type = "date" class = "form-control" id = "rep_bdate"/>
					</div>
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6">
						<label>Relation with Beneficiary</label>
						<select class="form-control" name="rep_rel_bene" id="rep_rel_bene">
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
							<option value="other_relation">Others, pls specify</option>
						</select>
					</div>
					</div><!--endrow-->
					<div class="row"><!--row-->
					<!--<div class = "form-group">-->
					<div class="col-md-6 mb-6" style="display: none" id="bene_relation">
						<label for="rep_rel">Relation with Beneficiary</label>
						<input type="text" name="rep_rel" class="form-control"  id="rep_rel">
					</div>
					</div><!--endrow-->
					<div id = "loading">
						
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id= "save_member" class="btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Save</button>
			</div>
				</form>
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
		$('#rep_rel_bene').change(function () {
                if ($(this).val() == 'other_relation') {
                    $('#bene_relation').show();
                } else {
                    $('#bene_relation').hide();
                }
            });
			$('#type_of_assistance').change(function () {
                if ($(this).val() == 'Burial') {
                    $('#fun').show();
                } else {
                    $('#fun').hide();
                }
            });
			$('#type_of_assistance').change(function () {
                if ($(this).val() == 'Medical') {
                    $('#med').show();
                } else {
                    $('#med').hide();
                }
            });
	})
</script>
</html>