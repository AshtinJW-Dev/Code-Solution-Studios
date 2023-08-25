<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'vendor/vlucas/phpdotenv/src/Dotenv.php';

$mail = new PHPMailer(true);
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //load .env files
$dotenv->load();

//get info from form
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

try {
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //change this to ENCRYPTION_SMTPS on deploy

    $mail->Host       = 'smtp.sendgrid.net'; //change to smtp server of choice
    $mail->Username   = 'apikey'; // Replace with your SendGrid username
    $mail->Password   = $_ENV['SENDGRID_API_KEY']; // Replace with your SendGrid API key
    $mail->Port       = 465;   

    $mail->setFrom('forms@codesolutionstudios.co.za'); //the sender of email(from)
    $mail->addAddress('noreply@codesolutionstudios.co.za'); //the reciever of email(to)
    $mail->addReplyTo($visitor_email); //set reply to 

    $mail->isHTML(true);
    $mail->Subject = 'Contact Form Submission'; //email subject
    $mail->Body    =  $message ; //email body
    $mail->AltBody =  $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
