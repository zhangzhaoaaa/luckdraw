<?php

 	$mysql_host = "localhost";
    $mysql_port = "3306";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "prize";
    
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }

	$sql="update tb_prizeSwitch set switch=".$_POST["status"];
    //echo $sql;
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);
	if (!mysql_query($sql,$con)){
  		die('Error: ' . mysql_error());
  	}
	mysql_close($con);
    $arr = array ('msg'=>1);
    echo json_encode($arr);
?>