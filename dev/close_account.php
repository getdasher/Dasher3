<?php
ini_set('display_errors', 1);
require_once('header.php'); ?>
<div class="modal-header">Account Closure</div>
<p style="margin-top:50px;">By pressing Close Account below you agree that your account will be closed at the nearest upcoming billing cycle.<br /><br />At that time your account will no longer be accesible and you will have 60 days to renew before your galleries and hashtags are removed from the Dasher database.</p>
<a href="/libs/stripe/account_closed.php" target="_parent"><button>Close Account</button></a> <button class="close_window" style="float:right;">Cancel</button>
<script>
	jQuery('.close_window').click(function(){
		parent.$.fancybox.close();
	});
</script>
<?php require_once('footer.php'); ?>