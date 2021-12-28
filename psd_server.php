<?php
session_start();
$params=json_decode(file_get_contents("php://input"),true);
require("database.php");
   

$admin =$_SESSION['admin'];

$my_new_psd = $params['my_new_psd'];
$input_psd = $params['input_psd'];
echo $admin.$my_org_psd.$input_psd;



$result = $conn->query("select * from user where account='$admin'");
$row = $result->fetch_assoc();
if($row['password'] == $input_psd){
    $conn = new mysqli($servername, $username, $password ,$dbname);
    try{
        // exit(json_encode($admin));
        $sql = "update user set password= '$my_new_psd' where account='$admin';";
        // echo $admin.$psd;
        if($conn->query($sql)==true){
            echo "修改成功";
            // exit(json_encode("修改成功"));
        }
        // else{
        // 	exit(json_encode("ERROR"));
        // }
        
    }catch(Exception $e){
        // exit(json_encode("ERROR"));
        echo "mysqli error";
    }
}
mysqli_close($conn);
exit(json_encode($input_psd,$my_new_psd));
?>