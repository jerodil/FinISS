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
			<li><a href="club.php">Club</a></li>
			<li><a href="sdo.php">SDO</a></li>
			<li><a href="benelist.php">Beneficiary</a></li>
			
		</ul>
		<br />
		<div class = "col-md-12 well">
			<a class = "btn btn-success" href = "member.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<br/>
			<br/>
			<div class = "alert alert-warning">Member / Update</div>
			<div class = "row">	
				<div class = "col-md-3 ">
				</div>
				<!--<div class = "col-md-2">
				</div>-->
				<div class = "col-md-6">
					<?php
						$acc_query = $conn->query("SELECT * FROM member WHERE mem_id = '$_REQUEST[mem_id]'"); //or die(mysqli_error());
						$acc_fetch = $acc_query->fetch_array();
					?>
					<form method = "POST">
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Beneficiary Information</i></h4>
						<div class = "form-group">
							<label>Lastname</label>
							<input type = "text" id = "lastname" type = "text" value= "<?php echo $acc_fetch['lastname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Firstname</label>
							<input  id = "firstname" type = "text" value = "<?php echo $acc_fetch['firstname']?>" class = "form-control" />
							<input  id = "mem_id" type = "hidden" value = "<?php echo $acc_fetch['mem_id']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Middlename</label>
							<input type = "text" id = "middlename" type = "text" value= "<?php echo $acc_fetch['middlename']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Ext Name</label>
							<input type = "text" id = "ext" type = "text" value= "<?php echo $acc_fetch['ext']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>House No./Street/Purok</label>
							<input type = "text" id = "st" type = "text" value= "<?php echo $acc_fetch['st']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Address Barangay</label>
							<input type = "text" id = "bgy" type = "text" value= "<?php echo $acc_fetch['bgy']?>" class = "form-control" />
						</div>
						<div class = "form-group">	
							<label>City</label>
							<select class="form-control" name="city" id="city" value= "<?php echo $acc_fetch['city']?>">
								<!--<option selected="selected">Select City</option>-->
								<?php
									include "conn.php";  // Using database connection file here
									$records = mysqli_query($conn, "SELECT city From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

									while($row = mysqli_fetch_array($records))
									{
										echo "<option value='". $row['city'] ."'>" .$row['city'] ."</option>";  // displaying data in option menu
									}	
								?> 
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
							<label>Province</label>
							<select class="form-control" name="province" id="province" value= "<?php echo $acc_fetch['province']?>">
								<!--<option selected="selected">Select Province</option> -->
								<?php
									include "conn.php";  // Using database connection file here
									$records = mysqli_query($conn, "SELECT province From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

									while($row = mysqli_fetch_array($records))
									{
										
										echo "<option value='". $row['province'] ."'>" .$row['province'] ."</option>";  // displaying data in option menu
										?>
										<option value="NCR_District_1_Manila">NCR_District_1_Manila</option>
										<option value="NCR_District_2">NCR_District_2</option>
										<option value="NCR_District_3">NCR_District_3</option>
										<option value="NCR_District_4">NCR_District_4</option>
									<?php	
									}	
								?>  
								
							</select>
						</div>
						<div class = "form-group">
							<label>Region</label>
							<select class="form-control" name="region" id="region" value= "<?php echo $acc_fetch['region']?>">
								
							<!--<option selected="selected">Select Region</option>-->
												<?php
							include "conn.php";  // Using database connection file here
							$records = mysqli_query($conn, "SELECT region From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

							while($row = mysqli_fetch_array($records))
							{
								echo "<option value='". $row['region'] ."'>" .$row['region'] ."</option>";  // displaying data in option menu
							}	
						?>  
								<option value="NCR">National Capital Region</option>
							</select>
						</div>
						<div class = "form-group">
							<label>Cellphone Number</label>
							<input type = "text" id = "cp" type = "text" value= "<?php echo $acc_fetch['cp']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Birthdate</label>
							<input type = "date" id = "bdate" type = "text" value= "<?php echo $acc_fetch['bdate']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Age</label>
							<input type = "text" id = "age" type = "text" value= "<?php echo $acc_fetch['age']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Sex</label>
							<select class="form-control" name="sex" id="sex" value= "<?php echo $acc_fetch['sex']?>">
								<!--<option selected="selected">Select Sex</option>-->
								<?php
									include "conn.php";  // Using database connection file here
									$records = mysqli_query($conn, "SELECT sex From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

									while($row = mysqli_fetch_array($records))
									{
										echo "<option value='". $row['sex'] ."'>" .$row['sex'] ."</option>";  // displaying data in option menu
									}	
								?> 
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class = "form-group">
							<label>Trabaho</label>
							<input type = "text" id = "work" type = "text" value= "<?php echo $acc_fetch['work']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Buwanang Kita</label>
							<input type = "text" id = "kita" type = "text" value= "<?php echo $acc_fetch['kita']?>" class = "form-control" />
						</div>
						<!--representative-->
						<h4 class="text-center bg-success p-1 rounded text-light"><i>Representative Information</i></h4>
						<div class = "form-group">
							<label>Lastname</label>
							<input type = "text" id = "rep_lname" type = "text" value= "<?php echo $acc_fetch['rep_lname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Firstname</label>
							<input type = "text" id = "rep_fname" type = "text" value= "<?php echo $acc_fetch['rep_fname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Middlename</label>
							<input type = "text" id = "rep_mname" type = "text" value= "<?php echo $acc_fetch['rep_mname']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Ext Name</label>
							<input type = "text" id = "rep_ext" type = "text" value= "<?php echo $acc_fetch['rep_ext']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>House No./Street/Purok</label>
							<input type = "text" id = "rep_st" type = "text" value= "<?php echo $acc_fetch['rep_st']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Address Barangay</label>
							<input type = "text" id = "rep_bgy" type = "text" value= "<?php echo $acc_fetch['rep_bgy']?>" class = "form-control" />
						</div>
						<div class = "form-group">	
							<label>City</label>
							<select class="form-control" name="rep_city" id="rep_city" value= "<?php echo $acc_fetch['city']?>">
								<!--<option selected="selected">Select City</option>-->
								<?php
									include "conn.php";  // Using database connection file here
									$records = mysqli_query($conn, "SELECT rep_city From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

									while($row = mysqli_fetch_array($records))
									{
										echo "<option value='". $row['rep_city'] ."'>" .$row['rep_city'] ."</option>";  // displaying data in option menu
									}	
								?> 
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
							<label>Province</label>
							<select class="form-control" name="rep_prov" id="rep_prov" value= "<?php echo $acc_fetch['rep_prov']?>">
								<!--<option selected="selected">Select Province</option> -->
								<?php
									include "conn.php";  // Using database connection file here
									$records = mysqli_query($conn, "SELECT rep_prov From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

									while($row = mysqli_fetch_array($records))
									{
										
										echo "<option value='". $row['rep_prov'] ."'>" .$row['rep_prov'] ."</option>";  // displaying data in option menu
										?>
										<option value="NCR_District_1_Manila">NCR_District_1_Manila</option>
										<option value="NCR_District_2">NCR_District_2</option>
										<option value="NCR_District_3">NCR_District_3</option>
										<option value="NCR_District_4">NCR_District_4</option>
									<?php	
									}	
								?>  
								
							</select>
						</div>
						<div class = "form-group">
							<label>Region</label>
							<select class="form-control" name="rep_region" id="rep_region" value= "<?php echo $acc_fetch['rep_region']?>">
								
							<!--<option selected="selected">Select Region</option>-->
												<?php
							include "conn.php";  // Using database connection file here
							$records = mysqli_query($conn, "SELECT rep_region From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

							while($row = mysqli_fetch_array($records))
							{
								echo "<option value='". $row['rep_region'] ."'>" .$row['rep_region'] ."</option>";  // displaying data in option menu
							}	
						?>  
								<option value="NCR">National Capital Region</option>
							</select>
						</div>
						<div class = "form-group">
							<label>Cellphone Number</label>
							<input type = "text" id = "rep_cp" type = "text" value= "<?php echo $acc_fetch['rep_cp']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Birthdate</label>
							<input type = "date" id = "rep_bdate" type = "text" value= "<?php echo $acc_fetch['rep_bdate']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							
							<label>Relation with Beneficiary</label>
							<select class="form-control" name="rep_rel_bene" id="rep_rel_bene">
							<!-- <option disabled selected>-- Select Member --</option>-->
								<?php
								include "conn.php";  // Using database connection file here
								$records = mysqli_query($conn, "SELECT rep_rel_bene From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

								while($row = mysqli_fetch_array($records))
								{
									echo "<option value='". $row['rep_rel_bene'] ."'>" .$row['rep_rel_bene'] ."</option>";  // displaying data in option menu
								}	
								?>  					
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
						<div class = "form-group"  id="bene_relation">
							<label>Relation with Beneficiary</label>
							<input type = "text" id = "rep_rel" type = "text" value= "<?php echo $acc_fetch['rep_rel']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							
							<label>Type of Assistance</label>
							<select class="form-control" name="type_of_assistance" id="type_of_assistance">
							<!-- <option disabled selected>-- Select Member --</option>-->
								<?php
								include "conn.php";  // Using database connection file here
								$records = mysqli_query($conn, "SELECT type_of_assistance From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

								while($row = mysqli_fetch_array($records))
								{
									echo "<option value='". $row['type_of_assistance'] ."'>" .$row['type_of_assistance'] ."</option>";  // displaying data in option menu
								}	
								?>  					
							<option value="Financial">Financial</option>
							<option value="Educational">Educational</option>
							<option value="Medical">Medical</option>
							<option value="Burial">Burial</option>
							<option value="Transportation">Transportation</option>
							</select>	
						</div>
						<div class = "form-group">
							
							<label>For Medical Assistance</label>
							<select class="form-control" name="med" id="med">
							<!-- <option disabled selected>-- Select Member --</option>-->
								<?php
								include "conn.php";  // Using database connection file here
								$records = mysqli_query($conn, "SELECT toa_med From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

								while($row = mysqli_fetch_array($records))
								{
									echo "<option value='". $row['toa_med'] ."'>" .$row['toa_med'] ."</option>";  // displaying data in option menu
								}	
								?>  					
								
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
							
							<label>For Funeral Assistance</label>
							<select class="form-control" name="fun" id="fun">
							<!-- <option disabled selected>-- Select Member --</option>-->
								<?php
								include "conn.php";  // Using database connection file here
								$records = mysqli_query($conn, "SELECT toa_fun From member WHERE `mem_id` = '$_REQUEST[mem_id]'");  // Use select query here 

								while($row = mysqli_fetch_array($records))
								{
									echo "<option value='". $row['toa_fun'] ."'>" .$row['toa_fun'] ."</option>";  // displaying data in option menu
								}	
								?>  					
								
								<option value="Funeral_Bill">Funeral_Bill</option>
								<option value="Transfer_of_Cadever">Transfer_of_Cadever</option>
							</select>	
						</div>
						<div id = "loading">
						</div>
						<br />
						<div class = "form-group">
							<button  type = "button" id = "mem_edit" class = "btn btn-warning form-control"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
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