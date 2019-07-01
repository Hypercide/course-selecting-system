<?php
	$id=$_GET['id'];

	require('../../connect.php');

	$sql = "select profilephoto from user where id={$id}";
	$rs = $pdo->query($sql);
	$result = $rs->fetch(PDO::FETCH_ASSOC);
	if ($result['profilephoto']!="default.jpg") {
		$filename = "../../images/" . $result['profilephoto'];
		unlink($filename);
	}
	
	$sql = "delete from user where id={$id}";
	$pdo->exec($sql);
?>