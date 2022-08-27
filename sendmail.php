<?php
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\PHPExeption; 

    require 'phpmailer/src/Exeption.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru','phpmailer/language/');
    $mail->isHTML(true);

    $mail->setFrom('bocik777@mail.ru', 'Боцик три топора');
    $mail->addAddress('bocik101@mail.ru');
    $mail->Subject = 'Отправка формы от пользователя';

    $body = '<h1>Пользователь предоставил следующие данные:</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя: </strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['number']))){
        $body.='<p><strong>Телефон: </strong> '.$_POST['number'].'</p>';
    }
    if(trim(!empty($_POST['message']))){
        $body.='<p><strong>Сообщение (проблема): </strong> '.$_POST['message'].'</p>';
    }

    $mail->Body = $body;

    if(!$mail->send()){
        $message = 'Ошибка';
    } else {
        $message = 'Данные отправлены';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>