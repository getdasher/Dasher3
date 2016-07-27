<?php
ini_set("display_errors", 1);
if(!session_id()){
session_start();
}
$errorMessage = "";
require_once ("connect.php");
$name = "";
	if(isset($_SESSION['loggedUser'])){
	if(isset($_GET['tou'])){
		$stamp = date('Y-m-d H:i:s');
		$touQuery = 	"UPDATE users SET tou_stamp = '".$stamp."' WHERE ID = ".$_SESSION['loggedUser'];
		if ($touresult = mysqli_query($link, $touQuery)) {	 
		header( 'Location: http://www.getdasher.com/dasher-tools/campaign_display.php' ) ;
		}
		else{
			printf("Error: %s\n", mysqli_error($link));
			echo "<br />";
		}
	}
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
<link rel='stylesheet' id='dasher-style-css'  href='http://getdasher.com/dasher-tools/styles.css' type='text/css' media='all' />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<script type='text/javascript' src='http://getdasher.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/dasher.js'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://getdasher.com/wp-content/plugins/fancy-box/jquery.easing.js?ver=1.3'></script>
<script type='text/javascript' src='http://getdasher.com/wp-includes/js/comment-reply.min.js?ver=3.7.1'></script>
<script type='text/javascript' src='modernizr.js'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://getdasher.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://getdasher.com/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 3.7.1" />
<link rel='shortlink' href='http://getdasher.com/?p=198' />
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<script type="text/javascript">
  jQuery(document).ready(function(){
	  
	  $("div.lazy").lazyload({
	        effect : "fadeIn"
	    });
   jQuery('.gallery-item').hover(
  function (e) {
	e.preventDefault();
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

<body class="page members-area">
<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
    <div class="header-body">
		<div class="site-branding">
			<h2 class="site-title"><?php $query = $_SERVER['PHP_SELF']; $posa = strpos($query, 'tou.php'); if($posa === false) { echo '<a href="http://www.getdasher.com/dasher-tools/campaign_display.php" rel="home"></a>'; } ?></h2>	
		</div>
			<?php if(isset($_SESSION['loggedUser'])): ?>
			<div class="right-buttons">
			<div class="welcome-user">Welcome <?php echo $name; ?>, <a href="logout.php">Log Out</a></div>
            <!--
			<a href="logout.php"><div class="header-button" id="settings-button">Settings</div></a>
            -->
			<?php if($posa === false) {  echo '<a href="http://www.getdasher.com/dasher-tools/campaign_display.php"><div class="header-button" id="campaigns-button">Campaigns</div></a>'; } ?>
			</div>
			<?php endif; ?>
      </div>
	</header><!-- #masthead -->
<div class="content-wrap">
	<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			
				
<article id="post-198" class="post-198 page type-page status-publish hentry">

	<div class="entry-content">

<?php 
}
else{
	$passCheck = "";
	$row_cnt = 0;
	if(isset($_POST['username'])){
		$loginquery = 'SELECT * FROM `users` WHERE `user_name` = "'.$_POST['username'].'"';
		if ($loginresult = mysqli_query($link, $loginquery)) {	 
			$row_cnt = mysqli_num_rows($loginresult);
			$logininfo =  mysqli_fetch_row($loginresult);
			$passCheck = $logininfo[1];
			$userId = $logininfo[2];
		}
		else{
			  echo 'Username '.$_GET['username'].' not found.';
		}
		if($passCheck == md5($_POST['password'])){
			$_SESSION['loggedUserInfo']['email'] = $_POST['username'];
			$_SESSION['loggedUserInfo']['id'] = $logininfo[2];
			$_SESSION['loggedUserInfo']['name'] = $logininfo[3];
			$_SESSION['loggedUserInfo']['cdate'] = strtotime( $logininfo[6] );
			$tou = $logininfo[7];
			if($tou != "0000-00-00 00:00:00"){
			$_SESSION['loggedUser'] = $userId;
			header( 'Location: http://www.getdasher.com/dasher-tools/campaign_display.php?logger=true' ) ;
			}
			else{
				$_SESSION['loggedUser'] = $userId;
				header( 'Location: http://www.getdasher.com/dasher-tools/tou.php?firstLog=true' ) ;
			}
		}
		elseif($row_cnt > 0){
			$errorMessage = 'Incorrect password for username '.$_POST['username'];
		}
		else{
			$errorMessage = 'Sorry that username was not found.';
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
			<link rel='stylesheet' id='dasher-style-css'  href='http://getdasher.com/dasher-tools/styles.css' type='text/css' media='all' />

			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


			<script type='text/javascript' src='http://getdasher.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
			<script type='text/javascript' src='http://getdasher.com/dasher-tools/dasher.js'></script>
			<script type='text/javascript' src='http://getdasher.com/dasher-tools/jquery.lazyload.js'></script>
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

			<body class="page members-area">
			<div id="page" class="hfeed site">
					<header id="masthead" class="site-header" role="banner">
			    <div class="header-body">
					<div class="site-branding">
						<h2 class="site-title"><a href="http://www.getdasher.com/dasher-tools/campaign_display.php" rel="home"></a></h2>	
					</div>
						<?php if(isset($_SESSION['loggedUser'])): ?>
						<div class="right-buttons">
						<div class="welcome-user">Welcome <?php echo $name; ?>, <a href="logout.php">Log Out</a></div>
                        <!--
						<a href="logout.php"><div class="header-button" id="settings-button">Settings</div></a>
                        -->
						<a href="http://www.getdasher.com/dasher-tools/campaign_display.php"><div class="header-button" id="campaigns-button">Campaigns</div></a>
						</div>
						<?php endif; ?>
			      </div>
				</header><!-- #masthead -->
			<div class="content-wrap">
				<div id="content" class="site-content">

				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">



			<article id="post-198" class="post-198 page type-page status-publish hentry">

				<div class="entry-content"> <?php
	}
	else{
			$mystring = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
			$findme   = 'login.php';
			$pos = strpos($mystring, $findme);
			$pos2 = strpos($mystring, 'password-set.php');
			$pos3 = strpos($mystring, 'contact.php');
			
			if($pos === FALSE  && $pos2 === FALSE  && $pos3 == FALSE){
			header( 'Location: http://www.getdasher.com/dasher-tools/login.php' ) ;
			}
			else{ ?>
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
				<link rel='stylesheet' id='dasher-style-css'  href='http://getdasher.com/dasher-tools/styles.css' type='text/css' media='all' />

				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


				<script type='text/javascript' src='http://getdasher.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
				<script type='text/javascript' src='http://getdasher.com/dasher-tools/dasher.js'></script>
				<script type='text/javascript' src='http://getdasher.com/dasher-tools/jquery.lazyload.js'></script>
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

				<body class="page members-area">
				<div id="page" class="hfeed site">
						<header id="masthead" class="site-header" role="banner">
				    <div class="header-body">
						<div class="site-branding">
							<h2 class="site-title"><a href="http://www.getdasher.com/dasher-tools/campaign_display.php" rel="home"></a></h2>	
						</div>
							<?php if(isset($_SESSION['loggedUser'])): ?>
							<div class="right-buttons">
							<div class="welcome-user">Welcome <?php echo $name; ?>, <a href="logout.php">Log Out</a></div>
                            <!--
							<a href="logout.php"><div class="header-button" id="settings-button">Settings</div></a>
                            -->
							<a href="http://www.getdasher.com/dasher-tools/campaign_display.php"><div class="header-button" id="campaigns-button">Campaigns</div></a>
							</div>
							<?php endif; ?>
				      </div>
					</header><!-- #masthead -->
				<div class="content-wrap">
					<div id="content" class="site-content">

					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">



				<article id="post-198" class="post-198 page type-page status-publish hentry">

					<div class="entry-content"> <?php
			}
	}
}
?>