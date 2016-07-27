<?php
	ini_set('memory_limit','128M');
	ini_set("display_errors", 0);
	header('Access-Control-Allow-Origin: *'); 
	session_start();
	require_once('../classes/class.database.php');
	
	function checkRemoteFile($url)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    // don't download content
	    curl_setopt($ch, CURLOPT_NOBODY, 1);
	    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    if(curl_exec($ch)!==FALSE)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}
	
	$user = $_GET['id'];
	$databaseName = 'dasher-'.$user;
	$database = new database($databaseName);
	
	$photos = array();
	$campaigns = $_GET['tags'];
	$campaignArray = explode ('-', $campaigns);
	$i = 0;
	$campaignOut = "";
	foreach ($campaignArray as $campaign){
		if($i == 0){
			$campaignOut = 'campaign_id = '.$campaign;
			$i++;
		}
		else{
			$campaignOut .= " || campaign_id =".$campaign;
		}
	}
	
	
	$photo_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
						 FROM campaign_photos cp
		 				 JOIN photos p ON cp.photo_id = p.id
						WHERE '.$campaignOut.' AND approval_status = 1 
						ORDER BY id DESC';
	
	$photo_query = str_replace('”', '', $photo_query);
	
	if ($results = $database->query($photo_query)) {	
		$i = 0;
		while( $info =  mysqli_fetch_assoc($results) ){
			if(checkRemoteFile($info['photo_url'])){
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
		}
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
	
	
$count2 = 1; 

$icons = $_GET['icons'];
$iconArray = explode ('-', $icons);
$iconArray = array_reverse($iconArray);
?>

<script type="text/javascript">

	$url = "http://app.getdasher.com/filmstrip/styles.php"+$vars;
	$append = "<link rel='stylesheet' id='dasher-style-css'  href='"+$url+"' type='text/css' media='all' />"
	jQuery('head').append($append);
	
	$append3 = "<link href='http://fonts.googleapis.com/css?family=<?php echo $_GET['font']; ?>' rel='stylesheet' type='text/css'>";
	jQuery('head').append($append3);
	
	$append2 = '<link rel="stylesheet" href="http://app.getdasher.com/bxslider/jquery.bxslider.css" type="text/css" />';
	jQuery('head').append($append2);

	jQuery(document).ready(function(){
		if(typeof jQuery.fancybox == 'function') {
		     console.log('fancy box loaded');
		} else {
			 $append2 = '<link rel="stylesheet" href="http://app.getdasher.com/fancybox/jquery.fancybox.css" type="text/css" />';
			 jQuery('head').append($append2);
			 jQuery.getScript( "http://app.getdasher.com/dasher-tools/fancybox/jquery.fancybox.js")
				.done(function( script, textStatus ) {
				jQuery("[rel=dasher-small]").fancybox({
							type : 'image',
							afterLoad: function() {
						        this.title = this.element.attr('fancy-title');
						    },
							helpers : {
							        title: {
							            type: 'over'
							        }
							    }
						});
				});
		}
			
			jQuery.getScript( "http://app.getdasher.com/bxslider/jquery.bxslider.js")
				.done(function( script, textStatus ) {
					jQuery('#items').bxSlider({
					    slideWidth: '150%',
					    maxSlides: 20,
					 	moveSlides: 1,
					    slideMargin: 10,
						onSliderLoad: function(){
							jQuery('.bx-clone').each(function(){
								jQuery(this).find('a').removeAttr('rel');
							});
						}
					  });
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
	if($_GET['logoC'] == 'true'){
		echo '<div class="custom_logo"></div>';
		}
		if($_GET['hashC'] == 'true'){
		echo '<div class="hash-title">'.$_GET['hash'].'</div>';
		}
		if($_GET['iconC'] == 'true'){
		echo '<div class="network-icons">';
		foreach ($iconArray as $icon){ echo '<span class="icon"><span class="socicon">'.$icon.'</span></span>'; }
		echo '</div>';
		}
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
			<div style="clear:both;"></div><a style="float:right; margin-top:20px;" href="http://getdasher.com" target="_blank"><img class="dasher-branding" src="http://app.getdasher.com/images/icons/powered.png" /></a><div style="clear:both;"></div>