<?php
ini_set('display_errors', '1');
include('header.php');
if(isset($_COOKIE['stripe'])){
include('libs/stripe/card_info.php');
}
$out = "";
$dbUsers = new database('users');
if(isset($_POST['user_name'])){
	$updateQuery = "UPDATE `users` SET `user_name` = '".$_POST['user_name']."', `email_address` = '".$_POST['email']."', `website` = '".$_POST['website']."', `company` = '".$_POST['company']."' WHERE `ID` = ".$_COOKIE['userid'];
	$update = $dbUsers->query($updateQuery);
	$out = "Account Information Updated";
}
if(isset($_POST['new_pass'])){
	$password = $dbUsers->hashData($_POST['new_pass']);
	$updateQuery = "UPDATE `users` SET `password` = '".$password."' WHERE `ID` = ".$_COOKIE['userid'];
	$update = $dbUsers->query($updateQuery);
	$out = "Account Information Updated";
}
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$userType = $user['user_type'];
$subQuery = "SELECT * FROM `users` WHERE `sub` = ".$_COOKIE['userid'];
$subUsersResult = $dbUsers->query($subQuery);
$subUsers = $dbUsers->getRows($subUsersResult);
if($user['sub_parents'] != "" && $_COOKIE['usertype'] == "sub"){
$sub_sub = unserialize($user['sub_parents']);
$j = 0;
foreach($sub_sub as $id){
	if($j == 0){
		$sub_children = " `ID` = ".$id;
		$j++;
	}
	else{
		$sub_children = " || `ID` = ".$id;
	}
}
echo $sub_children;
$subQuery2 = "SELECT * FROM `users` WHERE".$sub_children;
$subResult2 = $dbUsers->query($subQuery2);
$sub_subs = $dbUsers->getRows($subResult2);
}
switch ($userType) {
 case 1:
        $PlanName = "Basic Plan";
		$num_galleries = 1;
		$num_tags = 3;
		$basicButton = "Current Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
    case 2:
        $PlanName = "Business Plan";
		$num_galleries = 5;
		$num_tags = 15;
		$basicButton = "Select Plan";
		$businessButton = "Current Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
    case 3:
        $PlanName = "Pro Plan";
		$num_galleries = -1;
		$num_tags = -1;
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Current Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
	case 4:
        $PlanName = "Basic Yearly Plan";
		$num_galleries = 1;
		$num_tags = 3;
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Current Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
	case 5:
        $PlanName = "Business Yearly Plan";
		$num_galleries = 5;
		$num_tags = 15;
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Current Plan";
		$proYear = "Select Plan";
        break;
    case 6:
        $PlanName = "Pro Yearly Plan";
		$num_galleries = -1;
		$num_tags = -1;
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Current Plan";
        break;
}

$dbCamps = new database($_COOKIE['userdatabase']);
$activeQuery = "SELECT COUNT(*) FROM `galleries` WHERE `status` = 1";
$results = $dbCamps->query($activeQuery);
$result = $dbCamps->getRow($results);
$numActive = $result['COUNT(*)'];

$activeQuery2 = "SELECT COUNT(*) FROM `campaign` WHERE `archived` = 0";
$results2 = $dbCamps->query($activeQuery2);
$result2 = $dbCamps->getRow($results2);
$numActive2 = $result2['COUNT(*)'];

if(isset($_GET['alert'])){
if($_GET['alert'] == "cardUpdated"){ ?>
	<script>
	$(document).ready(function(){
	$.fancybox.open({ href: "/cardUpdated.php", type:'iframe', width:'400px', height:'430px', autoSize: false }); }); 
	</script>
	<?php
}
if($_GET['alert'] == "planUpdated"){ ?>
	<script>
	$(document).ready(function(){
	$.fancybox.open({ href: "/plan_updated.php", type:'iframe', modal: true, padding:0, width:'450px', height:'250px', autoSize:false, closeBtn: false, iframe:{scrolling : 'no'} }); 
	}); 
	</script>
	<?php
}
if($_GET['alert'] == "closed"){ ?>
	<script>
	$(document).ready(function(){
	$.fancybox.open({ href: "/closed.php", type:'iframe', width:'400px', height:'330px', autoSize: false }); }); 
	</script>
	<?php
}
}

