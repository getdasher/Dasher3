</div><!-- #page -->
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-body">
		<div class="site-info">
			<div class="legal">&copy;Dasher <?php echo date('Y'); ?></div>
			<div class="support-link"><a href="/contact.php">Contact / Support</a></div>
	      	<div class="socialIcon"><a href="http://www.facebook.com/GetDasher"><img src="http://app.getdasher.com/images/facebook-24-black.png" /></a></div>
	        <div class="socialIcon"><a href="https://twitter.com/getdasher"><img src="http://app.getdasher.com/images/twitter-24-black.png" /></a></div>
		</div><!-- .site-info -->
      </div>
	</footer><!-- #colophon -->
<div class="walkthrough">
	<a class="fancybox-walk" rel="walk_thru" href="/images/walkthru_1.jpg"><img src="/images/walkthru_1.jpg" /></a>
	<a class="fancybox-walk" rel="walk_thru" href="/images/walkthru_2.jpg"><img src="/images/walkthru_2.jpg" /></a>
	<a class="fancybox-walk" rel="walk_thru" href="/images/walkthru_3.jpg"><img src="/images/walkthru_3.jpg" /></a>
	<a class="fancybox-walk" rel="walk_thru" href="/images/walkthru_4.jpg"><img src="/images/walkthru_4.jpg" /></a>
</div>
<?php
	if(isset($_COOKIE['userid'])){
	$database = new database('users');
	$selectionQuery = $database->query('SELECT * FROM `users` WHERE `id` = "'.$_COOKIE['userid'].'"');
	$selection = $database->getRow($selectionQuery);
	if($selection['walkthrough'] != 'true'){
		echo "<script type='text/javascript'>
		$(document).ready(function(){
				$('.fancybox-walk:first-child').trigger('click');
		});
		</script>";
		$query = 'UPDATE `users` SET `walkthrough`="true" WHERE `id`='.$_COOKIE['userid'];
		$updateQuery = $database->query($query);
	}
}
?>
<script>
var _elev = window._elev || {};(function() {var i,e;i=document.createElement("script"),i.type='text/javascript';i.async=1,i.src="https://static.elev.io/js/v3.js",e=document.getElementsByTagName("script")[0],e.parentNode.insertBefore(i,e);})();
_elev.account_id = '55439548393c2';
</script>
</body>
</html>