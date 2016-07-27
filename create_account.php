<?php
ini_set('display_errors', '1');
include('header.php');
$multiplier = 1;
$subtractor = 0;
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$email = $user['email_address'];
if(isset($_GET['discount'])){
	$requiredUrl = "libs/stripe/coupon.php";
	$_GET['coupon'] = $_GET['discount'];
	require_once($requiredUrl);
	if(isset($percentOff)){
		$multiplier = ".".$percentOff;
	}
	if(isset($amountOff)){
		$subtractor = $amountOff;
	}
}
?>
<h1>Select A Plan</h1>
<div class="year-month-toggle">Annual &nbsp;&nbsp;<input type="checkbox" name="month-slider" id="iconsbox1" class="faChkSlide month-checkbox" /><label for="iconsbox1" class="left-label">&nbsp;</label>Monthly<br />10% SAVINGS WHEN YOU CHOOSE AN ANNUAL SUBSCRIPTION.</div>
<!-- PRICING TABLE -->
<div class="pricing">
<ul class="pricing_table year-table">
     
    <li class="price_block">
        <h3>Basic</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$<?php if($multiplier != 1){ $amount = 22.49 - ($multiplier * 22.49); echo number_format((float)$amount, 2, '.', ''); } elseif($subtractor != 0){ echo 22.49 - $subtractor; } else { echo "22.49";} ?></span>
                <span class="price_tenure">per month<br /><strong>SAVE $30 per year</strong></span>
            </div>
        </div>
        <ul class="features">
            <li>3 Active Hashtags</li>
            <li>1 Active Gallery</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
			<form action="/new_charge.php?sub=4" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_live_DCHhvkgGazGe5SwhjWuqYgIY"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Basic Yearly Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
			    data-amount="<?php if($multiplier != 1){ echo 26988 - ($multiplier * 26988); } elseif($subtractor != 0){ echo 26988 - ($subtractor *100); } else { echo "26988";} ?>">
			  </script>
				<input type="hidden" name="coupon" value="<?php echo $_GET['discount']; ?>">
			</form>
        </div>
    </li>

        <li class="callout price_block">
        <h3 class="callout">Business</h3>
         <div class="price">
            <div class="price_figure">
                <span class="price_number"><br />$<?php if($multiplier != 1){ $amount = 71.99 - ($multiplier * 71.99); echo number_format((float)$amount, 2, '.', '');  } elseif($subtractor != 0){ echo 71.99 - $subtractor; } else { echo "71.99";} ?></span>
                <span class="price_tenure">per month<br /><strong>SAVE $96 per year</strong></span>
            </div>
        </div>
        <ul class="features">
            <li>15 Active Hashtags</li>
            <li>5 Active Galleries</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
            <form action="/new_charge.php?sub=5" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_live_DCHhvkgGazGe5SwhjWuqYgIY"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Business Yearly Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
			    data-amount="<?php if($multiplier != 1){ echo 86388 - ($multiplier * 86388); } elseif($subtractor != 0){ echo 86388 - ($subtractor *100); } else { echo "86388";} ?>">
			  </script>
				<input type="hidden" name="coupon" value="<?php echo $_GET['discount']; ?>">
			</form>
        </div>
    </li>

        <li class="price_block">
        <h3>Pro</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">Contact Us</span>
                <span class="price_tenure"></span>
            </div>
        </div>
        <ul class="features">
            <li>Unlimited Hashtags</li>
            <li>Unlimited Galleries</li>
			<li>Unlimited Users</li>
            <li>Client Level Dashboard Control</li>
            <li>API Connectivity</li>
        </ul>
        <div class="footer">
            <a class="popcontact" href="/contact.php"><button class="support-link stripe-button-el">Contact</button></a>
        </div>
    </li>
     <div style="clear:both;"></div>
    <hr />
    <div class="starter" style="text-align:center;">
   	 <strong style="margin-right:20px;">Starter Plan</strong> One Hashtag, One Gallery $<?php if($multiplier != 1){ $amount = 8.99 - ($multiplier * 8.99); echo number_format((float)$amount, 2, '.', '');  } elseif($subtractor != 0){ echo 8.99 - $subtractor; } else { echo "8.99";} ?>/mo
       <form action="/new_charge.php?sub=8" method="POST" style="border:none; display:inline-block; color:#000; text-decoration:underine; font-size:16px;">
   	  <script
   	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
   	    data-key="pk_live_DCHhvkgGazGe5SwhjWuqYgIY"
   	    data-image="/images/google_signin_logo.jpg"
   	    data-name="Dasher"
   	    data-label = "Choose Plan"
   	    data-description="Starter Plan"
   		data-email="<?php echo $email; ?>"
   		data-allowRememberMe = "false"
   		data-panelLabel = "Subscribe"
   	    data-amount="<?php if($multiplier != 1){ echo 10788 - ($multiplier * 10788); } elseif($subtractor != 0){ echo 10788 - ($subtractor *100); } else { echo "10788";} ?>">
   	  </script>
		<input type="hidden" name="coupon" value="<?php echo $_GET['discount']; ?>">
   	</form>
    </div>
    <hr />
