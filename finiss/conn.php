<?php
	$conn = new mysqli('localhost', 'root', '', 'smsi');
	if(!$conn){
		die('Could not Connect to Database' . $conn->mysqli_error );
	}