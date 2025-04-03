<!DOCTYPE HTML>
<?php
	require_once 'session.php';
	require_once 'account_name.php';
?>
<html lang = "eng">
	<head>
		<meta charset =  "UTF-8">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
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
			<li class="active"><a href="#">Home</a></li>
			<li><a href="account.php">Account</a></li>
			<li><a href="member.php">Member</a></li>
			<li><a href="club.php">Program</a></li>
			<li><a href="sdo.php">SDO</a></li>
			<li><a href="benelist.php">Beneficiary</a></li>
			
		</ul>
		<br />
		
		<div class="row">
			<div class="col-lg-3">
				<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
					<div class="col-xs-6">
						<i class="glyphicon glyphicon-user" style="font-size:60px;color:lightblue;"></i>
					</div>
					<div class="col-xs-6 text-right">
						<?php
						$dash_query = "Select * from admin";
						$dash_query_run = mysqli_query($conn, $dash_query);

						if($user_total = mysqli_num_rows($dash_query_run))
						{
							echo '<h2 class="announcement-heading">'.$user_total.'</h2>';
						}
						else
						{
							echo '<h3 class="announcement-heading"> No Data</h3>';
						}
						?>
						<!--<p class="announcement-heading">1</p>-->
						<p class="announcement-text">Registered Users</p>
					</div>
					</div>
				</div>
				<a href="account.php">
					<div class="panel-footer announcement-bottom">
					<div class="row">
						<div class="col-xs-6">
						Expand
						</div>
						<div class="col-xs-6 text-right">
						<i class="glyphicon glyphicon-arrow-right"></i>
						</div>
					</div>
					</div>
				</a>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
						<div class="col-xs-6">
							<i class="glyphicon glyphicon-list-alt"style="font-size:60px;color:lightblue;"></i>
						</div>
						<div class="col-xs-6 text-right">
						<?php
							$dash_query = "Select * from sdo_tbl";
							$dash_query_run = mysqli_query($conn, $dash_query);

							if($user_total = mysqli_num_rows($dash_query_run))
							{
								echo '<h2 class="announcement-heading">'.$user_total.'</h2>';
							}
							else
							{
								echo '<h3 class="announcement-heading"> No Data</h3>';
							}
						?>
							<!--<p class="announcement-heading">12</p>-->
							<p class="announcement-text"> Total SDO</p>
						</div>
						</div>
					</div>
					<a href="sdo.php">
						<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
							Expand
							</div>
							<div class="col-xs-6 text-right">
							<i class="glyphicon glyphicon-arrow-right"></i>
							</div>
						</div>
						</div>
					</a>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
						<div class="col-xs-6">
							<i class="glyphicon glyphicon-usd"style="font-size:60px;color:lightblue;"></i>
						</div>
						<div class="col-xs-6 text-right">
						<?php
							$connection = mysqli_connect("localhost", "root", "", "smsi");

							// Check if the connection was successful
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$query = "SELECT SUM(amount) AS total_sum FROM ce_tbl";

							$result = mysqli_query($connection, $query);
							$row = mysqli_fetch_assoc($result);
							$totalSum = $row['total_sum'];

						?>
							<h2 class="announcement-heading"><?php echo number_format($totalSum); ?></h2>
							<p class="announcement-text">Total Beneficiaries Served</p>
						</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
							Expand
							</div>
							<div class="col-xs-6 text-right">
							<i class="glyphicon glyphicon-arrow-right"></i>
							</div>
						</div>
						</div>
					</a>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="panel panel-secondary">
					<div class="panel-heading">
						<div class="row">
						<div class="col-xs-6">
							<i class="glyphicon glyphicon-barcode"style="font-size:60px;color:lightblue;"></i>
						</div>
						<div class="col-xs-6 text-right">
						<?php
							$dash_query = "Select * from ce_tbl";
							$dash_query_run = mysqli_query($conn, $dash_query);

							if($user_total = mysqli_num_rows($dash_query_run))
							{
								echo '<h2 class="announcement-heading">'.$user_total.'</h2>';
							}
							else
							{
								echo '<h3 class="announcement-heading"> No Data</h3>';
							}
						?>
							<!--<h3 class="announcement-heading">18</h3>-->
							<p class="announcement-text">Registered Beneficiary</p>
						</div>
						</div>
					</div>
					<a href="benelist.php">
						<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
							Expand
							</div>
							<div class="col-xs-6 text-right">
							<i class="glyphicon glyphicon-arrow-right"></i>
							</div>
						</div>
						</div>
					</a>
					</div>
				</div>
		</div>
          <!-- ./col -->
		<!--<div class = "col-md-12 well">

			<img src = "images/logo.png"/>
		</div>-->
	</div>
	<footer class = "navbar navbar-fixed-bottom navbar-inverse">
		<label class = "pull-right">&copy; <?php echo date('Y', strtotime('+8 HOURS'))?> Developed By: <b>RICTMS</b></label>
	</footer>
</body>	
<script src = "js/jquery-3.1.1.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "js/script.js"></script>
</html>