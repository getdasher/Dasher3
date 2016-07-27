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
<link rel='stylesheet' id='dasher-style-css'  href='/css/style.css' type='text/css' media='all' />

<!-- Load JS-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript' src='http://app.getdasher.com/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/doubletaptogo.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/dasher.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/js/modernizr.js'></script>
<script type='text/javascript'>
	$(document).ready(function(){
	myVar=setTimeout(function(){$('.login-alerts').fadeOut('slow'); clearTimeout(myVar)},5000);
	$('.alertx').click(function(){
		$('.login-alerts').fadeOut();
	});
	});
</script>
</head>
<body class="page support">
	<div class="login-content">
<div class="modal-header">Need Help</div>
<h2 style="margin-top:50px;">Fill out the form below</h2>
<form method="POST" class="retrieve-login" style="margin:auto; width:100%;" onSubmit="javascript: return checkMatch();">
	<span class="form-required">* Fields Required</span><br />
	<span class="form-required">*</span><input type="text" name="contact-name" id="namer" placeholder="Name"></input><br />
	<span class="email-required">Not a valid email address.</span><span class="form-required">*</span><input type="text" name="email" id="email" placeholder="Email"></input><br />
	<span class="form-required">*</span><div class="styled-select" >
	<select name="topic"  id="why">
		<option value="" selected="selected">How Can We Help?</option>
		<option value="Support">Support</option>
		<option value="General Information">General Information</option>
		<option value="Billing">Billing Question</option>
	</select>
	</div>
	<span class="form-required">*</span><textarea rows="4" placeholder="Inquiry" id="inquiry" name="inquiry"></textarea>
	<input type="submit" value="Submit" name="submit" class="button" style="float:left; margin-top:0;" /><button class="close_window" style="float:right;">Cancel</button>
	<script>
		jQuery('.close_window').click(function(){
			parent.$.fancybox.close();
		});
	</script>
</form> 
<script type="text/javascript">
	function checkMatch(){
		$namer = jQuery('#namer').val();
		$email = jQuery('#email').val();
		var atpos=$email.indexOf("@");
		var dotpos=$email.lastIndexOf(".");
		$why = jQuery('#why').val();
		$inquiry = jQuery('#inquiry').val();
		if ($namer==null || $namer=="")
		  {
		  jQuery('.retrieve-login .form-required').css('display', 'inline');
		  return false;
		  }
		else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$email.length)
		  {
			jQuery('.retrieve-login .email-required').css('display', 'inline');
		  return false;
		  }
		else if ($why==null || $why=="")
		  {
		 	jQuery('.retrieve-login .form-required').css('display', 'inline');
			  return false;
		  }
		else if ($inquiry==null || $inquiry=="")
		  {
		  	jQuery('.retrieve-login .form-required').css('display', 'inline');
			  return false;
		  }
		else{
			return true;
		}
	}
</script>
</body>
</html>