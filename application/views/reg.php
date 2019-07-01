<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>注册 - DedsecAdmin</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<script src="/public/layui2/layui.js"></script>
<link rel="stylesheet" href="/public/css/reg.css" media="all">
<link rel="stylesheet" href="/public/layui2/css/layui.css" media="all" />
</head>
<body>
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>DedsecAdmin</h2>
            <p>
                Dedsec在线选课系统
            </p>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-note" for="LAY-user-login-s_id"></label>
                <input type="text" name="s_id" id="LAY-user-login-s_id" lay-verify="required" placeholder="学号" class="layui-input">
                <span class="spantip s_idspan">学号已被注册</span>
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-user" for="LAY-user-login-username"></label>
                <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="姓名" class="layui-input">
                <span class="spantip usernamespan"></span>
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="pass" placeholder="密码" class="layui-input">
                <span class="spantip passwordspan">密码格式不对噢</span>
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-repass"></label>
                <input type="password" id="LAY-user-login-repass" lay-verify="required" placeholder="确认密码" class="layui-input">
                <span class="spantip repassspan">两次密码不一致</span>
            </div>
            <!-- <div class="layui-form-item">
                <input type="checkbox" name="agreement" lay-skin="primary" title="同意用户协议" checked>
            </div> -->
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-reg-submit">注 册</button>
            </div>
            <div class="layui-trans layui-form-item layadmin-user-login-other">
                <!-- <label>社交账号注册</label>
                <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
                <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
                <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a> -->
                <a href="<?php echo site_url("Login/") ?>" class="layadmin-user-jump-change layadmin-link layui-hide-xs">用已有帐号登入</a>
            </div>
        </div>
    </div>
    <div class="layui-trans layadmin-user-login-footer">
        <p>
            © 2018 赣ICP备18010687号
            <a href="http://www.dedsec.top/" target="_blank">dedsec.top</a>
        </p>
    </div>
</div>
<script>
  layui.use(['layer','form'], function(){
    var $ = layui.$
    ,layer = layui.layer
    ,form = layui.form;
    var form = layui.form;
    form.render();

    var regs_id=/^[0-9]{12,12}$/    /*匹配12位的纯数字学号*/
    var regpwd=/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_.]{6,16}$/ /*匹配6~12个字符、必须同时包括字母和数字的密码*/

    $("#LAY-user-login-s_id").blur(function(){
        if ($("#LAY-user-login-s_id").val()=="") {
            layer.msg('请输入你的学号噢',{time: 1000});
            $("#LAY-user-login-s_id").addClass("warning");
        }else{
            if (!regs_id.test($("#LAY-user-login-s_id").val())) {
                $("#LAY-user-login-s_id").addClass("warning");
                $(".s_idspan").text("学号格式不对噢");
                $(".s_idspan").addClass("displayspan");
            }else{
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url("Reg/s_id_check") ?>",
                    data:"s_id=" + $("#LAY-user-login-s_id").val(),
                    dataType:"json",
                    success: function(msg){
                        // var temp = JSON.stringify(msg);
                        if(msg.digit==1)
                        {
                            $("#LAY-user-login-s_id").addClass("warning");
                            $(".s_idspan").text("学号已被注册");
                            $(".s_idspan").addClass("displayspan");
                            form.render();
                        }
                        else
                        {
                            $("#LAY-user-login-s_id").removeClass("warning");
                            $(".s_idspan").html("<i class='layui-icon layui-icon-release'></i>");
                            $(".s_idspan>i").addClass("alreadyright");
                            $(".s_idspan").addClass("displayspan");
                            form.render();
                        }
                    }
                });
            }
        }
    });

    $("#LAY-user-login-username").blur(function(){
        if ($("#LAY-user-login-username").val()=="") {
            layer.msg('请输入用户名噢',{time: 1000});
            $("#LAY-user-login-username").addClass("warning");
            form.render();
        }else{
            $("#LAY-user-login-username").removeClass("warning");
            $(".usernamespan").html("<i class='layui-icon layui-icon-release'></i>");
            $(".usernamespan>i").addClass("alreadyright");
            $(".usernamespan").addClass("displayspan");
            form.render();
        }
    });

    $("#LAY-user-login-password").blur(function(){
        if ($("#LAY-user-login-password").val()=="") {
            layer.msg('请输入你的密码噢',{time: 1000});
            $("#LAY-user-login-password").addClass("warning");
        }else{
            if (!regpwd.test($("#LAY-user-login-password").val())) {
                layer.msg('请输入6-16位的包含数字和字母的密码',{time: 1400});
                $(".passwordspan").text("密码格式不对噢");
                $("#LAY-user-login-password").addClass("warning");
                $(".passwordspan").addClass("displayspan");
            }else{
                $("#LAY-user-login-password").removeClass("warning");
                $(".passwordspan").html("<i class='layui-icon layui-icon-release'></i>");
                $(".passwordspan>i").addClass("alreadyright");
                $(".passwordspan").addClass("displayspan");
                form.render();
            }
        }
    });

    $("#LAY-user-login-repass").blur(function(){
        if ($("#LAY-user-login-repass").val()=="") {
            layer.msg('请输入确认密码噢',{time: 1000});
            $("#LAY-user-login-repass").addClass("warning");
        }else{
            if (!($("#LAY-user-login-repass").val()==$("#LAY-user-login-password").val())) {
                $(".repassspan").text("两次密码不一致");
                $("#LAY-user-login-repass").addClass("warning");
                $(".repassspan").addClass("displayspan");
            }else{
                $("#LAY-user-login-repass").removeClass("warning");
                $(".repassspan").html("<i class='layui-icon layui-icon-release'></i>");
                $(".repassspan>i").addClass("alreadyright");
                $(".repassspan").addClass("displayspan");
                form.render();
            }
        }
    });
        
    //提交
    form.on('submit(LAY-user-reg-submit)', function(obj){
        var field = obj.field;

        if ($(".s_idspan:has(i)").length==0) {      //判断是否通过验证
            $("#LAY-user-login-s_id")[0].focus();
            return false;
        }

        if ($(".usernamespan:has(i)").length==0) {
            $("#LAY-user-login-username")[0].focus();
            return false;
        }

        if ($(".passwordspan:has(i)").length==0) {
            $("#LAY-user-login-password")[0].focus();
            return false;
        }

        if ($(".repassspan:has(i)").length==0) {
            $("#LAY-user-login-repass")[0].focus();
            return false;
        }
        console.log(field);
        $.ajax({
            type:"POST",
            url:"<?php echo site_url("Reg/reg_check") ?>",
            data:field,
            dataType:"json",
            success: function(msg){
                // var temp = JSON.stringify(msg);
                if(msg.digit==1)
                {
                    layer.msg('注册成功', {
                        offset: '15px'
                        ,icon: 1
                        ,time: 1000
                    }, function(){
                        window.location.href="<?php echo site_url("Login/") ?>"; //跳转到登入页
                    });
                }
                else
                {
                    layer.alert("用户名或密码错误");
                    _this.text("登录").prop("disabled", false).removeClass("layui-disabled");
                }
            }
        });
        return false;
    });
  });
  </script>
</body>
</html>