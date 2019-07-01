<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>个人资料</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/public/layui2/css/layui.css" media="all" />
	<link rel="stylesheet" href="/public/css/public.css" media="all" />
</head>
<body class="childrenBody">
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md8">
				<div class="layui-row layui-col-space15">
					<div class="layui-col-md12">
						<div class="layui-card">
							<div class="layui-card-header card-top">
								<form class="layui-form">
									已选列表　　　　
									<div class="layui-inline">
										<div class="layui-input-inline">
											<input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" />
										</div>
										<a class="layui-btn search_btn layui-btn-normal" data-type="reload">搜索</a>
									</div>
									<div class="layui-inline">
										<a class="layui-btn layui-btn-bright refresh_btn">刷新一下</a>
									</div>
								</form>
							</div>
							<div class="layui-card-body">
								<table id="courseList" lay-filter="courseList"></table>
							</div>
						</div>
						<script type="text/html" id="courseListBar">
							<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">强制退课</a>
						</script>
					</div>
				</div>
			</div>
			<div class="layui-col-md4">
				<div class="layui-card">
					<div class="layui-card-header">学生信息</div>
					<div class="layui-card-body layui-text">
						<table class="layui-table studentinfo">
							<colgroup><col width="70"><col></colgroup>
							<tbody>
								<tr>
									<th>学号</th>
									<td id="s_id"><?php echo $s_id;?></td>
								</tr>
								<tr>
									<th>姓名</th>
									<td><?php echo $username;?></td>
								</tr>
								<tr>
									<th>性别</th>
									<td><?php echo $sex;?></td>
								</tr>
								<tr>
									<th>电话</th>
									<td><?php echo $tel;?></td>
								</tr>
								<tr>
									<th>邮箱</th>
									<td><?php echo $email;?></td>
								</tr>
								<tr>
									<th>专业</th>
									<td><?php if ($major=="1") {
										echo "软件工程";
									}else if ($major=="2") {
										echo "嵌入式";
									}else if ($major=="3") {
										echo "数字媒体技术";
									}?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="/public/js/datechange.js"></script>
<script type="text/javascript" src="/public/layui2/layui.js"></script>
<script type="text/javascript" src="/public/js/user/userInfo.js"></script>
</body>
</html>