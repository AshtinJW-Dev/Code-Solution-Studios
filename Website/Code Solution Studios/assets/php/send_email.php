<?php
$to = 'recipient@example.com';
$subject = 'Test Email';
$message = 'This is a test email sent from XAMPP.';
$headers = 'From: sender@example.com' . "\r\n" .
           'Reply-To: sender@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
   echo 'Email sent successfully!';
} else {
   echo 'Error: Unable to send email.';
}
?>