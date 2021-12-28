<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <!-- <div class="box">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="inputBox">
                <input type="text" name="account" required="">
                <label>Account</label>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <input type="submit" name="" value="Submit">
        </form>
    </div> -->
    
    
</body>
</html>

<?php
    $conn = new mysqli("localhost:3306","root","mysql","codezero");
    if($conn->connect_error){
        die("could not connect mysql");
    }
    if(isset($_POST['account']) && isset($_POST['password'])){
        $account = $_POST['account'];
        $psd = $_POST['password'];


        $conn->query("set name utf8");
        $result = $conn->query("select * from user where account='$account'");

        $row = $result->fetch_assoc();

        if($psd == $row['password']){
        echo "<script>alert('login success');</script>";
        }else{
            echo "<script>alert('wrong password');</script>";
        }
        mysqli_close($conn);

    }
    
?>

