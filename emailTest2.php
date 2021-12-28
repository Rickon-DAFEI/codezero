<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="email"><input type="submit">
    </form>
    
</body>
</html>


<?php
$email = $_POST['email'];
$rand = sendEmail($email);
echo $rand;
function sendEmail($sendTo){

    require "PHPMailer/class.phpmailer.php";
    require "PHPMailer/class.smtp.php";
    // require 'E:\phpstudy_pro\WWW\codezero\PHPMailer\src\PHPMailer.php';
    $mail = new PHPMailer();
    try {
        //Server settings
        $mail->SMTPDebug = 0;                           // Enable ve6rbose debug output
        $mail->isSMTP();                                // Send using SMTP
        $mail->SMTPAuth   = true;                       // Enable SMTP authentication
        $mail->Host       = 'smtp.qq.com';              // Set the SMTP server to send through
        $mail->SMTPSecure = 'ssl';                      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged  
        $mail->Port       = 465;                        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet    = 'UTF-8';  
        
        $mail->Username   = '1051365125@qq.com';        // SMTP username

        $mail->Password   = 'rpdilmztllqmbdcb';         // SMTP password
    
        $mail->From = '1051365125@qq.com';              //设置发送方 必须和Username一致

        $mail->isHTML(true);                            // Set email format to HTML  邮件正文是否为html编码 注意此处是一个方法
        
        // $mail->addAddress('898716374@qq.com');
        $mail->addAddress($sendTo);
        //Content
        $randNumber = rand(100000,999999);
        $mail->Subject = "邮件主题";                    //邮件主题
        $mail->Body = $randNumber;                      //邮件内容
        // $mail->addAttachment('img/head/xml.jpg');       //添加附件
        $state = $mail->send(); 
        echo $state."<br>";
        return $randNumber;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}
?>