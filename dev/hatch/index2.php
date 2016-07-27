<?php
header('Access-Control-Allow-Origin: *'); 
ini_set("display_errors", 1);
session_start();
require_once ("connect2.php");
require_once ("settings.php");
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gallery | DASHER</title>

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.css" />
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://app.getdasher.com/dasher-tools/fancybox/jquery.fancybox.css' type='text/css' media='all' />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script type='text/javascript' src='http://app.getdasher.com/dasher-tools/dasher.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/dasher-tools/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://app.getdasher.com/dasher-tools/fancybox/jquery.fancybox.js'></script>
<script>
$width = jQuery( window ).width();
if($width < 960){
	jQuery('head').append("<link rel='stylesheet' id='dasher-style-css'  href='http://app.getdasher.com/dasher-tools/galleryMobile.css' type='text/css' media='all' />");
	$newScript = '<script type="text/javascript" src="http://app.getdasher.com/dasher-tools/jquery.flip.min.js">';
	jQuery('head').append($newScript);
	jQuery('head').append('<\/script>');
	jQuery(document).ready(function(){
		jQuery('.back').wrap("<div class='back-holder'></div>");
		jQuery('.back').attr('title', '');
		
		jQuery('.front').wrap("<div class='front-holder'></div>");
		jQuery( ".card" ).click(function() {
			if(jQuery(this).find('.back').css('display') == "none"){
	      	jQuery(this).flip({
				direction:'lr',
				color:'#FFFFFF'
			});
			jQuery(this).find('.back').toggle();
			jQuery(this).find('.front').toggle();
			jQuery(this).css('background-color', '#d9581e');
			jQuery(this).css('margin', 'auto');
		}
		else{
	      	jQuery(this).flip({
				direction:'lr',
				color:'#FFFFFF'
			});
			jQuery(this).find('.back').toggle();
			jQuery(this).find('.front').toggle();
			jQuery(this).css('background-color', '#d9581e');
			jQuery(this).css('margin', 'auto');
		}
	    });
		jQuery('.front').each(function(){
			$orgWidth = jQuery(this).parent().parent('.card').attr('orgWidth');
			$orgHeight = jQuery(this).parent().parent('.card').attr('orgHeight');
				$windowWidth = jQuery(window).width();
				if($windowWidth >= 601){
				$curWidth = jQuery(window).width() * .46;
				}
				else{
				$curWidth = jQuery(window).width() * .9;	
				}
			$percent = $curWidth / $orgWidth;
			$newHeight = $orgHeight*$percent;
			jQuery(this).css('height', $newHeight);
			jQuery(this).css('width', $curWidth);
			jQuery(this).parent().parent().find('.back-holder').find('.back').css('height', $newHeight);
			jQuery(this).parent().parent().find('.back-holder').find('.back').css('width', $curWidth);
			jQuery(this).parent().parent().find('.front-holder').find('.front').css('height', $newHeight);
			jQuery(this).parent().parent().find('.front-holder').find('.front').css('width', $curWidth);
		});
		
		jQuery(window).on('resize', function(){
			jQuery('.front').each(function(){
				$orgWidth = jQuery(this).parent().parent('.card').attr('orgWidth');
				$orgHeight = jQuery(this).parent().parent('.card').attr('orgHeight');
					$windowWidth = jQuery(window).width();
					if($windowWidth >= 601){
					$curWidth = jQuery(window).width() * .46;
					}
					else{
					$curWidth = jQuery(window).width() * .9;	
					}
				$percent = $curWidth / $orgWidth;
				$newHeight = $orgHeight*$percent;
				jQuery(this).css('height', $newHeight);
				jQuery(this).css('width', $curWidth);
				jQuery(this).parent().parent().find('.back-holder').find('.back').css('height', $newHeight);
				jQuery(this).parent().parent().find('.back-holder').find('.back').css('width', $curWidth);
				jQuery(this).parent().parent().find('.front-holder').find('.front').css('height', $newHeight);
				jQuery(this).parent().parent().find('.front-holder').find('.front').css('width', $curWidth);
			});
		});
	});
}
else {
jQuery('head').append("<link rel='stylesheet' id='dasher-style-css'  href='http://app.getdasher.com/dasher-tools/styles.css' type='text/css' media='all' />");
	  jQuery(document).ready(function(){

			$('.brick.w1 #container-card:nth-child(2) .back, .brick.w1 #container-card:nth-child(3) .back, .brick.w5 .col3 #container-card:nth-child(1) .back, .brick.w5 .col3 #container-card:nth-child(2) .back, .brick.w5 .col3 #container-card:nth-child(3) .back').tooltip({
			          content: function () {
			              return $(this).prop('title');
			          },
					  position: {
					        my: "center bottom-20",
					        at: "center top",
					        using: function( position, feedback ) {
					          $( this ).css( position );
					          $( "<div>" )
					            .addClass( "arrow" )
					            .addClass( feedback.vertical )
					            .addClass( feedback.horizontal )
					            .appendTo( this );
					        }
					      }
			      });

			$('.brick.w1 #container-card:nth-child(1), .brick.w1 #container-card:nth-child(4), .brick.w5 #container-card').each(function(){ 
					if($(this).parent('.col3').length > 0){

					}
					else {
					$(this).find('.back').attr('title', ''); 
				}
			});

			$('.hatch').fancybox({
				helpers:  {
				        title : {
				            type : 'over'
				        }
				    },
				beforeShow : function() {
				        this.title = $(this.element).attr('titler');
				    },
					autoPlay: true,
					playSpeed: 5000
				});
				
    $( ".front" ).hover(function() {
      $( this ).next('back').tooltip();
    }, function() {
      $( this ).next('back').tooltip();
    });
});

}
</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
	  
	  $("div.lazy").lazyload({
	        effect : "fadeIn"
	    });
	
	
	  
	  
    });
  </script>
  
  <script type="text/javascript">
    jQuery(function () {
        jQuery('#hiwEmail').submit(function (e) {
            e.preventDefault();
            jQuery.getJSON(
            this.action + "?callback=?",
            jQuery(this).serialize(),
            function (data) {
                if (data.Status === 400) {
                    alert("Error: " + data.Message);
                } else { // 200
                    jQuery('#aikyur-aikyur').fadeToggle();
                    jQuery('#emailSubmit').fadeToggle(function () {
    jQuery(".email-formArea").html("Thanks we will be in touch soon!");
  });
                }
            });
        });
    });
