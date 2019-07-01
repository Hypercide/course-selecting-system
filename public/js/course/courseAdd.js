layui.use(['form','layer','layedit','laydate','upload'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        laypage = layui.laypage,
        upload = layui.upload,
        layedit = layui.layedit,
        $ = layui.jquery;

    //获取授课教师下拉
    $.ajax({
        type:"POST",
        url:"http://course.cn/Course/getTeacherSelect/Pushpa",
        dataType:"json",
        success: function(data){
            // var temp = JSON.stringify(data);
            // alert(temp);
            $(".teacher_block").html(data.data);
            form.render();
        }
    });

    //用于同步编辑器内容到textarea


    //上传缩略图
    // upload.render({
    //     elem: '.thumbBox',
    //     url: '../../json/userface.json',
    //     method : "get",  //此处是为了演示之用，实际使用中请将此删除，默认用post方式提交
    //     done: function(res, index, upload){
    //         var num = parseInt(4*Math.random());  //生成0-4的随机数，随机显示一个头像信息
    //         $('.thumbImg').attr('src',res.data[num].src);
    //         $('.thumbBox').css("background","#fff");
    //         $('.msg').text('');
    //     }
    // });


    //创建一个编辑器
    var editIndex = layedit.build('course_info',{
        height : 410,
        // uploadImage : {
        //     url : "/public/images/"
        // }
    });

    $("#course_id").blur(function(){
        if ($("#course_id").val()=="") {
            layer.msg('请输入课程号噢',{time: 1000});
            $("#course_id").addClass("warning");
        }else{
            $.ajax({
                type:"POST",
                url:"http://course.cn/Course/course_id_check",
                data:"course_id=" + $("#course_id").val(),
                dataType:"json",
                success: function(msg){
                    // var temp = JSON.stringify(msg);
                    if(msg.digit==1)
                    {
                        $("#course_id").addClass("warning");
                        layer.msg('该课程号已被注册',{time: 1000});
                        form.render();
                    }
                    else
                    {
                        $("#course_id").removeClass("warning");
                        form.render();
                    }
                }
            });
        }
    });
    form.on('submit(addCourse)', function(obj){
        layedit.sync(editIndex);
        var temp=$("#addCourseform").serialize();
        $("#addCourse").text("发布中...").prop("disabled", true).addClass("layui-disabled");

        if ($("#course_id").hasClass("warning")) {
            layer.msg('该课程号已被注册',{time: 1000});
            $("#addCourse").html("<i class='layui-icon'>&#xe609;</i>发布").prop("disabled", false).removeClass("layui-disabled");
            return false;
        }
        console.log(temp);

        $.ajax({
            type:"POST",
            url:"http://course.cn/Course/add_check",
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
                    $("#addCourse").html("<i class='layui-icon'>&#xe609;</i>发布").prop("disabled", false).removeClass("layui-disabled");
                }
            }
        });
        return false;
    });

})