<?php
use PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php'
require 'phpmailer/src/PHPMailer.php'

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->IsHTML(true);

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'flong.destre@yandex.ru'; // Логин на почте
    $mail->Password   = '43215768As'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('flong.destre@yandex.ru', 'Имя отправителя'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('deps.whip@gmail.com');

$mail->Subject = 'Контакт'

$hand = "Правая";
if($_POST['hand'] == "left"){
	$hand = "Левая";
}

$body = '<h1>Номер</h1>';

if(trim(!empty($_POST['form__input']))){
	$body.='<p><strong>Номер:</strong> '.$_POST['form__input'].'</p>';
}

if (!$mail->send()) {
	$message = 'Ошибка';
}else{
	$message = 'Данные отправленны!';
}

$response =['message'=> $message];

header('Content-type: application/json');
echo json_encode($response);
?>