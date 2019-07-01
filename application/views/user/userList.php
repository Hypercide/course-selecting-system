<?php 
	require('../../connect.php');

	$pdo->query('set names utf8');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $sql = "select count(id) from user";
	$rs = $pdo->query($sql);
	$result = $rs->fetch(PDO::FETCH_ASSOC);
	$count = $result['count(id)'];

	$page_num = isset($_GET['limit'])?$_GET['limit']:10;	//接收limit，每页显示多少条数据
	$pages = ceil($count/$page_num);				  		//总页数，向上取整
	$page = isset($_GET['page'])?$_GET['page']:1;			//当前页数
	$startpos = ($page - 1)*$page_num;

	$sql = "select id,username,email,level,lastlogintime,profilephoto from user order by id asc limit $startpos,$page_num";
	$rs = $pdo->query($sql);
	$result = $rs->fetchall(PDO::FETCH_ASSOC);


	$data = array(
		"code" => 0,
		"msg" => "",
		"count" => $count,
		"data" => $result
	);


    echo json_encode($data);

 ?>