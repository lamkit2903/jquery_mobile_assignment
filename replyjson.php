<?php
include 'databaseconnect.php';

/* set out document type to text/javascript instead of text/html */
header("Content-type: text/javascript");

/* our multidimentional php array to pass back to javascript via ajax */
$replytopic = $_GET['topicid'];
$userReply = $_GET['userReply'];

$arr = array();

if ($userReply != null) {
	$sql = "select * from userinfo, topics, replies where reply_topic = topic_id and reply_by = id and reply_by = '$userReply';"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
		$newarr = array(
			"reply_id" => $row['reply_id'],
			"reply_content" => $row['reply_content'],
			"reply_date" => $row['reply_date'],
			"reply_topic" => $row['reply_topic'],
			"reply_by" => $row['userid']
		);
		array_push($arr, $newarr);
	}
}
else {
	$sql = "select * from userinfo, topics, replies where reply_topic = '$replytopic' and reply_topic = topic_id and reply_by = id;"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
		$newarr = array(
			"reply_id" => $row['reply_id'],
			"reply_content" => $row['reply_content'],
			"reply_date" => $row['reply_date'],
			"reply_topic" => $row['reply_topic'],
			"reply_by" => $row['userid']
		);
		array_push($arr, $newarr);
	}
}

/* encode the array as json. this will output [{"first_name":"Darian","last_name":"Brown","age":"28","email":"darianbr@example.com"},{"first_name":"John","last_name":"Doe","age":"47","email":"john_doe@example.com"}] */
echo json_encode($arr);
?>