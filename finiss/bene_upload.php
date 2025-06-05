<!DOCTYPE HTML>
<?php
    require_once 'session.php';
    require_once 'account_name.php';
    include 'conn.php'; // Add database connection
ini_set('display_errors', 1);
error_reporting(E_ALL);

file_put_contents("debug_log.txt", "Received POST request: " . json_encode($_POST) . "\n", FILE_APPEND);

// Database connection (PostgreSQL)
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=data", "postgres", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Upload Handler
if (isset($_POST['upload'])) {
    if (isset($_FILES['file']['tmp_name'])) {
        $file = fopen($_FILES['file']['tmp_name'], 'r');
        if ($file === false) {
            die("Error opening the file.");
        }
        fgetcsv($file); // Skip header
        $data = [];
        $duplicates = [];

        while (($row = fgetcsv($file)) !== FALSE) {
            $data[] = $row;
        }
        fclose($file);

        // Process data and check for duplicates based on first_name and last_name
        foreach ($data as $record) {
            $batch_file = $record[1];
            $first_name = $record[2];
            $last_name = $record[3];
            
            $stmt = $pdo->prepare("SELECT id FROM bulk_uploads WHERE first_name = ? AND last_name = ?");
            $stmt->execute([$first_name, $last_name]);

            if ($stmt->rowCount() > 0) {
                $duplicates[] = array_merge($record, ['Duplicate']);
            } else {
                // Insert clean record
                $status = 'Clean';
                $stmt = $pdo->prepare("INSERT INTO bulk_uploads (ref_num, batch_file, first_name, last_name, status) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$record[0], $batch_file, $first_name, $last_name, $status]);
                $duplicates[] = array_merge($record, ['Clean']);
            }
        }
        export_to_csv($duplicates);
    } else {
        echo "Please upload a valid CSV file.";
    }
}

// Export function
function export_to_csv($data) {
    $filename = "upload_data_" . date('Y-m-d_H-i-s') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $output = fopen('php://output', 'w');
    
    // Write the header row
    fputcsv($output, ['Ref Number', 'Batch File', 'First Name', 'Last Name', 'Status', 'Amount']);

    $totalAmount = 0; // Initialize total amount
    foreach ($data as $row) {
        $amount = (float)$row[5]; // Assuming the 'Amount' is in the 6th column (index 5)
        $totalAmount += $amount;
        fputcsv($output, $row);
    }

    // Add total amount row
    fputcsv($output, []); // Empty row for separation
    fputcsv($output, ['Total Amount', '', '', '', '', $totalAmount]);

    // Add SDO name at the bottom
    $sdoName = "Your SDO Name"; // Replace with the actual SDO name
    fputcsv($output, []); // Empty row for separation
    fputcsv($output, ['SDO:', $sdoName]);

    fclose($output);
    exit;
}

// Fetch Data for Display
if (isset($_POST['fetch_data'])) {
    $start = isset($_POST['start']) ? (int)$_POST['start'] : 0;
    $length = isset($_POST['length']) ? (int)$_POST['length'] : 10;
    $search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

    // Get total record count
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM bulk_uploads WHERE first_name ILIKE ? OR last_name ILIKE ?");
    $stmt->execute(["%$search%", "%$search%"]);
    $totalRecords = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Fetch paginated data
    $stmt = $pdo->prepare("
        SELECT * FROM bulk_uploads 
        WHERE first_name ILIKE ? OR last_name ILIKE ? 
        ORDER BY id DESC 
        LIMIT ? OFFSET ?
    ");
    $stmt->execute(["%$search%", "%$search%", $length, $start]);
    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = [
            $row['id'],
            $row['ref_num'],
            $row['batch_file'],
            $row['first_name'],
            $row['last_name'],
            $row['status'],
            $row['nature_of_payment'] ?? 'N/A',
            $row['amount'] ?? 'N/A',
            "<button class='btn btn-primary update-btn' data-id='{$row['id']}'>Update</button>",
        ];
    }

    echo json_encode([
        "draw" => isset($_POST['draw']) ? (int)$_POST['draw'] : 1,
        "recordsTotal" => $totalRecords,
        "recordsFiltered" => $totalRecords,
        "data" => $data,
    ]);
    exit;
}

 if (isset($_POST['update_record'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $amount = $_POST['amount'] ?? 0;
    $nature_of_payment = $_POST['nature_of_payment'] ?? '';

    try {
        $stmt = $pdo->prepare("UPDATE bulk_uploads SET first_name = ?, last_name = ?, amount = ?, nature_of_payment = ? WHERE id = ?");
        $success = $stmt->execute([$first_name, $last_name, $amount, $nature_of_payment, $id]);

        // Clear any previous output
        ob_clean();

        // Send a proper JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Record updated successfully!' : 'Failed to update record.',
        ]);
    } catch (PDOException $e) {
        // Clear any previous output
        ob_clean();

        // Send an error JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage(),
        ]);
    }
    exit;
}

