<?php

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db 	 = "offstreams";
	
	$conn = new mysqli($host, $user, $pass, $db);
	
	// Remove printf on actual server
	if (mysqli_connect_errno()) {
		printf("Connection failed %s\n", mysqli_connect_error());
		
		// Location to error page
		header("Location: error.php");
		exit;
	}

?>