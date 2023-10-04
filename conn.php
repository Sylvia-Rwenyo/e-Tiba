<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "CERA";

	// Create a connection
	$conn = mysqli_connect($servername,
		$username, $password, $database);

	if(!$conn) {
		die("Error". mysqli_connect_error());
	}
	$SECRETKEY = "CeraPass@123456";
?>
