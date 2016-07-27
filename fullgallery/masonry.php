<?php
header('Access-Control-Allow-Origin: *'); 
ini_set("display_errors", 1);
session_start();
require_once ("../classes/class.database.php");

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
		        echo '<img src="https://app.getdasher.com/images/twitter-24-black.png" alt="twitter" class="icon" /> ';
		        break;
		    case 2:
		        echo '<img src="https://app.getdasher.com/images/instagram-24-black.png" alt="instagram" class="icon" /> ';
		        break;
		    case 3:
		        echo '<img src="https://app.getdasher.com/images/googleplus-24-black.png" alt="googleplus" class="icon" /> ';
		        break;
			case 4:
			    echo '<img src="https://app.getdasher.com/images/facebook-24-black.png" alt="facebook" class="icon" /> ';
			    break;
		}
	}
	
	
$count2 = 1; 
$count3 = 1;

$icons = $_GET['icons'];
$iconArray = explode ('-', $icons);
$item = "";
$j = 0;

?>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open%20Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />

<script type="text/javascript">
jQuery(document).ready(function(){
	if(typeof jQuery.fancybox == 'function') {
		jQuery('.fancybox').fancybox({type : 'image',
		afterLoad: function() {
	        
	    },
		helpers : {
		        title: {
		            type: 'over'
		        }
		}
		
		    });
	} else {
		 $append2 = '<link rel="stylesheet" href="https://app.getdasher.com/fancybox/jquery.fancybox.css" type="text/css" />';
		 jQuery('head').append($append2);
		 jQuery.getScript( "https://app.getdasher.com/dasher-tools/fancybox/jquery.fancybox.js")
			.done(function( script, textStatus ) {
				jQuery('.fancybox').fancybox({type : 'image',
				afterLoad: function() {
			        this.title = this.element.attr('fancy');
			    },
				helpers : {
				        title: {
				            type: 'over'
				        }
				}
				
				    });
			});
	}
	$width = jQuery( '.dasher2' ).width();
	$url = "https://app.getdasher.com/fullgallery/styles2.php"+$vars;
	$url = $url.replace('#', '');
	$append = "<link rel='stylesheet' id='dasher-style-css'  href='"+$url+"' type='text/css' media='all' />"
	jQuery('head').append($append);
	$append1 = '<link href="https://app.getdasher.com/css/photomosaic.css" rel="stylesheet" type="text/css" />';
    jQuery('head').append($append1);
		jQuery.getScript( "https://app.getdasher.com/fullgallery/imagesloaded.pkgd.min.js").done(function(){
		jQuery.getScript( "https://cdnjs.cloudflare.com/ajax/libs/masonry/3.2.2/masonry.pkgd.min.js")
			.done(function( script, textStatus ) {
				if($width < 400){
					jQuery('.dasher2 .item').css('width', '98%');
					jQuery('.dasher2 .item2').css('width', '98%');
					
				}
				else if($width < 700){
					jQuery('.dasher2 .item').css('width', '48%');
					jQuery('.dasher2 .item2').css('width', '48%');
				}
				else{
					jQuery('.dasher2 .item').css('width', '31%');
					jQuery('.dasher2 .item2').css('width', '31%');
				}
				var container = document.querySelector('#container');
				var msnry;
				msnry = new Masonry( container );
				// initialize Masonry after all images have loaded
				jQuery('.dasher2 #container').fadeToggle();
				 var refresher = setInterval(myTimer, 500);
				 function myTimer() {
				     msnry = new Masonry( container );
				 }
				imagesLoaded( container, function() {
				jQuery('.waiting').fadeToggle();
				msnry = new Masonry( container );
				window.clearInterval(refresher);
				});
			});
		});
		
		jQuery( window ).resize(function() {
			$width = jQuery( '.dasher2' ).width();
			if($width < 400){
				jQuery('.dasher2 .item').css('width', '98%');
				jQuery('.dasher2 .item2').css('width', '98%');
				
			}
			else if($width < 700){
				jQuery('.dasher2 .item').css('width', '48%');
				jQuery('.dasher2 .item2').css('width', '48%');
			}
			else{
				jQuery('.dasher2 .item').css('width', '31%');
				jQuery('.dasher2 .item2').css('width', '31%');
			}
		  msnry = new Masonry( container );
		});
});
function onLayout() {
  jQuery('.dasher2').css('visibility', 'visible');
}
</script>
<style>
	.dasher2{
		font-family: <?php echo $_GET['font'] ?>;
		color: #<?php echo $_GET['color']; ?>;
		font-size:14px;
		line-height:20px;
	}
	.dasher2 #container{
		margin-top:230px;
		display:none;
	}
	.dasher2 .item{
	  display: block;
	  overflow: hidden;
	  margin:1%;
	}
	.dasher2 .item2 {
	  display: block;
	  overflow: hidden;
	  margin:1%;
	}
	.dasher2 .item img, .item2 img {
	  display: block;
	  max-width: 100%;
	}
	.dasher2 .item2 img{
		max-height:200px;
	}
	
	.dasher2 .item .icon, .item2 .icon{
		display:block;
		float:left;
		margin-left:5px;
	}
	
	.dasher2 .item .caption, .item2 .caption{
		border: solid thin #ccc;
		border-top:0;
		border-bottom-width:2px;
		border-radius:0px 0px 5px 5px;
		padding-top:5px;
		position:relative;
		display:block;
		background: rgba(255,255,255, .5);
	}
	.dasher2 .item .caption p, .item2 .caption p{
	  padding-right: 15px;
	  padding-left: 35px;
	  margin-top: 3px;
	}
	.dasher2 .img-back{
		width:100%;
		height:100%;
	}
	.dasher2 a{
		color:#<?php echo $_GET['color']; ?>;
	}
	
	.dasher2 .ted-logo{
		margin:auto;
		width:586px;
		height:145px;
		float:left;
		margin-top:10px;
		margin-left:30px;
	}
	
	.dasher2 .ted-logo img{
		max-width:100%;
	}
	
	.dasher2 .full-header{
		position:fixed;
		top:0;
		z-index:20000000;
		background-color:#FFF;
		width: 101%;
		height:160px;
	  	margin-left: -1%;
		padding-bottom:0px;
		-webkit-box-shadow: 0px 1px 3px 0px rgba(135,135,135,1);
		-moz-box-shadow: 0px 1px 3px 0px rgba(135,135,135,1);
		box-shadow: 0px 1px 3px 0px rgba(135,135,135,1);
	}
	.dasher2 .gallery_logo{
		float:right;
		margin-top:60px;
		margin-right: 36px;
	}
	.dasher2 .dasher-branding{
		margin-top:20px;
		margin:auto;
		width:146px !important;
		display:block;
	}
	
