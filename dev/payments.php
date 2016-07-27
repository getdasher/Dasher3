<?php
ini_set('display_errors', 1);
require_once('header.php'); ?>
<form action="/charge" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_CZPvrpWyM77s3RXQNmThOYkK"
    data-image="/images/google_signin_logo.jpg"
    data-name="Dasher"
    data-description="Business Plan"
    data-amount="4999">
  </script>
</form>
<?php require_once('footer.php'); ?>