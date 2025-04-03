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
			<li class="active"><a href="sdo.php">SDO</a></li>
			<li><a href="benelist.php">Beneficiary</a></li>
			
		</ul>
		<br />
		<div class = "col-md-12 well">
			<button type = "button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Add SDO</button> 
			<a href="#"><button onclick="window.print()" type = "button" class = "btn btn-primary" disabled><span class = "glyphicon glyphicon-export"></span> export data</button></a>
			<br/>
			<br/>
			<div class = "alert alert-info">
				<table id = "table" class = "table-bordered">
					<thead>
						<tr>
							<th>Fullname (FN, MN, LN)</th>
                          
                            <th>Office</th>
                            <th>Unit</th>
                           <!-- <th>Documents Submitted</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = $conn->query("SELECT * FROM `sdo_tbl`"); //or die(mysqli_error());
							while($f_query = $query->fetch_array()){
						?>
						<tr>
							<td><?php echo $f_query['sdo_fname']." ".$f_query['sdo_mname']." ".$f_query['sdo_lname']?></td>
                            <td><?php echo $f_query['sdo_office']?></td>
                            <td><?php echo $f_query['sdo_unit']?></td>
                            <!--<td><?php //echo $f_query['ors']?></td>-->
							<td><a href = "sdo_req.php?sdo_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Requirements List" class = "btn btn-secondary"><span class = "glyphicon glyphicon-list-alt"></span> Requirements List </a>
								| <a href = "cash_advance.php?sdo_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Cash Advance" class = "btn btn-primary"><span class = "glyphicon glyphicon-tags"></span> Cash Advance </a>
								| <a href = "disbursement.php?sdo_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Cash Disbursement" class = "btn btn-success"><span class = "glyphicon glyphicon-folder-open"></span> Cash Disbursment </a>
								| <a href = "balance.php?sdo_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Fund Monitor" class = "btn btn-primary"><span class = "glyphicon glyphicon-ruble"></span> Fund Monitor </a>
								| <a href = "cheque_add.php?sdo_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Check List" class = "btn btn-info"><span class = "glyphicon glyphicon-credit-card"></span> Check List </a>
								| <a href = "sdo_edit.php?sdo_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Update SDO Details" class = "btn btn-warning" disabled><span class = "glyphicon glyphicon-edit"></span> Edit SDO Info</a>
								| <a  href = "delete_admin.php?admin_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Delete" class = "btn btn-danger" disabled><span class = "glyphicon glyphicon-trash"></span> Delete </a></td>
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
				<h4 class="modal-title" id="myModalLabel">Add SDO</h4>
			</div>
			<div class="modal-body">
				<form method = "POST" enctype = "multipart/form-data">
					<div class = "form-group">
						<label>Firstname</label>
						<input type = "text" class = "form-control" id = "sdo_fname"/>
					</div>
					<div class = "form-group">
						<label>Middlename</label>
						<input type = "text" class = "form-control" id = "sdo_mname"/>
					</div>
                    <div class = "form-group">
						<label>Last Name</label>
						<input type = "text" class = "form-control" id = "sdo_lname"/>
					</div>
                    <div class = "form-group">
						<label>Ext</label>
						<input type = "text" class = "form-control" id = "sdo_ext"/>
					</div>
                    <div class = "form-group">
						<label>Employee ID</label>
						<input type = "text" class = "form-control" id = "sdo_emp_id"/>
					</div>
                    <div class = "form-group">
						<label>Office</label>
						<input type = "text" class = "form-control" id = "sdo_office"/>
					</div>
                    <div class = "form-group">
						<label>Unit</label>
						<input type = "text" class = "form-control" id = "sdo_unit"/>
					</div>
                    <div class = "form-group">
						<label>Position</label>
						<input type = "text" class = "form-control" id = "sdo_pos"/>
					</div>
                    <div class = "form-group">
						<label>Employment Status</label>
						<input type = "text" class = "form-control" id = "sdo_emp_status"/>
					</div>
                    
					<div class = "form-group">
						<label>Year</label>
							<select name="year_sdo" id="year_sdo" class="form-control" >
									<option disabled selected>-- Select Year --</option>				
									<option value="2020">2020</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
							</select>
					</div>
					<div class = "form-group">
						<label>Contact Number</label>
						<input type = "text" class = "form-control" id = "cp"/>
					</div>
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Documents Checklist</i></h4>
					<div class = "form-group">
							<input type="checkbox" class="form-check-input" name="ors[]" value="Obligation Request Statement">
							<label>Obligation Request Statement (ORS)</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="dv[]" value="Disbursement Voucher">
							<label>Disbursement Voucher (DV)</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="rso[]" value="Regional Special Order">
							<label>Regional Special Order (RSO) authorizing the cash advance by a particular SDO</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="rso_ben[]" value="RSO authorizing the payment of grants">
							<label>RSO authorizing the payment of grants (if beneficiaries are pre-targeted)</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="conca[]" value="Certificate of No Unliquidated Cash Advance">
							<label>Certificate of No Unliquidated Cash Advance</label>
							<br/>
							<input type="checkbox" class="form-check-input" name="fb[]" value="Copy of SDOs valid Fidelity Bond">
							<label>Copy of SDOs valid Fidelity Bond</label>
							<br/>
						</div>
					<div id = "loading">
						
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id= "add_sdo" class="btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Save</button>
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
	})
</script>
</html>