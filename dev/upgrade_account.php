<?php
ini_set('display_errors', '1');
include('header.php');
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$userType = $user['user_type'];
switch ($userType) {
    case 1:
        $PlanName = "Basic Plan";
		$num_galleries = 1;
		$num_tags = 5;
		$basicButton = "Current Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
    case 2:
        $PlanName = "Business Plan";
		$num_galleries = 3;
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
		$num_galleries = 'Unlimited';
		$num_tags = 'Unlimited';
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
		$num_tags = 5;
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Current Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
	case 5:
        $PlanName = "Business Yearly Plan";
		$num_galleries = 3;
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
		$num_galleries = 'Unlimited';
		$num_tags = 'Unlimited';
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Current Plan";
        break;
}
?>
<a href="/my-account/" class="action_button" style="border:none !important; margin-bottom:10px; padding-left:0 !important; display: inline-block;"><i class="fa fa-chevron-left"></i> Back To Account</a>
<h1>Select A Plan</h1>
<div class="year-month-toggle">Annually &nbsp;&nbsp;<input type="checkbox" name="month-slider" id="iconsbox1" class="faChkSlide month-checkbox" /><label for="iconsbox1" class="left-label">&nbsp;</label>Monthly<br />10% Savings On Every Annual Purchase.</div>
<!-- PRICING TABLE -->
<div class="pricing">
<ul class="pricing_table year-table">
     
    <li class="price_block">
        <h3>Basic</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$22.49</span>
                <span class="price_tenure">per month<br /><strong>SAVE $30 per year</strong></span>
            </div>
        </div>
        <ul class="features">
            <li>3 Active Hashtags</li>
            <li>1 Active Gallery</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
			<div class="button changePlan <?php echo $basicYear; ?>" type="4" tags="1"><?php echo $basicYear; ?></div>
        </div>
    </li>

        <li class="callout price_block">
        <h3 class="callout">Business</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number"><br />$71.99</span>
                <span class="price_tenure">per month<br /><strong>SAVE $96 per year</strong></span>
            </div>
        </div>
        <ul class="features">
            <li>15 Active Hashtags</li>
            <li>5 Active Galleries</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
           <div class="button changePlan <?php echo $businessYear; ?>" type="5" tags="3"><?php echo $businessYear; ?></div>
        </div>
    </li>

        <li class="price_block">
        <h3>Pro</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">Contact Us</span>
                <span class="price_tenure"></span>
            </div>
        </div>
        <ul class="features">
            <li>Unlimited Hashtags</li>
            <li>Unlimited Galleries</li>
			<li>Unlimited Users</li>
            <li>Client Level Dashboard Control</li>
            <li>API Connectivity</li>
        </ul>
        <div class="footer">
            
        </div>
    </li>
</ul>
<ul class="pricing_table month-table">
     
    <li class="price_block">
        <h3>Basic</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$24.99</span>
                <span class="price_tenure">per month</span>
            </div>
        </div>
        <ul class="features">
            <li>3 Active Hashtags</li>
            <li>1 Active Gallery</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
			<div class="button changePlan <?php echo $basicButton; ?>" type="1" tags="1"><?php echo $basicButton; ?></div>
        </div>
    </li>

        <li class="callout price_block">
        <h3 class="callout">Business</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">$79.99</span>
                <span class="price_tenure">per month</span>
            </div>
        </div>
        <ul class="features">
            <li>15 Active Hashtags</li>
            <li>5 Active Galleries</li>
			<li>Unlimited Users</li>
            <li>Full Dashboard Control</li>
        </ul>
        <div class="footer">
           <div class="button changePlan <?php echo $businessButton; ?>" type="2" tags="3"><?php echo $businessButton; ?></div>
        </div>
    </li>

        <li class="price_block">
        <h3>Pro</h3>
        <div class="price">
            <div class="price_figure">
                <span class="price_number">Contact Us</span>
                <span class="price_tenure"></span>
            </div>
        </div>
        <ul class="features">
            <li>Unlimited Hashtags</li>
            <li>Unlimited Galleries</li>
			<li>Unlimited Users</li>
            <li>Client Level Dashboard Control</li>
            <li>API Connectivity</li>
        </ul>
        <div class="footer">
            
        </div>
    </li>
</ul>
 </div>
<!-- END PRICING TABLE -->
<script>
	$numGalleries = '<?php echo $num_galleries; ?>';
	jQuery(document).ready(function(){
	jQuery('.changePlan').click(function(){
		$type = jQuery(this).attr('type');
		if(jQuery(this).hasClass('Current') == false){
			$newNum = jQuery(this).attr('tags');
			if($numGalleries > $newNum){
				$url = '/downgrade.php?type='+$type;
				$.fancybox.open({ href: $url, type:'iframe', modal: true, padding:0, width:400, height:400, autoSize:false, closeBtn: false, iframe:{scrolling : 'no'} });
			}
			else{
		
		$url = "/libs/stripe/plan_change.php?sub="+$type
		jQuery.get($url, function( data ) {
		  jQuery( ".result" ).html( data );
		  console.log( "Load was performed." );
		  window.location = '/my-account/?alert=planUpdated';
		});
	}
}
	});
	jQuery('.month-checkbox').change(function(){
			jQuery('.year-table').toggle();
			jQuery('.month-table').toggle();
	});
});
</script>
<?php
include('footer.php');
?>