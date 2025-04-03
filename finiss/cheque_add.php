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
			<button type = "button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Add Cheque</button>
			<a class = "btn btn-danger"  href = "sdo.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<br/>
			<br/>
			<div class = "alert alert-info">
			<?php
			
			if(isset($_REQUEST['sdo_id'])){
				$c_query = $conn->query("SELECT * FROM `sdo_tbl` WHERE `sdo_id` = '$_REQUEST[sdo_id]'");// or die(mysqli_error());
				$c_fetch = $c_query->fetch_array();
				$sdo_id = $c_fetch['sdo_id'];
			}
			else{
				
			}
				
			?>
			
				<div class = "alert alert-success"><?php echo $c_fetch['sdo_fname'] ." ".$c_fetch['sdo_lname']?> / SDO Cheque List</div>
			<table id = "table" class = "table-bordered">
					<thead>
						<tr>
							<th>SDO Firstname</th>
							<th>SDO Lastname</th>
                            <th>SDO Cheque no.</th>
							<th>SDO Cheque Date</th>
                            
							
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sdo_id = $c_fetch['sdo_id'];
							$query = $conn->query("SELECT * FROM `sdo_tbl` sdo LEFT JOIN `cheque_tbl` che ON sdo.sdo_id = che.sdo_id  WHERE che.`sdo_id` = $sdo_id");// or die(mysqli_error());
							while($f_query = $query->fetch_array()){
						?>
						<tr>
							<td><?php echo $f_query['sdo_fname']?></td>
							<td><?php echo $f_query['sdo_lname']?></td>
                            <td><?php echo $f_query['cheque_no']?></td>
							<td><?php echo $f_query['cheque_date']?></td>
                           
							<!--<td><?php //echo $f_query['ors']?></td>
							<td><?php //echo $f_query['dv']?></td>
							<td><?php //echo $f_query['uacs_object']?></td>-->
							<td><center><a  href = "cheque_edit.php?cheque_id=<?php echo $f_query['cheque_id']?>&cheque_id=<?php echo $f_query['cheque_id']?>" class = "btn btn-warning" disabled><span class = "glyphicon glyphicon-edit"></span> Edit</a> | <a  href = "delete_group.php?group_id=<?php echo $f_query['sdo_id']?>&club_id=<?php echo $f_query['sdo_id']?>" class = "btn btn-danger" disabled><span class = "glyphicon glyphicon-trash" disabled></span> Remove</a></center></td>
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
						<label>Cash Advance Amount</label>
						<select id = "ca_id" class = "chosen-select">
							<option value = "">Select a CA amount</option>
							<?php
								$g_query = $conn->query('SELECT * FROM `ca_tbl`') ;//or die(mysqli_error());
								while($g_fetch = $g_query->fetch_array()){
									echo '<option value = "'.$g_fetch['ca_id'].'">'.$g_fetch['amount_ca'].'</option>';
								}
							?>
						</select>
						
						<input type = "hidden" id = "sdo" value = "<?php echo $c_fetch['sdo_id']?>" />
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