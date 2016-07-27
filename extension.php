<?php
ini_set('display_errors', 1);
session_start();
require 'classes/class.smtp.php';
require 'classes/class.phpmailer.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Members Area | DASHER</title>
<style>
.modal-header{
	background-color: #f4922e;
	  color: #FFF;
	  text-align: center;
	  width: 100%;
	  font-family: 'Open Sans', sans-serif;
	  text-transform: uppercase;
	  position: absolute;
	  left: 0px;
	  top: 0px;
	  z-index: 1000000;
}
.action_button, button {
    text-decoration: none; 
    color: #f37520; 
    border: 1px solid #f37520 !important;
    font-weight: bold; 
    background: #fff; 
    padding: 5px 20px  !important; 
    font-size: 11px; 
    text-transform: uppercase;
	background-image:none !important;
	border-radius: 0 !important;
	box-shadow: none !important;
	min-height: 0 !important;
	height: 25px !important;
	width: auto !important;
	cursor:pointer;
	font-family: 'Open Sans', sans-serif;
}
.entry-content {
   width: 100%;
   font-family: 'Open Sans', sans-serif;
   text-align:center;
}

</style>
</head>
<body>
	<div class="entry-content">
<div class="modal-header">Trial Extension</div>
<?php
if(isset($_POST['message'])){
	$mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'adam.vauthier@gmail.com';                 // SMTP username
	$mail->Password = 'yblstfzlavyjhuri';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;
	$mail->From = $_COOKIE['useremail'];
	$mail->FromName = $_COOKIE['username'];
	$mail->addAddress('info@getdasher.com');     // Add a recipient
	$mail->WordWrap = 250;                                 // Set word wrap to 50 characters

	$mail->Subject = 'Dasher Trial Extension Request';
	$body = 'Dear Dasher Team,<br />A request for extension has been submitted by '.$_COOKIE['useremail'].'<br /><br />Message: '.$_POST['message'].'<br /><br />Thanks,<br />The Dasher Server';
	$mail->msgHTML($body);

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo  '<p style="margin-top:50px;">Thanks your email has been received we will be in touch shortly about your message!</p><a href="/create_account.php" class="action_button" target="_parent" >View Plans ></a> ';
	}
	 }
else{ ?>
	<p style="margin-top:50px;">We want you to get the most out of Dasher. Just let us know why you need an extension and we'd be happy to extend your trial for 2 weeks.<br /><br />
	<form action="" method="post">
		<textarea name="message" rows="4" cols="50"></textarea><br /><br />
		<input type = "submit" class="action_button" value="Request Extension >" />
	</form>
</p><br />
<a href="/create_account.php" class="action_button" target="_parent" >View Plans ></a> 
<?php }
?>
</div>
</body>
</html>