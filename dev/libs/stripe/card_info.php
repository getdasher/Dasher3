<?php
ini_set('display_errors', 1);
require_once('init.php');
if($_COOKIE['usertype'] == "manager"){
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$custID = $user['stripe_id'];
\Stripe\Stripe::setApiKey("sk_test_t1QVuFRbnYxSCFuhQlwCUYyT");
$customer = \Stripe\Customer::retrieve($custID);
if(isset($customer->sources->data[0]->last4)){
$last4 = $customer->sources->data[0]->last4;
$brand = $customer->sources->data[0]->brand;
$month = $customer->sources->data[0]->exp_month;
$year = $customer->sources->data[0]->exp_year;
}
}
?>