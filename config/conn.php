<?php 

	$host = "localhost";
	$user = "u367303683_root";
	$passw = "batatafrita32";
	$db = "u367303683_banan";

	$conn = new mysqli($host, $user, $passw, $db);

	if ($conn->connect_error) {
	    die('Connect Error (' . $conn->connect_errno . ') '
	            . $conn->connect_error);
	}

 ?>