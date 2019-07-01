layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery;

    var regpwd=/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_.]{6,16}$/ /*匹配6~12个字符、必须同时包括字母和数字的密码*/


    $("#oldpwd").blur(function(){
        if ($("#oldpwd").val()=="") {
            layer.msg('请输入旧密码噢',{time: 1000});
            $("#oldpwd").addClass("warning");
        }else{
            $.ajax({
                type:"POST",
                url:"http://course.cn/User/oldpwd_check/" + $("#oldpwd").val(),
                dataType:"json",
                success: function(msg){
                    // var temp = JSON.stringify(msg);
                    if(msg.digit==2)
                    {
                        $("#oldpwd").addClass("warning");
                        layer.msg('旧密码错误',{time: 1000});
                        form.render();
                    }
                    else
                    {
                        $("#oldpwd").removeClass("warning");
                        form.render();
                    }
                }
            });
        }
    });

    $("#newpwd").blur(function(){
        if ($("#newpwd").val()=="") {
            layer.msg('请输入你的密码噢',{time: 1000});
            $("#newpwd").addClass("warning");
        }else{
            if (!regpwd.test($("#newpwd").val())) {
                layer.msg('请输入6-16位的包含数字和字母的密码',{time: 1400});
                $("#newpwd").addClass("warning");
            }else{
                $("#newpwd").removeClass("warning");
                form.render();
            }
        }
    });

    $("#repwd").blur(function(){
        if ($("#repwd").val()=="") {
            layer.msg('请输入确认密码噢',{time: 1000});
            $("#repwd").addClass("warning");
        }else{
            if (!($("#repwd").val()==$("#newpwd").val())) {
                layer.msg('两次密码不一致喔',{time: 1000});
                $("#repwd").addClass("warning");
            }else{
                $("#repwd").removeClass("warning");
                form.render();
            }
        }
    });

    form.on('submit(changePwd)', function(obj){
        $("#changepwd-btn").text("修改中...").prop("disabled", true).addClass("layui-disabled");

        if ($("#course_id").hasClass("warning")) {
            layer.msg('旧密码错误',{time: 1000});
            $("#changepwd-btn").text("立即修改").prop("disabled", false).removeClass("layui-disabled");
            return false;
        }
        if ($("#newpwd").hasClass("warning")) {
            layer.msg('请输入6-16位的包含数字和字母的密码',{time: 1000});
            $("#changepwd-btn").text("立即修改").prop("disabled", false).removeClass("layui-disabled");
            return false;
        }
        if ($("#repwd").hasClass("warning")) {
            layer.msg('两次密码不一致喔',{time: 1000});
            $("#changepwd-btn").text("立即修改").prop("disabled", false).removeClass("layui-disabled");
            return false;
        }
        var temp=$("#changePwd").serialize();
        console.log(temp);

        $.ajax({
            type:"POST",
            url:"http://course.cn/user/changepwd_check",
            data:temp,
            dataType:"json",
            success: function(msg){
                // var temp = JSON.stringify(msg);
                if(msg.digit==1)
                {
                    // top.layer.close(index);
                    top.layer.msg("课程添加成功！");
                    layer.closeAll("iframe");
                    //刷新父页面
                    parent.location.reload();
                }
                else
                {
                    top.layer.msg("课程已存在！");
                    $("#changepwd-btn").text("立即修改").prop("disabled", false).removeClass("layui-disabled");
                }
            }
        });
        return false;
    });

    

})