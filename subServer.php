<?php
    session_start();
    require("database.php");
    $admin = $_SESSION['admin'];
    $params=json_decode(file_get_contents("php://input"),true);
    // $pro_id=2;
    $sql = "select pro_id ,submittime,judgestatus,language,file_path from submit where username='$admin' order by submittime desc";
    $pro_body = mysqli_query($con,$sql);
    $ans = $pro_body->fetch_all();
    exit(json_encode($ans));
    // echo "ok!";
    mysqli_close($con);
?>