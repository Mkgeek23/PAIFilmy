<?php

	$servername = "localhost";
	$dbname = "pai";
	$username = "root";
	$password = "";


	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}

	mysqli_set_charset($conn, "utf8");

	error_reporting(E_ALL ^ E_NOTICE);
	
	$pepper = "c1isvFdxMDdmjOlvxpecFw"; //ziarno do haszowania

	require_once("func.php");

?>