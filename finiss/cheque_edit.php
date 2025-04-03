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
			<a class = "btn btn-success" href = "cheque_add.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<br/>
			<br/>
            
			<div class = "alert alert-warning">Check Details / Update</div>
           
			<div class = "row">	
				<div class = "col-md-3 ">
				</div>
				<!--<div class = "col-md-2">
				</div>-->
				<div class = "col-md-6">
					<?php
						$acc_query = $conn->query("SELECT * FROM cheque_tbl WHERE cheque_id = '$_REQUEST[cheque_id]'"); //or die(mysqli_error());
						$acc_fetch = $acc_query->fetch_array();
					?>
					<form method = "POST">
					<h4 class="text-center bg-success p-1 rounded text-light"><i>Check Information</i></h4>
						<div class = "form-group">
							<label>Check Number</label>
							<input type = "text" id = "cheque_no" type = "text" value= "<?php echo $acc_fetch['cheque_no']?>" class = "form-control" />
                            <input  id = "cheque_id" type = "hidden" value = "<?php echo $acc_fetch['cheque_id']?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Check Date</label>
							<input type="date" id = "cheque_date" type = "text" value = "<?php echo $acc_fetch['cheque_date']?>" class = "form-control" />
						</div>
						
						
						<div id = "loading">
						</div>
						<br />
						<div class = "form-group">
							<button  type = "button" id = "check_edit" class = "btn btn-warning form-control"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
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