@media screen and (max-width:1060px){
	.dasher2 .item{
		width:31%;
	}
	.dasher2 .item2{
		width:48%;
	}
	.dasher2 .ted-logo{
		max-width:100%;
	}
}
@media screen and (max-width:700px){
	.dasher2 .item{
		width: 48%;
	}
	.dasher2 .item2 {
		width: 98%;
	}
}
@media screen and (max-width:400px){
	.dasher2 .item{
		width: 98%;
	}
	.dasher2 .item2 {
		width: 98%;
	}
}
</style>
			<?php if($_GET['siteColor'] == 'light'){
			echo '<div style="clear:both;"></div><a href="http://getdasher.com" target="_blank" style="float:right; margin-right:2%;"><img class="dasher-branding" src="https://app.getdasher.com/images/icons/powered_by_dasher_dark.png" /></a>';
			}
			else{
					echo '<div style="clear:both;"></div><a href="http://getdasher.com" target="_blank" style="float:right margin-right:2%;" class="dasher-branding"><img src="https://app.getdasher.com/images/hatch_header_08.png" /></a>';
			}
	
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

	echo '<div class = "waiting" style="margin:auto; width:200px; text-align:center; font-family: Arial; color:#F0F0F0; margin-top:100px;"><img src="https://app.getdasher.com/images/ajax-loader.gif" /><br /><br /><img src="https://app.getdasher.com/images/logo-header.png" /></div><div style="clear:both;"></div><div id="container" style="margin-top:0;">';
						if( count($photos) > 0 ):
						 foreach( $photos as $photo): 
							 if($photo['approval_status'] != ""): 
				                 if( $photo['approval_status'] == 1 ):  ?>
										<?php
										$url = $photo['url'];
										 ?>
									<?php if($j%4 == 0  && $j != 0){$item = "2";} else {$item = "";} ?>
									<div class="item<?php echo $item; ?>">
					                    <a href="<?php echo $photo['url']; ?>" class="fancybox" fancy='<span class="tooltip"><?php getTypeImage($photo['type']); ?><br /><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post &#8611;</a></span>'>
					                        <div class="img-back" style="background: url(<?php echo $photo['url']; ?>); background-size:cover; background-position:center; px" alt="">
					<img src="<?php echo $photo['url']; ?>" style="visibility:hidden"/><div style="clear:both;"></div></div><div style="clear:both;"></div></a>
										<div class="caption"><?php getTypeImage($photo['type']); ?><p><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post &#8611;</a></p></div>
					                </div>
				
						<?php $j++; endif;
				              endif;
						 endforeach;
				echo '<div class="clearfix"></div>
			</div>';
			else: 
				echo '<p>No photos have been collected yet.</p>';
			endif;
		
			?>
</body>
</html>