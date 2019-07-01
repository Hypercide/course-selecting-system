layui.use(['form','layer','layedit','laydate','upload'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        laypage = layui.laypage,
        upload = layui.upload,
        layedit = layui.layedit,
        $ = layui.jquery;

    var localedit = layui.sessionData('courseedit');
    var teacher = localedit.course_teacher;
    //获取授课教师下拉
    $.ajax({
        type:"POST",
        url:"http://course.cn/Course/getTeacherSelect/" + teacher,
        dataType:"json",
        success: function(data){
            // var temp = JSON.stringify(data);
            // alert(temp);
            $(".teacher_block").html(data.data);
            form.render();
        }
    });

    //创建一个编辑器
    var editIndex = layedit.build('course_info',{
        height : 410,
        // uploadImage : {
        //     url : "/public/images/"
        // }
    });

    form.on('submit(addCourse)', function(obj){
        layedit.sync(editIndex);
        $("#addCourse").text("发布中...").prop("disabled", true).addClass("layui-disabled");
        $("#course_id").prop("disabled", false).removeClass("layui-disabled");
        var temp=$("#addCourseform").serialize();
        console.log(temp);

        $.ajax({
            type:"POST",
            url:"http://course.cn/Course/edit_check",
            data:temp,
            dataType:"json",
            success: function(msg){
                // var temp = JSON.stringify(msg);
                if(msg.digit==1)
                {
                    // top.layer.close(index);
                    top.layer.msg("课程修改成功！");
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