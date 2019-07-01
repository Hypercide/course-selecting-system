
//获取系统时间
var newDate = '';
getLangDate();
//值小于10时，在前面补0
function dateFilter(date){
    if(date < 10){return "0"+date;}
    return date;
}
function getLangDate(){
    var dateObj = new Date(); //表示当前系统时间的Date对象
    var year = dateObj.getFullYear(); //当前系统时间的完整年份值
    var month = dateObj.getMonth()+1; //当前系统时间的月份值
    var date = dateObj.getDate(); //当前系统时间的月份中的日
    var day = dateObj.getDay(); //当前系统时间中的星期值
    var weeks = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
    var week = weeks[day]; //根据星期值，从数组中获取对应的星期字符串
    var hour = dateObj.getHours(); //当前系统时间的小时值
    var minute = dateObj.getMinutes(); //当前系统时间的分钟值
    var second = dateObj.getSeconds(); //当前系统时间的秒钟值
    var timeValue = "" +((hour >= 12) ? (hour >= 18) ? "晚上" : "下午" : "上午" ); //当前时间属于上午、晚上还是下午
    newDate = dateFilter(year)+"年"+dateFilter(month)+"月"+dateFilter(date)+"日 "+" "+dateFilter(hour)+":"+dateFilter(minute)+":"+dateFilter(second);
    document.getElementById("nowTime").innerHTML = timeValue + "好！ 欢迎使用DedsecAdmin。当前时间为： "+newDate+"　"+week;
    setTimeout("getLangDate()",1000);
}

layui.config({
    base : "/public/layui2/lay/modules/"
}).use(['form','element','layer','jquery','carousel'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        element = layui.element,
        $ = layui.jquery;
        var carousel = layui.carousel;
    

    $(".main_a").click(function(){
        parent.addTab($(this));
    })

    $.ajax({
        type:"POST",
        url:"http://course.cn/Course/getcoursecount",
        dataType:"json",
        success: function(data){
            $(".course_count").html(data.count);
        }
    });

    $.ajax({
        type:"POST",
        url:"http://course.cn/User/getuserchoosencount",
        dataType:"json",
        success: function(data){
            $(".choosen_count").html(data.count);
        }
    });

    var ins1 = carousel.render({
        elem: '.layadmin-shortcut'
        , width: '100%'
        , height: '200px'
        , autoplay: false
        , interval: 4000
        , arrow: 'none' //始终不显示箭头
    });

    var ins2 = carousel.render({
        elem: '.layadmin-backlog'
        , width: '100%'
        , height: '200px'
        , autoplay: false
        , interval: 4000
        , arrow: 'none' //始终不显示箭头
    });

    var ins3 = carousel.render({
        elem: '.layadmin-news'
        , width: '100%'
        , height: '200px'
        , interval: 4000
        , anim: 'fade'
        , arrow: 'none' //始终不显示箭头
    });

})