// Generate RD Handler
if (isset($_POST['generate_rd'])) {
    $rdDate = $_POST['rd_date'];
    $payrollNo = $_POST['dv_payroll_no'];
    $bursNo = $_POST['ors_burs_no'];
    $responsibilityCenter = $_POST['responsibility_center'];
    $uacsCode = $_POST['uacs_code'];
    $batchFile = $_POST['batch_file'];

    $stmt = $pdo->prepare("SELECT ref_num, batch_file, first_name, last_name, status, amount FROM bulk_uploads WHERE batch_file = ?");
    $stmt->execute([$batchFile]);
    
    $data = [];
    $totalAmount = 0; // Initialize total amount
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $amount = (float)$row['amount']; // Assuming the 'Amount' field is named 'amount'
        $totalAmount += $amount;
        
        $data[] = [
            'ref_num' => $row['ref_num'],
            'batch_file' => $row['batch_file'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'status' => $row['status'],
            'rd_date' => $rdDate,
            'dv_payroll_no' => $payrollNo,
            'ors_burs_no' => $bursNo,
            'responsibility_center' => $responsibilityCenter,
            'uacs_code' => $uacsCode,
            'amount' => $amount
        ];
        
        $updateStmt = $pdo->prepare("UPDATE bulk_uploads SET rd_date = ?, dv_payroll_no = ?, ors_burs_no = ?, responsibility_center = ?, uacs_code = ? WHERE ref_num = ?");
        $updateStmt->execute([$rdDate, $payrollNo, $bursNo, $responsibilityCenter, $uacsCode, $row['ref_num']]);
    }

    // Export data to CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="RD_' . date('Y-m-d') . '.csv"');
    $output = fopen('php://output', 'w');
    
    // Custom header
    fputcsv($output, ['Report of Cash Disbursement']);
    fputcsv($output, ['Entity Name: DSWD', '', 'Report No:']);
    fputcsv($output, ['Fund Cluster: 01', '', 'Sheet No:']);
    fputcsv($output, []); // Empty row for separation

    // Column headers for data
    fputcsv($output, ['Ref Num', 'Batch File', 'First Name', 'Last Name', 'Status', 'Date', 'Payroll No.', 'ORS/BURS No.', 'Responsibility Center', 'UACS Code', 'Amount']);
    
    // Data rows
    foreach ($data as $row) {
        fputcsv($output, array_values($row));
    }

    // Add total amount row
    fputcsv($output, []); // Empty row for separation
    fputcsv($output, ['Total Amount', '', '', '', '', '', '', '', '', '', $totalAmount]);

    // Add SDO name at the bottom
    $sdoName = "Your SDO Name"; // Replace with the actual SDO name
    fputcsv($output, []); // Empty row for separation
    fputcsv($output, ['SDO:', $sdoName]);

    fclose($output);
    exit;
}

// Insert Beneficiary Handler (POST Request)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_beneficiary'])) {
    error_log("Insert beneficiary request received"); // Log request

    // Capture form data
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $nature_of_payment = trim($_POST['nature_of_payment'] ?? '');

    // Debug: Log received data
    error_log("Received Data: First Name - $first_name, Last Name - $last_name, Amount - $amount, Nature of Payment - $nature_of_payment");

    // Validate fields
    if (empty($first_name) || empty($last_name) || empty($amount) || empty($nature_of_payment)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    // Ensure amount is numeric
    if (!is_numeric($amount)) {
        echo json_encode(["status" => "error", "message" => "Amount must be a numeric value."]);
        exit;
    }

    // Check if database connection is working
    if (!$pdo) {
        error_log("Database connection failed!");
        echo json_encode(["status" => "error", "message" => "Database connection failed!"]);
        exit;
    }

    try {
        // Prepare SQL query using named placeholders
        $stmt = $pdo->prepare("INSERT INTO bulk_uploads (first_name, last_name, amount, nature_of_payment, status) 
                               VALUES (:first_name, :last_name, :amount, :nature_of_payment, 'Pending')");
        
        $result = $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':amount' => $amount,
            ':nature_of_payment' => $nature_of_payment
        ]);

        if ($result) {
            echo json_encode(["status" => "success", "message" => "Beneficiary added successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to insert data"]);
        }
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Log error
        echo json_encode(["status" => "error", "message" => "Database Error: " . $e->getMessage()]);
    }

    exit;
}
?>
<!DOCTYPE HTML>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
    <link rel="icon" href="images/dswd.png" sizes="32x32" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>FinISS - Beneficiary Upload</title>
