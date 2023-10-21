<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "e-Tiba";

	// Create a connection
	$conn = mysqli_connect($servername,
		$username, $password, $database);

	if(!$conn) {
		die("Error". mysqli_connect_error());
	}
	$SECRETKEY = "e-TibaPass@123456";
?>
