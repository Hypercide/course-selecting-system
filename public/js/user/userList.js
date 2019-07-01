layui.use(['form','layer','table','laytpl','element'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        element = layui.element,
        table = layui.table;

    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url : 'http://course.cn/User/getuserlist',
        cellMinWidth : 40,
        page : true,
        height : "full-125",
        limit : 12,              //向后台传值
        limits : [12,15,20,25],
        id : "userListTable",
        cols : [[
            {type: "checkbox", width:40},
            {field: 's_id', title: '学号', width:130, align:"center"},
            {field: 'username', title: '姓名',width:80, align:"center"},
            {field: 'sex', title: '性别', width:60, align:"center"},
            {field: 'tel', title: '电话', width:130, align:"center"},
            {field: 'email', title: '用户邮箱', minWidth:200, align:'center',templet:function(d){
                return '<a class="layui-blue" href="mailto:'+d.email+'">'+d.email+'</a>';
            }},
            {field: 'major', title: '专业', width:100,align:'center',templet:function(d){
                if(d.major == "1"){
                    return "软件工程";
                }else if(d.major == "2"){
                    return "嵌入式";
                }else if(d.major == "3"){
                    return "数字媒体技术";
                }
            }},
            {field: 'lastlogintime', title: '最后登录时间', minWidth:170, align:'center',templet:function(d){
                if (d.lastlogintime!=="") {
                    return formatDate('Y-m-d H:i:s',d.lastlogintime);
                }else{
                    return "";
                }
            }},
            {title: '操作', width:160, templet:'#userListBar',align:"center"}
        ]]
    });

    function tableReload() {
        table.render({
            elem: '#userList',
            url : 'http://course.cn/User/getuserlist',
            cellMinWidth : 40,
            page : true,
            height : "full-125",
            limit : 12,              //向后台传值
            limits : [12,15,20,25],
            id : "userListTable",
            cols : [[
                {type: "checkbox", width:40},
                {field: 's_id', title: '学号', width:130, align:"center"},
                {field: 'username', title: '姓名',width:80, align:"center"},
                {field: 'sex', title: '性别', width:60, align:"center"},
                {field: 'tel', title: '电话', width:130, align:"center"},
                {field: 'email', title: '用户邮箱', minWidth:200, align:'center',templet:function(d){
                    return '<a class="layui-blue" href="mailto:'+d.email+'">'+d.email+'</a>';
                }},
                {field: 'major', title: '专业', width:100,align:'center',templet:function(d){
                    if(d.major == "1"){
                        return "软件工程";
                    }else if(d.major == "2"){
                        return "嵌入式";
                    }else if(d.major == "3"){
                        return "数字媒体技术";
                    }
                }},
                {field: 'lastlogintime', title: '最后登录时间', minWidth:170, align:'center',templet:function(d){
                    if (d.lastlogintime!=="") {
                        return formatDate('Y-m-d H:i:s',d.lastlogintime);
                    }else{
                        return "";
                    }
                }},
                {title: '操作', width:160, templet:'#userListBar',align:"center"}
            ]]
        });
    }
    //查询
    $(".search_btn").click(function(){
        var userArray = [];
        if($(".searchVal").val() != ''){
            var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
            $.ajax({
                url : "http://course.cn/User/getuserlist",
                type : "get",
                dataType : "json",
                success : function(data){
                    usersData = data.data;
                    // var temp = JSON.stringify(usersData);
                    // alert(temp);
                    console.log(usersData);
                    function changeStr(data){
                        var dataStr = '';
                        var showNum = data.split(eval("/"+selectStr+"/ig")).length - 1;
                        if(showNum > 1){
                            for (var j=0;j<showNum;j++) {
                                dataStr += data.split(eval("/"+selectStr+"/ig"))[j] + "<i style='color:#03c339;font-weight:bold;'>" + selectStr + "</i>";
                            }
                            dataStr += data.split(eval("/"+selectStr+"/ig"))[showNum];
                            return dataStr;
                        }else{
                            dataStr = data.split(eval("/"+selectStr+"/ig"))[0] + "<i style='color:#03c339;font-weight:bold;'>" + selectStr + "</i>" + data.split(eval("/"+selectStr+"/ig"))[1];
                            return dataStr;
                        }
                    }

                    for(var i=0;i<usersData.length;i++){
                        var usersStr = usersData[i];
                        var selectStr = $(".searchVal").val();
                        //学号
                        if(usersStr.s_id.indexOf(selectStr) > -1){
                            usersStr["s_id"] = changeStr(usersStr.s_id);
                        }
                        //姓名
                        if(usersStr.username.indexOf(selectStr) > -1){
                            usersStr["username"] = changeStr(usersStr.username);
                        }
                        //电话
                        if(usersStr.tel.indexOf(selectStr) > -1){
                            usersStr["tel"] = changeStr(usersStr.tel);
                        }
                        //专业
                        if(usersStr.major.indexOf(selectStr) > -1){
                            usersStr["major"] = changeStr(usersStr.major);
                        }
                        //用户邮箱
                        if(usersStr.email.indexOf(selectStr) > -1){
                            usersStr["email"] = changeStr(usersStr.email);
                        }
                        //性别
                        if(usersStr.sex.indexOf(selectStr) > -1){
                            usersStr["sex"] = changeStr(usersStr.sex);
                        }
                        //会员等级
                        // if(usersStr.level.indexOf(selectStr) > -1){
                        //     usersStr["level"] = changeStr(usersStr.level);
                        // }
                        if(usersStr.s_id.indexOf(selectStr)>-1 || usersStr.username.indexOf(selectStr)>-1 || usersStr.tel.indexOf(selectStr)>-1 || usersStr.email.indexOf(selectStr)>-1 || usersStr.major.indexOf(selectStr)>-1 || usersStr.sex.indexOf(selectStr)>-1){
                            userArray.push(usersStr);
                        }
                    }
                    usersData = userArray;
                    // var temp = JSON.stringify(usersData);
                    // alert(temp);
                    table.render({
                        elem : '#userList',
                        data : usersData,
                        cellMinWidth : 40,
                        page : true,
                        height : "full-125",
                        limit : 12,              //向后台传值
                        limits : [12,15,20,25],
                        id : "userListTable",
                        cols : [[
                            {type: "checkbox", width:40},
                            {field: 's_id', title: '学号', width:130, align:"center"},
                            {field: 'username', title: '姓名',width:80, align:"center"},
                            {field: 'sex', title: '性别', width:60, align:"center"},
                            {field: 'tel', title: '电话', width:130, align:"center"},
                            {field: 'email', title: '用户邮箱', minWidth:200, align:'center',templet:function(d){
                                return '<a class="layui-blue" href="mailto:'+d.email+'">'+d.email+'</a>';
                            }},
                            {field: 'major', title: '专业', width:100,align:'center',templet:function(d){
                                if(d.major == "1"){
                                    return "软件工程";
                                }else if(d.major == "2"){
                                    return "嵌入式";
                                }else if(d.major == "3"){
                                    return "数字媒体技术";
                                }
                            }},
                            {field: 'lastlogintime', title: '最后登录时间', minWidth:170, align:'center',templet:function(d){
                                return formatDate('Y-m-d H:i:s',d.lastlogintime);
                            }},
                            {title: '操作', width:160, templet:'#userListBar',align:"center"}
                        ]]
                    });
                }
            })
                
            layer.close(index);
        }else{
            layer.msg("请输入需要查询的内容");
        }
    })
    //添加用户
    function addUser(edit){
        var index = layui.layer.open({
            title : "添加用户",
            type : 2,
            content : "http://course.cn/User/useradd",
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                if(edit){
                    form.render();
                }
            }
        })
        layui.layer.full(index);
        window.sessionStorage.setItem("index",index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(window.sessionStorage.getItem("index"));
        })
    }
    $(".addUser_btn").click(function(){
        addUser();
    })

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('userListTable'),
            data = checkStatus.data,
            userId = [];

        if(data.length > 0) {
            for (var i in data) {
                userId.push(data[i].id);
            }
            // var temp = JSON.stringify(data);
            // alert(userId);
            layer.confirm('确定删除选中的用户？', {icon: 3, title: '提示信息'}, function (index) {
                $.get("http://course.cn/User/userdels",{
                    userId : userId  //将需要删除的userId作为参数传入
                },function(data){
                    tableReload();
                    layer.close(index);
                })
            })
        }else{
            layer.msg("请选择需要删除的用户");
        }
    })

    //修改信息
    function editUser(id,edit){
        var index = layui.layer.open({
            title : "修改信息",
            closeBtn: 1,
            type : 2,
            content : "http://course.cn/User/useredit/" + id,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                if(edit){
                    form.render();
                }
            }
        })
        layui.layer.full(index);
        window.sessionStorage.setItem("index",index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(window.sessionStorage.getItem("index"));
        })
    }

    //更多信息
    function moreInfo(id,edit){
        var tempurl = "http://course.cn/User/moreinfo/" + id;
        var index = layui.layer.open({
            title : "更多信息",
            closeBtn: 1,
            type : 2,
            content : tempurl,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                if(edit){
                    form.render();
                }
            }
        })
        layui.layer.full(index);
        window.sessionStorage.setItem("index",index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(window.sessionStorage.getItem("index"));
        })
    }

    //列表操作
    table.on('tool(userList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'edit'){ //编辑
            // var temp = JSON.stringify(data);
            // alert(data.major);
            layui.sessionData('useredit', {
                key: 'sex',
                value: data.sex
            });
            layui.sessionData('useredit', {
                key: 'major',
                value: data.major
            });
            editUser(data.id);
        }else if(layEvent === 'more'){ //删除
            moreInfo(data.id);
        }else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此用户？',{icon:3, title:'提示信息'},function(index){
                $.get("http://course.cn/User/userdel/"+data.id,{
                },function(data){
                    tableReload();
                    layer.close(index);
                })
            });
        }
    });

})
