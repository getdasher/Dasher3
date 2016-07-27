<?php /* Template Name: Dev Con Page Template */ ?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- DNS Prefetch -->
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	
	<title>  Preview Page : dasher</title>
	
	<!-- Meta -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Just another WordPress site">
	<link rel="shortcut icon" href="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/favicon.ico">
	<!--### Stylesheet and Bootstrap ###-->
<link rel="stylesheet" href="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/css/bootstrap.min.css" />
<link rel="stylesheet" href="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/css/lightbox.css" />
	<!-- CSS + jQuery + JavaScript -->
	<meta name='robots' content='noindex,nofollow' />
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://vauthierferguson.com/Dasher/wp-content/plugins/fancy-box/jquery.fancybox.css?ver=1.2.6' media='all' />
<link rel='stylesheet' id='html5blank-css'  href='http://vauthierferguson.com/Dasher/wp-content/themes/dasher/style.css?ver=1.0' media='all' />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js?ver=1.9.0'></script>
<script type='text/javascript' src='http://vauthierferguson.com/Dasher/wp-content/plugins/fancy-box/jquery.fancybox.js?ver=1.2.6'></script>
<script type='text/javascript' src='http://vauthierferguson.com/Dasher/wp-content/plugins/fancy-box/jquery.easing.js?ver=1.3'></script>
<script type='text/javascript' src='http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/conditionizr.min.js?ver=2.0.0'></script>
<script type='text/javascript' src='http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/modernizr.min.js?ver=2.6.2'></script>
<script type='text/javascript' src='http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/scripts.js?ver=1.0.0'></script>
<script type='text/javascript' src='http://vauthierferguson.com/Dasher/wp-includes/js/comment-reply.min.js?ver=3.5.1'></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var select = $('a[href$=".bmp"],a[href$=".gif"],a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".BMP"],a[href$=".GIF"],a[href$=".JPG"],a[href$=".JPEG"],a[href$=".PNG"]');
		select.attr('rel', 'fancybox');
		select.fancybox();
	});
</script>

<!--### Google Fonts ###-->

<link href="http://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

<!--### Javascript Library ###-->

<script type="text/javascript" src="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/slides.min.jquery.js"></script>
<script type="text/javascript" src="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/jquery.tipTip.minified.js"></script>
<script type="text/javascript" src="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/main.js"></script>
<script type="text/javascript" src="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/organictabs.jquery.js"></script>
<script type="text/javascript" src="http://vauthierferguson.com/Dasher/wp-content/themes/dasher/js/lightbox.js"></script>
	
</head><body style="background:none; width:955px; height:480px;">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div id="gallery-1" class="gallery galleryid-142 gallery-columns-3 gallery-size-thumbnail">
		<?php include('./dasher-tools/pinterest_query_preview.php'); ?>
        <?php include('./dasher-tools/twitter-gather-preview.php'); ?>
        <?php include('./dasher-tools/instagram-gather-preview.php'); ?>
			<br style="clear: both;">
			<br style="clear: both;">
		</div>
	<?php endwhile; ?>
    <?php endif; ?>

</body></html>