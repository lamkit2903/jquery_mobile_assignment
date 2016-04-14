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
	parse_str(file_get_contents("php://input"),$post_vars);
	$userid = $post_vars['userid'];
	$num = $post_vars['num'];
	$list = $post_vars['list'];
    $sql = "update favourite set list_$num = '$list' where list_by = '$userid';";
	$result = mysql_query($sql);
	$num_row = $result;
	break;
  case 'POST':
	break;
  case 'DELETE':
	break;
}

echo $num_row;

?>