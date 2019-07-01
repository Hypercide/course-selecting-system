<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dedsec后台管理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/public/layui2/css/layui.css">
	<link rel="stylesheet" href="/public/css/layuiadmin.css" media="all" />
	<!-- <link rel="stylesheet" href="/public/css/public.css" media="all" /> -->
	<script type="text/javascript" src="/public/echarts/echarts.js"></script>
	<script type="text/javascript" src="/public/echarts/echartsTheme.js"></script>
</head>
<body class="childrenBody">
	<div class="layui-fluid">
		<div class="layui-card">
			<div class="layui-card-body">
				<div style="float: left;"><?php echo $_SESSION['username']; ?>，</div>
				<div id="nowTime"></div><div style="clear: both;"></div>
			</div>
		</div>
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md8">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md6">
					<div class="layui-card">
						<div class="layui-card-header">
							快捷方式
						</div>
						<div class="layui-card-body">
							<div class="layui-carousel layadmin-carousel layadmin-shortcut">
								<div carousel-item>
									<ul class="layui-row layui-col-space10">
										<li class="layui-col-xs3">
											<a class="main_a" href="javascript:;" data-url="<?php echo site_url("Homepage/course") ?>">
												<i class="layui-icon layui-icon-console"></i>
												<cite>课程列表</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a class="main_a" href="javascript:;" data-url="<?php echo site_url("Homepage/user") ?>">
												<i class="layui-icon layui-icon-username"></i>
												<cite>用户中心</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
									</ul>
									<ul class="layui-row layui-col-space10">
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
										<li class="layui-col-xs3">
											<a lay-href="">
												<i class="layui-icon layui-icon-set"></i>
												<cite>占位</cite>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="layui-col-md6">
					<div class="layui-card">
						<div class="layui-card-header">
							统计信息
						</div>
						<div class="layui-card-body">
							<div class="layui-carousel layadmin-carousel layadmin-backlog">
								<div carousel-item>
									<ul class="layui-row layui-col-space10">
										<li class="layui-col-xs6">
											<a href="javascript:;" data-url="<?php echo site_url("Homepage/course") ?>" class="main_a layadmin-backlog-body">
												<cite>课程列表</cite>
												<h3>课程数量</h3>
												<p>
													<span class="course_count"></span>
												</p>
											</a>
										</li>
										<li class="layui-col-xs6">
											<a href="javascript:;" data-url="<?php echo site_url("Homepage/user") ?>" class="main_a layadmin-backlog-body">
												<cite>用户中心</cite>
												<h3>用户数量</h3>
												<p>
													<span class="user_count"></span>
												</p>
											</a>
										</li>
										<li class="layui-col-xs6">
											<a lay-href="template/goodslist.html" class="layadmin-backlog-body">
												<cite></cite>
												<h3>占位</h3>
												<p>
													<span>99</span>
												</p>
											</a>
										</li>
										<li class="layui-col-xs6">
											<a href="javascript:;" onclick="layer.tips('不跳转', this, {tips: 3});" class="layadmin-backlog-body">
												<cite></cite>
												<h3>占位</h3>
												<p>
													<span>20</span>
												</p>
											</a>
										</li>
									</ul>
									<ul class="layui-row layui-col-space10">
										<li class="layui-col-xs6">
											<a href="javascript:;" class="layadmin-backlog-body">
												<cite></cite>
												<h3>占位</h3>
												<p>
													<span style="color: #FF5722;">5</span>
												</p>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-header">
							数据概览
						</div>
						<div id="test" style="width: 100%;height: 260px;"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="layui-col-md4">
			<div class="layui-card">
				<div class="layui-card-header">
					版本信息
				</div>
				<div class="layui-card-body layui-text">
					<table class="layui-table">
					<colgroup>
					<col width="100">
					<col>
					</colgroup>
					<tbody>
					<tr>
						<td>
							当前版本
						</td>
						<td>
							v1.0.0
							<!-- <script type="text/html" template>
		                      	v{{ layui.admin.v }}
		                      	<a href="http://fly.layui.com/docs/3/" target="_blank" style="padding-left: 15px;">更新日志</a>
		                    </script> -->
						</td>
					</tr>
					<tr>
						<td>
							基于框架
						</td>
						<td>
							layui-v2.x
							<!-- <script type="text/html" template>
		                      	layui-v{{ layui.v }}
		                    </script> -->
						</td>
					</tr>
					<tr>
						<td>
							主要特色
						</td>
						<td>
							零门槛 / 响应式 / 清爽 / 极简
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class="layui-card">
				<div class="layui-card-header">
					开发动态
				</div>
				<div class="layui-card-body">
					<div class="layui-carousel layadmin-carousel layadmin-news" data-autoplay="true" data-anim="fade" lay-filter="news">
						<div carousel-item>
							<div>
								<a href="http://www.dedsec.top" target="_blank" class="layui-bg-red">DedsecAdmin</a>
							</div>
							<div>
								<a href="http://www.dedsec.top" target="_blank" class="layui-bg-green">第一个版本</a>
							</div>
							<div>
								<a href="http://www.dedsec.top" target="_blank" class="layui-bg-blue">一切　敬请期待！</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript" src="/public/layui2/layui.js"></script>
	<script type="text/javascript" src="/public/js/main.js"></script>
	<!-- <script type="text/javascript" src="/public/js/layuiEcharts.js"></script> -->
</body>
</html>