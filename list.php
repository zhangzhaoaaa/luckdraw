<?php
    $mysql_host = "localhost";
    $mysql_port = "3306";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "prize";

    $mysql_table = "tb_prize";
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
<style type="text/css">
.demo{width:320px; margin:10px auto 20px auto; min-height:300px;}
.msg{text-align:center; height:32px; line-height:32px; font-weight:bold; margin-top:50px}

</style>
</head>

<body>

<div id="main">
   
   <div class="msg">一共十个奖品，<a href="javascript:void(0)" onClick="window.location.reload()">刷新一下</a></div>
    <div class="msg">温馨提示：如果中奖，会有提示，请拿着手机上台领奖并出示中奖提示</div>
   <div class="demo">
        <table width="400px" height="208" border="0" cellpadding="0" cellspacing="0" >
      <tr><td><b>中奖状态</b></td><td><b>手机号</b></td></tr>
    <?php while($row = mysql_fetch_array($result)){ ?>
      <tr>
        <td> <?php echo $row['status']==0?"没中奖":"中奖";?></td>
        <td><?php echo $row['phonenumber']==""?"无":$row['phonenumber'];?></td> 
    </tr>
    <?php  
        }       
        mysql_close($con);
    ?>
 </table> 

    </div>
   </div>
    
</body>
</html>
