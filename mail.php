<?php
require_once 'actions.php';
require_once 'functions.php';

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$sum = $_SESSION['sum'];

// function formText() {
//     if ( isset($_GET['phone']) && isset($_GET['name'])) {
//       session_destroy();
//       return 'Спасибо за заказ. С вами скоро свяжутся!';
//     } else {
//       return 'оформить заказ';
//     }
// }

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'andreyforprog@gmail.com'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'ofnyiognzwfrifsq'; // Ваш пароль от почты с которой будут отправляться письма
$mail->Port = 587; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('dzharuzov@mail.ru'); // от кого будет уходить письмо?
$mail->addAddress('andreyforprog@gmail.com');     // Кому будет уходить письмо
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$goodsMail = '';
$user = 'имя клиента - ' . $name . '; '. 'номер: '. $phone . '; mail клиента - ' . $email . '; <br>';

foreach ($_SESSION['CartId'] as $id) {
    $gg = getGoods('', $id['id']);
    $goodsMail = $goodsMail . 'товар - ' . $gg[0]['good'] . ', колличество - ' . $id['quantity'] . ', по цене - ' . $gg[0]['price'] . '<hr>';
}

$mail->Subject = 'Заказ с сайта';
$mail->Body = $user . $goodsMail . '<h4>сумма заказа: ' . $sum . ';</h4>';
$mail->AltBody = '';


if(!$mail->send()) {
    echo 'Error';
} else {
    header('location: ty.php');
    session_destroy();
}
?>