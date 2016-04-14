<?php
	$hostname = "127.0.0.1";
	$username = "root";
	$password = "12345678";
	$connection = mysql_connect($hostname, $username, $password)
		or die("Could not open connection to database");
	mysql_select_db("website", $connection) or die("Could not select database");
?>