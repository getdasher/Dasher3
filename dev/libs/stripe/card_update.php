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
print_r($customer);
?>