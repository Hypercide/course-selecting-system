<?php 
	require('../../connect.php');

	$delID = $_GET['userId'];	//得到一个id数组
	$id = 0;				//避开字符串最后的连接符号
	foreach ($delID as $value) {
		$id .= ",".$value;
	}

	$sql = "delete from user where id in ($id)";
	$pdo->exec($sql);
 ?>