</ul>
<ul class="pricing_table month-table">
     
    <li class="price_block">
        <h3>Basic</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$<?php if($multiplier != 1){ $amount = 24.99 - ($multiplier * 24.99); echo number_format((float)$amount, 2, '.', '');  } elseif($subtractor != 0){ echo 24.99 - $subtractor; } else { echo "24.99";} ?></span>
                <span class="price_tenure">per month</span>
            </div>
        </div>
        <ul class="features">
            <li>3 Active Hashtags</li>
            <li>1 Active Gallery</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
			<form action="/new_charge.php?sub=1" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_live_DCHhvkgGazGe5SwhjWuqYgIY"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Basic Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
			    data-amount="<?php if($multiplier != 1){ echo 2499 - ($multiplier * 2499); } elseif($subtractor != 0){ echo 2499 - ($subtractor *100); } else { echo "2499";} ?>">
			  </script>
				<input type="hidden" name="coupon" value="<?php echo $_GET['discount']; ?>">
			</form>
        </div>
    </li>

        <li class="callout price_block">
        <h3 class="callout">Business</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$<?php if($multiplier != 1){ $amount = 79.99 - ($multiplier * 79.99); echo number_format((float)$amount, 2, '.', '');  } elseif($subtractor != 0){ echo 79.99 - $subtractor; } else { echo "79.99";} ?></span>
                <span class="price_tenure">per month</span>
            </div>
        </div>
        <ul class="features">
            <li>15 Active Hashtags</li>
            <li>5 Active Galleries</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
            <form action="/new_charge.php?sub=2" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_live_DCHhvkgGazGe5SwhjWuqYgIY"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Business Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
			    data-amount="<?php if($multiplier != 1){ echo 7999 - ($multiplier * 7999); } elseif($subtractor != 0){ echo 7999 - ($subtractor *100); } else { echo "7999";} ?>">
			  </script>
				<input type="hidden" name="coupon" value="<?php echo $_GET['discount']; ?>">
			</form>
        </div>
    </li>

        <li class="price_block">
        <h3>Pro</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">Contact Us</span>
                <span class="price_tenure"></span>
            </div>
        </div>
        <ul class="features">
            <li>Unlimited Hashtags</li>
            <li>Unlimited Galleries</li>
			<li>Unlimited Users</li>
            <li>Client Level Dashboard Control</li>
            <li>API Connectivity</li>
        </ul>
        <div class="footer">
           <a class="popcontact" href="/contact.php"><button class="support-link">Contact</button></a>
        </div>
    </li>
     <div style="clear:both;"></div>
    <hr />
    <div class="starter" style="text-align:center;">
   	 <strong style="margin-right:20px;">Starter Plan</strong> One Hashtag, One Gallery $<?php if($multiplier != 1){ $amount = 9.99 - ($multiplier * 9.99); echo number_format((float)$amount, 2, '.', '');  } elseif($subtractor != 0){ echo 9.99 - $subtractor; } else { echo "9.99";} ?>/mo
       <form action="/new_charge.php?sub=7" method="POST" style="border:none; display:inline-block; color:#000; text-decoration:underine; font-size:16px;">
   	  <script
   	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
   	    data-key="pk_live_DCHhvkgGazGe5SwhjWuqYgIY"
   	    data-image="/images/google_signin_logo.jpg"
   	    data-name="Dasher"
   	    data-label = "Choose Plan"
   	    data-description="Starter Plan"
   		data-email="<?php echo $email; ?>"
   		data-allowRememberMe = "false"
   		data-panelLabel = "Subscribe"
   	    data-amount="<?php if($multiplier != 1){ echo 999 - ($multiplier * 999); } elseif($subtractor != 0){ echo 999 - ($subtractor *100); } else { echo "999";} ?>">
   	  </script>
		<input type="hidden" name="coupon" value="<?php echo $_GET['discount']; ?>">
   	</form>
    </div>
    <hr />
</ul>
<div style="clear:both;"></div>
    <div class="coupon" style="text-align:center;">
		<form action="" method="GET" style="width:800px;">
   	 <strong style="margin-right:20px;">Have A Coupon?</strong><input type="text" name="discount" class="coupon-field" style="height:25px; display:inline-block; width:200px;" /> <input type="submit" class="button coupon-button" style="display:inline-block; height:26px; padding-top:2px; width: 120px;" value="Add Coupon">
   	</form>
    </div>
 </div>
 <div class="notice" style="clear:both; text-align:left; font-size:12px; width:800px; margin:auto;" class="action-button">After submitting your information your card will be billed today and will be billed automatically every 30 days or 12 months depending on your subscription plan. We want to hear from you. Please email team@getdasher.com anytime.</div>
<!-- END PRICING TABLE -->
	<script>
		jQuery(document).ready(function(){
		jQuery('.month-checkbox').change(function(){
				jQuery('.year-table').toggle();
				jQuery('.month-table').toggle();
		});
	});
	</script>
<?php
include('footer.php');
?>