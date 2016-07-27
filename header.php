<?php
ini_set('display_errors', 0);
session_start();
$BASE_URL = "app.getdasher.com";
$class_link = $_SERVER['PHP_SELF'];
$headerText = 'Location: /login/?page='.$class_link;
$class_link = str_replace('/', '', $class_link);
$class_link = str_replace('.', '-', $class_link);
$class_link = str_replace('_', '-', $class_link);
require_once('classes/class.database.php');
require_once('classes/class.authorization.php');
if(!isset($_COOKIE["userdatabase"])){
	header($headerText);
}
$_COOKIE['delinquent'] = "";
if(($_COOKIE["userloggedIn"]) == false){header($headerText);}
if($_COOKIE['stripe']){
require_once('libs/stripe/customer_delinquent.php');
}
$trialEnd = false;
$stamp = strtotime($_COOKIE['trial_stamp']);
$month = strtotime($_COOKIE['trial_stamp']);
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$currentStamp = time();
if($currentStamp > $month){
	$trialEnd = true;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Members Area | DASHER</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="http://<?php echo $BASE_URL ?>/xmlrpc.php">
<link href="http://getdasher.com/v3landing/apple-touch-icon-152.png" rel="shortcut icon" sizes='152x152'/>

<!-- Load Stylesheet-->
<link href="/libs/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://<?php echo $BASE_URL ?>/fancybox/jquery.fancybox.css' type='text/css' media='all' />
<link rel="stylesheet" href="http://<?php echo $BASE_URL ?>/css/colpick.css" type="text/css"/>
<link href="http://hayageek.github.io/jQuery-Upload-File/uploadfile.min.css" rel="stylesheet">

<!-- Load JS-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/dasher.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://<?php echo $BASE_URL ?>/js/modernizr.js'></script>
<script type="text/javascript" src="http://<?php echo $BASE_URL ?>/js/colpick.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/jquery.uploadfile.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>


<link rel='stylesheet' id='dasher-style-css'  href='http://<?php echo $BASE_URL ?>/css/style.css' type='text/css' media='all' />
<?php 
if($_COOKIE['usertype'] == "manager"){
if($_COOKIE['stripe'] == "" && $trialEnd == true && $stamp < $month && $class_link != "need-account-php" && $class_link != "need-account-sub-php" && $class_link != "create-account-php" && $class_link != "my-account-php" && $class_link != 'new-charge-php'): ?>
	<script>
		$(document).ready(function(){
			$.fancybox.open({ href: 'http://<?php echo $BASE_URL ?>/need_account.php', type:'iframe', modal: true, padding:0, width:600, height:400, autoSize:false, closeBtn: false, iframe:{scrolling : 'no'} });
		});
	</script>
<?php endif; ?>
<?php if($_COOKIE['delinquent'] == true && $class_link != 'account-delinquent-php' && $class_link != 'account-delinquent-sub-php' && $class_link != "need-account-sub-php" && $class_link != "my-account-php" && $class_link != 'card-update-info-php'  && $class_link != "close-account-php") { ?>
<script>
	$(document).ready(function(){
		$.fancybox.open({ href: 'http://<?php echo $BASE_URL ?>/account_delinquent.php', type:'iframe', modal: true, padding:0, width:'450px', height:'250px', autoSize:false, closeBtn: false, iframe:{scrolling : 'no'} });
	});
</script>
<?php }
}
else{
	if($_COOKIE['stripe'] == "" && $trialEnd == true && $stamp < $month && $class_link != "need-account-php" && $class_link != "need-account-sub-php" && $class_link != "create-account-php" && $class_link != "my-account-php" && $class_link != 'new-charge-php'): ?>
		<script>
			$(document).ready(function(){
				$.fancybox.open({ href: 'http://<?php echo $BASE_URL ?>/need_account_sub.php', type:'iframe', modal: true, padding:0, width:600, height:400, autoSize:false, closeBtn: false, iframe:{scrolling : 'no'} });
			});
		</script>
	<?php endif; ?>
	<?php if($_COOKIE['delinquent'] == true && $class_link != 'account-delinquent-php' && $class_link != 'account-delinquent-sub-php' && $class_link != "need-account-sub-php" && $class_link != "my-account-php" && $class_link != 'card-update-info-php'  && $class_link != "close-account-php") { ?>
	<script>
		$(document).ready(function(){
			$.fancybox.open({ href: 'http://<?php echo $BASE_URL ?>/account_delinquent_sub.php', type:'iframe', modal: true, padding:0, width:'450px', height:'250px', autoSize:false, closeBtn: false, iframe:{scrolling : 'no'} });
		});
	</script>
	<?php }	
}
 ?>
</head>
<body class="page members-area <?php echo $class_link; ?>">
    <div id="page" class="hfeed site">
	    <header id="masthead" class="site-header" role="banner">
   			<div class="navigation">
				<div class="logo-area"><a href="/"><img class='nav-logo' src="http://app.getdasher.com/images/logo-header.png" /></a></div>
				<i class="fa fa-bars show-mobile-nav"></i>
				<nav id="nav" role="navigation">
				    <ul>
				        <a href="/"><li>Dashboard</li></a>
				        <a href="/gallery-builder/" aria-haspopup="true"><li>Build A Gallery</li></a>
						<a href="#" target="_blank" class="account-nav ideas-nav"><li class="ideas-nav">Help 
				              <ul><a href="http://getdasher.com/faq/" target="_blank"><li>FAQ</li></a></ul>
								<ul><a href="http://getdasher.com/category/ideas/" target="_blank"><li>Blog Posts</li></a></ul>
							</li></a>
						<a href="#" aria-haspopup="true" class="account-nav"><li class="account-right">Account <i class="fa fa-chevron-down"></i>
							<ul><a href="/galleries/" aria-haspopup="true"><li>My Galleries</li></a></ul>
							<ul><a href="/my-account/"><li>Settings</li></a></ul>
							<ul><a href="/logout.php"><li>Sign Out</li></a></ul>
				        </li></a>
				    </ul>
				</nav>
			</div>
	    </header><!-- #masthead -->
        <div class="content-wrap">
	                        <div class="entry-content">
								<div class="new-hashtag-button" data-fancybox-type="iframe" href="/newcampaign.php">+ Add A Hashtag</div>