</head>
<body class="alert-info">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Financial Support Information System</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a><span class="glyphicon glyphicon-user"></span> <?php echo htmlspecialchars($acc_name ?? '', ENT_QUOTES, 'UTF-8'); ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <ul class="nav nav-pills">
            <li><a href="home.php">Home</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="member.php">Member</a></li>
            <li><a href="club.php">Program</a></li>
            <li><a href="sdo.php">SDO</a></li>
            <li><a href="benelist.php">Beneficiary</a></li>
            <li class="active"><a href="bene_upload.php">Beneficiary Upload</a></li>
        </ul>
        <br />
        <div class="col-md-12 well">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_message ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success_message ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Upload CSV File:</label>
                    <input type="file" class="form-control" name="file" required />
                </div>
                <button type="submit" name="upload" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#generateRDModal"><span class="glyphicon glyphicon-file"></span> Generate RD</button>
                 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#generateRDModal"><span class="glyphicon glyphicon-plus-sign"></span> Add Beneficiary</button>
            </form>
            <br /><br />
            <div class="alert alert-info">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reference</th>
                            <th>Batch File</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>Nature of Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $result = $pdo->query("SELECT * FROM bulk_uploads");
                        if (!$result) {
                            echo "<tr><td colspan='6'>Error loading data: " . htmlspecialchars($pdo->errorInfo()[2] ?? '', ENT_QUOTES, 'UTF-8') . "</td></tr>";
                        } else {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['ref_num'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['batch_file'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['first_name'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['last_name'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['status'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($row['nature_of_payment'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>
                                    <button class='btn btn-warning btn-sm update-btn' data-id='" . $row['id'] . "'>
                                        <i class='fas fa-edit'></i> Update
                                    </button>
                                </td>
                                </tr>";
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <!-- Generate RD Modal -->
    <div class="modal fade" id="generateRDModal" tabindex="-1" role="dialog" aria-labelledby="generateRDModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="generateRDModalLabel">Generate RD</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rd_date">RD Date:</label>
                            <input type="date" class="form-control" name="rd_date" required>
                        </div>
                        <div class="form-group">
                            <label for="dv_payroll_no">DV/Payroll No.:</label>
                            <input type="text" class="form-control" name="dv_payroll_no" required>
                        </div>
                        <div class="form-group">
                            <label for="ors_burs_no">ORS/BURS No.:</label>
                            <input type="text" class="form-control" name="ors_burs_no" required>
                        </div>
                        <div class="form-group">
                            <label for="responsibility_center">Responsibility Center:</label>
                            <input type="text" class="form-control" name="responsibility_center" required>
                        </div>
                        <div class="form-group">
                            <label for="uacs_code">UACS Code:</label>
                            <input type="text" class="form-control" name="uacs_code" required>
                        </div>
                        <div class="form-group">
                            <label for="batch_file">Batch File:</label>
                            <select class="form-control" name="batch_file" required>
                                <?php
                                    $batchFiles = $pdo->query("SELECT DISTINCT batch_file FROM bulk_uploads");
                                    while ($batch = $batchFiles->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . htmlspecialchars($batch['batch_file'] ?? '', ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($batch['batch_file'] ?? '', ENT_QUOTES, 'UTF-8') . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="generate_rd" class="btn btn-primary">Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  <!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="updateModalLabel">Update Record</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update-id" name="id">
                    <div class="form-group">
                        <label for="update-first-name">First Name:</label>
                        <input type="text" class="form-control" id="update-first-name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="update-last-name">Last Name:</label>
                        <input type="text" class="form-control" id="update-last-name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="update-amount">Amount:</label>
                        <input type="number" class="form-control" id="update-amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="update-nature-of-payment">Nature of Payment:</label>
                        <select class="form-control" id="update-nature-of-payment" name="nature_of_payment" required>
                            <option value="" disabled selected>-- Select Nature of Payment --</option>
                            <option value="Medical Assistance">Medical Assistance</option>
                            <option value="Funeral Assistance">Funeral Assistance</option>
                            <option value="Transportation Assistance">Transportation Assistance</option>
                            <option value="Educational Assistance">Educational Assistance</option>
                            <option value="Food Assistance">Food Assistance</option>
                            <option value="Cash Relief Assistance">Cash Relief Assistance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <footer class="navbar navbar-fixed-bottom navbar-inverse">
        <label class="pull-right">&copy; <?php echo date('Y'); ?> Developed By: <b>RICTMS</b></label>
    </footer>
</body>
<script src="js/jquery-3.1.1.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
 $(document).ready(function(){
      $('#table').DataTable();

      // Open Update Modal
      $('.update-btn').on('click', function(){
          const id = $(this).data('id');
          const row = $(this).closest('tr');
          const firstName = row.find('td:nth-child(4)').text();
          const lastName = row.find('td:nth-child(5)').text();
          const amount = row.find('td:nth-child(7)').text();
          const natureOfPayment = row.find('td:nth-child(8)').text();

          $('#update-id').val(id);
          $('#update-first-name').val(firstName);
          $('#update-last-name').val(lastName);
          $('#update-amount').val(amount);
          $('#update-nature-of-payment').val(natureOfPayment);

          $('#updateModal').modal('show');
      });

      // Submit Update Form
      $('#updateForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    $.ajax({
        url: 'bene_upload.php', // Ensure the URL points to the correct PHP file
        type: 'POST',
        data: $(this).serialize() + '&update_record=true', // Serialize the form data
        dataType: 'json', // Expect JSON response
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message); // Display success message
                $('#updateModal').modal('hide'); // Close modal
                setTimeout(function() {
                    location.reload(); // Refresh the page
                }, 500);
            } else {
                alert('Error: ' + response.message);
                console.error('Server Response:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error); // Log error details
            console.error('Status:', status);
            console.error('Response:', xhr.responseText); // Log server response for debugging
            alert('An error occurred while updating the record. Check the console for details.');
        }
    });
});
  });
</script>
</html>