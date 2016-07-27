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
?>