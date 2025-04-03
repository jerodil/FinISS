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
		<link rel = "stylesheet" type = "text/css" href = "css/chosen.css" />
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
			<button type = "button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Upload Requirements</button>
			<a class = "btn btn-success"  href = "benelist.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<br/>
			<br/>
			<div class = "alert alert-info">
			<?php
				$c_query = $conn->query("SELECT * FROM `ce_tbl` WHERE `ce_id` = '$_REQUEST[ce_id]'");// or die(mysqli_error());
				$c_fetch = $c_query->fetch_array();
				$sdo = $c_fetch['ce_id'];
			?>
				<div class = "alert alert-success"><?php echo $c_fetch['ben_fname']."  ".$c_fetch['ben_lname']?> / Beneficiary Requirements List</div>
					<?php
						$ce_id = $c_fetch['ce_id'];				
						if($stmt = $conn->query("SELECT * FROM `ce_tbl` ce LEFT JOIN `req_tbl` req ON ce.ce_id = req.ce_id  WHERE req.`ce_id` = $ce_id")){

						echo "No of records : ".$stmt->num_rows."<br>";
						
						echo "<table id='table' class='table my_table'>
						<tr class='info'> <th> Beneficiary Name </th><th>Requirements Submitted</th></tr>";
						while ($row = $stmt->fetch_assoc()) {
						echo "<tr><td>$row[ben_fname] [ben_lname]</td>
						<td><img src=gis/$row[gis] class='rounded-circle' ";
						}
						echo "</table>";
						}else{
						echo $conn->error;
						}
					?>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload Scanned Requirements</h4>
			</div>
			<div class="modal-body">
				<form method = "POST" enctype = "multipart/form-data" id="photo_form">
					<div class = "form-group">
						<label>SDO</label>
						<select id = "ce_id" class = "chosen-select">
							<option value = "">Select Beneficiary</option>
							<?php
								$g_query = $conn->query('SELECT * FROM `ce_tbl`') ;//or die(mysqli_error());
								while($g_fetch = $g_query->fetch_array()){
									echo '<option value = "'.$g_fetch['ce_id'].'">'.$g_fetch['ben_fname'].' '.$g_fetch['ben_lname'].'</option>';
								}
							?>
						</select>
						<input type = "hidden" id = "ce_id" value = "<?php echo $c_fetch['ce_id']?>" />
					</div>
                    <div class="form-group">
						<label for="photo-upload">General Intake Sheet</label>
						<input type="file" class="form-control" name="gis" id="gis" />
					</div>
					<div class="form-group">
						<label for="photo-upload">DSWD 4PS ID</label>
						<input type="file" class="form-control" name="pantawid_id" id="pantawid_id" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Justification</label>
						<input type="file" class="form-control" name="just" id="just" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Medical Certificate/Abstract</label>
						<input type="file" class="form-control" name="med_cert_abs" id="med_cert_abs" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Prescription</label>
						<input type="file" class="form-control" name="prescript" id="prescript" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Statement of Account</label>
						<input type="file" class="form-control" name="soa" id="soa" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Treatment Protocol</label>
						<input type="file" class="form-control" name="treat_proc" id="treat_proc" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Quotation</label>
						<input type="file" class="form-control" name="quotation" id="quotation" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Discharge Summary</label>
						<input type="file" class="form-control" name="dis_sum" id="dis_sum" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Laboratory Request</label>
						<input type="file" class="form-control" name="lab_req" id="lab_req" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Charge Slip</label>
						<input type="file" class="form-control" name="charge_slip" id="charge_slip" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Funeral Contract</label>
						<input type="file" class="form-control" name="funeral_cont" id="funeral_cont" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Death Certificate</label>
						<input type="file" class="form-control" name="death_cert" id="death_cert" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Death Summary</label>
						<input type="file" class="form-control" name="det_sum" id="det_sum" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Referral Letter</label>
						<input type="file" class="form-control" name="ref_let" id="ref_let" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Social Case Study Report</label>
						<input type="file" class="form-control" name="soc_cas_stud_rep" id="soc_cas_stud_rep" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Valid ID</label>
						<input type="file" class="form-control" name="valid_id" id="valid_id" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Certificate of Indigency</label>
						<input type="file" class="form-control" name="cert_indigency" id="cert_indigency" />
					</div>
					<div class="form-group">
						<label for="photo-upload">Other Requirements</label>
						<input type="file" class="form-control" name="other_req" id="other_req" />
					</div>
					<div id = "loading">
						
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id= "upload_req" class="btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Save</button>
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
<!--<script src = "js/chosen.jquery.js"></script>-->
<script src = "js/script.js"></script>
<script src = "js/jquery.dataTables.min.js"></script>

<script type = "text/javascript">
	
	$(document).ready(function(){
		$('#table').DataTable();
		
	})
	function viewImage(imagePath) {
		window.open(imagePath, "Image", "width=500,height=500");
	}
</script>
<script type = "text/javascript">
	//$('.chosen-select').chosen({width: "100%"});
</script>
</html>