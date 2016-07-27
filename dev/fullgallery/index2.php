<?php
header('Access-Control-Allow-Origin: *'); 
ini_set("display_errors", 0);
session_start();
require_once ("../classes/class.database.php");
function ranger($url){
    $headers = array(
    "Range: bytes=0-32768"
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
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
						ORDER BY id ASC';
					

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
		        echo '<img src="http://app.getdasher.com/images/twitter-24-black.png" alt="twitter" class="icon" /> ';
		        break;
		    case 2:
		        echo '<img src="http://app.getdasher.com/images/instagram-24-black.png" alt="instagram" class="icon" /> ';
		        break;
		    case 3:
		        echo '<img src="http://app.getdasher.com/images/googleplus-24-black.png" alt="googleplus" class="icon" /> ';
		        break;
			case 4:
			    echo '<img src="http://app.getdasher.com/images/facebook-24-black.png" alt="facebook" class="icon" /> ';
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
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open%20Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery.getScript( "http:app.getdasher.com/js/jquery-ui.min.js");
	if(typeof jQuery.fancybox == 'function') {
	    //console.log('fancy box loaded');
	} else {
	     console.log('fancy box not loaded');
		 $append2 = '<link rel="stylesheet" href="http://app.getdasher.com/fancybox/jquery.fancybox.css" type="text/css" />';
		 jQuery('head').append($append2);
		 jQuery.getScript( "http://app.getdasher.com/dasher-tools/fancybox/jquery.fancybox.js")
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
	$url = "http://app.getdasher.com/fullgallery/styles2.php"+$vars;
	$url = $url.replace('#', '');
	$append = "<link rel='stylesheet' id='dasher-style-css'  href='"+$url+"' type='text/css' media='all' />"
	jQuery('head').append($append);
	$append1 = '<link href="http://app.getdasher.com/css/photomosaic.css" rel="stylesheet" type="text/css" />';
    jQuery('head').append($append1);
		jQuery.getScript( "http://cdnjs.cloudflare.com/ajax/libs/masonry/3.2.2/masonry.pkgd.min.js")
			.done(function( script, textStatus ) {
				var container = document.querySelector('#container');
								  var msnry = new Masonry( container, {
								  });
				console.log('masnry is finished loading');
				jQuery("html, body").animate({ scrollTop: jQuery(document).height() },  <?php echo $i*10000; ?>, 'linear', function(){window.location.reload();});
			});
});
</script>
<style>
	body{
		font-family: 'Open Sans', sans-serif;
		font-size:14px;
		line-height:20px;
	}
	#container{
		margin-top:230px;
	}
	.item{
	  width: 23%;
	  display: block;
	  overflow: hidden;
	  margin:1%;
	}
	.item2 {
	  width: 48%;
	  display: block;
	  overflow: hidden;
	  margin:1%;
	}
	.item img, .item2 img {
	  display: block;
	  max-width: 100%;
	}
	.item2 img{
		max-height:200px;
	}
	
	.item .icon, .item2 .icon{
		display:block;
		float:left;
		margin-left:5px;
	}
	
	.item .caption, .item2 .caption{
		border: solid thin #ccc;
		border-top:none;
		border-bottom-width:2px;
		border-radius:5px;
		padding-top:5px;
	}
	.item .caption p, .item2 .caption p{
	  padding-right: 15px;
	  padding-left: 35px;
	  margin-top: 3px;
	}
	.img-back{
		width:100%;
		height:100%;
	}
	a{
		color:#000;
	}
	
	.ted-logo{
		margin:auto;
		width:586px;
		height:145px;
		float:left;
		margin-top:10px;
		margin-left:30px;
	}
	
	.ted-logo img{
		max-width:100%;
	}
	
	.full-header{
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
	.gallery_logo{
		float:right;
		margin-top:60px;
		margin-right: 36px;
	}
	.dasher-branding{
		margin-top:20px;
		margin:auto;
		width:146px !important;
		display:block;
	}
	
@media screen and (max-width:1060px){
	.item{
		width:31%;
	}
	.item2{
		width:48%;
	}
	.ted-logo{
		max-width:100%;
	}
}
@media screen and (max-width:700px){
	.item{
		width: 48%;
	}
	.item2 {
		width: 98%;
	}
}
@media screen and (max-width:400px){
	.item{
		width: 98%;
	}
	.item2 {
		width: 98%;
	}
}
</style>
<div class="full-header">
<div class="ted-logo"><img src="http://app.getdasher.com/images/tedx_header_b.png" /></div>
<div class="gallery_logo"><img src="http://app.getdasher.com/images/hatch_header_08.png"></div>
</div>
<?php	
	echo '<div style="clear:both;"></div><div id="container">';
						if( count($photos) > 0 ):
						 foreach( $photos as $photo): 
							 if($photo['approval_status'] != ""): 
				                 if( $photo['approval_status'] == 1 ):  ?>
										<?php
										$url = $photo['url'];
										$raw = ranger($url);
										$im = imagecreatefromstring($raw);
										$width = imagesx($im);
										$height = imagesy($im) / 1.75; ?>
									<?php if($j%4 == 0  && $j != 0  && $height > 150){$item = "2";} else {$item = "";} ?>
									<div class="item<?php echo $item; ?>">
					                    <a href="<?php echo $photo['url']; ?>" class="fancybox" fancy='<span class="tooltip"><?php getTypeImage($photo['type']); ?><br /><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post &#8611;</a></span>'>
					                        <div class="img-back" style="background: url(<?php echo $photo['url']; ?>); background-size:cover; background-position:center; height:<?php echo $height; ?>px" 
					                            alt=""
					                        ></div></a>
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
			if($_GET['siteColor'] == 'light'){
			echo '<div style="clear:both;"></div><a href="http://getdasher.com" target="_blank"><img class="dasher-branding" src="http://app.getdasher.com/images/icons/powered_by_dasher_dark.png" /></a>';
			}
			else{
					echo '<div style="clear:both;"></div><a href="http://getdasher.com" target="_blank" class="dasher-branding"><img src="http://app.getdasher.com/images/hatch_header_08.png" /></a>';
			}
		
			?>
</body>
</html>
