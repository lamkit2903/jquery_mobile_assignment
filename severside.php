<?php
include 'ab.php';

$method = $_SERVER["REQUEST_METHOD"];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

$num_row="";

switch ($method) {
  case 'GET':
  case 'PUT':
  case 'POST':
	$username = $_POST['userid'];
	$pwd = $_POST['password'];
    $sql = "insert into users (userid, password) VALUES('$username', '$pwd');";
	$result = mysql_query($sql);
	$num_row = $result;
	break;
  case 'DELETE':
	break;
}

echo $num_row;

?>