if($out != ""){ ?>
	<div class="campaign-alert"><?php echo $out; ?></div>
<?php }
?>
<h1>My Account</h1>
<span class="required-info" style="display:none;">Required Fields</span>
<form action="" method="POST" class="setting-form" id="account-info-form">
Full Name<span class="required-info">*</span><input type="text" name = "user_name" id="user-name" value="<?php echo $user['user_name']; ?>" />
Email<span class="required-info">*</span> <input type="text" name="email" id="email" value="<?php echo $user['email_address']; ?>" /><span class="form-info">(This will change your login id)</span>
Company<input type="text" name="company" value="<?php echo $user['company']; ?>" />
Website<input type="text" name="website" value="<?php echo $user['website']; ?>" />
<input type="submit" value="Save Settings" class="action_button" />
</form>
<script>
jQuery(document).ready(function(){
jQuery('#account-info-form').submit(function(){
	$name = jQuery(this).find('#user-name').val();
	$email = jQuery(this).find('#email').val();
	if($name == "" || $email == ""){
		jQuery('.required-info').css('display', 'inline-block');
		jQuery('.required-info').css('color', 'red');
		return false;
	}
	else{
		return true;
	}
});
});
</script>
<div class="current-plan">
	<h1><?php echo $PlanName; ?></h1>
	<span class="data-point"><?php echo $numActive2; ?> / <?php echo $num_tags; ?> Active Campaigns</span>
	<span class="data-point"><?php echo $numActive; ?> / <?php echo $num_galleries; ?> Active Galleries</span><br />
	<?php if($_COOKIE['usertype'] == "manager"){ ?>
	<a href="/my-plan/" class="action_button">Change Plan</a>
	<?php } ?>
	<h1 style="margin-top:20px;">Users &amp; Permissions</h1>
	<?php foreach($subUsers as $user){
		echo $user['email_address'];
		echo " <span style='font-size:11px; color:#ADADAD;'><a href='/update_permissions.php?id=".$user['email_address']."' class='edit-permissions' style='font-size:16px; color:#ADADAD; text-decoration:underline;'> <i class=\"fa fa-cog\"></i></a></span><br />";
	}
	?>
	<?php 
	if($user['sub_parents'] != "" && $_COOKIE['usertype'] == "sub"){
	foreach($sub_subs as $user){
		echo $user['email_address'];
		echo " <span style='font-size:11px; color:#ADADAD;'><a href='/update_permissions.php?id=".$user['email_address']."' class='edit-permissions' style='font-size:16px; color:#ADADAD; text-decoration:underline;'> <i class=\"fa fa-cog\"></i></a></span><br />";
	}
}
	?>
	<button id="add-user">Add User</button><br />
</div>
<script>
	jQuery(document).ready(function(){
		jQuery('#add-user').fancybox({ href: '/add_user.php', type: 'iframe', padding: '0', width:'300px', closeBtn: false, iframe:{scrolling : 'no'} });
		jQuery('.edit-permissions').fancybox({ type: 'iframe', padding: '0', width:'350px', closeBtn: false, iframe:{scrolling : 'no'} });
	});
</script>
<div style="clear:both;"></div>
<hr />
<form action="" method="post" target="_parent" class="new-password">
<h1>New Password</h1>
<div class="alert-password">* Passwords Do Not Match</div>
<input type="password" name="new_pass" id="new-pass" placeholder="New Password" />
<input type="password" name="confirm_pass" id="confirm-pass" placeholder="Confirm New Password" />
<input type="submit" class="action_button change_account" value = "Save Password">
</form>
<script>
jQuery(document).ready(function(){
	jQuery('.new-password').submit(function(){
		$newPass = jQuery(this).find('#new-pass').val();
		$confirmPass = jQuery(this).find('#confirm-pass').val();
		if($newPass != $confirmPass || $newPass == "" || $confirmPass == ""){
			jQuery('.alert-password').css('display', 'block');
			return false;
		}
		else{
			return true;
		}
	});
});
</script>
<hr />
<?php 
if($_COOKIE['usertype'] == "manager"){
	if(isset($last4)){ ?>
<div class="billing-info">
	<h1><i class="fa fa-credit-card"></i> Update Credit Card</h1>
	<p>Current Card:<br /><?php echo $brand; ?> **** **** **** <?php echo $last4; ?><br />Exp: <?php echo $month; ?> / <?php echo $year; ?></p>
	<a href="#" class="action_button update-card-button">Update Information</a>
	<p style="margin-top:10px;"><strong>When will you charge my card?</strong><br />
	We'll charge you when your subscription starts. If you're unhappy we'll issue a full refund. No questions asked.<br /><br />
	<strong>Is my credit card number safe? What if you get hacked?</strong><br />
	We never store your credit card number on our servers. It goes straight to Stripe, our credit card processor. So even if someone did hack us, your credit card info isn't here.
	<br /><br />
	<strong>Do you accept international credit cards?</strong><br />
	Yes, we accept cards from Visa, Mastercard, American Express, Discover and JCB from all over the world.</p>
</div>
<?php } else { ?>
	<div class="billing-info">
		<h1><i class="fa fa-credit-card"></i> Renew Account</h1>
		<p>Click below to reinstate your account by adding a credit card.</p>
		<a href="#" class="action_button update-card-button">Add Credit Card</a>
	</div>
	<?php }  ?>
<div class="close-account">
	<h1>Close Account</h1>
	<p>Click to close your account.  Your information will be saved for 60 days in which time you can reinstate your account.</p>
	<a href="#" class="action_button close-account">Close Account</a>
</div>
<script>
	jQuery(document).ready(function(){
		jQuery('.close-account').fancybox({ href: '/close_account.php', type: 'iframe', padding: '0', width:'300px', height:'380px', autoSize: false, closeBtn: false, iframe:{scrolling : 'no'} });
	});
</script>
<div style="clear:both;"></div>
<script>
 jQuery(document).ready(function(){
		jQuery('.update-card-button').fancybox({ type: 'iframe', href: '/card-update-info.php', padding: '0', width: '300px', height: '350px', autoSize: false, closeBtn: false, iframe:{scrolling : 'no'} });
		<?php if(isset($_GET['card'])){ ?>
			jQuery('.update-card-button').trigger('click');
		<?php } ?>
	});
	</script>
<?php
}
include('footer.php');
?>
