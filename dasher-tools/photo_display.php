<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");
    require_once ("settings.php");

	function remove_querystring_var($url, $key) { 
		$url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&'); 
		$url = substr($url, 0, -1); 
		return $url; 
	}
	
	$currentLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$status = ' AND approval_status = ""';
	
	if(isset($_GET['status'])){
		$status = ' AND approval_status = '.$_GET['status'];
	}

	$photos = array();
	
	$count_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
						 FROM campaign_photos cp
		 				 JOIN photos p ON cp.photo_id = p.id
						WHERE campaign_id = '. $_GET['id'] . $status . ' ORDER BY p.id DESC';
	$count_result = mysqli_query($link, $count_query);
	$totalCount=mysqli_num_rows($count_result);
	$pages = round($totalCount / 100);
	
	$limit = 100;
	if(isset($_GET['page'])){
		$limit = $limit*$_GET['page'];
		if($_GET['page'] < $pages){
			$nextCount = $_GET['page']+1;
			$next = "&page=".$nextCount;
		}
		$starter = $limit - 99;
		$previous = $_GET['page'] -1;
		$prev = "&page=".$previous;
	}
	else{
		$next = "&page=2";
		$starter = 1;
	}
	
	
	$photo_query = 'SELECT p.photo_url, p.id, cp.approval_status, p.type, p.captions, p.user_link, p.user_name, p.service_link, p.post_id
						 FROM campaign_photos cp
		 				 JOIN photos p ON cp.photo_id = p.id
						WHERE campaign_id = '. $_GET['id'] . $status . ' ORDER BY p.id DESC LIMIT '.$limit;
	
	if ($results = mysqli_query($link, $photo_query)) {	
		$i = 0;
		$rowcount2=mysqli_num_rows($results);
		while( $info =  mysqli_fetch_assoc($results) ){
			$photos[$i]['url'] = $info['photo_url'];
			$photos[$i]['id'] = $info['id'];
			$photos[$i]['type'] = $info['type'];
			$photos[$i]['postlink'] = $info['service_link'];
			$photos[$i]['userlink'] = $info['user_link'];
			$photos[$i]['username'] = $info['user_name'];
			$tempCaption = urldecode($info['captions']);
			$photos[$i]['captions'] = str_replace("'", '', $tempCaption);
			$photos[$i]['approval_status'] = $info['approval_status'];
			$i++;
		};
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
	
	// Get New Photos that haven't been approved ::::::::::::::::::::::::::::::::::Start
	$new_photos = array();
	
	foreach( $photos as $photo){
		if( $photo['approval_status'] == ""){
			array_push($new_photos, $photo);
		}
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
	
	
	
?>

<?php include_once('header.php'); ?>
	<a title="Campaign Widget Code" class="widget-code iframe-fancy" href="http://www.getdasher.com/dasher-tools/widgetCode.php?id=<?php echo $_GET['id']; ?>">Slider Widget Code</a>
	<?php if(isset($_GET['status'])  && $_GET['status'] == 0 || isset($_GET['status']) && $_GET['status'] == 1): ?>
	<div class="to-campaign-photos"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dasher-tools/photo_display.php?id=<?php echo $_GET['id']; ?>" style="color:#FFF;">SEE NEW IMAGES</a></div>
	<?php else: ?>
    <div class="to-campaign-photos"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dasher-tools/photo_display.php?id=<?php echo $_GET['id']; ?>&status=1" style="color:#FFF;">SEE MODERATED IMAGES</a></div>
	<?php endif; ?>
	<?php if(!isset($_GET['status'])): ?>
	<div id="new_photos">
		<?php
		if( count($new_photos) > 0 ): ?>
 		 <h1>New Photos</h1>
         <ul>
	     <?php
	     $image_id = 1;
		 foreach( $new_photos as $photo):
			 if( $photo['approval_status'] == ""): ?>
			 <?php if( $image_id >= $starter): ?>
             <div class="img-set" id="image_ID_<?php echo $image_id; ?>" >		 
				<a href="<?php echo $photo['url']; ?>" class="fancybox" fancy-title='<?php getTypeImage($photo['type']); ?><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a><br /><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a>'>
					<li class="blank-photo" style="background-image:url(); overflow:hidden; width:100%; height:181px; background-size:cover;" data-original="<?php echo $photo['url']; ?>" ></li>
				</a>
				<div class="hoverdata" style="display: none;">
						<?php getTypeImage($photo['type']); ?>
						<div class="userNameTwitter"><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a></div>
						<div class="userDescription"><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a></div>
				</div>
				<li>
				<form action="">
					<label class="approve" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="approve">
					<input type="radio" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="approve" ><img src="images/approve.jpg" />
					</label>
					<label class="decline" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="deny">
					<input type="radio" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="deny" ><img src="images/deny.jpg" />
					</label>
				</form>
				<div style='clear:both;'></div>
				</li>
            </div>
		<?php endif; ?>
		<?php $image_id++; ?>
		<?php endif;
		endforeach; 
		endif;
		?>
        </ul>
	</div><!--new_photos-->	 
	 <div style="clear:both;"></div>
	<?php 	endif; ?>

	<?php if(isset($_GET['status'])): ?>
	<div id="photo_album"> 

		<h1>Campaign Photos</h1>
		<?php if(isset($_GET['status'])  && $_GET['status'] == 0): ?>
        <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dasher-tools/photo_display.php?id=<?php echo $_GET['id']; ?>&status=1" class="hide-denied-photos">Show Approved Photos</a>
		<?php else: ?>
        <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dasher-tools/photo_display.php?id=<?php echo $_GET['id']; ?>&status=0" class="show-denied-photos">Show Denied Photos</a>
      	<?php endif; ?>
		<a name="camp-photos" /><ul class="campaign-photos">
		<?php
		if( count($photos) > 0 ):
		 foreach( $photos as $photo): 
			 if($photo['approval_status'] != ""): 
                 if( $settings['archived_photos'] == 1 && $photo['approval_status'] == 1 ): ?>
                 <div class="camp-photo img-set" id="image_ID_<?php echo $image_id; ?>">
    				<a href="<?php echo $photo['url']; ?>" class="fancybox" title="" fancy-title='<?php getTypeImage($photo['type']); ?><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a><br /><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a>'>
						<li style="background-image: url(<?php echo $photo['url']; ?>); overflow:hidden; width:100%; height:181px; background-size:cover;" ></li>
					</a>
					<div class="hoverdata" style="display: none;">
							<?php getTypeImage($photo['type']); ?>
							<div class="userNameTwitter"><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a></div>
							<div class="userDescription"><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a></div>
					</div>
    				<li>
						<form action="">
							
							<label class="decline" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="deny" <?php echo $photo['approval_status'] == 0 ? "checked" : "" ?>>
							<input type="radio" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="deny" <?php echo $photo['approval_status'] == 0 ? "checked" : "" ?> ><img src="images/deny.jpg" />
							</label>
						</form>
						<div style='clear:both;'></div>
    				</li>
                </div>
                
            <?php elseif($settings['archived_photos'] == 0): ?>
                <div class="camp-photo img-set" id="image_ID_<?php echo $image_id; ?>">
   					<a href="<?php echo $photo['url']; ?>" class="fancybox" title="" fancy-title='<?php getTypeImage($photo['type']); ?><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a><br /><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a>'>
						<li style="background-image: url(<?php echo $photo['url']; ?>); overflow:hidden; width:100%; height:181px; background-size:cover;" ></li>
					</a>
					<div class="hoverdata" style="display: none;">
							<?php getTypeImage($photo['type']); ?>
							<div class="userNameTwitter"><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a></div>
							<div class="userDescription"><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a></div>
					</div>
					<li>
					<form action="">
						<label class="approve" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="approve" <?php echo $photo['approval_status'] == 1 ? "checked" : "" ?>>
						<input type="radio" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="approve" <?php echo $photo['approval_status'] == 1 ? "checked" : "" ?>><img src="images/approve.jpg" />
						</label>
					</form>
					<div style='clear:both;'></div>
   				</li>
               </div>
           <?php else: ?>
               <div class="camp-photo img-set" id="image_ID_<?php echo $image_id; ?>">
  					<a href="<?php echo $photo['url']; ?>" class="fancybox" title="" fancy-title='<?php getTypeImage($photo['type']); ?><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a><br /><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a>'>
						<li style="background-image: url(<?php echo $photo['url']; ?>); overflow:hidden; width:100%; height:181px; background-size:cover;" ></li>
					</a>
					<div class="hoverdata" style="display: none;">
							<?php getTypeImage($photo['type']); ?>
							<div class="userNameTwitter"><a href="<?php echo $photo['userlink']; ?>" target="_blank"><?php echo $photo['username']; ?></a></div>
							<div class="userDescription"><?php echo $photo['captions']; ?><br /><a href="<?php echo $photo['postlink']; ?>" target="_blank">View the Post</a></div>
					</div>
					<li>
					<form action="">
						<label class="approve" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="approve" <?php echo $photo['approval_status'] == 1 ? "checked" : "" ?>>
						<input type="radio" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="approve" <?php echo $photo['approval_status'] == 1 ? "checked" : "" ?>><img src="images/approve.jpg" />
						</label>
						<label class="decline" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="deny" <?php echo $photo['approval_status'] == 0 ? "checked" : "" ?>>
						<input type="radio" name="approve_<?php echo $photo['id'] ?>" imgid="<?php echo $photo['id']; ?>" value="deny" <?php echo $photo['approval_status'] == 0 ? "checked" : "" ?> ><img src="images/deny.jpg" />
						</label>
					</form>
					<div style='clear:both;'></div>
  				</li>
              </div>
		<?php endif;
              endif;
		 endforeach; 
		else: ?>
			<p>No photos have been collected yet.</p>
		<?php endif ?>
		</ul >
	</div><!--photo_album-->
	<?php endif; ?>
		
	<?php if($pages > 1): 
		if(isset($prev)): ?>
		<?php
		$prev_link = remove_querystring_var($currentLink, 'page').$prev;
		?>
		<a href="<?php echo $prev_link; ?>">Prev &lt;</a><br />
		<?php endif; ?>
	<?php if(isset($next)): ?>
			<?php
			$next_link = remove_querystring_var($currentLink, 'page').$next;
			?>
			<a href="<?php echo $next_link; ?>">Next &gt;</a>
			<?php endif; endif; ?>
<?php include_once('footer.php'); ?>