<?php
ini_set('display_errors', 0);
session_start();
$BASE_URL = "app.getdasher.com";
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
	<div class="login-content" style="width:80%;">
		<a href="/"><div class="login-logo"></div></a>
<p class="p1"><span class="s1">THIS AGREEMENT is entered into as of today by and between USER, and DASHER LLC, with its primary address at 321 E GALENA, BUTTE, MT USA 59701.</span></p>
<ol class="ol1">
  <li class="li3"><span class="s2"></span><span class="s3">Functionality, Performance, &amp; Deliverables</span></li>
  <ol class="ol2">
    <li class="li3"><span class="s2"></span><span class="s1">The Dasher platform and software, hereafter referred to as SERVICE will search media associated with hashtags determined and established by the User.</span></li>
    <ol class="ol3">
      <li class="li3"><span class="s2"></span><span class="s1">Dasher <b>re-displays</b> information, more specifically images, and their respective “post”</span><span class="s4"> </span><span class="s1">text associated with hashtags established by DASHER’s users.</span></li>
    </ol>
    <li class="li3"><span class="s2"></span><span class="s1">Account set-up and management will occur on DASHER’s servers at http://app.getdasher.com.</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">Widget</span></li>
    <ol class="ol3">
      <li class="li3"><span class="s2"></span><span class="s1">Dasher will provide User with code allowing the organization to display a stream of images on it’s website within the page of their choice.</span></li>
    </ol>
    <li class="li3"><span class="s2"></span><span class="s1">Survey &amp; Feedback</span></li>
    <ol class="ol3">
      <li class="li4"><span class="s2"></span><span class="s1">Dasher may contact to User by email or other provided and preferred method of contact to conduct a performance and feedback survey.<span class="Apple-converted-space"> </span></span></li>
    </ol>
  </ol>
  <li class="li3"><span class="s2"></span><span class="s3">Appearance of the Dasher Name and Brand</span></li>
  <ol class="ol2">
    <li class="li4"><span class="s2"></span><span class="s1">As part of this beta usage agreement the DASHER app identity may appear on widgets and other extensions of the service outside the primary dashboard for promotional and marketing purposes.</span></li>
  </ol>
  <li class="li3"><span class="s2"></span><span class="s3">Integrated 3rd Party Solutions &amp; Networks</span></li>
  <ol class="ol2">
    <li class="li3"><span class="s2"></span><span class="s1">DASHER utilizes Google+, Instagram, Facebook, &amp; Twitter API connections to aggregate information.</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">DASHER’s use of the APIs outlined in section III - A. of this agreement is approved by but is not affiliated with, representative of, or authorized by said organizations.</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">User agrees to the attached appendix Google+, Instagram, Facebook, &amp; Twitter user agreements.</span></li>
  </ol>
