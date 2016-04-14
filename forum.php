<?php
include 'databaseconnect.php';

$method = $_SERVER["REQUEST_METHOD"];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

$num_row="";

switch ($method) {
  case 'GET':
	
	break;
  case 'PUT':
	break;
  case 'POST':
	$tpsub = $_POST['topic'];
	$tpautor = $_POST['userid'];
	$firstcontent = $_POST['content'];
	$tpid = "";
	$sql = "insert into topics (topic_subject, topic_date, topic_by) VALUES('$tpsub', NOW(), '$tpautor');";
	$result = mysql_query($sql);
	$sql = "select * from topics where topic_by = '$tpautor';"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
		$tpid = $row['topic_id'];
	}
	$sql = "insert into replies (reply_content, reply_date, reply_topic, reply_by) VALUES('$firstcontent', NOW(), '$tpid', '$tpautor');";
	$result = mysql_query($sql);
	$num_row = $result;
	break;
  case 'DELETE':
	parse_str(file_get_contents("php://input"),$_SERVER);
	$topicid = $_SERVER['topicid'];
	$replyid = $_SERVER['replyid'];
	if ($topicid != 0) {
		$sql = "delete from replies where reply_topic = '$topicid';";
		$result = mysql_query($sql);
		if ($result) {
			$num_row = 1;
		}
		else {
			$num_row = 0;
		}
		$sql = "delete from topics where topic_id = '$topicid';";
		$result = mysql_query($sql);
		if ($result) {
			$num_row = 2;
		}
		else {
			$num_row = 0;
		}
	}
	if ($replyid != 0) {
		$sql = "delete from replies where reply_id = '$replyid';";
		$result = mysql_query($sql);
		if ($result) {
			$num_row = 1;
		}
		else {
			$num_row = 0;
		}
	}
	break;
}

echo $num_row;

?>