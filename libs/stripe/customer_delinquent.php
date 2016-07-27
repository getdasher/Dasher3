<?php
ini_set('display_errors', 0);
require_once('init.php');
$delinquent = false;
$custID = 0;
$trial_date = "";
if($_COOKIE['usertype'] == "sub"){
	$dbUsers = new database('users');
	$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['parentId'];
	$user = $dbUsers->getRow($userQuery);
	$custID = $user['stripe_id'];
}
elseif($_COOKIE['usertype'] == "manager"){
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$custID = $user['stripe_id'];
}
\Stripe\Stripe::setApiKey("sk_live_79JSOf9OvcFQlUe2xBCRSGLc");
$customer = \Stripe\Customer::retrieve($custID);
$subscriptionCount = $customer->subscriptions->total_count;
$delinquent_object = $customer->delinquent;
if($delinquent_object == true || $subscriptionCount == 0){
	$_COOKIE['delinquent'] = true;
}
?>