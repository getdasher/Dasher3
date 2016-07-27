<?php
ini_set('display_errors', 1);
require_once('header.php'); ?>
<div class="modal-header">Gallery Limit</div>
<p style="margin-top:50px; display:block;">It looks like you have reached your maximum number of galleries for this account.  You can upgrade at any time or disable one to activate another.</p>
<button class="close_window" style="float:right;">Close</button>
<div style="clear:both;"></div>
<script>
	jQuery('.close_window').click(function(){
		parent.$.fancybox.close();
	});
</script>
<?php require_once('footer.php'); ?>