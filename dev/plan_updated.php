<?php
ini_set('display_errors', 1);
require_once('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$userType = $user['user_type'];
switch ($userType) {
    case 1:
        $PlanName = "Basic Plan";
		$planCost = "$24.99 per month";
        break;
    case 2:
        $PlanName = "Business Plan";
		$planCost = "$79.99 per month";
        break;
    case 3:
        $PlanName = "Pro Plan";
		$planCost = "";
        break;
	case 4:
        $PlanName = "Basic Yearly Plan";
		$planCost = "$269.88 per year";
        break;
	case 5:
        $PlanName = "Business Yearly Plan";
		$planCost = "$863.88 per month";
        break;
    case 6:
        $PlanName = "Pro Yearly Plan";
		$planCost = "";
        break;
}
?>
<div class="modal-header">Plan Updated</div>
<p style="margin-top:50px; display:block;">Your plan was successfully updated. You will see the changes in the next billing cycle.  Any remaining positive balances will be used before your card is charged.</p>
<button class="close_window" style="float:right;">Close Window</button>
<div style="clear:both"></div>
<script>
	jQuery('.close_window').click(function(){
		parent.location = "http://app.getdasher.com/my-account/";
	});
</script>
<?php require_once('footer.php'); ?>