</ol>
<p class="p2"><span class="s1"></span><br></p>
<ol class="ol1">
  <li class="li3"><span class="s2"></span><span class="s3">Billing and Collection Policies and Procedures</span></li>
  <ol class="ol2">
    <li class="li3"><span class="s2"></span><span class="s1">When You register to use the Services, You may be required to select a payment option to subscribe for the Services which will include a price and minimum billing term.</span></li>
    <ol class="ol3">
      <li class="li3"><span class="s2"></span><span class="s1">Both the price, billing interval, and minimum billing term will be made expressly clear to you before you make any payment. If you feel you have been billed in error due to a miscommunication, contact us immediately at info@getdasher.com</span></li>
    </ol>
    <li class="li3"><span class="s2"></span><span class="s1">You may be eligible to a free trial, of a specified period commencing at the time of registration, which will allow access to the services without choosing a payment option or entering any billing details</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">Your Account will automatically renew at the end of the minimum term, in intervals of 1 month or 1 year; depending on options chosen at the time of choosing a payment plan; until terminated.</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">Payment shall be taken automatically monthly, quarterly or annually in advance.</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">If You wish to terminate Your Account, You can email Dasher LLC at info@getdasher.com however due to the manual nature of the request, we cannot guarantee to cancel your account before your next payment date unless you provide at least 3 weeks (21 days) notice before your renewal date.</span></li>
    <li class="li4"><span class="s2"></span><span class="s1">Alternatively, you may terminate your paid subscription within your Dashboard. You may terminate your account this way no less than 3 days before your next payment renewal date.</span></li>
  </ol>
  <li class="li3"><span class="s2"></span><span class="s3">Testimonial and/or Case Study Participation</span></li>
  <ol class="ol2">
    <li class="li3"><span class="s2"></span><span class="s1">DASHER may utilize this partnership as a use case for promotion of the Dasher product and service.</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">Any and all use of the User name, brand, logo, or other reference must first be approved by User in writing. User further reserves the right to use for its own marketing purpose any marketing collateral generated by DASHER featuring or referencing User.</span></li>
    <li class="li3"><span class="s2"></span><span class="s1">As such, User may agree to participate in any or all of the following at DASHER’s expense:</span></li>
    <ol class="ol3">
      <li class="li3"><span class="s2"></span><span class="s1">Case Study &amp; Video</span></li>
      <ol class="ol4">
        <li class="li3"><span class="s2"></span><span class="s1">Information captured may include name of business, light description of services provided, and specific uses of the DASHER product and related results.</span></li>
        <li class="li3"><span class="s2"></span><span class="s1">A video will be produced outlining the aforementioned. It may capture the organization’s presence in public setting to depict effectiveness.</span></li>
        <ol class="ol3">
          <li class="li3"><span class="s2"></span><span class="s1">As part of an effective partnership, DASHER will present the video for approval by the organization before displaying the final product to ensure the message is effective representation of the performance of the product and represents the User in an “on-brand,” respectful, and positive manner.</span></li>
        </ol>
      </ol>
      <li class="li3"><span class="s2"></span><span class="s1">Testimonial</span></li>
      <ol class="ol4">
        <li class="li3"><span class="s2"></span><span class="s1">Organization may provide a short testimonial outlining effectiveness of the DASHER product.</span></li>
      </ol>
      <li class="li3"><span class="s2"></span><span class="s1">Logo</span></li>
      <ol class="ol4">
        <li class="li3"><span class="s2"></span><span class="s1">DASHER may display the organization’s logo/identity on the DASHER website, social media, and proposals as part of a listing of successful users/clientele.</span></li>
      </ol>
    </ol>
  </ol>
</ol>
<p class="p2"><span class="s1"></span><br></p>
<ol class="ol1">
  <li class="li3"><span class="s2"></span><span class="s1">Either party may terminate this Agreement at any time upon written notice to either DASHER or User, respectively, and in accordance with Section IV-F, after which any rights granted hereunder to either party shall cease.</span></li>
</ol>
<p class="p1"><span class="s1">APPENDIX</span></p>
<p class="p5"><span class="s1"></span><br></p>
<p class="p3"><span class="s1"><i>INDIVIDUAL SOCIAL NETWORK USER TERMS OF SERVICE (</i></span><span class="s3"><i>LINKED</i></span><span class="s1"><i>):</i></span></p>
<p class="p2"><span class="s1"><i></i></span><br></p>
<ol class="ol1">
  <li class="li3"><span class="s2"><a href="https://www.facebook.com/legal/terms" style="text-align:left"><span class="s5"><i>Facebook</i></span></a></span></li>
  <li class="li3"><span class="s2"><a href="https://twitter.com/tos" style="text-align:left"><span class="s5"><i>Twitter</i></span></a></span></li>
  <li class="li3"><span class="s2"><a href="http://instagram.com/legal/terms/" style="text-align:left"><span class="s5"><i>Instagram</i></span></a></span></li>
  <li class="li3"><span class="s2"><a href="http://www.google.com/+/policy/pagesterm.html" style="text-align:left"><span class="s5"><i>Google+</i></span></a></span></li>
  <li class="li3"><span class="s2"><a href="http://www.google.com/+/policy/contestspolicy.html" style="text-align:left"><span class="s5"><i>Google+ Contests</i></span></a></span></li>
</ol>
</div>
<?php include('footer.php'); ?>