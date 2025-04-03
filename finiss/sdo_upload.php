<?php
// Database connection
require_once 'conn.php';


// if (!$conn) {
//     die("Database connection failed: " . mysqli_connect_error());
// }

// Image upload and database insertion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
    $sdo_id = $_POST['sdo_id'];
    $imageCount = count($_FILES["images"]["name"]);

    for ($i = 0; $i < $imageCount; $i++) {
        $filename = $_FILES["images"]["name"][$i];
        $tempname = $_FILES["images"]["tmp_name"][$i];
        $folder = "sdo_upload/";

        // Move uploaded image to the "upload" folder
        move_uploaded_file($tempname, $folder.$filename);

        // Insert image details into the database
        $sql = "INSERT INTO sdo_img (sdo_id,filename, filepath) VALUES ('$sdo_id','$filename', '$folder$filename')";
        mysqli_query($conn, $sql);
    }

    echo "Images uploaded successfully!";
    header("Location: sdo.php");
    exit(); // Make sure to exit after the redirect
}
?>
