<?php
	require('../../connect.php');
	header("Content-type: text/html; charset=utf-8");
	$news_title = $_POST['news_title'];
	$news_keyword = $_POST['news_keyword'];
	$news_thumbnail = $_POST['thumbnail'];
	$news_content = $_POST['news_content'];
	$news_type = $_POST['category_id'];
	$news_top = (isset($_POST['news_top'])) ? "checked" : "";
	$news_addtime=time();
	$array = ['digit'=>1];
    $sql="insert into news set 	news_title='{$news_title}',
    							news_keyword='{$news_keyword}',
    							news_thumbnail='{$news_thumbnail}',
    							news_content='{$news_content}',
    							news_type='{$news_type}',
    							news_top='{$news_top}',
    							news_addtime='{$news_addtime}'";
	if($pdo->exec($sql))
	{
		echo json_encode($array);
	}
	else{
		$array = ['digit'=>2];
		echo json_encode($array);
	}
	
 ?>