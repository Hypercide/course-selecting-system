layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;

    //课程列表
    var tableIns = table.render({
        elem: '#courseList',
        url : 'http://course.cn/Course/getcourselist',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limit : 12,
        limits : [12,15,20,25],
        id : "courseListTable",
        cols : [[
            {type: "checkbox", width:50},
            {field: 'course_id', title: 'ID', width:60, align:"center"},
            {field: 'course_name', title: '课程名', minWidth:300, align:"center"},
            {field: 'course_credit', title: '学分', width:100,align:'center'},
            {field: 'course_theoryhour', title: '理论学时', width:100,align:'center'},
            {field: 'course_practicehour', title: '实践学时', width:100,align:'center'},
            {field: 'course_teacher', title: '授课教师', width:130,align:'center'},
            {field: 'course_remain', title: '课余量', width:80,align:'center'},
            {title: '操作', width:170, templet:'#courseListBar',align:"center"}
        ]]
    });

    function tableReload() {
        table.render({
            elem: '#courseList',
            url : 'http://course.cn/Course/getcourselist',
            cellMinWidth : 95,
            page : true,
            height : "full-125",
            limit : 12,
            limits : [12,15,20,25],
            id : "courseListTable",
            cols : [[
                {type: "checkbox", width:50},
                {field: 'course_id', title: 'ID', width:60, align:"center"},
                {field: 'course_name', title: '课程名', minWidth:300, align:"center"},
                {field: 'course_credit', title: '学分', width:100,align:'center'},
                {field: 'course_theoryhour', title: '理论学时', width:100,align:'center'},
                {field: 'course_practicehour', title: '实践学时', width:100,align:'center'},
                {field: 'course_teacher', title: '授课教师', width:130,align:'center'},
                {field: 'course_remain', title: '课余量', width:80,align:'center'},
                {title: '操作', width:170, templet:'#courseListBar',align:"center"}
            ]]
        });
    }
    //查询
    $(".search_btn").click(function(){
        var userArray = [];
        if($(".searchVal").val() != ''){
            var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
            $.ajax({
                url : "http://course.cn/Course/getcourselist",
                type : "get",
                dataType : "json",
                success : function(data){
                    courseData = data.data;
                    // var temp = JSON.stringify(courseData);
                    // alert(temp);
                    console.log(courseData);
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

                    for(var i=0;i<courseData.length;i++){
                        var courseStr = courseData[i];
                        var selectStr = $(".searchVal").val();
                        //课程号
                        if(courseStr.course_id.indexOf(selectStr) > -1){
                            courseStr["course_id"] = changeStr(courseStr.course_id);
                        }
                        //课程名
                        if(courseStr.course_name.indexOf(selectStr) > -1){
                            courseStr["course_name"] = changeStr(courseStr.course_name);
                        }
                        //学分
                        if(courseStr.course_credit.indexOf(selectStr) > -1){
                            courseStr["course_credit"] = changeStr(courseStr.course_credit);
                        }
                        //理论课时
                        if(courseStr.course_theoryhour.indexOf(selectStr) > -1){
                            courseStr["course_theoryhour"] = changeStr(courseStr.course_theoryhour);
                        }
                        //实践课时
                        if(courseStr.course_practicehour.indexOf(selectStr) > -1){
                            courseStr["course_practicehour"] = changeStr(courseStr.course_practicehour);
                        }
                        //授课教师
                        if(courseStr.course_teacher.indexOf(selectStr) > -1){
                            courseStr["course_teacher"] = changeStr(courseStr.course_teacher);
                        }
                        //会员等级
                        // if(courseStr.level.indexOf(selectStr) > -1){
                        //     courseStr["level"] = changeStr(courseStr.level);
                        // }
                        if(courseStr.course_id.indexOf(selectStr)>-1 || courseStr.course_name.indexOf(selectStr)>-1 || courseStr.course_credit.indexOf(selectStr)>-1 || courseStr.course_practicehour.indexOf(selectStr)>-1 || courseStr.course_theoryhour.indexOf(selectStr)>-1 || courseStr.course_teacher.indexOf(selectStr)>-1){
                            userArray.push(courseStr);
                        }
                    }
                    courseData = userArray;
                    // var temp = JSON.stringify(courseData);
                    // alert(temp);
                    table.render({
                        elem : '#courseList',
                        data : courseData,
                        cellMinWidth : 95,
                        page : true,
                        height : "full-125",
                        limit : 12,
                        limits : [12,15,20,25],
                        id : "courseListTable",
                        cols : [[
                            {type: "checkbox", width:50},
                            {field: 'course_id', title: 'ID', width:60, align:"center"},
                            {field: 'course_name', title: '课程名', minWidth:300, align:"center"},
                            {field: 'course_credit', title: '学分', width:100,align:'center'},
                            {field: 'course_theoryhour', title: '理论学时', width:100,align:'center'},
                            {field: 'course_practicehour', title: '实践学时', width:100,align:'center'},
                            {field: 'course_teacher', title: '授课教师', width:130,align:'center'},
                            {field: 'course_remain', title: '课余量', width:80,align:'center'},
                            {title: '操作', width:170, templet:'#courseListBar',align:"center"}
                        ]]
                    });
                }
            })
                
            layer.close(index);
        }else{
            layer.msg("请输入需要查询的内容");
        }
    })
    
    //添加课程
    function addCourse(edit){
        var index = layui.layer.open({
            title : "添加课程",
            type : 2,
            content : "http://course.cn/Course/addCourse",
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
    $(".addCourse_btn").click(function(){
        addCourse();
    })

    //修改课程
    function editCourse(course_id,edit){
        var index = layui.layer.open({
            title : "修改信息",
            closeBtn: 1,
            type : 2,
            content : "http://course.cn/Course/courseedit/" + course_id,
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
        var tempurl = "http://course.cn/Course/moreinfo/" + id;
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

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('courseListTable'),
            data = checkStatus.data,
            courseId = [];
        if(data.length > 0) {
            for (var i in data) {
                courseId.push(data[i].course_id);
            }
            layer.confirm('确定删除选中的课程？', {icon: 3, title: '提示信息'}, function (index) {
                $.get("http://course.cn/Course/coursedels",{
                    courseId : courseId  //将需要删除的userId作为参数传入
                },function(data){
                    tableReload();
                    layer.close(index);
                })
            })
        }else{
            layer.msg("请选择需要删除的课程");
        }
    })

    //列表操作
    table.on('tool(courseList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'edit'){ //编辑
            layui.sessionData('courseedit', {
                key: 'course_teacher',
                value: data.course_teacher
            });
            editCourse(data.course_id);
        } else if(layEvent === 'more'){ //更多
            moreInfo(data.course_id);
        } else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此课程？',{icon:3, title:'提示信息'},function(index){
                $.get("http://course.cn/Course/coursedel/"+data.course_id,{
                },function(data){
                    tableReload();
                    layer.close(index);
                })
            });
        }
    });

})