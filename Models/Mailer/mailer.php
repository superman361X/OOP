<?php

use PHPMailer\PHPMailer\PHPMailer;

//include_once "phpMailer/PHPMailer.php";
//include_once "phpMailer/Exception.php";
//include_once "phpMailer/SMTP.php";

class Mailer
{
    public $username = "123456789@qq.com";//发送的邮箱
    public $password = "*************";//qq邮箱授权码

    public function sendMail($title, $content, $address)
    {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 1;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.qq.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->CharSet = 'UTF-8';
        $mail->FromName = '啦啦啦啦一朵花';
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->From = $this->username;
        $mail->isHTML(true);

        $mail->addAddress($address, "aaa");
        $mail->Subject = $title;
        $mail->Body = $content;
        $status = $mail->send();
        if ($status) {
            return 1;
        } else {
            return 0;
        }
    }


}

// $mail->ErrorInfo();