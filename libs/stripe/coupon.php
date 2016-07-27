<?php
ini_set('display_errors', 1);
require_once('init.php');
\Stripe\Stripe::setApiKey("sk_live_79JSOf9OvcFQlUe2xBCRSGLc");
$coupon = \Stripe\Coupon::retrieve($_GET['coupon']);
if($coupon['percent_off'] != ""){
	$percentOff = $coupon['percent_off'];
}
elseif($coupon['amount_off'] != ""){
	$amountOff = sprintf('%.2f', $coupon['amount_off'] / 100);
}
else{
	$discountError = "coupon not found";
}
?>