<?php
	ini_set('display_errors', 1);
	session_start();
	require 'classes/class.database.php';
	$dbCamps = new database('users');
	$campaigns = $dbCamps->query('SELECT * FROM `users` WHERE `id` = '.$_GET['id']);
	$user = $dbCamps->getRow($campaigns);
	
	if($user['gallery'] != 'true'){
			$session = curl_init();
			$customer_id = $user['ID']; // You'll want to set this dynamically to the unique id of the user associated with the event
			$customerio_url = 'https://track.customer.io/api/v1/customers/'.$user['ID'].'/events';

			$site_id = '3cb9a8a90558f2a2f041';
			$api_key = '6dc9af926edaf57c5722';

			$data = array("name" => "build_gallery");

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
			$hashQuery3 = 'UPDATE `users` SET `gallery` = "true" WHERE `ID` = '.$user['ID'];
			$hashCheck3 = $dbCamps->query($hashQuery3);
	}
	
	require 'classes/class.phpmailer.php';
	require 'classes/class.smtp.php';

	date_default_timezone_set('Etc/UTC');

	//Create a new PHPMailer instance
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

	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';

	//Set an alternative reply-to address
	$mail->addReplyTo('info@getdasher.com', 'Dasher');

	//Set who the message is to be sent to
	$mail->addAddress($user['email_address'], $user['user_name']);

	//Set the subject line
	$mail->Subject = 'Your Gallery Embed Code';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	
	$body = '<p>Hi '.$user['user_name'].',</p><p>Here\'s the embed code for your gallery.</p><code style="font-size:0.85em;font-family:Consolas,Inconsolata,Courier,monospace;margin:0px 0.15em;padding:0px 0.3em;white-space:pre-wrap;border:1px solid rgb(234,234,234);border-radius:3px;display:inline;background-color:rgb(248,248,248)">&lt;div class="dasher2" &gt;&lt;script type="text/javascript" src="'.$_GET['code'].'" &gt;&lt;/script&gt;&lt;/div&gt;</code><p>If you need help embedding, just reply to this message.<br />We also have a great <a href="http://getdasher.com/faq/#embed_gallery">post</a> on getting things up and running.<br /><br />Thanks,<br />The Dasher Team';
	$mail->msgHTML($body);
	
	$dbName = 'dasher-'.$_GET['id'];
	$db2 = new database($dbName);
	if(isset($_SESSION['gallery-edit-id'])){
	$query = 'UPDATE `galleries` SET `name` = "'.$_GET['title'].'", `code` = "'.$_GET['code'].'" WHERE `ID` = "'.$_SESSION['gallery-edit-id'].'"';
	$result = $db2->query($query);
	echo $_SESSION['gallery-edit-id'];
	}
	else{
	$query = 'INSERT INTO `galleries` (name, code)  VALUES ("'.$_GET['title'].'", "'.$_GET['code'].'")';	
	$result = $db2->query($query);
 	echo mysqli_insert_id($db2->mysqli);
	}

	

?>