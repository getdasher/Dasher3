<?php
header('Access-Control-Allow-Origin: *'); 
ini_set("display_errors", 1);
session_start();
require_once ("connect.php");
require_once ("settings.php");
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gallery | DASHER</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="http://getdasher.com/xmlrpc.php">
<script type="text/javascript" src="//use.typekit.net/gpj8hol.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.css" />
<link rel="alternate" type="application/rss+xml" title="DASHER &raquo; Feed" href="http://getdasher.com/feed/" />
<link rel="alternate" type="application/rss+xml" title="DASHER &raquo; Comments Feed" href="http://getdasher.com/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="DASHER &raquo; About Comments Feed" href="http://getdasher.com/about/feed/" />
<link rel='stylesheet' id='jquery.fancybox-css'  href='http://getdasher.com/dasher-tools/fancybox/jquery.fancybox.css' type='text/css' media='all' />
<link rel='stylesheet' id='dasher-style-css'  href='http://getdasher.com/dasher-tools/styles.css' type='text/css' media='all' />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script type='text/javascript' src='http://getdasher.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/dasher.js'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/jquery.lazyload.js'></script>
<script type='text/javascript' src='http://getdasher.com/dasher-tools/fancybox/jquery.fancybox.js'></script>
<script type='text/javascript' src='http://getdasher.com/wp-includes/js/comment-reply.min.js?ver=3.7.1'></script>
<script type='text/javascript' src='modernizr.js'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://getdasher.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://getdasher.com/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 3.7.1" />
<link rel='shortlink' href='http://getdasher.com/?p=198' />
<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
.site-branding img{float:left;}
.content-wrap{
	background:#FFF;
}
#content{width:1100px; position:relative; background:#FFF;}
.header-body{width:1100px;}
.gallery_banner{
	margin-left: 210px;
	position: absolute;
	z-index: 1000;
}
.site-branding{
	width:1100px;
}
.site-branding .gallery_logo{
	float:right;
}
		.fancybox-title-over-wrap {
		position: absolute;
		bottom: 0;
		left: 0;
		width: 96%;
		color: #fff;
		padding: 10px;
		background: #000;
		background: rgba(0, 0, 0, .8);
		}
	  .ui-tooltip, .arrow:after {
	    background: #000;
		background: rgba(0, 0, 0, .8);
		border:none;
	  }
	.ui-tooltip a{
		color:#d9581e;
	}
	  .ui-tooltip {
	    padding: 5px 10px;
	    color: white;
	    border-radius: 5px;
	    font-family: ff-ernestine-web-pro, sans-serif;
		font-size: 12px;
		font-style: italic;
	    text-transform: uppercase;
	    box-shadow: 0;
	
	  }
	  .arrow {
	    width: 70px;
	    height: 16px;
	    overflow: hidden;
	    position: absolute;
	    left: 50%;
	    margin-left: -35px;
	    bottom: -16px;
	  }
	  .arrow.top {
	    top: -16px;
	    bottom: auto;
	  }
	  .arrow.left {
	    left: 20%;
	  }
	  .arrow:after {
	    content: "";
	    position: absolute;
	    left: 20px;
	    top: -20px;
	    width: 25px;
	    height: 25px;
	    box-shadow: 6px 5px 9px -9px black;
	    -webkit-transform: rotate(45deg);
	    -moz-transform: rotate(45deg);
	    -ms-transform: rotate(45deg);
	    -o-transform: rotate(45deg);
	    tranform: rotate(45deg);
	  }
	  .arrow.top:after {
	    bottom: -20px;
	    top: auto;
	  }
</style>
<script type="text/javascript">
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
	
		$('.card').fancybox({
			helpers:  {
			        title : {
			            type : 'over'
			        }
			    },
			beforeShow : function() {
			        this.title = $(this.element).attr('titler');
			    }
			});
	  
	  
	  $("div.lazy").lazyload({
	        effect : "fadeIn"
	    });
		
  	  $( ".front" ).hover(
  	    function() {
  	      $( this ).next('back').tooltip();
  	    }, function() {
  	      $( this ).next('back').tooltip();
  	    }
  	  );
	  
	  
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
<body class="page members-area">
<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
    <div class="header-body">
		<div class="site-branding">
			<img src="images/dev_con_logo.png" class="devcon_logo" />
			<img src="images/dev_con_banner.png" class="gallery_banner" />
			<a href="http://getdasher.com" target="_blank"><img src="images/devcon_dasher_logo.png" class="gallery_logo" /></a>
		</div>
			      </div>
	</header><!-- #masthead -->
<div class="content-wrap">
	<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			
				
<article id="post-198" class="post-198 page type-page status-publish hentry">

	<div class="entry-content">
<?php
	$photos = array();
	
	$photo_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
						 FROM campaign_photos cp
		 				 JOIN photos p ON cp.photo_id = p.id
						WHERE campaign_id = '. $_GET['id'] .'
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
									 <div class="card" href="<?php echo $photo['url']; ?>" titler='<span class="tooltip"><?php getTypeImage($photo['type']); ?><br /><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post &#8611;</a></span>' >
				                 <div class="front face lazy" data-original="<?php echo $photo['url']; ?>" href="<?php echo $photo['url']; ?>"></div>
								<div class="back face center" title = '<span class="tooltip"><?php getTypeImage($photo['type']); ?><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post &#8611;</a></span>'><span class="smallSlideType"><?php getTypeImage($photo['type']); ?></span><span class="tooltip"><?php getTypeImage($photo['type']); ?><br /><a href='<?php echo $photo['userlink']; ?>' target='_blank'><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href='<?php echo $photo['postlink']; ?>' target='_blank'>View the Post &#8611;</a></span></div>
							</div></div>
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
			</div>
			
			<div style="clear:both;"></div><a href="http://www.getdasher.com" target="_blank"><img class="dasher-branding" src="http://getdasher.com/wp-content/uploads/2014/02/powered_by_dasher1.png" width="688" /></a>';
			else: 
				echo '<p>No photos have been collected yet.</p>';
			endif;
			?>