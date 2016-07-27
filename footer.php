</div><!-- #page -->
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-body">
		<div class="site-info">
			<div class="legal">&copy;Dasher <?php echo date('Y'); ?></div>
			<div class="support-link"><a href="/contact.php">Contact / Support</a></div>
			<div style="display:inline-block"> | <a href="/terms-of-use/" target="_blank">Terms of Use</a></div>
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
<script type="text/javascript">
OnboardTipsSiteKey="e3dff4cf7b991baea3c0c692e1e05665eb59c331",function(){var e=document.
createElement("script");e.type="text/javascript",e.async=!0,e.
edit=document.location.search.indexOf("edit=true")>-1,e.edit=e.edit?e.
edit:"undefined"!=typeof Storage?localStorage.getItem("edit"):!1,e.
src=e.edit?"https://onboardtips.com/onboardtips.js?s=e3dff4cf7b991baea3c0c692e1e05665eb59c331"
:"https://s3-eu-west-1.amazonaws.com/onboardtips/e3dff4cf7b991baea3c0c692e1e05665eb59c331-onboardtips.min.js",e.onload=e.onreadystatechange=function(
){var e=this.readyState;if(!e||"complete"==e||"loaded"==e)try{OnboardTips.identify(
{})}catch(t){}};var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)}();
</script>
</body>
</html>