<?php
require_once('classes/class.database.php');
if(session_id() == '') {
    session_start();
}
	$database = new database('users');
	$email = $_POST['account'];
	$selectionQuery = $database->query('SELECT * FROM `users` WHERE `email_address` = "'.$email.'"');
	$selection = $database->getRow($selectionQuery);
	if($selection){
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
	
					echo "Authenticated";
}