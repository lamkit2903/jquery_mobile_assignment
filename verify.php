<?php
include 'databaseconnect.php';

$method = $_SERVER["REQUEST_METHOD"];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

$num_row="";

switch ($method) {
  case 'GET':
	$username = $_GET['userid'];
	$pwd = $_GET['password'];
    $sql = "select * from userinfo;"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
			if ($username == $row['userid'] && $pwd == $row['password']) {
				$num_row = $row['id'];
				break;
			} else {
				$num_row = "";
			}
		}
	break;
  case 'PUT':
	parse_str(file_get_contents("php://input"),$post_vars);
	$username = $post_vars['userid'];
	$pwd = $post_vars['password'];
    $sql = "update userinfo set password = '$pwd' where userid = '$username';";
	$result = mysql_query($sql);
	$num_row = $result;
	break;
  case 'POST':
	$username = $_POST['userid'];
	$pwd = $_POST['password'];
	$email = $_POST['email'];
    $sql = "insert into userinfo (userid, password, email) VALUES('$username', '$pwd', '$email');";
	$result = mysql_query($sql);
	$saveid = 0;
	$sql = "select * from userinfo;"; 
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)){
			if ($username == $row['userid']) {
				$saveid = $row['id'];
				break;
			}
		}
	$sql = "insert into favourite (list_by) VALUES('$saveid');";
	$result = mysql_query($sql);
	$num_row = $result;
	break;
  case 'DELETE':
	parse_str(file_get_contents("php://input"),$_SERVER);
	$username = $_SERVER['userid'];
    $sql = "delete from userinfo where userid = '$username';";
	$result = mysql_query($sql);
	if ($result) {
		$num_row = 1;
	}
	else {
		$num_row = 0;
	}
	break;
}

echo $num_row;

?>