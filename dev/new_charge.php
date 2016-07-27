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

// Create the charge on Stripe's servers - this will charge the user's card
try {
$customer = \Stripe\Customer::create(array(
	  "source" => $token,
	  "plan" => $_GET['sub'],
	  "email" => $user['email_address'])
);
$customer_json = $customer->__toJSON();
$customer_info = json_decode($customer_json);
$stripe_id = $customer_info->id;
$status = 'active';
$query2 = "UPDATE `users` SET `stripe_id` = '".$stripe_id."', `stripe_status` = '".$status."', `user_type` = '".$_GET['sub']."' WHERE `ID` = ".$user['ID'];
$queryResult = $dbUsers->query($query2);
setcookie('stripe', $stripe_id);
header('Location: http://app.getdasher.com');
} catch(\Stripe\Error\Card $e) {
  echo $e;
}



?>