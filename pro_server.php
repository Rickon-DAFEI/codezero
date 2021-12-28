<?php

    require("database.php");
    $params=json_decode(file_get_contents("php://input"),true);
    $pro_id = $params['pro_id'];
    // $pro_id=2;
    $sql = "select title,concat(tlimit,'    ',mlimit),pro_des,input,output,sample_input,sample_output,resource,hint from prolis where pro_id=$pro_id";
    $pro_body = mysqli_query($con,$sql);
    $ans = $pro_body->fetch_array();
    exit(json_encode($ans));
    // echo "ok!";
    mysqli_close($con);
?>