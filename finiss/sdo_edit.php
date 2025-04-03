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
			<li class="active"><a href="sdo.php">SDO</a></li>
            <li><a href="benelist.php">Beneficiary</a></li>
		
		</ul>
		<br />
		<div class = "col-md-12 well">
			<a class = "btn btn-success" href = "sdo.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<br/>
			<br/>
			<div class = "alert alert-warning">SDO / Update</div>
			<div class = "row">	
				<div class = "col-md-3 ">
				</div>
				<!--<div class = "col-md-2">
				</div>-->
				<div class = "col-md-6">
					<?php
						$acc_query = $conn->query("SELECT * FROM sdo_tbl WHERE sdo_id = '$_REQUEST[sdo_id]'"); //or die(mysqli_error());
						$acc_fetch = $acc_query->fetch_array();
					?>
					<form method = "POST">
					<h4 class="text-center bg-success p-1 rounded text-light"><i>SDO Information</i></h4>
						<div class = "form-group">
							<label>SDO Firstname</label>
							<input type = "text" id = "sdo_fname" type = "text" value= "<?php echo $acc_fetch['sdo_fname']?>" class = "form-control" />
                            <input  id = "sdo_id" type = "hidden" value = "<?php echo $acc_fetch['sdo_id']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Middlename</label>
							<input  id = "sdo_mname" type = "text" value = "<?php echo $acc_fetch['sdo_mname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Lastname</label>
							<input type = "text" id = "sdo_lname" type = "text" value= "<?php echo $acc_fetch['sdo_lname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Ext Name</label>
							<input type = "text" id = "sdo_ext" type = "text" value= "<?php echo $acc_fetch['sdo_ext']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Employee Number</label>
							<input type = "text" id = "sdo_emp_id" type = "text" value= "<?php echo $acc_fetch['sdo_emp_id']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Office</label>
							<input type = "text" id = "sdo_office" type = "text" value= "<?php echo $acc_fetch['sdo_office']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Unit</label>
							<input type = "text" id = "sdo_unit" type = "text" value= "<?php echo $acc_fetch['sdo_unit']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Position</label>
							<input type = "text" id = "sdo_unit" type = "text" value= "<?php echo $acc_fetch['sdo_unit']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>SDO Position</label>
							<input type = "text" id = "sdo_pos" type = "text" value= "<?php echo $acc_fetch['sdo_pos']?>" class = "form-control" />
						</div>
						
						<div class = "form-group">
							<label>SDO Employment Status</label>
							<input type = "text" id = "sdo_emp_status" type = "text" value= "<?php echo $acc_fetch['sdo_emp_status']?>" class = "form-control" />
						</div>
						
						<div class = "form-group">
						<label>Year</label>
							<select name="year_sdo" id="year_sdo" class="form-control" value="<?php echo $acc_fetch['year_sdo']?>">
									<!--<option disabled selected>-- Select Year --</option> -->				
									<?php
									include "conn.php";  // Using database connection file here
									$records = mysqli_query($conn, "SELECT year_sdo From sdo_tbl WHERE `sdo_id` = '$_REQUEST[sdo_id]'");  // Use select query here 

									while($row = mysqli_fetch_array($records))
									{
										echo "<option value='". $row['sdo_id'] ."'>" .$row['year_sdo'] ."</option>";  // displaying data in option menu
									}	
									?> 
									<option value="2020">2020</option>
									<option value="2022">2022</option>
									<option value="2024">2024</option> 
							</select>
							
					</div>
					<div class = "form-group">
						<label>Contact Number</label>
						<input type = "text" class = "form-control" id = "cp" value= "<?php echo $acc_fetch['cp']?>"/>
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
						<br />
						<div class = "form-group">
							<button  type = "button" id = "sdo_edit" class = "btn btn-warning form-control"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
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