<?php 

        
include_once 'conn.php';

$select_query = mysqli_query($conn, "SELECT sdo.sdo_id, ce.date_assess, ca.ors_num, ca.dv_num, ce.ben_fname, ce.ben_mname, ce.ben_lname, ca.uacs_object_num, ce.toa, sdo.sdo_fname, sdo.sdo_mname, sdo.sdo_lname, ce.amount FROM sdo_tbl as sdo INNER JOIN ca_tbl as ca ON ca.sdo_id = sdo.sdo_id INNER JOIN ce_tbl AS ce ON ce.ca_id = ca.ca_id WHERE sdo.sdo_id = {$_REQUEST['sdo_id']}");

// Create a UTF-8 encoded CSV file with a BOM
$csv_file = fopen('php://output', 'w');
fprintf($csv_file, "\xEF\xBB\xBF"); // Add BOM to indicate UTF-8 encoding

// Define the header row for the CSV file
$header = array(
    'id',
    'Date',
    'DV/ PAYROLL NO.',
    'ORS/BURS NO.',
    'Payee',
    'UACS OBJECT CODE',
    'Nature of Payment',
    'SDO',
    'SDO Amount'
);

// Write the header row to the CSV file
fputcsv($csv_file, $header);

// Fetch and write data rows to the CSV file
while ($data = mysqli_fetch_array($select_query)) {
    // Format the amount as currency (Peso)
    $formatted_amount = '₱ ' . number_format($data['amount'], 2);

    // Create an array for the data row
    $row = array(
        $data['sdo_id'],
        $data['date_assess'],
        $data['dv_num'],
        $data['ors_num'],
        $data['ben_fname'] . ' ' . $data['ben_mname'] . ' ' . $data['ben_lname'],
        $data['uacs_object_num'],
        $data['toa'],
        $data['sdo_fname'] . ' ' . $data['sdo_mname'] . ' ' . $data['sdo_lname'],
        $formatted_amount // Formatted as currency
    );

    // Write the data row to the CSV file
    fputcsv($csv_file, $row);
}

// Set the appropriate headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=data.csv');

// Output the generated CSV file
fclose($csv_file);   
?>