<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加用户</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/public/layui2/css/layui.css" media="all" />
	<link rel="stylesheet" href="/public/css/user.css" media="all" />
</head>
<body class="childrenBody">
	<div class="layui-card">
		<div class="layui-card-body">
			<form class="layui-form" method="post" id="addUserform">
				<div class="user_left">
					<div class="layui-form-item">
						<label class="layui-form-label">学号</label>
						<div class="layui-input-block">
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="text" name="s_id" value="<?php echo $s_id ?>" id="s_id" disabled class="layui-input s_id layui-disabled" lay-verify="required" placeholder="请输入学号">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">姓名</label>
						<div class="layui-input-block">
							<input type="text" name="username" value="<?php echo $username ?>" class="layui-input userame" lay-verify="required" placeholder="请输入姓名">
						</div>
					</div>
					<div class="layui-form-item">
					    <label class="layui-form-label">密码</label>
					    <div class="layui-input-block">
					    	<input type="password" name="password" disabled value="<?php echo $password ?>" placeholder="" lay-verify="required" class="layui-input pwd layui-disabled">
					    </div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">性别</label>
						<div class="layui-input-block">
							<input type="radio" name="sex" value="男" title="男" class="radio_male">
							<input type="radio" name="sex" value="女" title="女" class="radio_female"> 
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">电话</label>
						<div class="layui-input-block">
							<input type="text" name="tel" value="<?php echo $tel ?>" class="layui-input" lay-verify="" placeholder="请输入电话号码">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">邮箱</label>
						<div class="layui-input-block">
							<input type="text" name="email" value="<?php echo $email ?>" class="layui-input userEmail" lay-verify="" placeholder="请输入邮箱">
						</div>
					</div>
					<div class="layui-form-item">
					    <div class="layui-inline">
						    <label class="layui-form-label">专业</label>
							<div class="layui-input-block major_block">
							</div>
					    </div>
					</div>
				</div>
				<div class="user_right">
					<button type="button" class="layui-btn" id="photo">
						<i class="layui-icon">&#xe67c;</i>上传头像
					</button>
				    <div class="layui-upload-list">
				    	<p><br></p>
				        <img class="layui-upload-img layui-circle" id="demo1" src="<?php echo '/public/images/'.$profilephoto ?>">
				    </div>
				    <input type="hidden" class="testListAction">
					<input type="hidden" class="isupload" value="">
			  		<input type="hidden" name="profilephoto" id="profilephoto" value="default.jpg">
				</div>
				<div class="layui-form-item" style="margin-left: 5%;">
				    <div class="layui-input-block">
				    	<button type="button" class="layui-btn reg">立即修改</button>
				    	<input type="hidden" class="savereg">
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				    </div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="/public/layui2/layui.js"></script>
	<script type="text/javascript" src="/public/js/user/userEdit.js"></script>
	<script type="text/javascript" src="/public/js/jquery-2.1.4.min.js"></script>
</body>
</html>