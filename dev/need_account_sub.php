<?php
ini_set('display_errors', 1);
require_once('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
?>
<div class="modal-header">Your Free Trial Has Come To An End</div>
<p style="margin-top:30px;">By now you’ve had some time to set up a hashtag campaign or two, customize a gallery, and embed a gallery on your site.</p><br />
<span><i class="fa fa-info-circle"></i> Any galleries that you have embedded on your website will now be disabled.</span><br /><br />
<span class="main-message">The next step is to check in with <?php echo $_COOKIE['parentEmail']; ?> to activate payment on this account.</span><br /><br />
If you’ve had any trouble getting your gallery to embed or have any questions, please don’t hesitate to <a href="mailto:team@getdasher.com">email us</a>. We’d be happy to help.<br /><br />
<?php require_once('footer.php'); ?>