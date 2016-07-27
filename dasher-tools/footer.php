</div><!-- #page -->
</div>
</div>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-body">
		<div class="site-info">
			      <img src="http://getdasher.com/wp-content/themes/dasher2/images/DasherElements_11.jpg" class="lowerLogo" />
					<div class="support-link"><a href="http://getdasher.com/dasher-tools/contact.php">Contact / Support</a></div>
      	<div class="socialIcon"><a href="http://www.facebook.com/GetDasher"><img src="http://getdasher.com/wp-content/themes/dasher2/images/facebook-24-black.png" /></div>
        <div class="socialIcon"><a href="https://twitter.com/getdasher"><img src="http://getdasher.com/wp-content/themes/dasher2/images/twitter-24-black.png" /></div>
      <div class="legal">&copy;Dasher <?php echo date('Y'); ?></div>
		</div><!-- .site-info -->
      </div>
	</footer><!-- #colophon -->


<script type='text/javascript' src='http://getdasher.com/wp-content/themes/dasher2/js/navigation.js?ver=20120206'></script>
<script type='text/javascript' src='http://getdasher.com/wp-content/themes/dasher2/js/skip-link-focus-fix.js?ver=20130115'></script>
<!--Customer.io Integration-->

<?php if(isset($_GET['firstLog'])) {?>
	
	<script type="text/javascript">
	  var _cio = _cio || [];
	  (function() {
	    var a,b,c;a=function(f){return function(){_cio.push([f].
	    concat(Array.prototype.slice.call(arguments,0)))}};b=["load","identify",
	    "sidentify","track","page"];for(c=0;c<b.length;c++){_cio[b[c]]=a(b[c])};
	    var t = document.createElement('script'),
	        s = document.getElementsByTagName('script')[0];
	    t.async = true;
	    t.id    = 'cio-tracker';
	    t.setAttribute('data-site-id', '3cb9a8a90558f2a2f041');
	    t.src = 'https://assets.customer.io/assets/track.js';
	    s.parentNode.insertBefore(t, s);
	  })();
	</script>

	<script type="text/javascript">

	    _cio.identify({
	      id:         '<?php echo $_SESSION['loggedUserInfo']['id']; ?>', // must be unique per customer
	      email:      '<?php echo $_SESSION['loggedUserInfo']['email']; ?>',
	      created_at:  <?php echo $_SESSION['loggedUserInfo']['cdate']; ?>, // seconds since the epoch (January 1, 1970)
	      name:       '<?php echo $_SESSION['loggedUserInfo']['name']; ?>', // Add any attributes you'd like to use in the email subject or body.
	      plan_name: 'beta'      // To use the example segments, set this to 'free' or 'premium'.
	    });

	</script>
	
	<script type="text/javascript">
	  _cio.track("first_login");
	</script>
<?php } ?>
<?php if(isset($_GET['submitCamp'])) {
	if($_GET['submitCamp']  == 'true') {
	?>
	<script type="text/javascript">
	  var _cio = _cio || [];
	  (function() {
	    var a,b,c;a=function(f){return function(){_cio.push([f].
	    concat(Array.prototype.slice.call(arguments,0)))}};b=["load","identify",
	    "sidentify","track","page"];for(c=0;c<b.length;c++){_cio[b[c]]=a(b[c])};
	    var t = document.createElement('script'),
	        s = document.getElementsByTagName('script')[0];
	    t.async = true;
	    t.id    = 'cio-tracker';
	    t.setAttribute('data-site-id', '3cb9a8a90558f2a2f041');
	    t.src = 'https://assets.customer.io/assets/track.js';
	    s.parentNode.insertBefore(t, s);
	  })();
	</script>

	<script type="text/javascript">

	    _cio.identify({
	      id:         '<?php echo $_SESSION['loggedUserInfo']['id']; ?>', // must be unique per customer
	      email:      '<?php echo $_SESSION['loggedUserInfo']['email']; ?>',
	      created_at:  <?php echo $_SESSION['loggedUserInfo']['cdate']; ?>, // seconds since the epoch (January 1, 1970)
	      name:       '<?php echo $_SESSION['loggedUserInfo']['name']; ?>', // Add any attributes you'd like to use in the email subject or body.
	      plan_name: 'beta'      // To use the example segments, set this to 'free' or 'premium'.
	    });

	</script>
	<script type="text/javascript">
	  _cio.track("create_campaign");
	</script>
<?php } } ?>

<?php if(isset($_GET['logger'])) {
	if($_GET['logger']  == 'true') {
	?>
	<script type="text/javascript">
	  var _cio = _cio || [];
	  (function() {
	    var a,b,c;a=function(f){return function(){_cio.push([f].
	    concat(Array.prototype.slice.call(arguments,0)))}};b=["load","identify",
	    "sidentify","track","page"];for(c=0;c<b.length;c++){_cio[b[c]]=a(b[c])};
	    var t = document.createElement('script'),
	        s = document.getElementsByTagName('script')[0];
	    t.async = true;
	    t.id    = 'cio-tracker';
	    t.setAttribute('data-site-id', '3cb9a8a90558f2a2f041');
	    t.src = 'https://assets.customer.io/assets/track.js';
	    s.parentNode.insertBefore(t, s);
	  })();
	</script>

	<script type="text/javascript">

	    _cio.identify({
	      id:         '<?php echo $_SESSION['loggedUserInfo']['id']; ?>', // must be unique per customer
	      email:      '<?php echo $_SESSION['loggedUserInfo']['email']; ?>',
	      created_at:  <?php echo $_SESSION['loggedUserInfo']['cdate']; ?>, // seconds since the epoch (January 1, 1970)
	      name:       '<?php echo $_SESSION['loggedUserInfo']['name']; ?>', // Add any attributes you'd like to use in the email subject or body.
	      plan_name: 'beta'      // To use the example segments, set this to 'free' or 'premium'.
	    });

	</script>
<?php } } ?>
<!--END Customer.io Integration-->
</body>
</html>
