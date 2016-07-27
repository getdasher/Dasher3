<?php
if(session_id() == '') {
    session_start();
}
require 'class.smtp.php';
require 'class.phpmailer.php';

function login($email, $password)
{
	$match = false;
	session_regenerate_id(true); 
	$database = new database('users');

	$selectionQuery = $database->query('SELECT * FROM `users` WHERE `email_address` = "'.$email.'"');
	$selection = $database->getRow($selectionQuery);

	$password = $database->hashData($password);
	if($selection['password'] == $password){
		$match = true;
	}
		
	$is_active = (boolean) $selection['tou_stamp'];
	setcookie('stripe', '');
	if($match == true) {
		if($is_active == true) {
				if($selection['sub'] != 0){
					$parentQuery = $database->query('SELECT * FROM `users` WHERE `ID` = "'.$selection['sub'].'"');
					$parent = $database->getRow($parentQuery);
					setcookie("username", $selection['name']);
					setcookie("useremail", $selection['email_address']);
					setcookie("userid", $selection['ID']);
					setcookie("userloggedIn", true, strtotime( '+3 days' ));
					setcookie("userdatabase", 'dasher-'.$selection['sub']);
					setcookie("usertype", "sub");
					setcookie("parentId", $selection['sub']);
					setcookie("trial_stamp", $parent['trial_stamp']);
					setcookie('parentEmail', $parent['email_address']);
					setcookie('stripe', $parent['stripe_id']);
				}
				else{
					setcookie("username", $selection['name']);
					setcookie("useremail", $selection['email_address']);
					setcookie("userid", $selection['ID']);
					setcookie("userloggedIn", true, strtotime( '+3 days' ));
					setcookie("userdatabase", 'dasher-'.$selection['ID']);
					setcookie("usertype", "manager");
					setcookie("trial_stamp", $selection['trial_stamp']);
					setcookie('stripe', $selection['stripe_id']);
				}
				$session = curl_init();
								$customer_id = $_COOKIE['userid'];
								$customerio_url = 'https://track.customer.io/api/v1/customers/'.$selection['ID'].'/events';

								$site_id = '3cb9a8a90558f2a2f041';
								$api_key = '6dc9af926edaf57c5722';

								$data = array("name" => "sign_in");

								curl_setopt($session, CURLOPT_URL, $customerio_url);
								curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
								curl_setopt($session, CURLOPT_HEADER, false);
								curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($session, CURLOPT_VERBOSE, 1);
								curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
								curl_setopt($session, CURLOPT_POSTFIELDS,http_build_query($data));

								curl_setopt($session,CURLOPT_USERPWD,$site_id . ":" . $api_key);

								if(ereg("^(https)",$request)) curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);

								curl_exec($session);
								curl_close($session);
				if($selection['signin'] != "true"){
					$session2 = curl_init();
					$customer_id = $_COOKIE['userid'];
					$customerio_url = 'https://track.customer.io/api/v1/customers/'.$selection['ID'].'/events';

					$site_id = '3cb9a8a90558f2a2f041';
					$api_key = '6dc9af926edaf57c5722';

					$data = array("name" => "sign_in");

					curl_setopt($session2, CURLOPT_URL, $customerio_url);
					curl_setopt($session2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
					curl_setopt($session2, CURLOPT_HEADER, false);
					curl_setopt($session2, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($session2, CURLOPT_VERBOSE, 1);
					curl_setopt($session2, CURLOPT_CUSTOMREQUEST, 'POST');
					curl_setopt($session2, CURLOPT_POSTFIELDS,http_build_query($data));

					curl_setopt($session2,CURLOPT_USERPWD,$site_id . ":" . $api_key);

					if(ereg("^(https)",$request)) curl_setopt($session2,CURLOPT_SSL_VERIFYPEER,false);

					curl_exec($session2);
					curl_close($session2);
					$hashQuery3 = 'UPDATE `users` SET `signin` = "true" WHERE `id` = '.$selection['ID'];
					$hashCheck3 = $database->query($hashQuery3);
				}
				return 3;
		} else {
			return 2;
		}
		
	}
}

function sendPassReset($email){
	$database = new database('users');
	$checkQuery = $database->query('SELECT * FROM `users` WHERE `email_address` = "'.$email.'"');
	if($database->hasRows($checkQuery)){
	$selection = $database->getRow($checkQuery);
		
	if($database->hasRows($checkQuery)){
		$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'adam.vauthier@gmail.com';                 // SMTP username
		$mail->Password = 'yblstfzlavyjhuri';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		$mail->From = 'info@getdasher.com';
		$mail->FromName = 'Dasher';
		$mail->addAddress($selection['email_address'], $selection['user_name']);     // Add a recipient

		$mail->WordWrap = 250;                                 // Set word wrap to 50 characters
                                // Set email format to HTML
		
		$validation_id = generateRandomCode();
		$db2 = new database('validators');
		$insertValidator = $db2->query('INSERT INTO password_reset (`validation_key`,`user_id`) VALUES ("'.$validation_id.'","'.$selection['ID'].'")');

		$mail->Subject = 'Dasher Password Reset';
		$body = 'Dear '.$selection['user_name'].',<br />You have requested to reset your Dasher password. Please click the link below to set a new password.<br /><br /><a href="app.getdasher.com/login.php?q=newpass&val_id='.$validation_id.'">Click to reset password</a><br /><br />If you did not make this request or did so in error, simply disregard and delete this message.<br /><br />Thanks,<br />The Dasher Team';
		$mail->msgHTML($body);

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    return  'A password reset link has been sent to you. Please check your email.';
		}
	}
	}
	else{
		$_GET['out'] = 'Sorry that email is not registered.';
		$_GET['pass'] = "TRUE";
	}
}

function updatePassword($validationID){
	$database = new database('validators');
	$checkQuery = $database->query('SELECT * FROM `password_reset` WHERE `validation_key` = "'.$validationID.'"');
	$db2 = new database('users');
	if($database->numRows($checkQuery) > 0){
		$insertPass = $database->hashData($_POST['password']);
		$validationData = $database->getRow($checkQuery);
		$insertUser = $validationData['user_id'];
		$update = $db2->query('UPDATE `users` SET password="'.$insertPass.'" WHERE ID = "'.$insertUser.'"');
		$deleteQuery = $database->query('DELETE FROM `password_reset` WHERE `validation_key` = "'.$validationID.'"');
		return true;
	}
	else{
		$deleteQuery = $database->query('DELETE FROM `password_reset` WHERE `validation_key` = "'.$validationID.'"');
		return false;
	}
}

function logout($email){
	session_destroy ( void );
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}
	return 1;
}

function session_check(){
	if(isset($_COOKIE['userloggedIn'])){
		return true;
	}
}

function get_id($username){
	$db = new database('users');
	$check_query = "SELECT * FROM `users` WHERE `email_address` = '".$username."'";
	$checkUser = $db->query($check_query);
	if($db->hasRows($checkUser) == true){
		$row = $db->getRow($checkUser);
			$id = $row['ID'];
			return $id;
	}
	else{
		return false;
	}
}

function generateRandomCode($l = 10){   
	$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	return substr(str_shuffle($alpha_numeric), 0, $l);
}
?>