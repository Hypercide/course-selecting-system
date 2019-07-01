layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        table = layui.table;

    var s_id = $("#s_id").html();

    //课程列表
    var tableIns = table.render({
        elem: '#courseList',
        url : 'http://course.cn/User/getuserchoosenlist/' + s_id,
        cellMinWidth : 45,
        page : true,
        height : "full-125",
        limit : 12,
        limits : [12,15,20,25],
        id : "courseListTable",
        cols : [[
            {type: "checkbox", width:50},
            {field: 'choosen_id', title: '选课ID', width:76, align:"center"},
            {field: 'course_id', title: '课程号', width:76, align:"center"},
            {field: 'course_name', title: '课程名', minWidth:166, align:"center"},
            {field: 'course_teacher', title: '授课教师', width:100,align:'center'},
            {field: 'choosen_addtime', title: '选课时间', width:170,align:'center',templet:function(d){
                if (d.choosen_addtime!=="") {
                    return formatDate('Y-m-d H:i:s',d.choosen_addtime);
                }else{
                    return "";
                }
            }},
            {title: '操作', width:100, templet:'#courseListBar',align:"center"}
        ]]
    });

    function tableReload() {

        table.render({
            elem: '#courseList',
            url : 'http://course.cn/User/getuserchoosenlist/' + s_id,
            cellMinWidth : 45,
            page : true,
            height : "full-125",
            limit : 12,
            limits : [12,15,20,25],
            id : "courseListTable",
            cols : [[
                {type: "checkbox", width:50},
                {field: 'choosen_id', title: '选课ID', width:76, align:"center"},
                {field: 'course_id', title: '课程号', width:76, align:"center"},
                {field: 'course_name', title: '课程名', minWidth:166, align:"center"},
                {field: 'course_teacher', title: '授课教师', width:100,align:'center'},
                {field: 'choosen_addtime', title: '选课时间', width:170,align:'center',templet:function(d){
                    if (d.choosen_addtime!=="") {
                        return formatDate('Y-m-d H:i:s',d.choosen_addtime);
                    }else{
                        return "";
                    }
                }},
                {title: '操作', width:100, templet:'#courseListBar',align:"center"}
            ]]
        });
    }
    //查询
    $(".search_btn").click(function(){
        var userArray = [];
        if($(".searchVal").val() != ''){
            var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
            $.ajax({
                url : "http://course.cn/User/getuserchoosenlist/" + s_id,
                type : "post",
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
                        //授课教师
                        if(courseStr.course_teacher.indexOf(selectStr) > -1){
                            courseStr["course_teacher"] = changeStr(courseStr.course_teacher);
                        }
                        if(courseStr.course_id.indexOf(selectStr)>-1 || courseStr.course_name.indexOf(selectStr)>-1 || courseStr.course_teacher.indexOf(selectStr)>-1){
                            userArray.push(courseStr);
                        }
                    }
                    courseData = userArray;
                    // var temp = JSON.stringify(courseData);
                    // alert(temp);
                    table.render({
                        elem : '#courseList',
                        data : courseData,
                        cellMinWidth : 45,
                        page : true,
                        height : "full-125",
                        limit : 12,
                        limits : [12,15,20,25],
                        id : "courseListTable",
                        cols : [[
                            {type: "checkbox", width:50},
                            {field: 'choosen_id', title: '选课ID', width:76, align:"center"},
                            {field: 'course_id', title: '课程号', width:76, align:"center"},
                            {field: 'course_name', title: '课程名', minWidth:166, align:"center"},
                            {field: 'course_teacher', title: '授课教师', width:100,align:'center'},
                            {field: 'choosen_addtime', title: '选课时间', width:170,align:'center',templet:function(d){
                                if (d.choosen_addtime!=="") {
                                    return formatDate('Y-m-d H:i:s',d.choosen_addtime);
                                }else{
                                    return "";
                                }
                            }},
                            {title: '操作', width:100, templet:'#courseListBar',align:"center"}
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

        if(layEvent === 'del'){          //选择课程
            layer.confirm('确定要强制该学生退出此课程？',{icon:3, title:'提示信息'},function(index){
                $.get("http://course.cn/User/choosendel/"+ data.choosen_id + "/" + data.course_id,{
                },function(data){
                    layer.msg("退课成功");
                    tableReload();
                    layer.close(index);
                })
            });
        }
    });

})