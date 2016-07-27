<?php
ini_set('display_errors', '1');
include('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$userType = $user['user_type'];
switch ($userType) {
    case 1:
	case 4:
        $planName = "Basic Plan";
		$num_galleries = 1;
        break;
    case 2:
	case 5:
        $planName = "Business Plan";
		$num_galleries = 3;
        break;
    case 3:
	case 6:
        $planName = "Pro Plan";
		$num_galleries = 'Unlimited';
        break;
		case 7:
		case 8:
	        $planName = "Starter Plan";
			$num_galleries = 1;
	        break;
}
$dbCamps = new database($_COOKIE['userdatabase']);
$activeQuery = "SELECT COUNT(*) FROM `galleries` WHERE `status` = 1";
$results = $dbCamps->query($activeQuery);
$result = $dbCamps->getRow($results);
$numActive = $result['COUNT(*)'];
?>
<script>
$numActive = <?php echo $numActive; ?>;
$numTotal = <?php echo $num_galleries; ?>;
jQuery(document).ready(function(){
	jQuery('.short').fancybox({ type : 'iframe', width : '550px', height: '200px', autoSize: false, padding:0, closeBtn: false, iframe:{scrolling : 'no'} });
	jQuery('.deleter').fancybox({type : 'iframe', width : '400px', height: '200px', autoSize: false, padding:0, closeBtn: false, iframe:{scrolling : 'no'} });
	jQuery('.icons-checkbox').click(function(event){
			$id = jQuery(this).attr('gid');
			if(jQuery(this).is(':checked')){
				if($numActive < $numTotal){
					$url = '/classes/gallery_update.php?id='+$id+"&state=1";
					jQuery.get( $url, function( data ) {
					});
					$numActive++;
				}
				else{
					event.preventDefault();
					jQuery.fancybox({ href: '/gallery_max.php', type: 'iframe', padding: '0', wrapCSS: 'modal-wrap', width:'300px', closeBtn: false });
				}
			}
		else{
			$numActive--;
			$url = '/classes/gallery_update.php?id='+$id+"&state=0";
			jQuery.get( $url, function( data ) {
			});
		}
	});
});
</script>
<h1>My Galleries</h1>
<p>Your <strong><?php echo $planName; ?></strong> includes <strong><?php echo $num_galleries; ?> Active Galleries</strong>.  Create and store as many galleries as you like.  Toggle to make gallery active or inactive</p>
<?php if($_COOKIE['usertype'] != "sub"){ ?>
<p><a href="/my-plan/"><button>View Plans ></button></a></p>
<?php } ?>
<p class="info"><i class="fa fa-info"></i> If a gallery is embedded on your webiste and is deactivated, Dasher will display a small logo until the gallery becomes active</p>
<?php
$galleries = $dbCamps->query('SELECT * FROM `galleries`');
if($dbCamps->numRows($galleries) > 0){
	$gallery_data = $dbCamps->getRows($galleries);
	foreach($gallery_data as $gallery){ 
		$checked = "";
		if($gallery['status'] == 1){
			$checked = 'checked="checked"';
		}
		?>
		<div class="gallery-snapshot">
							<input type="checkbox" <?php echo $checked; ?> name="gallery-slider" id="iconsbox<?php echo $gallery['ID']; ?>" gid="<?php echo $gallery['ID']; ?>" class="faChkSlide icons-checkbox" /><label for="iconsbox<?php echo $gallery['ID']; ?>" class="left-label">&nbsp;</label><div class = "slide-opacity">
		    				<div class="gallery-title"><?php echo $gallery['name']; ?></div>
							<div class="gallery-date"><?php echo date('M d, Y', strtotime($gallery['date'])); ?></div>
							<a href="/gallery_delete_notice.php?id=<?php echo $gallery['ID']; ?>" class="embed-code deleter">Delete Gallery</a>
							<a href="/gallery-builder/?edit=<?php echo $gallery['ID']; ?>" class="embed-code">Edit Gallery</a>
							<a href="/gallery_short.php?name=<?php echo $gallery['name']; ?>&id=<?php echo $gallery['ID']; ?>" class="embed-code short" coder="<?php echo $gallery['name']; ?>"><div>Get Embed Code</div></a>
							</div>
							<div class='clear'></div></div>
	<?php }
}
else{
	echo "Please create your first gallery.";
}
echo '</div>';
include('footer.php');
?>
