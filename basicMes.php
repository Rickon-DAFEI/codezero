<?php
session_start();
$params=json_decode(file_get_contents("php://input"),true);
// echo $params;
   
$servername = "localhost:3306";
$username = "root";
$password = "mysql";
$dbname = "CodeZero";
$admin =$_SESSION['admin'];
$conn = new mysqli($servername, $username, $password ,$dbname);
echo $admin;
$input_user_name = $params['input_user_name'];
$input_sex = $params['input_sex'];
$input_birth = $params['input_birth'];
$input_address = $params['input_address'];
// echo $input_user_name.$input_sex.$input_birth.$input_address;

try{
    // exit(json_encode($admin));
    $sql1 = "update user set username= '$input_user_name' where account='$admin';";
    $sql2 = "update user set sex= '$input_sex' where account='$admin';";
    $sql3 = "update user set birthday= '$input_birth' where account='$admin';";
    $sql4 = "update user set address= '$input_address' where account='$admin';";
    // echo $admin.$my_email;
    if($conn->query($sql1)==true && $conn->query($sql2)==true && $conn->query($sql3)==true && $conn->query($sql4)==true){
        $_SESSION['nick'] = $input_user_name;
        exit(json_encode("OK"));
    }else{
        exit(json_encode("ERROR"));
    }
}catch(Exception $e){
    // exit(json_encode("ERROR"));
    echo "mysqli error";
}

mysqli_close($conn);

?>