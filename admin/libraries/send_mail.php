<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Instantiation and passing `true` enables exceptions
function send_mail($send_to_email,$send_to_fullname,$subject,$content,$option=array()){
    global $config;
    $config_email=$config['email'];
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output  SMTP::DEBUG_SERVER
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $config_email['smtp_host'];                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $config_email['smtp_user'];                     //SMTP username
    $mail->Password   = $config_email['smtp_pass'];                               //SMTP password
    $mail->SMTPSecure = $config_email['smtp_scure'];         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged PHPMailer::ENCRYPTION_STARTTLS
    $mail->Port       = $config_email['smtp_port'];                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->CharSet = $config_email['charset'];
    //Recipients
    $mail->setFrom($config_email['smtp_user'],$config_email['smtp_fullname'] );
    $mail->addAddress($send_to_email, $send_to_fullname);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo($config_email['smtp_user'],$config_email['smtp_fullname']);    ///email người dùng phản hồi lại
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    return 'Đã gửi thành công';
} catch (Exception $e) {
    return "email chưa được gửi :chi tiết lỗi: {$mail->ErrorInfo}";
}
}
