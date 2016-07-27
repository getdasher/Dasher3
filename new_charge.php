<?php
ini_set('display_errors', '1');
include('./classes/class.database.php'); 
require_once('./libs/stripe/init.php');
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
//print_r($user);
// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_t1QVuFRbnYxSCFuhQlwCUYyT");

// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];
$coupon = "";
if(isset($_POST['coupon'])){
	$coupon = $_POST['coupon'];
}

// Create the charge on Stripe's servers - this will charge the user's card
try {
$customer = \Stripe\Customer::create(array(
	  "source" => $token,
	  "plan" => $_GET['sub'],
	  "email" => $user['email_address']),
	  "coupon" => $coupon
);
$customer_json = $customer->__toJSON();
$customer_info = json_decode($customer_json);
$stripe_id = $customer_info->id;
$status = 'active';
$query2 = "UPDATE `users` SET `stripe_id` = '".$stripe_id."', `stripe_status` = '".$status."', `user_type` = '".$_GET['sub']."' WHERE `ID` = ".$user['ID'];
$queryResult = $dbUsers->query($query2);
setcookie('stripe', $stripe_id);
$session = curl_init();
				$customer_id = $_COOKIE['userid'];
				$customerio_url = 'https://track.customer.io/api/v1/customers/'.$user['ID'].'/';

				$site_id = '3cb9a8a90558f2a2f041';
				$api_key = '6dc9af926edaf57c5722';
				$data = array("plan_name" => $_GET['sub']);

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
header('Location: http://app.getdasher.com');
} catch(\Stripe\Error\Card $e) {
  echo $e;
}



?>