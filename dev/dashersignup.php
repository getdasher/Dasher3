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
<script src="https://apis.google.com/js/client:platform.js" async defer></script>
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

function signinCallback(authResult) {
  if (authResult['status']['signed_in']) {
    // Update the app to reflect a signed in user
    // Hide the sign-in button now that the user is authorized, for example:
    document.getElementById('signinButton').setAttribute('style', 'display: none');
	$getPerson = 'https://www.googleapis.com/plus/v1/people/me?access_token='+authResult['access_token'];
	$.get( $getPerson, function( data ) {
	  console.log(data);
	  $name = data['name']['givenName'];
	  $emails = data['emails'][0]['value'];
	  $.post( "/googleLogin.php", { account: $emails})
	  .done(function( data2 ) {
	    	if(data2 == 'Authenticated'){
				window.location = "http://app.getdasher.com/";
			}
			else{
				$.post( "/user_create.php", { email: $emails, name: $name})
				.done(function( data3 ) {
					$.post( "/googleLogin.php", { account: $emails})
					  .done(function( data4 ) {
					window.location = "http://app.getdasher.com/";
				});
				});
			}
	  });
	});
	
  } else {
    // Update the app to reflect a signed out user
    // Possible error values:
    //   "user_signed_out" - User is signed-out
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatically log in the user
    console.log('Sign-in state: ' + authResult['error']);
  }
}

</script>
</head>

<body class="page login">
<div class="content-wrap">
<div class="newsignup-form">
	<img src = '/images/login-logo.jpg'>
	<h1>Create Your Account</h1>
	<br/>
	<p>Sign Up to start using Dasher!</p>
	<form method="POST" class="signup-form" id="form1" action="/user_create.php">
		<input type="text" name="name" placeholder="First Name" title="Please enter your name" required /><br />
		<input type="text" name="email" title="Please enter your email" required <?php if(isset($_POST['email'])){echo 'placeholder="'.$_POST['email'].'" value="'.$_POST['email'].'"';} else { echo 'placeholder="Email Address"'; } ?> />
		<input type="password" name="password" placeholder="Password" id="password" title="Please enter your password, between 5 and 12 characters" required /><br />
		<input type="password" name="password-check" id="password-check" placeholder="Confirm Password" required /><br />
		<div class="error"></div>
		<input type="submit" value="Sign Up >" name="submit" /><br />
	</form>
	<span id="signinButton">
  <span
    class="g-signin"
    data-callback="signinCallback"
    data-clientid="455856658160-fuhgc7gmhtc6ihbdl1etc90hn0kr5csb.apps.googleusercontent.com"
    data-cookiepolicy="single_host_origin"
    data-requestvisibleactions="http://schema.org/AddAction"
    data-scope="https://www.googleapis.com/auth/plus.profile.emails.read">
  </span>
</span>
<div id="status">
</div>
	<a href="http://app.getdasher.com/">Already have an account? Sign In</a>
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
</div>
<?php include_once('footer.php'); ?>