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
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //change this to ENCRYPTION_SMTPS on deploy/STARTTLS on test

    $mail->Host       = 'sandbox.smtp.mailtrap.io'; //change to smtp server of choice
    $mail->Username   = $_ENV['MAILTRAP_USER']; // Replace with your SendGrid username
    $mail->Password   = $_ENV['MAILTRAP_PASS']; // Replace with your SendGrid API key
    $mail->Port       = 465;   

    $mail->setFrom('forms@codesolutionstudios.co.za', 'CSS Form Service'); //the sender of email(from)
    $mail->addAddress('noreply@codesolutionstudios.co.za'); //the reciever of email(to)
    $mail->addReplyTo($visitor_email); //set reply to 

    $email_template = 'mail_template.html';
    $mail_message = file_get_contents($email_template); 
    $mail_message = str_replace('%name%', $name, $message);
    $mail_message = str_replace('%email%', $visitor_email, $message);
    $mail_message = str_replace('%message%', $message, $message);

    $mail->isHTML(true);
    $mail->Subject = 'Contact Form Submission'; //email subject
    $mail->Body    =  $mail_message;//email body
    $mail->AltBody =  $mail_message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
