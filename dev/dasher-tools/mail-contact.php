<?php
require_once('class.phpmailer.php');

$mail             = new PHPMailer();

$body             = eregi_replace("[\]",'',$body);

$body = "Name: ".$namer."<br />Inquiry: ".$body;

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.getdasher.com"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "mail.getdasher.com"; // sets the SMTP server
$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
$mail->Username   = "noreply@getdasher.com"; // SMTP account username
$mail->Password   = "dasher13";        // SMTP account password

$mail->SetFrom('noreply@getdasher.com', 'Dasher');

$mail->AddReplyTo($email);

$mail->Subject    = "Dasher ".$topic."  Inquiry";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAddress('adam@getdasher.com');

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
}
?>