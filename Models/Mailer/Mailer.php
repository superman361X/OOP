<?php

namespace Models\Mailer;

use PHPMailer\PHPMailer\PHPMailer;

//use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    const USERNAME = "554157247@qq.com";//发送的邮箱
    const PASSWORD = "lmhqcjhpduinbdbf";//qq邮箱授权码

    protected $params = [];

    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }


    public function send()
    {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.qq.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->CharSet = 'UTF-8';
        $mail->FromName = 'zhouc';
        $mail->Username = self::USERNAME;
        $mail->Password = self::PASSWORD;
        $mail->From = self::USERNAME;
        $mail->isHTML(true);

        $mail->addAddress($this->params['address'], "SS");
        $mail->Subject = $this->params['title'];
        $mail->Body = $this->params['content'];
        $status = $mail->send();
        if ($status) {
            return 1;
        } else {
            return 0;
        }
    }


}

// $mail->ErrorInfo();