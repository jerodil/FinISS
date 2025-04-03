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
			<button type = "button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Add Cash Advance</button>
			<a class = "btn btn-danger"  href = "sdo.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
            <button type="button" class="btn btn-primary" disabled><span class="glyphicon glyphicon-print"></span> Print Disbursment</button>
			<br/>
			<br/>
			<div class = "alert alert-info">
			<?php
				$c_query = $conn->query("SELECT * FROM `sdo_tbl` WHERE `sdo_id` = '$_REQUEST[sdo_id]'");// or die(mysqli_error());
				$c_fetch = $c_query->fetch_array();
				$sdo = $c_fetch['sdo_id'];
			?>
				<div class = "alert alert-success"><?php echo $c_fetch['sdo_fname'] ." ".$c_fetch['sdo_lname']?> / SDO Cash Advance</div>
			<table id = "table" class = "table-bordered">
					<thead>
						<tr>
							<th>SDO Fullname (FN, MN, LN)</th>
							<th>Nature of CA</th>
                            <th>Amount CA</th>
							<th>Responsible Center</th>
                            <th>ORS Number</th>
                            <th>ORS Number</th>
                            <th>UACS OBJECT</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = $conn->query("SELECT * FROM `ca_tbl` ca LEFT JOIN `sdo_tbl` sdo ON ca.sdo_id = sdo.sdo_id  WHERE sdo.sdo_id = '$c_fetch[sdo_id]'");// or die(mysqli_error());
							while($f_query = $query->fetch_array()){
						?>
						<tr>
							<td><?php echo $f_query['sdo_fname']." ".$f_query['sdo_mname']." ".$f_query['sdo_lname']?></td>
							<td><?php echo $f_query['noca']?></td>
                            <td><?php echo '₱ ' . number_format($f_query['amount_ca'])	?></td>
							<td><?php echo $f_query['responsible_center']?></td>
							<td><?php echo $f_query['ors_num']?></td>
                            <td><?php echo $f_query['dv_num']?></td>
                            <td><?php echo $f_query['uacs_object_num']?></td>
							<td><center><a  href = "delete_group.php?group_id=<?php echo $f_query['sdo_id']?>&club_id=<?php echo $f_query['sdo_id']?>" data-toggle="tooltip" data-placement="top" title="Delete" class = "btn btn-danger" disabled><span class = "glyphicon glyphicon-trash"></span> Remove</a></center></td>
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
				<h4 class="modal-title" id="myModalLabel">Add Cash Advance</h4>
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
						<input type = "hidden" id = "sdo" value = "<?php echo $g_fetch['sdo_id']?>" />
					</div>
                    <div class = "form-group">
                        <label>Nature of Cash Advance</label>
                                <select class="form-control" name="noca" id="noca">
                                    <option selected="selected">Select</option>
                                    <option value="Financial_Assistance">Financial_Assistance</option>
                                    <option value="Educational">Educational</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Funeral">Funeral</option>
                                    <option value="Material_Assistance">Material_Assistance</option>
                                </select>
					</div>
                    <div class = "form-group">
						<label>Amount of Cash Advance</label>
						<input type = "number" class = "form-control" id = "amount_ca"  min="1" max="1000000"/>
					</div>
					<div class = "form-group">
						<label>Responsible Center</label>
						<input type = "text" class = "form-control" id = "responsible_center"/>
					</div>
                    <!--<div class = "form-group">
                        <label>SDO</label>
                            <select id = "cheque_id" class = "chosen-select">
                                <option value = "">Select Check Number / ORS / DV</option>
                                <?php
                                    
                                   // $g_query = $conn->query('SELECT * FROM `cheque_tbl`') ;//or die(mysqli_error());
                                  //  while($g_fetch = $g_query->fetch_array()){
                                       // echo '<option value = "'.$g_fetch['cheque_id'].'">'.$g_fetch['cheque_no'].' / '.$g_fetch['ors'].' / '.$g_fetch['dv'].'</option>';
                                        
                                   // }
                                ?>
                            </select>
                            <input type = "hidden" id = "cheque_id" value = "<?php //echo $g_fetch['cheque_id']?>" />
					</div>-->
					<div class = "form-group">
						<label>ORS</label>
						<input type = "text" class = "form-control" id = "ors_num"/>
					</div>
					<div class = "form-group">
						<label>DV</label>
						<input type = "text" class = "form-control" id = "dv_num"/>
					</div>
					<div class = "form-group">
						<label>UACS Code</label>
						<input type = "text" class = "form-control" id = "uacs_object_num"/>
					</div>
					<div id = "loading">
						
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id= "add_ca" class="btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Save</button>
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