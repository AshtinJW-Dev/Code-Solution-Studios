<?php
//get data from form  

$name = $_POST['name'];
$email= $_POST['email'];
$telNumber= $_POST['tel-number'];
$service= $_POST['service'];
$plan= $_POST['plan'];
$message= $_POST['message'];
$to = "codesolutionstudios@gmail.com";
$subject = "Mail From website";
$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Number =" . $telNumber"\r\n Service =" . $service"\r\n Plan =" . $plan"\r\n Message =" . $message;
$headers = "From: noreply@codesolutionstudios.co.za" . "\r\n"
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect
header("Location:index.html");
?>