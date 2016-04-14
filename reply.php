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
	$rptopic = $_POST['replytopic'];
	$rpautor = $_POST['userid'];
	$rpmessage = $_POST['message'];
	$sql = "insert into replies (reply_content, reply_date, reply_topic, reply_by) VALUES('$rpmessage', NOW(), '$rptopic', '$rpautor');";
	$result = mysql_query($sql);
	$num_row = $result;
	break;
  case 'DELETE':
	break;
}

echo $num_row;

?>