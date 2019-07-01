layui.use(['form','layer','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.$;

    form.verify({
        pwd : function(value, item){
            if(value.length < 6){
                return "密码长度不能小于6位";
            }
        },
        confirmpwd : function(value, item){
            if(!$("#pwd").val()==value){
                return "两次输入密码不一致，请重新输入！";
            }
        }
    })

    var upload = layui.upload;
        //普通图片上传
        //执行实例
    var uploadInst = upload.render({
        elem: '#photo' //绑定元素
        ,url: '../../addimg.php' //上传接口PHP 接收文件
        ,field:'pics'
        ,auto: false
        ,bindAction:'#testListAction'
        ,accept: 'image'
        ,exts: 'jpg|png|gif|jpeg'
        ,choose: function(obj){
            //预读本地文件示例，不支持ie8
            $("#isupload").val('1');
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


   $(".reg").click(function(){
        $(".reg").text("注册中...").prop("disabled", true).addClass("layui-disabled");
        $(".testListAction").click();
        setTimeout("upform()",100);
        return false;
    })

    $(".savereg").click(function(){
        var temp=$("#addUserform").serialize();
        console.log(temp);
        $.ajax({
            type:"POST",
            url:"userAdd.php",
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