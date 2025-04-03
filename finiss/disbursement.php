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
			<li class="active"><a href="sdo.php">SDO</a></li>
			<li><a href="benelist.php">Beneficiary</a></li>
			
		</ul>
		<br />
		<div class = "col-md-12 well">
			<button type = "button" class = "btn btn-success" disabled data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Add Entity</button>
			<a class = "btn btn-danger"  href = "sdo.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<a class = "btn btn-primary"  href = "export.php?sdo_id=<?php echo $_GET['sdo_id']; ?>"><span class = "glyphicon glyphicon-export"></span> Export to Excel</a>
			<a class = "btn btn-warning"  href = "#=<?php //echo $_GET['sdo_id']; ?>"><span class = "glyphicon glyphicon-print"></span> Print Data</a>
			<br/>
			<br/>
			<div class = "alert alert-info">
			<?php
			if(isset($_REQUEST['sdo_id'])){
				$c_query = $conn->query("SELECT * FROM `sdo_tbl` WHERE `sdo_id` = '$_REQUEST[sdo_id]'");// or die(mysqli_error());
				$c_fetch = $c_query->fetch_array();
				$sdo = $c_fetch['sdo_id'];
			}
			else{

			}
			?>
			<?php
					// Assuming you have your database credentials
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "smsi";

					// Create a connection
					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check the connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					// SQL query to select the sum total
					$sql = "SELECT sdo.sdo_id, SUM(amount) AS sum_total FROM sdo_tbl sdo Join ce_tbl ce ON sdo.sdo_id = ce.sdo_id where sdo.sdo_id =  '$c_fetch[sdo_id]'";

					// Execute the query
					$result = $conn->query($sql);

					// Check if the query was successful
					if ($result) {
						// Fetch the result as an associative array
						$row = $result->fetch_assoc();

						// Access the sum total value as a float and format it with the peso symbol
						$sumTotal = (float)$row['sum_total']; // Convert to float
						$formattedSumTotal = number_format($sumTotal, 2); // Format with 2 decimal places
						$pesoSymbol = '₱ ';

						// Display the sum total with the peso symbol
						//echo $pesoSymbol . $formattedSumTotal;
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					 }

					// Close the connection
					//$conn->close();
				?>
				<div class = "alert alert-success" style=" color: red;"><strong><?php echo $c_fetch['sdo_fname'] ." ".$c_fetch['sdo_lname']?> </strong> / SDO Report on Disbusement / Total Paid Beneficiaries :  <strong><?php echo $pesoSymbol . $formattedSumTotal; ?></strong> </div>
				<table id = "table" class = "table-bordered">
				<thead>
						<tr>
						<th>Bene ID</th>
							<th>Payroll Date</th>
							<th>DV Payroll Number</th>
                            <th>ORS Number</th>
							<!--<th>Responsibility Center</th>-->
							<th>SDO (FN, MN, LN)</th>
                            <th>Payee (FN, MN, LN)</th>
							<th>UACS Object Code</th>
							<th>Nature of Payment</th>
							<th>Amount</th>
							<!--<th>Action</th>-->
						</tr>
					</thead>
					<tbody>
					<?php
						$query = $conn->query("SELECT * FROM sdo_tbl as sdo INNER JOIN ca_tbl as ca ON ca.sdo_id = sdo.sdo_id INNER JOIN ce_tbl AS ce ON ce.ca_id = ca.ca_id  WHERE sdo.sdo_id = '$c_fetch[sdo_id]'");// or die(mysqli_error());

						while ($f_query = $query->fetch_array()) {
						?>
							<tr>
								<td><?php echo $f_query['ce_id'] ?></td>
								<td><?php echo $f_query['date_assess'] ?></td>
								<td><?php echo $f_query['dv_num'] ?></td>
								<td><?php echo $f_query['ors_num'] ?></td>
								<!--<td><?php //echo $f_query['responsible_center']?></td>-->
								<td><?php echo $f_query['sdo_fname'] . " " . $f_query['sdo_mname'] . " " . $f_query['sdo_lname'] ?></td>
								<td><?php echo $f_query['ben_fname'] . " " . $f_query['ben_mname'] . " " . $f_query['ben_lname'] ?></td>
								<td><?php echo $f_query['uacs_object_num'] ?></td>
								<td><?php echo $f_query['toa'] ?></td>
								
								<td><?php echo '₱ ' . number_format($f_query['amount']) ?></td> <!-- Display amount with peso symbol -->
								
								<!--<td><center><a  href = "delete_group.php?group_id=<?php //echo $f_query['sdo_id']?>&club_id=<?php // echo $f_query['sdo_id']?>" class = "btn btn-danger"><span class = "glyphicon glyphicon-trash"></span> Remove</a></center></td>-->
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
				<h4 class="modal-title" id="myModalLabel">Add Cheque</h4>
			</div>
			<div class="modal-body">
				<form method = "POST" enctype = "multipart/form-data">
					<div class = "form-group">
						<label>SDO</label>
						<select id = "sdo_id" class = "chosen-select">
							<option value = "">Select a SDO</option>
							<?php
								$g_query = $conn->query('SELECT * FROM `sdo_tbl`') ;//or die(mysqli_error());
								while($g_fetch = $g_query->fetch_array()){
									echo '<option value = "'.$g_fetch['sdo_id'].'">'.$g_fetch['sdo_fname'].' '.$g_fetch['sdo_lname'].'</option>';
								}
							?>
						</select>
						<input type = "hidden" id = "sdo" value = "<?php echo $c_fetch['sdo_id']?>" />
					</div>
                    <div class = "form-group">
						<label>Cheque No.</label>
						<input type = "text" class = "form-control" id = "cheque_no"/>
					</div>
                    <div class = "form-group">
						<label>Cheque Date</label>
						<input type = "date" class = "form-control" id = "cheque_date"/>
					</div>
                    <div class = "form-group">
						<label>Cheque Amount</label>
						<input type = "text" class = "form-control" id = "cheque_amount"/>
					</div>
					<div id = "loading">
						
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id= "add_sdo_cheque" class="btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Save</button>
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
<script src = "js/chosen.jquery.js"></script>
<script src = "js/script.js"></script>
<script src = "js/jquery.dataTables.min.js"></script>

<script type = "text/javascript">
	$(document).ready(function(){
		$('#table').DataTable();
	})
</script>
<script type = "text/javascript">
	$('.chosen-select').chosen({width: "100%"});
</script>
</html>