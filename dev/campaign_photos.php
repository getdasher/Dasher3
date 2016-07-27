<?php
ini_set('display_errors', 1);
$BASE_URL = "dashboard.getdasher.com";
include('header.php');
include('classes/class.photo.php');
include('classes/class.campaign.php');

$newPhotos = array();
$approvedPhotos = array();
$deniedPhotos = array();

$database = $_COOKIE['userdatabase'];
$dbCamps = new database($database);

$newCount_Photos = $dbCamps->query('SELECT *
					 FROM campaign_photos cp
	 				 JOIN photos p ON cp.photo_id = p.id
					WHERE `campaign_id` = '.$_GET['id'].' AND approval_status = "NULL" AND photo_url != ""
					ORDER BY cp.id DESC LIMIT 100');
$photosNew = $dbCamps->getRows($newCount_Photos);

$approvedCount_Photos = $dbCamps->query('SELECT *
					 FROM campaign_photos cp
	 				 JOIN photos p ON cp.photo_id = p.id
					WHERE `campaign_id` = '.$_GET['id'].' AND approval_status = "1" AND photo_url != ""
					ORDER BY cp.id DESC LIMIT 100');
$photosApproved = $dbCamps->getRows($approvedCount_Photos);

$denyCount_Photos = $dbCamps->query('SELECT *
					 FROM campaign_photos cp
	 				 JOIN photos p ON cp.photo_id = p.id
					WHERE `campaign_id` = '.$_GET['id'].' AND approval_status = "0" AND photo_url != ""
					ORDER BY cp.id DESC LIMIT 100');
$photosDenied = $dbCamps->getRows($denyCount_Photos);

$newCount_query = 'SELECT COUNT(*)
					 FROM campaign_photos cp
	 				 JOIN photos p ON cp.photo_id = p.id
					WHERE `campaign_id` = '.$_GET['id'].' AND approval_status = "NULL" AND photo_url != ""
					ORDER BY cp.id DESC';
$countQuery = $dbCamps->query($newCount_query);
$count = $dbCamps->getRow($countQuery);
$totalNewImages = $count['COUNT(*)'];

$approvedCount_query = 'SELECT COUNT(*)
					 FROM campaign_photos cp
	 				 JOIN photos p ON cp.photo_id = p.id
					WHERE `campaign_id` = '.$_GET['id'].' AND approval_status = "1" AND photo_url != ""
					ORDER BY cp.id DESC';
$countQuery = $dbCamps->query($approvedCount_query);
$count = $dbCamps->getRow($countQuery);
$totalApprovedImages = $count['COUNT(*)'];

$deniedCount_query = 'SELECT COUNT(*)
					 FROM campaign_photos cp
	 				 JOIN photos p ON cp.photo_id = p.id
					WHERE `campaign_id` = '.$_GET['id'].' AND approval_status = "0" AND photo_url != ""
					ORDER BY cp.id DESC';
$countQuery = $dbCamps->query($deniedCount_query);
$count = $dbCamps->getRow($countQuery);
$totalDeniedImages = $count['COUNT(*)'];

$campaign = new campaign($_GET['id']);

foreach($photosNew as $photoitem){
	
	$photograph = new photo($photoitem['photo_id']);
	$newPhotos[] = $photograph;
}

foreach($photosApproved as $photoitem){
	
	$photograph = new photo($photoitem['photo_id']);
	$approvedPhotos[] = $photograph;
}

foreach($photosDenied as $photoitem){
	
	$photograph = new photo($photoitem['photo_id']);
	$deniedPhotos[] = $photograph;
}

//New Photos
?>
<p class="campaign-name">#<?php echo $campaign->hashtag; ?></p>
<options class="desktop-options">
<div class="tab current" change="new-photos"><h1 class="tab-title">New</h1><p>Photos awaiting your review.</p><div class="count"><?php echo $totalNewImages; ?></div></div>
<div class="tab" change="approved-photos"><h1 class="tab-title">Approved Photos</h1><p>Photos that are displayed in your gallery.</p><div class="count approved-count"><?php echo $totalApprovedImages; ?></div></div>
<div class="tab" change="denied-photos"><h1 class="tab-title">Denied Photos</h1><p>Photos you don't want to display in your gallery.</p><div class="count"><?php echo $totalDeniedImages; ?></div></div>
</options>
<options class="mobile-options">
<select name="mobile-photo-nav" id = "mobile-photo-nav">
<option class="tab current" value="new-photos">New Photos - <?php echo $totalNewImages; ?></option>
<option class="tab" value="approved-photos">Approved Photos - <?php echo $totalApprovedImages; ?></option>
<option class="tab" value="denied-photos">Denied Photos - <?php echo $totalDeniedImages; ?></optioin>
</select>
</options>
<div style="clear:both;"></div>
<div class="hashtag-set current-list" id="new-photos">
<?php
 foreach($newPhotos as $photo) : ?>
 	<?php $typeImage = typeImage($photo->type);?>
     <div class="img-set" id="image_ID_<?php echo $photo->id; ?>" >		
		<a href="<?php echo $photo->photoUrl; ?>" class="fancybox" fancy-title='<?php echo $typeImage; ?><a href="<?php echo str_replace(' ', '', $photo->photoUserLink); ?>" target="_blank"><?php echo $photo->photoUser; ?></a><br /><?php echo str_replace("'", '', urldecode($photo->photoCaptions)); ?><br /><a href="<?php echo $photo->photoService; ?>" target="_blank">View the Post></a>'>
			<li class="blank-photo" style="background-image:url(); overflow:hidden; width:100%; height:181px; background-size:cover;" data-original="<?php echo $photo->photoUrl; ?>" ><i class="fa fa-search" out="<?php echo $photo->photoUrl; ?>"></i></li>
		</a>
		<div class="hoverdata" style="display: none;">
				
				<div class="userNameTwitter"><?php echo $typeImage; ?><a href="<?php echo str_replace(' ', '', $photo->photoUserLink); ?>" target="_blank"><?php echo $photo->photoUser; ?></a></div>
				<div class="userDescription"><?php echo urldecode($photo->photoCaptions); ?><br /><a href="<?php echo $photo->photoService; ?>" target="_blank">View the Post</a></div>
				
		</div>
		<li>
		<form action="">
			<label class="approve" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="approve">
			<input type="radio" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="approve" ><i class="fa fa-check"></i>
			</label>
			<label class="decline" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="deny">
			<input type="radio" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="deny" ><i class="fa fa-times"></i>
			</label>
		</form>
		<div style='clear:both;'></div>
		</li>
    </div>
	<?php
endforeach;
?>
<div class="clear"></div>
<div class="button more-photos" type="new">More Photos</div>
</div>
<div class="hashtag-set" id="approved-photos">
<?php
//Approved Photos

//New Photos
 foreach($approvedPhotos as $photo) : ?>
 	<?php $typeImage = typeImage($photo->type); ?>
     <div class="img-set" id="image_ID_<?php echo $photo->id; ?>" >	
		<a href="<?php echo $photo->photoUrl; ?>" class="fancybox" fancy-title='<?php echo $typeImage; ?><a href="<?php echo str_replace(' ', '', $photo->photoUserLink); ?>" target="_blank"><?php echo $photo->photoUser; ?></a><br /><?php echo str_replace("'", '', urldecode($photo->photoCaptions)); ?><br /><a href="<?php echo $photo->photoService; ?>" target="_blank">View the Post</a>'>
			<li class="blank-photo" style="background-image:url(); overflow:hidden; width:100%; height:181px; background-size:cover;" data-original="<?php echo $photo->photoUrl; ?>" ><i class="fa fa-search" out="<?php echo $photo->photoUrl; ?>"></i></li>
		</a>
		<div class="hoverdata" style="display: none;">
				
				<div class="userNameTwitter"><?php echo $typeImage; ?><a href="<?php echo str_replace(' ', '', $photo->photoUserLink); ?>" target="_blank"><?php echo $photo->photoUser; ?></a></div>
				<div class="userDescription"><?php echo urldecode($photo->photoCaptions); ?><br /><a href="<?php echo $photo->photoService; ?>" target="_blank">View the Post</a></div>
		</div>
		<li>
		<form action="">
			<label class="approve" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="approve">
			<input type="radio" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="approve" ><i class="fa fa-check"></i>
			</label>
			<label class="decline" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="deny">
			<input type="radio" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="deny" ><i class="fa fa-times"></i>
			</label>
		</form>
		<div style='clear:both;'></div>
		</li>
    </div>
	<?php
endforeach;
?>
<div class="approve-clear clear"></div>
<div class="button more-photos" type="approved">More Photos</div>
</div>
<div class="hashtag-set" id="denied-photos">
<?php 
//Denied Photos
//New Photos
 foreach($deniedPhotos as $photo) : ?>
 	<?php $typeImage = typeImage($photo->type); ?>
     <div class="img-set" id="image_ID_<?php echo $photo->id; ?>" >	
		<a href="<?php echo $photo->photoUrl; ?>" class="fancybox" fancy-title='<?php echo $typeImage; ?><a href="<?php echo str_replace(' ', '', $photo->photoUserLink); ?>" target="_blank"><?php echo $photo->photoUser; ?></a><br /><?php echo str_replace("'", '', urldecode($photo->photoCaptions)); ?><br /><a href="<?php echo $photo->photoService; ?>" target="_blank">View the Post</a>'>
			<li class="blank-photo" style="background-image:url(); overflow:hidden; width:100%; height:181px; background-size:cover;" data-original="<?php echo $photo->photoUrl; ?>" ><i class="fa fa-search" out="<?php echo $photo->photoUrl; ?>"></i></li>
		</a>
		<div class="hoverdata" style="display: none;">
				
				<div class="userNameTwitter"><?php echo $typeImage; ?><a href="<?php echo str_replace(' ', '', $photo->photoUserLink); ?>" target="_blank"><?php echo $photo->photoUser; ?></a></div>
				<div class="userDescription"><?php echo urldecode($photo->photoCaptions); ?><br /><a href="<?php echo $photo->photoService; ?>" target="_blank">View the Post</a></div>
		</div>
		<li>
		<form action="">
			<label class="approve" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="approve">
			<input type="radio" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="approve" ><i class="fa fa-check"></i>
			</label>
			<label class="decline" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="deny">
			<input type="radio" name="approve_<?php echo $photo->id; ?>" imgid="<?php echo $photo->id; ?>" value="deny" ><i class="fa fa-times"></i>
			</label>
		</form>
		<div style='clear:both;'></div>
		</li>
    </div>
	<?php
endforeach;
?>
<div class="clear"></div>
<div class="button more-photos" type="denied">More Photos</div>
</div>
<script>
	$(document).ready(function(){
		$count = 100;
		$('.tab').click(function(){
			$newTab = $(this);
			$shower = "#"+$(this).attr('change');
			if ($($shower).css('display') == 'none'){
			$('.current-list').fadeToggle("fast", function(){ 
				$('.current').removeClass('current');
				$('.current-list').css('display', 'none');
				$('.current-list').removeClass('current-list');
				$($shower).fadeToggle("fast", function(){
					$($shower).addClass('current-list');
					$($newTab).addClass('current');
					window.scrollTo(1,1);
					window.scrollTo(0,0);
				});
			});
		}
		});
		
		$('.more-photos').click(function(){
			$button = $(this);
			$button.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
			$type = $(this).attr('type');
			$div = "#"+$type+"-photos .clear";
			console.log($div);
			$url = "/more_photos.php?offset="+$count+"&type="+$type+"&id=<?php echo $_GET['id']; ?>";
			$.get( $url, function( data ) {
			  $($div).before( data );
			  console.log( "Load was performed." );
			 $count = 200;
			jQuery(".blank-photo").lazyload({
			      effect : "fadeIn"
			  });
			$button.html('More Photos');
			});
		});
	});
</script>
</div>
<?php
include('footer.php');
?>