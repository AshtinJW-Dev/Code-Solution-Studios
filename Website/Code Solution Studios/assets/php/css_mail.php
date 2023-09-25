<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'vendor/vlucas/phpdotenv/src/Dotenv.php';

function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}


$errors = [];
$errorMessage = '';
$successMessage = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client= 'Big Poppa';
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $message = sanitizeInput($_POST['message']);
    $option = $_POST['radio'];
    //$example = sanitizeInput($_POST['example']);

    $template = file_get_contents('css_email.html');

    $template = str_replace('{client}', $client, $template);
    $template = str_replace('{name}', $name, $template);
    $template = str_replace('{email}', $email, $template);
    $template = str_replace('{radio}', $option, $template);
    //$template = str_replace('{example}', $example, $template);
    $template = str_replace('{message}', $message, $template);
  
  if (empty($name)) {
    $errors[] = 'Name is empty';
  }
  if (empty($email)) {
    $errors[] = 'Email is empty';
  }  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email is invalid';
  }

  if (!empty($errors)) {
    $allErrors = join('<br/>', $errors);
    $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
  } else {
    $emailSubject = 'New email from your contact form';

      // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //load .env files
        $dotenv->load();
        try {
            // Configure the PHPMailer instance
            $mail->isSMTP();
            $mail->Host = 'smtp.sendgrid.net';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SENDGRID_USER'];
            $mail->Password = $_ENV['SENDGRID_API_KEY'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //STARTTLS or SMTPs
            $mail->Port = 465;

            // Set the sender, recipient, subject, and body of the message
            $mail->setFrom($_ENV['FROM_EMAIL'], $name);
            $mail->addAddress($_ENV['TO_EMAIL']);
            $mail->Subject = $emailSubject;
            $mail->isHTML(true);
            $mail->Body = $template;

            // Send the message
            $mail->send();

            // After sending email
            $response = ['success' => true]; // Or false for failure
            echo json_encode($response);

        } catch (Exception $e) {
      $errorMessage = "Oops, something went wrong. Please try again later";
      echo json_encode(['error' => $errorMessage]);
    }
  }
}
