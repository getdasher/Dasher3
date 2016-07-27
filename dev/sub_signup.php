<?php
ini_set('display_errors', 1);
$BASE_URL = "app.getdasher.com";
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$out = "";
require_once('classes/class.database.php');
require_once('classes/class.authorization.php');

$email = $_GET['email'];

$database = new database('users');
$selectionQuery = $database->query('SELECT * FROM `users` WHERE `email_address` = "'.$email.'"');
$selection = $database->getRow($selectionQuery);
if($selection['password']){
	header('Location: http://app.getdasher.com/login/');
}
else{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Members Area | DASHER</title>
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
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script type='text/javascript'>
jQuery(document).ready(function(){
$("#form1").validate();

$("#form1").submit(function(e){
	$pass1 = jQuery('#password').val();
	$pass2 = jQuery('#password-check').val();

	console.log($pass2);
	if($pass1 == $pass2){
		
	}
	else{
		jQuery('.error').html('Passwords Do Not Match.');
				return false;
	}

});
});
</script>
</head>

<body class="page login">
<div class="content-wrap">
<div class="newsignup-form">
	<img src = '/images/login-logo.jpg'>
	<h1>We just need a couple of pieces of information!</h1>
	<br/>
	<p>Sign Up to start using Dasher!</p>
	<form method="POST" class="signup-form" id="form1" action="http://app.getdasher.com/user_sub_create.php">
		<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" />
		<input type="password" name="password" placeholder="Password" id="password" title="Please enter your password, between 5 and 12 characters" required /><br />
		<input type="password" name="password-check" id="password-check" placeholder="Confirm Password" required /><br />
		<div class="error"></div>
		<input type="submit" value="Sign Up >" name="submit" /><br />
	</form>
</div>

<div class="infoscreen">
	<div class="info">
		We’d love a <a href="http://twitter.com/home?status=Trying%20out%20Dasher%20(%40GetDasher)%20to%20build%20a%20gallery%20of%20my%20customer%27s%20photos.%20http%3A%2F%2Fgetdasher.com%2F"target="_blank">tweet</a>, a <a href="https://www.facebook.com/sharer/sharer.php?u=http://getdasher.com/"target="_blank">share</a>, or even a <a href="mailto:casey@getdasher.com?subject=Trying Out Dasher"target="_blank">quick line</a> about how you’ll use Dasher.
	</div>
	<div class="screenshot">
		<img src = '/images/dasher_sign_up.png'>
	</div>
</div>
</div>
<?php } include_once('footer.php'); ?>