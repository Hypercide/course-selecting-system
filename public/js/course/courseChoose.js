layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
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
            {title: '操作', width:120, templet:'#courseListBar',align:"center"}
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
                {title: '操作', width:120, templet:'#courseListBar',align:"center"}
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
                        //学号
                        if(courseStr.course_id.indexOf(selectStr) > -1){
                            courseStr["course_id"] = changeStr(courseStr.course_id);
                        }
                        //姓名
                        if(courseStr.course_name.indexOf(selectStr) > -1){
                            courseStr["course_name"] = changeStr(courseStr.course_name);
                        }
                        //电话
                        if(courseStr.course_credit.indexOf(selectStr) > -1){
                            courseStr["course_credit"] = changeStr(courseStr.course_credit);
                        }
                        //专业
                        if(courseStr.course_theoryhour.indexOf(selectStr) > -1){
                            courseStr["course_theoryhour"] = changeStr(courseStr.course_theoryhour);
                        }
                        //用户邮箱
                        if(courseStr.course_practicehour.indexOf(selectStr) > -1){
                            courseStr["course_practicehour"] = changeStr(courseStr.course_practicehour);
                        }
                        //性别
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
                            {title: '操作', width:120, templet:'#courseListBar',align:"center"}
                        ]]
                    });
                }
            })
                
            layer.close(index);
        }else{
            layer.msg("请输入需要查询的内容");
        }
    })

    //刷新页面
    $(".refresh_btn").click(function(){
        tableReload();
    })

    //列表操作
    table.on('tool(courseList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'choose'){          //选择课程
            layer.confirm('确定添加此课程？',{icon:3, title:'提示信息'},function(index){
                $.ajax({
                    type: "post",
                    url: "http://course.cn/Course/choosecourse/" + data.course_id,
                    dataType: "json",
                    success:function(msg) {
                        if (msg.digit==0) {
                            layer.msg("你已选择该门课程，不能重复选课");
                            layer.close(index);
                        }else if (msg.digit==1) {
                            layer.msg("课程置入成功");
                            tableReload();
                            layer.close(index);
                        }else if (msg.digit==2) {
                            layer.msg("选课失败，课余量不足");
                            tableReload();
                            layer.close(index);
                        }
                    }
                });
            });
        }
    });

})