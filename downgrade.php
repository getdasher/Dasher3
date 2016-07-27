<?php
require_once('header.php');
ini_set('display_errors', 1); ?>
<div class="modal-header">Account Change</div>
<p style="margin-top:50px;">
	You are about to move to a plan with fewer active hashtags and active galleries. Your most recent hashtags and galleries will be saved, but deactivated if you are currently utilizing more than this plan's allotted amount. Please visit the <a href="/" target="_parent">Hashtag Dashboard</a> and <a href="/galleries/" target="_parent">My Galleries</a> pages to make any changes after you change plans.</p>
	<button class="downgrade">Continue</button><button style="float:right;" class="close_window">Cancel</button>
	<div style="clear:both;"></div>
<div style="clear:both;"></div>
<script>
	jQuery('.close_window').click(function(e){
		e.preventDefault();
		parent.$.fancybox.close();
	});
	jQuery('.downgrade').click(function(){
		$type = '<?php echo $_GET['type']; ?>';
		$url = "/downgrader.php?sub="+$type
		jQuery.get($url, function( data ) {
		  jQuery( ".result" ).html( data );
		  console.log( "Load was performed." );
		  window.parent.location = '/my-account/?alert=planUpdated';
		});
	});
	</script>
</script>
<?php
 require_once('footer.php'); ?>