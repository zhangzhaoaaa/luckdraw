<?php
    $mysql_host = "localhost";
    $mysql_port = "3306";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "prize";

    $mysql_table = "tb_prize";
    $mysql_record = "SELECT * FROM ".$mysql_table." where status=0 limit 1 ";
    $mysql_totalcount = "SELECT count(*) as totalCount FROM ".$mysql_table." where status='1'";
    $mysql_switch = "SELECT * FROM tb_prizeswitch";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);
    $query=mysql_query($mysql_totalcount,$con);
    $switch = mysql_query($mysql_switch,$con);
    $real_id="";
    $isPrize=0;
    $noPrize=0;
    $randIndex=0;
    $totalRow=mysql_fetch_array($query);
    $switchStatus = mysql_fetch_array($switch);
    $total = $totalRow["totalCount"];
    $switchResult = $switchStatus["switch"];
    if($total<10){//如果还有未中奖的
        $result = mysql_query($mysql_record);
        $row = mysql_fetch_array($result);
        mysql_close($con);
       
        $resultArray=array(0,0,1,0,0);
        $rowLen = count($row);

        if ($rowLen>0&&$row['id']!=null){
            $real_id = $row['id'];
            $index=mt_rand(0, 4);
            $randIndex=$index;
            $isPrize=$resultArray[$index];
            //echo "值：".$isPrize;
        }else{
            $isPrize = 0;
        }
    }else{
        $isPrize = 0;
        $noPrize=1;
    }
   
    echo "<script>var randIndex=\"$randIndex\";var isPrize=\"$isPrize\";var real_id=\"$real_id\";var noPrize=\"$noPrize\";var switchResult=\"$switchResult\";</script>";
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>刮刮卡效果</title>
<style type="text/css">
body{
    margin: 0;
    padding: 0;
    background-color: red;
}
.demo{width:320px; margin:10px auto 20px auto; min-height:200px;}
.msg{text-align:center; height:32px; line-height:32px; font-weight:bold; }
.button{
width: 70px;
line-height: 25px;
text-align: center;
font-weight: bold;
color: #fff;
text-shadow:1px 1px 1px #333;
border-radius: 5px;
margin:0 20px 20px 0;
position: relative;
overflow: hidden;
}
.button.yellow{
border:1px solid #d2a000;
box-shadow: 0 1px 2px #fedd71 inset,0 -1px 0 #a38b39 inset,0 -2px 3px #fedd71 inset;
background: -webkit-linear-gradient(top,#fece34,#d8a605);
background: -moz-linear-gradient(top,#fece34,#d8a605);
background: linear-gradient(top,#fece34,#d8a605);
cursor: pointer;
}
header {
    margin: 20 auto;
    text-align: center;
    font-size: 20;
    font-weight: 200;
    color: #E0E805;
}

footer{
    margin: 20;
    font-size: 14;
}
footer .header{
    color:#E0E805;
}
ul li{
    color:#fff;
    margin: 5 auto;
}

</style>
</head>

<body>
<div id="main">
   <header class="header">感谢参加我们的婚礼</header>
   <section class="">
       <div class="msg"><a href="javascript:void(0)" onClick="window.location.reload()">再刮一次</a></div>
    <div class="msg" style="display:none;" id="noPrize">奖品被抢光了</div>
   <div class="demo">
        <canvas></canvas>
        <div id="acceptPrize" style="display: none;position: relative;top: 180;left: 60;">
        <input type="text" value="" id="phone" placeholder="手机号">
        <button onclick="javascript:lingjiang();" class="button yellow">领奖</button></div>
    </div>

   </section>
   <footer>
    <div class="footerContainer">
        <div class="header">活动规则</div>
        <div style="clear:left;"></div>
        <ul><li>活动开始后，点击【再刮一次】刷新界面，即可刮卡抽奖</li>
            <li>想要中奖，就得刮干净点哦</li>
           <li>如中奖，会有提示，请拿着手机上台领奖并出示中奖提示</li>
       </ul>
    </div>
    
</footer>
</div>
<script src="http://libs.useso.com/js/jquery/1.10.0/jquery.min.js"></script>
<script type="text/javascript">

if (noPrize==1){
    $('#noPrize').show();
}else{
    $('#noPrize').hide();
}
var bodyStyle = document.body.style;

bodyStyle.mozUserSelect = 'none';
bodyStyle.webkitUserSelect = 'none';

var img = new Image();
var canvas = document.querySelector('canvas');
canvas.style.backgroundColor='transparent';
canvas.style.position = 'absolute';
var imgs = ['p_0.jpg','p_1.jpg','p_2.jpg','p_3.jpg','p_4.jpg'];
console.log(randIndex,isPrize);
img.src = imgs[randIndex];

img.addEventListener('load', function(e) {
    var ctx;
    var w = img.width,
        h = img.height;
    var offsetX = canvas.offsetLeft,
        offsetY = canvas.offsetTop;
    var mousedown = false;

    function layer(ctx) {
        ctx.fillStyle = 'gray';
        ctx.fillRect(0, 0, w, h);
    }

    function eventDown(e){
        e.preventDefault();
        mousedown=true;
    }
    function getTransparentPercent() {
        var imgData = ctx.getImageData(0, 0, w, h),
            pixles = imgData.data,
            transPixs = [];
        for (var i = 0, j = pixles.length; i < j; i += 4) {
            var a = pixles[i + 3];
            if (a < 128) {
                transPixs.push(i);
            }
        }
        return (transPixs.length / (pixles.length / 4) * 100).toFixed(2);
    }
    function eventUp(e){
        e.preventDefault();
        mousedown=false;
    }

    function eventMove(e){
        e.preventDefault();
        if(mousedown) {
             if(e.changedTouches){
                 e=e.changedTouches[e.changedTouches.length-1];
             }
             var x = (e.clientX + document.body.scrollLeft || e.pageX) - offsetX || 0,
                 y = (e.clientY + document.body.scrollTop || e.pageY) - offsetY || 0;
             with(ctx) {
                 beginPath()
                 arc(x, y, 10, 0, Math.PI * 2);
                 fill();

             }
             if(getTransparentPercent()>50){
                if (isPrize==1){
                    document.getElementById('acceptPrize').style.display="block";
                }else{
                    $('#noPrize').html('很遗憾未中奖').show();
                }
             }
        }
    }

    canvas.width=w;
    canvas.height=h;
    canvas.style.backgroundImage='url('+img.src+')';
    ctx=canvas.getContext('2d');
    ctx.fillStyle='transparent';
    ctx.fillRect(0, 0, w, h);
    layer(ctx);

    ctx.globalCompositeOperation = 'destination-out';

    if (switchResult==0){
        alert("抽奖还没有开始！");
        return;
    }else{
        if (noPrize==1){
            canvas.removeEventListener('touchstart');
            canvas.removeEventListener('touchend');
            canvas.removeEventListener('touchmove');
            canvas.removeEventListener('mousedown');
            canvas.removeEventListener('mouseup');
            canvas.removeEventListener('mousemove');
        }else{
            canvas.addEventListener('touchstart', eventDown);
            canvas.addEventListener('touchend', eventUp);
            canvas.addEventListener('touchmove', eventMove);
            canvas.addEventListener('mousedown', eventDown);
            canvas.addEventListener('mouseup', eventUp);
            canvas.addEventListener('mousemove', eventMove);
        }
    }
    
});


function lingjiang(){
    var reg = /^1\d{10}$/;
    //TODO 把中奖人的手机号放过来

    var phoneNumber = document.getElementById('phone').value.trim();
    if (reg.test(phoneNumber)){
        $.get("/checkPrize.php?phoneNumber="+phoneNumber,function(data){
            var retInfo = JSON.parse(data);
            if (retInfo.msg){
                alert("抓类？都得拉奖啊呀！给别人个机会吧！");
            }else{
                $.post('/updatePrize.php',{id:real_id,phoneNumber:phoneNumber},function(data){
                    var retInfo1 = JSON.parse(data);
                    if (retInfo1.msg==1){
                        alert('恭喜你，中奖啊，拿着这个上台领奖吧！');
                    }else{
                        alert('遗憾的告诉你，你的手机号登记失败，请重试！');
                    }
                })
            }
        });
    }else{
        alert("请输入正确的手机号码！");
    }    
}

</script>
</body>
</html>
