<?php
ini_set('display_errors', 1);
require_once('classes/class.campaign.php');
require_once('header.php');
$dbUsers = new database('users');
if(isset($_COOKIE['parentId'])){
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['parentId'];
}
else{	
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
}
$user = $dbUsers->getRow($userQuery);
$userType = $user['user_type'];
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
$activeQuery = "SELECT COUNT(*) FROM `campaign` WHERE `archived` = 0";
$results = $dbCamps->query($activeQuery);
$result = $dbCamps->getRow($results);

$numActive = $result['COUNT(*)'];

if(isset($_POST['hashtag'])){ 
	createCampaign($_POST['hashtag'], $_POST['facebook']);
	echo "<script>window.parent.location = '/campaign-display/?alert=newcampaign'; </script>";
} 	
elseif(isset($_GET['q'])){	?>
	<div class="modal-header">NEW HASHTAG</div>
	<form action="" method="post" style="margin-top:50px; width:100%; font-size:12px;">
		<input type="text" name="hashtag" placeholder="#hashtag" style="margin-bottom:10px;" />
		<br /><i class="fa fa-facebook"></i> Connect a Facebook Page. Enter a URL:
		<input type="text" name="facebook" placeholder="&#xf09a; Facebook ID" style="margin-top:5px; margin-bottom:5px;" />
		<br /><i class="fa fa-info"></i> Entering your Facebook page's URL or Page ID allows Dasher to more effectively search for photos on Facebook, improving your results.
		<input type = "submit" value="create tag" />
	</form>
<?php } else { 
	
		if($numActive < $num_tags){
	?>
<div class="modal-header">CHOOSING A HASHTAG</div>
<p style="margin-top:50px;">Any word or phrase with the # symbol immediately in front of it is a hashtag. This symbol turns the word into a link that makes it easier to find and follow.  You also add a facebook page or group id or name to allow Dasher to find photos on your facebook presence.</p>
<a href="?q=newhash" ><button>Continue</button></a> <button class="close_window" style="float:right;">Cancel</button>
<script>
		jQuery('.close_window').click(function(){
			parent.$.fancybox.close();
		});
		</script> <?php }
		else{ ?>
			<div class="modal-header">NEW HASHTAG</div>
			<p style="margin-top:50px; width:100%; font-size:14px;">It looks like you have reached your maximum number of active hashtags. You can select a new plan that fits your needs or deactivate a hashtag.</p>
			<button class="plans_window" style="float:left;">View Plans</button><button class="close_window" style="float:right;">Close Window</button>
			<script>
					jQuery('.close_window').click(function(){
						parent.$.fancybox.close();
					});
					jQuery('.plans_window').click(function(){
						window.parent.location = "/my-plan/";
					});
			</script>
			<?php } } ?>
</body>
</html>