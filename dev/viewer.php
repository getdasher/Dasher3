<?php
	ini_set("display_errors", 1);
	header('Access-Control-Allow-Origin: *'); 
	session_start();
	require_once('classes/class.database.php');
	
	$database = new database('dasher-57');
	
	$photos = array();
	
	$photo_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
						 FROM campaign_photos cp
		 				 JOIN photos p ON cp.photo_id = p.id
						WHERE campaign_id = "'. $_GET['id'] .'" || campaign_id = "'.$_GET['id2'].' || campaign_id = 3"
						ORDER BY id ASC';
	
	$photo_query = str_replace('”', '', $photo_query);
	
	if ($results = $database->query($photo_query)) {	
		$i = 0;
		while( $info =  mysqli_fetch_assoc($results) ){
			$photos[$i]['url'] = $info['photo_url'];
			$photos[$i]['id'] = $info['id'];
			$photos[$i]['type'] = $info['type'];
			$photos[$i]['postlink'] = $info['service_link'];
			$photos[$i]['userlink'] = $info['user_link'];
			$photos[$i]['username'] = $info['user_name'];
			$photos[$i]['captions'] = urldecode($info['captions']);
			$photos[$i]['captions'] = str_replace("'", '&#39', $photos[$i]['captions']);
			$photos[$i]['approval_status'] = $info['approval_status'];
			$i++;
		};
	}
	
	// Get New Photos that haven't been approved ::::::::::::::::::::::::::::::::::END
	
	function getTypeImage($picID){
		switch ($picID) {
		    case 1:
		        echo '<img src="http://app.getdasher.com/images/twitter-24.png" alt="twitter" class="icon" /> ';
		        break;
		    case 2:
		        echo '<img src="http://app.getdasher.com/images/instagram-24.png" alt="instagram" class="icon" /> ';
		        break;
		    case 3:
		        echo '<img src="http://app.getdasher.com/images/googleplus-24.png" alt="googleplus" class="icon" /> ';
		        break;
			case 4:
			    echo '<img src="http://app.getdasher.com/images/facebook-24.png" alt="facebook" class="icon" /> ';
			    break;
		}
	}
	
	
$count2 = 1; ?>

<link rel="stylesheet" href="http://app.getdasher.com/bxslider/jquery.bxslider.css" type="text/css" />
<script type="text/javascript" src="http://app.getdasher.com/bxslider/jquery.bxslider.js" type="text/javascript" ></script>
<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery('#items').bxSlider({
		    slideWidth: 160,
		    minSlides: 2,
		    maxSlides: 2,
		 	moveSlides: 1,
		    slideMargin: 10
		  });
		
		jQuery('.slide').hover(
		  function() {
		    jQuery( this ).find('.title').toggle();
		  }, function() {
		    jQuery( this ).find('.title').toggle();
		  });
		
		
	});
</script>

<?php	
	echo '<div id="items" style="margin-left:5px;">';
						if( count($photos) > 0 ):
						 foreach( $photos as $photo): 
							 if($photo['approval_status'] != ""): 
				                 if( $photo['approval_status'] == 1 ): ?>
				                 <div class="slide"><a href="<?php echo $photo['url']; ?>" class="fancybox" rel="dasher-small" fancy-title='<?php getTypeImage($photo['type']); ?> <a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?> <a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a>'><img src="<?php echo $photo['url']; ?>" />
									<div class="title"><?php getTypeImage($photo['type']); ?> <a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?> <a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a></div></a>
								</div>
								<?php
						 endif;
				              endif;
						 endforeach; endif; ?>
			</div>
			<a href="http://getdasher.com" class="dasher-logo" target="_blank"><img src="http://app.getdasher.com/images/dasher_bozeman_brewing.png" /></a>