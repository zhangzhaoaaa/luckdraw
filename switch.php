<?php
    $mysql_host = "localhost";
    $mysql_port = "3306";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "prize";

    $mysql_table = "tb_prizeswitch";
    $mysql_record = "SELECT * FROM ".$mysql_table;
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);
    $result = mysql_query($mysql_record);   
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>刮刮卡效果</title>

</head>

<body>
<div id="main">
   
   <div class="demo">
        <?php $row = mysql_fetch_array($result); 
           if ($row["switch"]==0){
?>
        <button onclick="javascript:start();">开启抽奖</button>
<?php 
           }else{ ?>
            <button onclick="javascript:closeSwitch();">关闭抽奖</button>
<?php
           }
          ?>
          <?php  mysql_close($con); ?>
          <button onclick="javascript:initPrize();">初始化抽奖数据</button>
    </div>
   </div>
   <script src="http://libs.useso.com/js/jquery/1.10.0/jquery.min.js"></script>
    <script>
        function start(){
            $.post('/updateSwitch.php',{status:1},function(data){
                console.log(data);
                window.location.reload();
            });
        }

        function closeSwitch(){
            $.post('/updateSwitch.php',{status:0},function(data){
                window.location.reload();
            });
        }
        function initPrize(){
            $.post('/initTable.php',{status:0},function(data){
                window.location.reload();
            });
        }
    </script>
</body>
</html>
