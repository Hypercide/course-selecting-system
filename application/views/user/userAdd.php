<?php
	require('../../connect.php');
	header("Content-type: text/html; charset=utf-8");
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);
	$email = $_POST['email'];
	$level = $_POST['level'];
	$profilephoto = $_POST['profilephoto'];
	$array = ['digit'=>1];
    $sql="insert into user set 	username='{$username}',
    							password='{$password}',
    							email='{$email}',
    							level='{$level}',
    							profilephoto='{$profilephoto}'";
	if($pdo->exec($sql))
	{
		echo json_encode($array);
	}
	else{
		$array = ['digit'=>2];
		echo json_encode($array);
	}
	
 ?>