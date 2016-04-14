<?php
include 'databaseconnect.php';

/* set out document type to text/javascript instead of text/html */
header("Content-type: text/javascript");

/* our multidimentional php array to pass back to javascript via ajax */
$arr = array();

$userid = $_GET['userid'];

	$sql = "select * from favourite where list_by = '$userid';"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
			$lista = "list_1";
			$listb = "list_2";
			$listc = "list_3";
			$listd = "list_4";
			$liste = "list_5";
			$listf = "list_6";
			$listg = "list_7";
			$listh = "list_8";
			$newarr = array(
				"lista" => $row[$lista],
				"listb" => $row[$listb],
				"listc" => $row[$listc],
				"listd" => $row[$listd],
				"liste" => $row[$liste],
				"listf" => $row[$listf],
				"listg" => $row[$listg],
				"listh" => $row[$listh],
			);
			array_push($arr, $newarr);
	}

/* encode the array as json. this will output [{"first_name":"Darian","last_name":"Brown","age":"28","email":"darianbr@example.com"},{"first_name":"John","last_name":"Doe","age":"47","email":"john_doe@example.com"}] */
echo json_encode($arr);
?>