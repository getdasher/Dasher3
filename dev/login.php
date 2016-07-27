<?php
//ini_set('display_errors', '1');
$BASE_URL = "app.getdasher.com";
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$out = $_GET['out'];
require_once('classes/class.database.php');
require_once('classes/class.authorization.php');

if(isset($_POST['username'])){
	if(login($_POST['username'], $_POST['password']) == 3){
			header('Location: /campaign-display/');
		}
		else{
			$out = "Sorry that username and password don't match those on file.";
		}
}
elseif(isset($_GET['google'])){
	$out = "Sorry that username and password don't match those on file.";
}
elseif(isset($_POST['pass-email'])){
	$out = sendPassReset($_POST['pass-email']);
}
elseif(isset($_POST['passwordconfirm'])){
	$setPass = updatePassword($_POST['val_id']);
	if ($setPass == true){
		$passSet = "Password Successfully Updated.";
	}
	else{
		$passSet = "Sorry there was an error.";
	}
}
elseif($_GET['q'] == "newpass"){
	$validationID = $_GET['val_id'];
	$passOut = "true";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Members Area | DASHER</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="http://app.getdasher.com/xmlrpc.php">

<!-- Load Stylesheet-->
<link rel="stylesheet" href="/libs/font-awesome/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600' rel='stylesheet' type='text/css'>
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://app.getdasher.com/fancybox/jquery.fancybox.css' type='text/css' media='all' />
<link rel='stylesheet' id='dasher-style-css'  href='http://app.getdasher.com/css/style.css' type='text/css' media='all' />

<!-- Load JS-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript' src='http://app.getdasher.com/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/doubletaptogo.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/dasher.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/modernizr.js'></script>
<script src="https://apis.google.com/js/client:platform.js" async defer></script>
<script type='text/javascript'>
	$(document).ready(function(){
	$('.alertx').click(function(){
		$('.login-alerts').fadeOut();
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
		  $.post( "http://app.getdasher.com/googleLogin.php", { account: $emails})
		  .done(function( data2 ) {
		    	if(data2 == 'Authenticated'){
					window.location = "http://app.getdasher.com/";
				}
				else{
					$.post( "http://app.getdasher.com/user_create.php", { email: $emails, name: $name})
					.done(function( data3 ) {
						$.post( "http://app.getdasher.com/googleLogin.php", { account: $emails})
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
	
	// This is called with the results from from FB.getLoginStatus().
	  function statusChangeCallback(response) {
	    console.log('statusChangeCallback');
	    console.log(response);
	    // The response object is returned with a status field that lets the
	    // app know the current login status of the person.
	    // Full docs on the response object can be found in the documentation
	    // for FB.getLoginStatus().
	    if (response.status === 'connected') {
	      // Logged into your app and Facebook.
	      testAPI();
	    } else if (response.status === 'not_authorized') {
	      // The person is logged into Facebook, but not your app.
	      //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
	    } else {
	      // The person is not logged into Facebook, so we're not sure if
	      // they are logged into this app or not.
	      //document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
	    }
	  }

	  // This function is called when someone finishes with the Login
	  // Button.  See the onlogin handler attached to it in the sample
	  // code below.
	  function checkLoginState() {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
	  }

	  window.fbAsyncInit = function() {
	  FB.init({
	    appId      : '446129668847368',
	    cookie     : true,  // enable cookies to allow the server to access 
	                        // the session
	    xfbml      : true,  // parse social plugins on this page
	    version    : 'v2.2' // use version 2.2
	  });

	  // Now that we've initialized the JavaScript SDK, we call 
	  // FB.getLoginStatus().  This function gets the state of the
	  // person visiting this page and can return one of three states to
	  // the callback you provide.  They can be:
	  //
	  // 1. Logged into your app ('connected')
	  // 2. Logged into Facebook, but not your app ('not_authorized')
	  // 3. Not logged into Facebook and can't tell if they are logged into
	  //    your app or not.
	  //
	  // These three cases are handled in the callback function.

	  FB.getLoginStatus(function(response) {
	    statusChangeCallback(response);
	  });

	  };

	  // Load the SDK asynchronously
	  (function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

	  // Here we run a very simple test of the Graph API after login is
	  // successful.  See statusChangeCallback() for when this call is made.
	  function testAPI() {
	    FB.api('/me', function(response) {
		  $.post( "http://app.getdasher.com/googleLogin.php", { account: response.email})
		  .done(function( data2 ) {
		    	if(data2 == 'Authenticated'){
					window.location = "http://app.getdasher.com/";
				}
				else{
					$.post( "http://app.getdasher.com/user_create.php", { email: response.email, name: response.name})
					.done(function( data3 ) {
						$.post( "http://app.getdasher.com/googleLogin.php", { account: response.email})
						  .done(function( data4 ) {
						window.location = "http://app.getdasher.com/";
					});
					});
				}
		  });
	    });
	  }
</script>
</head>
<body class="page login">
	<div class="login-content">
		<a href="/"><div class="login-logo"></div></a>
<?php if(isset($_GET['pass'])): ?>
		<form name="password-reset" action="<?php echo $actual_link; ?>" method="post">
			<input type="text" name="pass-email" placeholder="Email Address" />
			<input type="submit" name="submit" value="SEND EMAIL &gt;" />
		</form>
		<a href="http://app.getdasher.com/signup/">Create Account</a><div>
		<?php if($_GET['out']){ echo '<div class="login-alerts"><span class="alert-text">'.$_GET['out'].'<br /><br /></span><span class="alertx"><i class="fa fa-times-circle"></i></span><div style="clear:both;"></div></div>'; } ?>
<?php elseif(isset($_GET['create'])): ?>
				<form name="login" action="<?php echo $actual_link; ?>" method="post">
					<input type="text" name="username" placeholder="Email Address" />
					<input type="password" name="password" placeholder="Password" />
					<input type="submit" name="submit" value="SIGN UP &gt;" />
				</form>
<?php elseif(isset($passOut)): ?>
			<form name="newpass" action="<?php echo $actual_link; ?>" method="post">
			<input type="password" name="password" placeholder="New Password" class="newPassInput" />
			<input type="password" name="passwordconfirm" placeholder="Password Confirmation" />
			<input type="hidden" name="val_id" value="<?php echo $_GET['val_id']; ?>" />
			<input type="submit" name="submit" value="UPDATE PASSWORD &gt;" />
<?php elseif(isset($passSet)): ?>
			<form name="login" action="<?php echo $actual_link; ?>" method="post">
				<input type="text" name="username" placeholder="Email Address" />
				<input type="password" name="password" placeholder="Password" />
				<input type="submit" name="submit" value="SIGN IN &gt;" />
			</form>
			<a href="http://app.getdasher.com/signup/">Create Account</a>
			<a href="/login/?pass=lost">Forgot Password?</a></div>
			<div class="login-alerts">
			<?php echo $passSet; ?>
			</div>
<?php else: ?>
		<form name="login" action="<?php echo $actual_link; ?>" method="post">
			<input type="text" name="username" placeholder="Email Address" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" name="submit" value="SIGN IN &gt;" />
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
		<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" data-size="large">
		</fb:login-button>

		<div id="status">
		</div>
		</span>
		<a href="http://app.getdasher.com/signup/">Create Account</a>
		<a href="/login/?pass=lost">Forgot Password?</a>
		</div>
		<?php if($out != ""){
			echo '<div class="login-alerts"><span class="alert-text">'.$out.'</span><span class="alertx"><i class="fa fa-times-circle"></i></span><div style="clear:both;"></div></div>';
		}
		?>
<?php endif; ?>
		<div class="login-footer">
			&copy;<?php echo date('Y'); ?> Dasher <a href="http://getdasher.com/" target="_blank">About</a> | <span class="support-link"><a href="/contact">Contact</a></span>
		</div>
	</div>
</body>
</html>