</script>
</head>
<body class="page members-area galleryview">
<div id="page" class="hfeed site">
<header id="masthead" class="site-header" role="banner">
    <div class="header-body">
		<div class="site-branding">
			<a href="http://hatchexperience.org/" target="_blank"><img src="http://app.getdasher.com/images/hatch_header_05.png" class="devcon_logo"></a>
			<img src="http://app.getdasher.com/images/hatch_header_02.png" class="gallery_banner">
			<a href="http://getdasher.com" target="_blank"><img src="http://app.getdasher.com/images/hatch_header_08.png" class="gallery_logo"></a>
		</div>
			      </div>
	</header>
<div class="content-wrap">
	<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			
				
<article id="post-198" class="page type-page status-publish hentry">

	<div class="entry-content">
<?php
	$photos = array();
	
	$photo_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
						 FROM campaign_photos cp
		 				 JOIN photos p ON cp.photo_id = p.id
						WHERE campaign_id = 1
						ORDER BY id DESC';

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
?>
<?php	
	echo '<div id="container"><div class="brick w'.$count3.'">';
						if( count($photos) > 0 ):
						 foreach( $photos as $photo): 
							 if($photo['approval_status'] != ""): 
				                 if( $photo['approval_status'] == 1 ): ?>
								  <div id="container-card">
								<a class="hatch" rel="gallery1" href="<?php echo $photo['url']; ?>" titler='<span class="tooltip"><?php getTypeImage($photo['type']); ?><br /><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post &#8611;</a></span>'>
								<img src="<?php echo $photo['url']; ?>" /></a> </div>
								<?php
								$count3++;
								if($count3 == 5){
									echo '</div><div class="brick w'.$count3.'"><div class="col3">';
								}
								if($count3 == 8){
									echo '</div>';
								}
								if($count3 == 11){
									echo '</div><div class="clearfix"></div><div class="brick w1">';
									$count3 = 1;
								}
						 endif;
				              endif;
						 endforeach;
				echo '<div class="clearfix"></div>
			</div>';
				?>
			<div style="clear:both;"></div><a href="http://getdasher.com" target="_blank" ><img class="dasher-branding" src="http://app.getdasher.com/images/powered_by_dasher1.png" width="688" /></a>
			<?php
			else: 
				echo '<p>No photos have been collected yet.</p>';
			endif;
			?>
</body>
</html>