<?php
ini_set('display_errors', 1);
require_once('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
?>
<h1>Edit Account</h1><br />
<form action="/my_account.php" method="post" target="_parent">
Name: <input type="text" name="user_name" value="<?php echo $user['user_name']; ?>" /><br /><br />
New Password (Optional)<br />
<input type="password" name="new_pass" placeholder="New Password" /><br />
<input type="password" name="confirm_pass" placeholder="Confirm New Password" /><br /><br />
<input type="submit" class="action_button change_account" value = "Submit Edits">
</form>
<?php require_once('footer.php'); ?>