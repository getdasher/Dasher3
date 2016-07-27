<?php
ini_set('display_errors', 1);
require_once('init.php');
\Stripe\Stripe::setApiKey("sk_test_t1QVuFRbnYxSCFuhQlwCUYyT");
$customer = \Stripe\Customer::retrieve("cus_5vzKqDLPakFshR");
$subData = $customer->subscriptions;
$subID = $subData->data[0]['id'];
$subscription = $customer->subscriptions->retrieve($subID);
$subscription->plan = '1';
$subscription->save();
echo $subscription;
?>