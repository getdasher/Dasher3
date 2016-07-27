<?php
//ini_set('display_errors', '1');
$BASE_URL = "dev.getdasher.com";
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$out = "";
require_once('classes/class.database.php');
require_once('classes/class.authorization.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sign Up | DASHER</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="http://<?php echo $BASE_URL ?>/xmlrpc.php">

<!-- Load Stylesheet-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600' rel='stylesheet' type='text/css'>
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://<?php echo $BASE_URL ?>/fancybox/jquery.fancybox.css' type='text/css' media='all' />
<link rel='stylesheet' id='dasher-style-css'  href='http://<?php echo $BASE_URL ?>/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='dasher-style-css'  href='http://<?php echo $BASE_URL ?>/css/signup_style.css' type='text/css' media='all' />

<!-- Load JS-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/dasher.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/modernizr.js'></script>
</head>

<body class="page login">
<div class="newsignup-form">
	<img src = '/images/login-logo.jpg'>
	<h1>Create Your Account</h1>
	<br/>
	<p>Sign Up to start using Dasher!</p>
	<form method="POST" class="signup-form" action="http://app.getdasher.com/user_create.php">
		<input type="text" name="name" placeholder="First Name"><br>
		<input type="text" name="email" placeholder="Email Address"><br>
		<input type="text" name="password" placeholder="Password"><br>
		<input type="submit" value="Sign Up >" name="submit"><br>
	</form>
	<a href="login.php">Already have an account? Sign In</a>
</div>

<div class="infoscreen">
	<div class="info">
		<h3>Dasher is <strong><i>free</i></strong> to use while in public beta.</h3>
		<br/>
		We’d love a <a href="http://twitter.com/home?status=Trying%20out%20Dasher%20(%40GetDasher)%20to%20build%20a%20gallery%20of%20my%20customer%27s%20photos.%20http%3A%2F%2Fgetdasher.com%2F"target="_blank">tweet</a>, a <a href="https://www.facebook.com/sharer/sharer.php?u=http://getdasher.com/"target="_blank">share</a>, or even a <a href="mailto:casey@getdasher.com?subject=Trying Out Dasher"target="_blank">quick line</a> about how you’ll use Dasher.
	</div>
	<div class="screenshot">
		<img src = '/images/dasher_sign_up.png'>
	</div>
</div>
<div style="clear:both;"></div>
<!-- PRICING TABLE -->
<div class="pricing">
<ul class="pricing_table">
     
    <li class="price_block">
        <h3>Basic</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$24.99</span>
                <span class="price_tenure">per month</span>
            </div>
        </div>
        <ul class="features">
            <li>3 Active Hashtags</li>
            <li>1 Active Gallery</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
			<form action="/charge" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Start Trial"
			    data-description="Basic Plan"
			    data-amount="2499">
			  </script>
			</form>
        </div>
    </li>

        <li class="callout price_block">
        <h3 class="callout">Business</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$79.99</span>
                <span class="price_tenure">per month</span>
            </div>
        </div>
        <ul class="features">
            <li>15 Active Hashtags</li>
            <li>5 Active Galleries</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
            <form action="/charge" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Start Trial"
			    data-description="Business Plan"
			    data-amount="7999">
			  </script>
			</form>
        </div>
    </li>

        <li class="price_block">
        <h3>Pro</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$499.99</span>
                <span class="price_tenure">per month</span>
            </div>
        </div>
        <ul class="features">
            <li>Unlimited Hashtags</li>
            <li>Unlimited Galleries</li>
            <li>Client Dashboard Control</li>
            <li>API Connectivity</li>
            <li>Multiple Users</li>
        </ul>
        <div class="footer">
            <form action="/charge" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Start Trial"
			    data-description="Pro Plan"
			    data-amount="49999">
			  </script>
			</form>
        </div>
    </li>
</ul>
 </div>
<!-- END PRICING TABLE -->
<?php include_once('footer.php'); ?>