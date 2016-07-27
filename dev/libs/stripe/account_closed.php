<?php
session_start();
require_once('../../classes/class.database.php');
require_once('init.php');
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$custID = $user['stripe_id'];
\Stripe\Stripe::setApiKey("sk_test_t1QVuFRbnYxSCFuhQlwCUYyT");
$customer = \Stripe\Customer::retrieve($custID);
$token = $_POST['stripeToken'];
$cardDeleteId = $customer->sources->data[0]->id;
$customer->sources->retrieve($cardDeleteId)->delete();
header( 'Location: http://dev.getdasher.com/my-account/?alert=closed' ) ;
?>