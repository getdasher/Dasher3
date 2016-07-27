<?php
header('Access-Control-Allow-Origin: *'); 
ini_set("display_errors", 1);
session_start();
require_once ("connect2.php");
require_once ("settings.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>#simmsbass</title>
  <link rel="stylesheet" href="superslides.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script>
setInterval(function() {
                  window.location.reload();
                }, 60000);
</script>
</head>
<body>
	<?php
		$photos = array();

		$photo_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
							 FROM campaign_photos cp
			 				 JOIN photos p ON cp.photo_id = p.id
							WHERE campaign_id = 1 AND approval_status = 1
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
			        echo '<div style="background-image:url(http://app.getdasher.com/images/twitter-24.png);" class="icon" ></div> ';
			        break;
			    case 2:
			        echo '<div style="background-image:url(http://app.getdasher.com/images/instagram-24.png);" class="icon" ></div> ';
			        break;
			    case 3:
			        echo '<div style="background-image:url(http://app.getdasher.com/images/googleplus-24.png);" class="icon" ></div> ';
			        break;
				case 4:
				    echo '<div style="background-image:url(http://app.getdasher.com/images/facebook-24.png);" class="icon" ></div> ';
				    break;
			}
		}


	$count2 = 1; 
	$count3 = 1;
	?>
	<div id="banner"><a href="http://simmsfishing.com" target="_blank" ><img src="http://app.getdasher.com/simms/Dasher-Art-Simms_03.png" height="100"></a><br />#simmsbass<br /><a href="http://getdasher.com" target="_blank"><img src="http://app.getdasher.com/images/powered_by_dasher_light.png" /></a></div>
  <div id="slides">
    <div class="slides-container">
		<?php foreach($photos as $photo): ?>
		<li>
      <img src="<?php echo $photo['url']; ?>" />
	  <div class="captions">
	  <?php getTypeImage($photo['type']); ?> <a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a> <?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post <i class="fa fa-chevron-right"></i></a></span>
	</div>
</li>
	<?php endforeach; ?>
    </div>

    <nav class="slides-navigation">
      <a href="#" class="next"><i class="fa fa-chevron-right"></i></a>
      <a href="#" class="prev"><i class="fa fa-chevron-left"></i></a>
    </nav>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.animate-enhanced.min.js"></script>
  <script src="js/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
  <script>
    $(function() {
      $('#slides').superslides({
        hashchange: true,
        play: 8000
      });
    });
  </script>
</body>
</html>

