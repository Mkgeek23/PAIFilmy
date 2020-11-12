<?php

	$servername = "sql107.epizy.com";
	$dbname = "epiz_27145850_pai";
	$username = "epiz_27145850";
	$password = "h5H1JjXasqOSum";


	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}

	mysqli_set_charset($conn, "utf8");

	error_reporting(E_ALL ^ E_NOTICE);
	
	$pepper = "c1isvFdxMDdmjOlvxpecFw"; //ziarno do haszowania

	require_once("func.php");

?>