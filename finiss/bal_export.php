<?php
include_once 'conn.php';

// Assuming you have fetched the $c_fetch['sdo_id'] value from your data source
// $c_fetch = ['sdo_id' => 1]; // Replace with your actual fetched data
// Assign the SDO ID value to $c_sdo_id
$c_sdo_id = isset($_GET['sdo_id']) ? $_GET['sdo_id'] : null;

if ($c_sdo_id === null) {
    die("SDO ID is missing.");
}

// Set appropriate headers for CSV export with UTF-8 encoding
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="SDO_Funds.csv"');

// Open output stream for writing CSV
$output = fopen('php://output', 'w');

// Write header row to CSV
fputcsv($output, ['SDO ID', 'SDO (SDO FN, MN, LN)', 'Funds Allocated', 'Outstanding Balance', 'Utilized Amount']);

// Add the GROUP BY clause to perform the SUM calculation correctly
$query = $conn->query("SELECT sdo_tbl.sdo_id, sdo_tbl.sdo_fname, sdo_tbl.sdo_mname, sdo_tbl.sdo_lname, ca_tbl.amount_ca, ca_tbl.amount_ca - SUM(ce_tbl.amount) AS result 
                    FROM ce_tbl 
                    JOIN ca_tbl ON ce_tbl.ca_id = ca_tbl.ca_id
                    JOIN sdo_tbl ON ca_tbl.sdo_id = sdo_tbl.sdo_id
                    WHERE sdo_tbl.sdo_id = '$c_sdo_id'
                    GROUP BY sdo_tbl.sdo_id, sdo_tbl.sdo_fname, sdo_tbl.sdo_mname, sdo_tbl.sdo_lname, ca_tbl.amount_ca");

while ($f_query = $query->fetch_array()) {
    // Format amounts in peso format
  // Format amounts with currency code
$funds_allocated = 'PHP ' . number_format($f_query['amount_ca'], 2);
$outstanding_balance = 'PHP ' . number_format($f_query['result'], 2);
$utilized_amount = 'PHP ' . number_format($f_query['amount_ca'] - $f_query['result'], 2);

    // Write data rows to CSV
    fputcsv($output, [
        $f_query['sdo_id'],
        $f_query['sdo_fname'] . " " . $f_query['sdo_mname'] . " " . $f_query['sdo_lname'],
        $funds_allocated,
        $outstanding_balance,
        $utilized_amount
    ]);
}

// Close the output stream
fclose($output);

// Terminate the script
exit;

?>