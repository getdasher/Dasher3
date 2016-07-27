<?php
ini_set('display_errors', 1);
require_once('header.php'); 
?>
<div class="modal-header">DELETE GALLERY</div>
<p style="margin-top:30px;">Are you certain that you want to delete this gallery? This action is irreversible.</p>
<button class="deleter">Delete Gallery</button><a href="javascript:parent.$.fancybox.close();" style="float:right;"><button style="float:right;">Close Window</button></a>
<script>
	jQuery(document).ready(function(){
		jQuery('.deleter').click(function(){
			$.get( "gallery_delete.php", { id: "<?php echo $_GET['id']; ?>"}).done(function( data ) {
			  parent.location.reload();
			});
		});
	});
</script>
<?php require_once('footer.php'); ?>