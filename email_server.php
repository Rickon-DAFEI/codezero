<?php
// $from = '1051365125@qq.com';
// $sendTo = '1051365125@qq.com';
$params=json_decode(file_get_contents("php://input"),true);
$sendTo=$params['my_email'];
// echo $sendTo;
$randNumber = sendEmail($sendTo);
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
        
        $mail->Username   = 'flossysy@qq.com';   
        // $mail->Username   = '1016831404@qq.com';     // SMTP username
        
        $mail->Password   = 'mbmyrtxypytwbcdi';         // SMTP password 1051365125
        // $mail->Password   = 'fetycezihxbpbffj';      // SMTP password 1016831404
        $mail->From = 'flossysy@qq.com';              //设置发送方 必须和Username一致
        // $mail->From = '1016831404@qq.com';  
        $mail->isHTML(true);                            // Set email format to HTML  邮件正文是否为html编码 注意此处是一个方法
        
        // $mail->addAddress('898716374@qq.com');
        $mail->addAddress($sendTo);
        //Content
        $randNumber = rand(100000,999999);
        $mail->Subject = "邮件主题";                    //邮件主题
        $mail->Body = $randNumber;                      //邮件内容
        // $mail->addAttachment('img/head/xml.jpg');       //添加附件
        $mail->send();
        return $randNumber;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}
exit(json_encode($randNumber));




?>