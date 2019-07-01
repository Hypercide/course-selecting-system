<?php 
	require('../../connect.php');

    $pdo->query('set names utf8');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $sql = "select count(news_id) from news";
	$rs = $pdo->query($sql);
	$result = $rs->fetch(PDO::FETCH_ASSOC);
	$count = $result['count(news_id)'];

	$page_num = isset($_GET['limit'])?$_GET['limit']:10;	//接收limit，每页显示多少条数据
	$pages = ceil($count/$page_num);				  		//总页数，向上取整
	$page = isset($_GET['page'])?$_GET['page']:1;			//当前页数
	$startpos = ($page - 1)*$page_num;

	$sql = "select news_id,news_title,news_keyword,news_type,news_top,news_addtime from news order by news_id asc limit $startpos,$page_num";
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