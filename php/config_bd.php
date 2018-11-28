<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Pizzeria";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	
	// Check connection
	if (!$conn) {
	    die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
	}
	
?>
