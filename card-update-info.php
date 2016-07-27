<?php
ini_set('display_errors', 1);
require_once('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  Stripe.setPublishableKey('pk_live_DCHhvkgGazGe5SwhjWuqYgIY');
  jQuery(function($) {
  $('#payment-form').submit(function(event) {
    var $form = $(this);

    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);

    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });
});
function stripeResponseHandler(status, response) {
  var $form = $('#payment-form');

  if (response.error) {
    // Show the errors on the form
    $form.find('.payment-errors').text('Card Information Incorrect or Failed. Please try again.');
    $form.find('button').prop('disabled', false);
  } else {
    // response contains id and card, which contains additional card details
    var token = response.id;
    // Insert the token into the form so it gets submitted to the server
    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    // and submit
    $form.get(0).submit();
  }
};
</script>
<form action="/libs/stripe/card_update.php" method="POST" id="payment-form" target="_parent">
<div class="modal-header">Dasher Payment Information</div>
  <span class="payment-errors"></span>
  <div class="form-row">
      <input type="text" size="20" data-stripe="number" placeholder="&#xf09d; Card Number" style=" margin-top:50px; margin-bottom:20px;"/>
  </div>
  <div class="form-row expiration-fields">
      <input type="text" size="2" data-stripe="exp-month" placeholder="&#xf073; MM" style="width:48%; float:left;"/>
    <input type="text" size="4" data-stripe="exp-year" placeholder="&#xf073; YYYY" style="width:48%; margin-left:4%; margin-bottom:20px;"/>
  </div>
  <div class="form-row">
      <input type="text" size="4" data-stripe="cvc" placeholder="&#xf023; CVC"  style = "width: 30%;" />
  </div>
  <button type="submit" style="margin-top:15px; cursor:pointer;">Update Card</button> <button style="cursor:pointer;" class="close_window">Cancel</button>
	<script>
		jQuery('.close_window').click(function(){
			parent.$.fancybox.close();
		});
	</script>
</form>
<p style="font-family: 'Open+Sans', arial, verdana; font-style:italic; font-size:12px; color:#404040; width: 85%; margin-left:5px; margin-top:10px;" >This form is Sercured via SSL for the safety of your information.</p>
<?php require_once('footer.php'); ?>