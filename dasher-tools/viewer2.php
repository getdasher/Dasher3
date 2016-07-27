<?php
	header('Access-Control-Allow-Origin: *'); 
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");
    require_once ("settings.php");

	$photos = array();
	
	$photo_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
						 FROM campaign_photos cp
		 				 JOIN photos p ON cp.photo_id = p.id
						WHERE campaign_id = '. $_GET['id'] .'
						ORDER BY id ASC';

	if ($results = mysqli_query($link, $photo_query)) {	
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
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
	
	// Get New Photos that haven't been approved ::::::::::::::::::::::::::::::::::END
	
	function getTypeImage($picID){
		switch ($picID) {
		    case 1:
		        echo '<img src="http://getdasher.com/wp-content/uploads/2014/02/twitter-24.png" alt="twitter" class="icon" /> ';
		        break;
		    case 2:
		        echo '<img src="http://getdasher.com/wp-content/uploads/2014/02/instagram-24.png" alt="instagram" class="icon" /> ';
		        break;
		    case 3:
		        echo '<img src="http://getdasher.com/wp-content/uploads/2014/02/googleplus-24.png" alt="googleplus" class="icon" /> ';
		        break;
			case 4:
			    echo '<img src="http://getdasher.com/wp-content/uploads/2014/02/facebook-24.png" alt="facebook" class="icon" /> ';
			    break;
		}
	}
	
	
$count2 = 1; ?>
<link rel='stylesheet' id='dasher-style-css'  href='http://getdasher.com/dasher-tools/user-iframe2.css' type='text/css' media='all' />
<script src="http://getdasher.com/dasher-tools/jquery.carouFredSel-6.2.1.js" type="text/javascript" ></script>
<script type="text/javascript" language="javascript" src="http://getdasher.com/dasher-tools/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" language="javascript" src="http://getdasher.com/dasher-tools/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" language="javascript" src="http://getdasher.com/dasher-tools/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" language="javascript" src="http://getdasher.com/dasher-tools/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery('.list_carousel #next').fadeToggle('fast');
		jQuery('.list_carousel #prev').fadeToggle('fast');

		jQuery('#items').carouFredSel({
			items : { 
			visible: 5, 
			start : 20, 
			},
			auto: false,
			scroll : {  items: 4, easing : "linear",  duration : 300 },
			width: 960,
			prev: '#prev',
			next: '#next',
			mousewheel: true,
			swipe: {
				onMouse: true,
				onTouch: true
			}
		});
		jQuery('.list_carousel').hover(function() {
	    	jQuery('.list_carousel #next').fadeToggle('fast');
			jQuery('.list_carousel #prev').fadeToggle('fast');
	  	}, function() {
			jQuery('.list_carousel #next').fadeToggle('fast');
			jQuery('.list_carousel #prev').fadeToggle('fast');
	  	});

		jQuery('.list_carousel li').click(function(){
			$title = jQuery(this).attr('titler');
			$('.dasher-gallery').colorbox({title : function(){
			  $title = jQuery(this).attr('titler');
			  return $title}, maxWidth : '90%', maxHeight : '90%', rel:'.dasher-gallery'});
		});
	});
</script>

<?php	
	echo '<div class="poa-banner"></div><div class="list_carousel">
				<ul id="items">';
						if( count($photos) > 0 ):
						 foreach( $photos as $photo): 
							 if($photo['approval_status'] != ""): 
				                 if( $photo['approval_status'] == 1 ): ?>
				                 <li style="background-image:url(<?php echo $photo['url']; ?>);" href="<?php echo $photo['url']; ?>" titler='<?php getTypeImage($photo['type']); ?> <a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?> <a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a>' class="dasher-gallery"></li><?php
						 endif;
				              endif;
						 endforeach;
				echo '</ul>
				<div class="clearfix"></div>
				<a id="prev" class="prev" href="#">&lsaquo;</a>
				<a id="next" class="next" href="#">&rsaquo;</a>
				<br />
			</div>
			
			<div style="clear:both;"></div><a href="http://www.getdasher.com" target="_blank"><img class="dasher-branding" src="http://getdasher.com/wp-content/uploads/2014/02/powered_by_dasher1.png" /></a>';
			else: 
				echo '<p>No photos have been collected yet.</p>';
			endif;
			?>