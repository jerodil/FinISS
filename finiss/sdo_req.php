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
			<button type = "button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-plus"></span> Upload Requirements</button>
			<a class = "btn btn-danger"  href = "sdo.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
            
			<br/>
			<br/>
			<div class = "alert alert-info">
			<?php
				$c_query = $conn->query("SELECT * FROM `sdo_tbl` WHERE `sdo_id` = '$_REQUEST[sdo_id]'");// or die(mysqli_error());
				$c_fetch = $c_query->fetch_array();
				$sdo = $c_fetch['sdo_id'];
			?>
				<div class = "alert alert-success"><?php echo $c_fetch['sdo_fname'] ." ".$c_fetch['sdo_lname']?> / SDO Uploaded Requirements</div>
                <?php
                    // Database connection
                    require_once 'conn.php';

                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    // Fetch image details from the database
                    $sdo_id = $c_fetch['sdo_id'];
                    $sql = "SELECT * FROM `sdo_img` sdo_img left join sdo_tbl sdo on sdo.sdo_id = sdo_img.sdo_id WHERE sdo_img.sdo_id = $sdo_id";
                    $result = mysqli_query($conn, $sql);
                    ?>
                <table id = "table" class = "table-bordered">
					<thead>    
						<tr>
							<th>SDO Name</th>
							<th>Image</th>
							<th>Filename</th>
							<th>Action</th>
						</tr>
					</thead>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['sdo_fname']." ".$row['sdo_lname']; ?></td>
                            <td><img src="sdo_upload/<?php echo $row['filename']; ?>" alt="<?php echo $row['filepath']; ?>" width="100"></td>
                            <td><?php echo $row['filepath']; ?></td>
                            <td><button class = "btn btn-success" onclick="showImage('<?php echo $row['filename']; ?>')">View</button></td>
                        </tr>
                    <?php } ?>
                </table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">SDO Uploaded Requirements</h4>
			</div>
			<div class="modal-body">
            <form action="sdo_upload.php" method="POST" enctype="multipart/form-data">
					<div class = "form-group">
						<label>SDO name</label>
						<select name="sdo_id" id = "sdo_id" class = "chosen-select">
							<option value = "">Select SDO</option>
							<?php
								$g_query = $conn->query('SELECT * FROM `sdo_tbl`') ;//or die(mysqli_error());
								while($g_fetch = $g_query->fetch_array()){
									echo '<option value = "'.$g_fetch['sdo_id'].'">'.$g_fetch['sdo_fname'].' '.$g_fetch['sdo_lname'].'</option>';
								}
							?>
						</select>
						<input type = "hidden" id = "sdo_id" name="sdo_id" value = "<?php echo $c_fetch['sdo_id']?>" />
                        </div>
                        <input type="file" name="images[]" multiple>
                        
                    
					<div id = "loading">
						
					</div>
			</div>
			<div class="modal-footer">
            <input type="submit" value="Upload">
				<!--<button type="button" id= "upload_req" class="btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Save</button>-->
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
    function showImage(filename) {
    var imageUrl = 'sdo_upload/' + filename;
    window.open(imageUrl);
    }
</script>
<script type = "text/javascript">
	$('.chosen-select').chosen({width: "100%"});
</script>
<?php
// Close the database connection
mysqli_close($conn);
?>
</html>