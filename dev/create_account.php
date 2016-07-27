<?php
ini_set('display_errors', '1');
include('header.php');
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$email = $user['email_address'];
?>
<h1>Select A Plan</h1>
<div class="year-month-toggle">Annually &nbsp;&nbsp;<input type="checkbox" name="month-slider" id="iconsbox1" class="faChkSlide month-checkbox" /><label for="iconsbox1" class="left-label">&nbsp;</label>Monthly<br />10% Savings On Every Annual Purchase.</div>
<!-- PRICING TABLE -->
<div class="pricing">
<ul class="pricing_table year-table">
     
    <li class="price_block">
        <h3>Basic</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$22.49</span>
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
			    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Basic Yearly Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
			    data-amount="26988">
			  </script>
			</form>
        </div>
    </li>

        <li class="callout price_block">
        <h3 class="callout">Business</h3>
         <div class="price">
            <div class="price_figure">
                <span class="price_number"><br />$71.99</span>
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
			    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Business Yearly Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
			    data-amount="86388">
			  </script>
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
            
        </div>
    </li>
</ul>
<ul class="pricing_table month-table">
     
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
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
			<form action="/new_charge.php?sub=1" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Basic Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
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
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
            <form action="/new_charge.php?sub=2" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
			    data-image="/images/google_signin_logo.jpg"
			    data-name="Dasher"
			    data-label = "Choose Plan"
			    data-description="Business Plan"
				data-email="<?php echo $email; ?>"
				data-allowRememberMe = "false"
				data-panelLabel = "Subscribe"
			    data-amount="7999">
			  </script>
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
           
        </div>
    </li>
</ul>
 </div>
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