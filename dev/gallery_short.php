<?php
ini_set('display_errors', 1);
require_once('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$url = "http://app.getdasher.com/galleries.php?id=".$_GET['id']."&name=".$_GET['name']."&user=".$_COOKIE['userid'];
?>
<div class="modal-header">Gallery Code</div>
<p style="margin-top:30px;">Copy and paste the code below to a page of your website.</p>
<p class="output-code">&lt;div class=&quot;dasher2&quot; &gt;&lt;script src="<?php echo $url; ?>"&gt;&lt;/script&gt;&lt;/div&gt;</p><br /><br />
<a href="javascript:parent.$.fancybox.close();"><button>Close Window</button></a>
<?php require_once('footer.php'); ?>