<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加课程</title>
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
<form class="layui-form layui-row layui-col-space10" id='addCourseform'>
	<div class="layui-col-md9 layui-col-xs12">
		<div class="layui-card">
			<div class="layui-card-body">
				<div class="layui-row layui-col-space10">
					<div class="layui-col-md9">
						<div class="layui-form-item magt3">
							<label class="layui-form-label">课程号</label>
							<div class="layui-input-block">
								<input type="text" class="layui-input layui-disabled" disabled value="<?php echo $course_id ?>" name="course_id" id="course_id" lay-verify="required" placeholder="请输入课程号">
							</div>
						</div>
						<div class="layui-form-item magt3">
							<label class="layui-form-label">课程名</label>
							<div class="layui-input-block">
								<input type="text" class="layui-input" value="<?php echo $course_name ?>" name="course_name" lay-verify="required" placeholder="请输入课程名">
							</div>
						</div>
					</div>
					<!-- <div class="layui-col-md3 layui-col-xs5">
						<div class="layui-upload-list thumbBox mag0 magt3">
							<p class="msg">上传图片</p>
							<img class="layui-upload-img thumbImg">
						</div>
						<input type="hidden" class="ListAction">
						<input type="hidden" class="isupload" value="">
						<input type="hidden" name="thumbnail" id="thumbnail" value="">
					</div> -->
				</div>
				<div class="layui-form-item magb0">
					<label class="layui-form-label">课程简介</label>
					<div class="layui-input-block">
						<textarea class="layui-textarea layui-hide" name="course_info" lay-verify="course_info" id="course_info"><?php echo $course_info; ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="layui-col-md3 layui-col-xs12">
		<div class="layui-card">
			<div class="layui-card-header">
				<i class="layui-icon">&#xe609;</i> 发布
			</div>
			<div class="layui-card-body">
				<div class="border">
					<div class="layui-form-item magt3">
						<label class="layui-form-label"><i class="layui-icon layui-icon-rate"></i> 课程学分</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" value="<?php echo $course_credit ?>" name="course_credit" lay-verify="required" placeholder="请输入课程学分">
						</div>
					</div>
					<div class="layui-form-item magt3">
						<label class="layui-form-label"><i class="layui-icon layui-icon-date"></i> 理论课时</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" value="<?php echo $course_theoryhour ?>" name="course_theoryhour" lay-verify="required" placeholder="请输入理论课时">
						</div>
					</div>
					<div class="layui-form-item magt3">
						<label class="layui-form-label"><i class="layui-icon layui-icon-layer"></i> 实践课时</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" value="<?php echo $course_practicehour ?>" name="course_practicehour" lay-verify="required" placeholder="请输入实践课时">
						</div>
					</div>
					<div class="layui-form-item magt3">
						<label class="layui-form-label"><i class="layui-icon layui-icon-search"></i> 考核方式</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" value="<?php echo $course_testtype ?>" name="course_testtype" lay-verify="required" placeholder="请输入考核方式">
						</div>
					</div>
					<div class="layui-form-item magt3">
						<label class="layui-form-label"><i class="layui-icon layui-icon-search"></i> 课余量</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" value="<?php echo $course_remain ?>" name="course_remain" lay-verify="required" placeholder="请输入课余量">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label"><i class="layui-icon layui-icon-username"></i> 授课教师</label>
						<div class="layui-input-block teacher_block"></div>
					</div>
					<hr class="layui-bg-gray" />
					<div class="layui-right">
						<a class="layui-btn layui-btn-sm" id="addCourse" lay-filter="addCourse" lay-submit><i class="layui-icon">&#xe609;</i>修改</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="/public/layui2/layui.js"></script>
<script type="text/javascript" src="/public/js/course/courseEdit.js"></script>
<script type="text/javascript" src="/public/js/jquery-2.1.4.min.js"></script>
</body>
</html>