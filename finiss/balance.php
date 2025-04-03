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
		
		<link rel="stylesheet" href="path/to/chosen.min.css">
		<script src="path/to/jquery.min.js"></script>
		<script src="path/to/chosen.jquery.min.js"></script>

<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
			
			<a class = "btn btn-danger"  href = "sdo.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
			<a class = "btn btn-primary"  href = "bal_export.php?sdo_id=<?php echo $_GET['sdo_id']; ?>"><span class = "glyphicon glyphicon-export"></span> Export to Excel</a>
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
						<th>SDO ID</th>
							<th>SDO (SDO FN, MN, LN)</th>
                            
							<th>Funds Allocated</th>
							<th>Outstanding Balance</th>
							<th>Utilized Amount</th>
							
						</tr>
					</thead>
					<tbody>
					<tbody>
					<?php
					// Assuming you have already established a database connection with $conn

					$c_sdo_id = $c_fetch['sdo_id']; // Assuming you fetched the $c_fetch['sdo_id'] value from somewhere
					
					// Add the GROUP BY clause to perform the SUM calculation correctly
					$query = $conn->query("SELECT sdo_tbl.sdo_id, sdo_tbl.sdo_fname, sdo_tbl.sdo_mname, sdo_tbl.sdo_lname, ca_tbl.amount_ca, ca_tbl.amount_ca - SUM(ce_tbl.amount) AS result 
										FROM ce_tbl 
										JOIN ca_tbl ON ce_tbl.ca_id = ca_tbl.ca_id
										JOIN sdo_tbl ON ca_tbl.sdo_id = sdo_tbl.sdo_id
										WHERE sdo_tbl.sdo_id = '$c_sdo_id'
										GROUP BY sdo_tbl.sdo_id, sdo_tbl.sdo_fname, sdo_tbl.sdo_mname, sdo_tbl.sdo_lname, ca_tbl.amount_ca"); 

					while ($f_query = $query->fetch_array()) {
						
					?>
						<tr>
							<td><?php echo $f_query['sdo_id']; ?></td>
							<td><?php echo $f_query['sdo_fname'] . " " . $f_query['sdo_mname'] . " " . $f_query['sdo_lname']; ?></td>
							<td><?php echo '₱ ' . number_format($f_query['amount_ca']); ?></td>
							<td><?php echo '₱ ' . number_format($f_query['result']); ?></td>
							<td><?php echo '₱ ' .  number_format($f_query['amount_ca'] - $f_query['result']); ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
				</table>
			</div>
		</div>
	</div>

	<footer class = "navbar navbar-fixed-bottom navbar-inverse">
	<label class = "pull-right">&copy; <?php echo date('Y', strtotime('+8 HOURS'))?> Developed By: <b>RICTMS</b></label>
	</footer>
</body>	

<script src = "js/script.js"></script>

<!-- Include jQuery -->
<script src="js/jquery-3.1.1.js"></script>

<!-- Include DataTables -->
<script src="js/jquery.dataTables.min.js"></script>

<!-- Include DataTables Buttons and related libraries -->
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>





<script type = "text/javascript">
// $(document).ready(function() {
//     var table = $('#table').DataTable({
//     // Assuming you have other configuration options here
//     // Add the new column definition
//     "columnDefs": [
//         {
//           // Target the 5th column (index 4, as it is 0-based)
//           "targets": 4,
//           "data": "new_column_data_key", // Replace with the actual key from the fetched data array
//           "render": function(data, type, row) {
//             // Customize the rendering of the new column data (optional)
//             // This function is called for each cell in the column
//             return data; // or format the data as needed
//           }
//         }
//       ]
// 	});
// 	   // Add the DataTables buttons configuration
// 	   new $.fn.dataTable.Buttons(table, {
//       buttons: [
//         {
//           extend: 'print', // Enable the print button
//           text: 'Print', // Customize the button text (optional)
//           exportOptions: {
//             columns: ':visible', // Use ':visible' to print only visible columns
//           },
//           customize: function(win) {
//             // Customize the printing window (optional)
//             // Here you can modify the appearance of the printed document
//             // For example, you can add headers or footers.
//             $(win.document.body).find('h1').css('text-align', 'center');
//           }
//         },
//         {
//           extend: 'excelHtml5', // Enable the Excel export button
//           text: 'Export to Excel', // Customize the button text (optional)
//           exportOptions: {
//             columns: ':visible', // Use ':visible' to export only visible columns
//           }
//         }
//       ]
//   }).container().appendTo($('#table_wrapper .col-md-6:eq(0)'));
// });
   
$(document).ready(function() {
	var table = $('#table').DataTable({
    // Assuming you have other configuration options here
    // Add the new column definition
    "columnDefs": [
      {
        // Target the 5th column (index 4, as it is 0-based)
        "targets": 5,
        "data": "new_column_data_key", // Replace with the actual key from the fetched data array
        "render": function(data, type, row) {
          // Customize the rendering of the new column data (optional)
          // This function is called for each cell in the column
          return data; // or format the data as needed
        }
      }
    ],
    // Customize language settings to hide "No data available" message
    "language": {
      "emptyTable": "No data available."
    },
    // Enable pagination
    "paging": true
  });

  // Hide the table footer when there is no data
  if (table.data().count() === 0) {
    $('#table_wrapper .dataTables_info').hide();
  }
});
</script>
<script type = "text/javascript">
	$('.chosen-select').chosen({width: "100%"});
</script>
</html>