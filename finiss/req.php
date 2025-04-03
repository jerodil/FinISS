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
                    // Database connection
                    require_once 'conn.php';

                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    // Fetch image details from the database
                    $ce_id = $c_fetch['ce_id'];
                    $sql = "SELECT * FROM `images` img left join ce_tbl ce on img.ce_id = ce.ce_id WHERE img.ce_id = $ce_id";
                    $result = mysqli_query($conn, $sql);
                    ?>
                <table id = "table" class = "table-bordered">
					<thead>    
						<tr>
							<th>Bene Name</th>
							<th>Image</th>
							<th>Filename</th>
							<th>Action</th>
						</tr>
					</thead>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['ben_fname']." ".$row['ben_lname']; ?></td>
                            <td><img src="upload/<?php echo $row['filename']; ?>" alt="<?php echo $row['filepath']; ?>" width="100"></td>
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
				<h4 class="modal-title" id="myModalLabel">Upload Scanned Requirements</h4>
			</div>
			<div class="modal-body">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
					<div class = "form-group">
						<label>Beneficiary name</label>
						<select name="ce_id" id = "ce_id" class = "chosen-select">
							<option value = "">Select Beneficiary</option>
							<?php
								$g_query = $conn->query('SELECT * FROM `ce_tbl`') ;//or die(mysqli_error());
								while($g_fetch = $g_query->fetch_array()){
									echo '<option value = "'.$g_fetch['ce_id'].'">'.$g_fetch['ben_fname'].' '.$g_fetch['ben_lname'].'</option>';
								}
							?>
						</select>
						<input type = "hidden" id = "ce_id" name="ce_id" value = "<?php echo $c_fetch['ce_id']?>" />
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
<!--<script src = "js/chosen.jquery.js"></script>-->
<script src = "js/script.js"></script>
<script src = "js/jquery.dataTables.min.js"></script>

<script type = "text/javascript">
	
	$(document).ready(function(){
		$('#table').DataTable();
		
	})
	function showImage(filename) {
    var imageUrl = 'upload/' + filename;
    window.open(imageUrl);
    }
</script>
<?php
// Close the database connection
mysqli_close($conn);
?>
</html>