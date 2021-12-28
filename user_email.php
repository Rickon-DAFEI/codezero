<?php
    session_start();
    $params=json_decode(file_get_contents("php://input"),true);
    require("database.php");
    $admin =$_SESSION['admin'];
    
    // 创建连接
    $my_email = $params['my_email'];
    // $pro_id=2;
    try{
        // exit(json_encode($admin));
        $sql = "update user set e_mail= '$my_email' where account='$admin';";
        echo $admin.$my_email;
        if($conn->query($sql)==true){
            exit(json_encode("OK"));
        }else{
            exit(json_encode("ERROR"));
        }
        
    }catch(Exception $e){
        // exit(json_encode("ERROR"));
        echo "mysqli error";
    }
    mysqli_close($con);
?>