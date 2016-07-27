<?php
ini_set("display_errors", 1);
if(!session_id()){
session_start();
}
require_once ("connect.php");
$name = "";
	if(isset($_SESSION['loggedUser'])){
	$sql2="SELECT name FROM users WHERE `id` = '".$_SESSION['loggedUser']."'";
	if ($results = mysqli_query($link, $sql2)) {	
		while( $info =  mysqli_fetch_assoc($results) ){
			$name = $info['name'];
		};
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
}

$rawCode = '<div class="dasher" style="height:325px; overflow:hidden;"><script type="text/javascript" src="http://www.getdasher.com/dasher-tools/viewer.js?id='.$_GET['id'].'"></script></div>.';

if($_SESSION['loggedUser'] == 14){
	$rawCode = '<div class="dasher" style="height:325px; overflow:hidden;"><script type="text/javascript" src="http://www.getdasher.com/dasher-tools/viewer2.js?id='.$_GET['id'].'"></script></div>.';
}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Members Area | DASHER</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="http://getdasher.com/xmlrpc.php">
<script type="text/javascript" src="//use.typekit.net/gpj8hol.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<!-- This site is optimized with the Yoast WordPress SEO plugin v1.4.19 - http://yoast.com/wordpress/seo/ -->
<!-- Admin only notice: this page doesn't show a meta description because it doesn't have one, either write it for this page specifically or go into the SEO -> Titles menu and set up a template. -->
<link rel="canonical" href="http://getdasher.com/about/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="About - DASHER" />
<meta property="og:description" content="ABOUT DASHER Everyone’s taking photos on there phones these days. Many of them have the potential to include brand names or can be powered by campaigns. We set to bridge the gap, creating an easy way for brands and business to tap into the power of their customers photos. JOSH HILL CASEY FERGUSON ADAM VAUTHIER &hellip;" />
<meta property="og:url" content="http://getdasher.com/about/" />
<meta property="og:site_name" content="DASHER" />
<meta property="article:published_time" content="2013-06-13T22:02:15+00:00" />
<meta property="article:modified_time" content="2013-11-18T10:51:54+00:00" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/headshot_two_two.jpg" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/twitter-24-black.png" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/linkedin-24-black.png" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/casey_new.jpg" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/instagram-24-black.png" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/adam_new.jpg" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/mary.png" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/dribbble-24-black.png" />
<meta property="og:image" content="http://getdasher.com/wp-content/uploads/2013/06/BSDC_logo.png" />
<!-- / Yoast WordPress SEO plugin. -->

<link rel="alternate" type="application/rss+xml" title="DASHER &raquo; Feed" href="http://getdasher.com/feed/" />
<link rel="alternate" type="application/rss+xml" title="DASHER &raquo; Comments Feed" href="http://getdasher.com/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="DASHER &raquo; About Comments Feed" href="http://getdasher.com/about/feed/" />
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://getdasher.com/dasher-tools/fancybox/jquery.fancybox.css' type='text/css' media='all' />
<link rel='stylesheet' id='admin-bar-css'  href='http://getdasher.com/wp-includes/css/admin-bar.min.css?ver=3.7.1' type='text/css' media='all' />
<link rel='stylesheet' id='boxes-css'  href='http://getdasher.com/wp-content/plugins/wordpress-seo/css/adminbar.css?ver=1.4.19' type='text/css' media='all' />
<link rel='stylesheet' id='dasher-style-css'  href='http://getdasher.com/wp-content/themes/dasher2/style.css?ver=3.7.1' type='text/css' media='all' />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<script type='text/javascript' src='http://getdasher.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/dasher.js'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://getdasher.com/wp-content/plugins/fancy-box/jquery.easing.js?ver=1.3'></script>
<script type='text/javascript' src='http://getdasher.com/wp-includes/js/comment-reply.min.js?ver=3.7.1'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://getdasher.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://getdasher.com/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 3.7.1" />
<link rel='shortlink' href='http://getdasher.com/?p=198' />
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<script type="text/javascript">
  jQuery(document).ready(function(){
   jQuery('.gallery-item').hover(
  function () {
    
    jQuery(this).find(".hoverdata").fadeToggle('fast');
  },
  function () {
    jQuery(this).find(".hoverdata").fadeToggle('fast');
  });
    });
  </script>
  
  <script type="text/javascript">
    jQuery(function () {
        jQuery('#hiwEmail').submit(function (e) {
            e.preventDefault();
            jQuery.getJSON(
            this.action + "?callback=?",
            jQuery(this).serialize(),
            function (data) {
                if (data.Status === 400) {
                    alert("Error: " + data.Message);
                } else { // 200
                    jQuery('#aikyur-aikyur').fadeToggle();
                    jQuery('#emailSubmit').fadeToggle(function () {
    jQuery(".email-formArea").html("Thanks we will be in touch soon!");
  });
                }
            });
        });
    });
</script>
</head>
<body style="background-color:#ebebeb;">
	<div class="scriptCode">
		<h1>Widget Code</h1>
		<p>Copy and Paste the code below onto your site where ever you would like it to appear.</p>
		<div class="raw-code"><pre><?php echo htmlspecialchars($rawCode); ?></pre></div>
		<p>This plugin requires jQuery to be installed on your site.  If you do not <a href="http://think2loud.com/576-jquery-101-adding-jquery-to-your-website/" target="_blank">Think2Loud has a great tutorial.</a></p>
	<p>
		For Lightbox implementation the following pieces of code can be added to the header or footer of your site:
		<ul>
		<li>colorbox:
		<div class="raw-code"><?php echo htmlspecialchars('jQuery(\'.list_carousel li\').click(function(){
					$title = jQuery(this).attr(\'titler\');
					$(\'.dasher-gallery\').colorbox({title : function(){
					  $title = jQuery(this).attr(\'titler\');
					  return $title}, maxWidth : \'90%\', maxHeight : \'90%\', rel:\'.dasher-gallery\'});
				});'); ?></div>
				</li>
				</ul>
	</p>
	</div>
	</html>
	</body>