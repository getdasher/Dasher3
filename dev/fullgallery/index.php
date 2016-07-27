<?php
header('Access-Control-Allow-Origin: *'); 
ini_set("display_errors", 0);
session_start();
require_once ("../classes/class.database.php");
?>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=<?php echo $_GET['font']; ?>' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />

<script type="text/javascript">
jQuery(document).ready(function(){
	if(typeof jQuery.fancybox == 'function') {
	     console.log('fancy box loaded');
	} else {
	     console.log('fancy box not loaded');
		 $append2 = '<link rel="stylesheet" href="http://app.getdasher.com/fancybox/jquery.fancybox.css" type="text/css" />';
		 jQuery('head').append($append2);
		 jQuery.getScript( "http://app.getdasher.com/dasher-tools/fancybox/jquery.fancybox.js")
			.done(function( script, textStatus ) {
				console.log('fancybox is finished loading');
				jQuery('.fancybox').fancybox();
			});
	}
$width = jQuery( '.dasher2' ).width();
	$url = "http://app.getdasher.com/fullgallery/styles2.php"+$vars;
	$url = $url.replace('#', '');
	$append = "<link rel='stylesheet' id='dasher-style-css'  href='"+$url+"' type='text/css' media='all' />"
	jQuery('head').append($append);
	$append1 = '<link href="http://app.getdasher.com/css/photomosaic.css" rel="stylesheet" type="text/css" />';
    jQuery('head').append($append1);
	jQuery(document).ready(function(){
		
		jQuery.getScript( "http://app.getdasher.com/js/photomosaic.min.js")
			.done(function( script, textStatus ) {
					 jQuery('#container').photoMosaic({

				                 input: 'html',
								 padding: 20,
								 prevent_crop: true,
								 show_loading: true,
								
				            // lightbox settings
				                modal_name : 'fancyBox',
				                modal_ready_callback: function($pm) {
									jQuery('.photomosaic-item img').each(function(){ jQuery(this).addClass('front'); jQuery(this).addClass('card');});
									jQuery('.photomosaic-item').each(function(){jQuery(this).addClass('panel');});
									jQuery('.photomosaic-item').wrap('<div class="panel"></div');
									jQuery('.front').each(function(){ 
										$newBack = '<div class="back card">'+jQuery(this).attr('title')+'</div>';
										$newBack = $newBack.replace('tooltip','smallSlideType');
										jQuery(this).after($newBack);
									});
									jQuery('.photomosaic-item img').each(function(){ $title = jQuery(this).attr('title'); jQuery(this).removeAttr('title'); jQuery(this).removeAttr('alt'); jQuery(this).attr('fancy', $title); });
									jQuery('.photomosaic-item').each(function(){ $title = jQuery(this).attr('title'); jQuery(this).removeAttr('title'); jQuery(this).removeAttr('alt'); jQuery(this).attr('fancy', $title); });
				                    jQuery('.photomosaic-item').fancybox({
										type : 'image',
										afterLoad: function() {
									        this.title = this.element.attr('fancy');
									    },
										helpers : {
										        title: {
										            type: 'over'
										        }
										    }
									});
				                }
				        });
						if($width >= 801){
							jQuery('#container').photoMosaic({
								columns: 4
							});
						}
			});
	});
});
</script>
<?php
	$photos = array();
	$user = $_GET['id'];
	$databaseName = 'dasher-'.$user;
	$database = new database($databaseName);
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
						WHERE '.$campaignOut.' && approval_status = 1
						ORDER BY id DESC';
					

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
$count3 = 1;

$icons = $_GET['icons'];
$iconArray = explode ('-', $icons);
?>

<?php	
	if($_GET['logoC'] == 'true'){
	echo '<div class="custom_logo"></div>';
	}
	if($_GET['hashC'] == 'true'){
	echo '<div class="hash-title">#'.$_GET['hash'].'</div>';
	}
	if($_GET['iconC'] == 'true'){
	echo '<div class="network-icons">';
	foreach ($iconArray as $icon){ echo '<span class="icon"><span class="socicon">'.$icon.'</span></span>'; }
	echo '</div>';
	}
	echo '<div style="clear:both;"></div><div id="container"><ul>';
						if( count($photos) > 0 ):
						 foreach( $photos as $photo): 
							 if($photo['approval_status'] != ""): 
				                 if( $photo['approval_status'] == 1 ): ?>
									<li>
					                    <a href="<?php echo $photo['url']; ?>">
					                        <img
					                            src="<?php echo $photo['url']; ?>"
					                            title='<span class="tooltip"><?php getTypeImage($photo['type']); ?><br /><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post &#8611;</a></span>'
					                            alt=""
					                        />
					                    </a>
					                </li>
				
						<?php endif;
				              endif;
						 endforeach;
				echo '<div class="clearfix"></div>
			</ul></div>';
			else: 
				echo '<p>No photos have been collected yet.</p>';
			endif;
			if($_GET['siteColor'] == 'light'){
			echo '<div style="clear:both;"></div><a href="http://getdasher.com" target="_blank"><img class="dasher-branding" src="http://app.getdasher.com/images/icons/powered_by_dasher_dark.png" /></a>';
			}
			else{
					echo '<div style="clear:both;"></div><a href="http://getdasher.com" target="_blank"><img class="dasher-branding" src="http://app.getdasher.com/images/icons/powered_by_dasher_light.png" /></a>';
			}
		
			?>
</body>
</html>
