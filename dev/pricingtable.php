<?php
//ini_set('display_errors', '1');
$BASE_URL = "app.getdasher.com";
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
<link rel='stylesheet' id='dasher-style-css'  href='http://<?php echo $BASE_URL ?>/css/signup_style.css' type='text/css' media='all' />
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://<?php echo $BASE_URL ?>/fancybox/jquery.fancybox.css' type='text/css' media='all' />
<link rel='stylesheet' id='dasher-style-css'  href='http://<?php echo $BASE_URL ?>/css/style.css' type='text/css' media='all' />

<!-- Load JS-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/dasher.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/modernizr.js'></script>
</head>

<body>
 
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
            <a href="#" class="action_button">Start Free</a>
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
            <a href="#" class="callout action_button">Start Free</a>
        </div>
    </li>

        <li class="price_block">
        <h3>Pro</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">- - -</span>
                <span class="price_tenure">Coming Soon</span>
            </div>
        </div>
        <ul class="features">
            <li>Unlimited Hashtags</li>
            <li>Unlimited Galleries</li>
            <li>Client Level Control, API, Multiple Users</li>
        </ul>
        <div class="footer">
            <a href="#" class="action_button">Start Free</a>
        </div>
    </li>
</ul>
 
<script src="prefixfree.min.js" type="text/javascript"></script>

</body>
</html>