<?php
ini_set('display_errors', 1);
session_start();
require_once('../../classes/class.database.php');
require_once('init.php');
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$custID = $user['stripe_id'];
\Stripe\Stripe::setApiKey("sk_test_t1QVuFRbnYxSCFuhQlwCUYyT");
$customer = \Stripe\Customer::retrieve($custID);
$subData = $customer->subscriptions;
$subID = $subData->data[0]['id'];
$subscription = $customer->subscriptions->retrieve($subID);
$subscription->plan = $_GET['sub'];
$subscription->save();
$query2 = "UPDATE `users` SET `user_type` = '".$_GET['sub']."' WHERE `ID` = ".$_COOKIE['userid'];
$queryResult = $dbUsers->query($query2);
$session = curl_init();
				$customer_id = $_COOKIE['userid'];
				$customerio_url = 'https://track.customer.io/api/v1/customers/'.$_COOKIE['userid'].'/';

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
?>