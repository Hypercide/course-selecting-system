layui.use(['form','layer','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.$;


    //获取授课教师下拉
    $.ajax({
        type:"POST",
        url:"http://course.cn/User/getMajorSelect/1",
        dataType:"json",
        success: function(data){
            // var temp = JSON.stringify(data);
            // alert(temp);
            $(".major_block").html(data.data);
            form.render();
        }
    });

    var upload = layui.upload;
        //普通图片上传
        //执行实例
    var uploadInst = upload.render({
        elem: '#photo' //绑定元素
        ,url: 'http://course.cn/User/addimg' //上传接口PHP 接收文件
        ,field:'pics'
        ,auto: false
        ,bindAction:'.testListAction'
        ,accept: 'image'
        ,exts: 'jpg|png|gif|jpeg'
        ,choose: function(obj){
            //预读本地文件示例，不支持ie8
            $(".isupload").val('1');
            obj.preview(function(index, file, result){
                $('#demo1').attr('src', result);
            });
        }
        ,done: function(res){
            // var files = JSON.stringify(res);
            // alert(res['data']);
            $("#profilephoto").val(res['data']);
            //上传完毕回调
        }
        ,error: function(){
          //请求异常回调
        }
    });

    $("#s_id").blur(function(){
        if ($("#s_id").val()=="") {
            layer.msg('请输入你的学号噢',{time: 1000});
            $("#s_id").addClass("warning");
        }else{
            $.ajax({
                type:"POST",
                url:"http://course.cn/User/s_id_check",
                data:"s_id=" + $("#s_id").val(),
                dataType:"json",
                success: function(msg){
                    // var temp = JSON.stringify(msg);
                    if(msg.digit==1)
                    {
                        $("#s_id").addClass("warning");
                        layer.msg('该课程号已被注册',{time: 1000});
                        form.render();
                    }
                    else
                    {
                        $("#s_id").removeClass("warning");
                        form.render();
                    }
                }
            });
        }
    });

    $(".reg").click(function(){
        $(".reg").text("注册中...").prop("disabled", true).addClass("layui-disabled");

        if ($("#s_id").hasClass("warning")) {
            layer.msg('该学号已被注册',{time: 1000});
            $(".reg").text("立即注册").prop("disabled", false).removeClass("layui-disabled");
            return false;
        }
        $(".pwd").prop("disabled", false).removeClass("layui-disabled");
        $(".pwd").val($("#s_id").val());
        $(".testListAction").click();
        setTimeout("upform()",100);
        return false;
    })

    $(".savereg").click(function(){
        var temp=$("#addUserform").serialize();
        console.log(temp);
        $.ajax({
            type:"POST",
            url:"http://course.cn/User/add_check",
            data:temp,
            dataType:"json",
            success: function(msg){
                console.log(msg);
                if(msg.digit==1)
                {
                    // top.layer.close(index);
                    top.layer.msg("用户添加成功！");
                    layer.closeAll("iframe");
                    //刷新父页面
                    parent.location.reload();
                }
                else
                {
                    // layer.alert("用户名或密码错误");
                    $(".reg").text("立即注册").prop("disabled", false).removeClass("layui-disabled");
                }
            }
        });
        return false;
    });

    //格式化时间
    function filterTime(val){
        if(val < 10){
            return "0" + val;
        }else{
            return val;
        }
    }
    //定时发布
    var time = new Date();
    var submitTime = time.getFullYear()+'-'+filterTime(time.getMonth()+1)+'-'+filterTime(time.getDate())+' '+filterTime(time.getHours())+':'+filterTime(time.getMinutes())+':'+filterTime(time.getSeconds());

})
    
    //延长事件等待后台完成图片上传
    function upform(){
        if($(".isupload").val()){
            if($("#profilephoto").val()!='default.jpg'){
                $(".savereg").click();
            }
            else{
                setTimeout("upform()",100)
            }
        }else{
                $(".savereg").click();
        }
    }