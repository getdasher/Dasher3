<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");
	include_once('header.php'); 
	
	if(isset($_POST['contact-name'])){
		$namer = $_POST['contact-name'];
		$email = $_POST['email'];
		$body = $_POST['inquiry'];
		$topic = $_POST['topic'];
		include('mail-contact.php');
		echo "Your inquiry has been submitted. We will be in touch soon.";
	}
	else {
?>
	
	<h1>Need Help</h1>
	<h2>Fill out the form below</h2>
	<form method="POST" class="retrieve-login" style="margin:auto; width:67%;" onSubmit="javascript: return checkMatch();">
		<span class="form-required">* Fields Required</span><br />
		<span class="form-required">*</span><input type="text" name="contact-name" id="namer" placeholder="Name"></input>
		<span class="email-required">Not a valid email address.</span><span class="form-required">*</span><input type="text" name="email" id="email" placeholder="Email"></input>
		<span class="form-required">*</span><div class="styled-select" >
		<select name="topic"  id="why">
			<option value="" selected="selected">How Can We Help?</option>
			<option value="Support">Support</option>
			<option value="General Information">General Information</option>
			<option value="Billing">Billing Question</option>
		</select>
		</div>
		<span class="form-required">*</span><textarea rows="4" placeholder="Inquiry" id="inquiry" name="inquiry"></textarea>
		<input type="submit" value="Submit" name="submit" class="button" />
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
	
						
<?php } include_once('footer.php'); ?>