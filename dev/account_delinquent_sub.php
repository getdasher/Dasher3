<?php
ini_set('display_errors', 1);
require_once('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
?>
<div class="modal-header">Payment Information Needed</div>
<p style="margin-top:30px; margin-bottom:20px;">Your form of payment was not valid or your account was closed. <span class="main-message">You can check in with <?php echo $_COOKIE['parentEmail']; ?> to re-activate payment on this account.</span></p>
<span><i class="fa fa-info-circle"></i> Any galleries that you have embedded on your website are now disabled.</span><br /><br />
<?php require_once('footer.php'); ?>