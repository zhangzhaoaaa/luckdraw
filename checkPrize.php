<?php

    $mysql_host = "localhost";
    $mysql_port = "3306";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "prize";

    $mysql_table = "tb_prize";

    $mysql_record = "SELECT * FROM ".$mysql_table." WHERE status='1' and phonenumber = '".$_GET["phoneNumber"]."' limit 1";
    
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);
    /*if (!mysql_query($mysql_record,$con)){
        die('Error: ' . mysql_error());
    }*/
    $result = mysql_query($mysql_record);
    $row = mysql_fetch_array($result);
    $rowId = $row["id"];
    //echo "row=====".$rowId;
    mysql_close($con);
    if ($rowId!=null&&$rowId!=""){
        $arr = array ('msg'=>1);
        echo json_encode($arr);
    }else{
        $arr = array ('msg'=>0);
        echo json_encode($arr);
    }
    

?>