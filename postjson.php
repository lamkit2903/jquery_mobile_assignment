<?php
include 'databaseconnect.php';

/* set out document type to text/javascript instead of text/html */
header("Content-type: text/javascript");

/* our multidimentional php array to pass back to javascript via ajax */

$userPost = $_GET['userpost'];

$arr = array();

if ($userPost != null) {
	$sql = "select * from topics, userinfo where id = topic_by and topic_by = '$userPost';"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
		$newarr = array(
					"topic_id" => $row['topic_id'],
					"topic_sub" => $row['topic_subject'],
					"topic_date" => $row['topic_date'],
					"topic_by" => $row['userid']
				);
	array_push($arr, $newarr);
	}
}

else {
	$sql = "select * from topics, userinfo where id = topic_by;"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
		$newarr = array(
					"topic_id" => $row['topic_id'],
					"topic_sub" => $row['topic_subject'],
					"topic_date" => $row['topic_date'],
					"topic_by" => $row['userid']
				);
	array_push($arr, $newarr);
	}
}

/* encode the array as json. this will output [{"first_name":"Darian","last_name":"Brown","age":"28","email":"darianbr@example.com"},{"first_name":"John","last_name":"Doe","age":"47","email":"john_doe@example.com"}] */
echo json_encode($arr);
?>