<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

$orders = isset($_POST['orders']) ? $_POST['orders'] : null;
$order_price = isset($_POST['order_price']) ? $_POST['order_price'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$subject = "ORDER!";
//$subject = isset($_POST['subject']) ? $_POST['subject'] : 'E-posta Konusu';
$content = isset($_POST['content']) ? $_POST['content'] : null;
$orders .= "<br>";
$orders .= $content;
$orders .= "<br>";
$orders .= $order_price;
try {

    $mail->setLanguage('tr');
    //$mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.live.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'abdurrahmanuzmez@outlook.com';
    $mail->Password = 'IaAFRA.Ss1';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // maili gönderen kişi
    $mail->setFrom('abdurrahmanuzmez@outlook.com');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $orders;
    $mail->AltBody = $content;

    $mail->send();

    $data = file_get_contents("4d-thank-you.php");
    echo $data;

} catch (Exception $e){
    echo $e->errorMessage();
}