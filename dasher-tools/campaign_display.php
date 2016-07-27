<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");

	$campaigns = array();
	$photos = array();
	
	//update to include current user id
	$campaign_query = 'SELECT * FROM `campaign` WHERE `user_id` = '.$_SESSION['loggedUser'];
	if ($results = mysqli_query($link, $campaign_query)) {
        $i = 0;
		while ($info =  mysqli_fetch_assoc($results) ){
			$campaigns[$i]['hashtag'] = $info['hashtag'];
            $campaigns[$i]['id'] = $info['ID'];
            $campaigns[$i]['archived'] = $info['archived'];
            $campaigns[$i]['deleted'] = $info['deleted'];
            $i++;		
		};
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
	
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	//:::::::::: ANALYTICS 														:::::
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	//switch over to current user id
	$photo_query = 'SELECT p.type, p.id, cp.approval_status, cp.campaign_id
					  FROM campaign_photos cp
		 			  JOIN photos p ON cp.photo_id = p.id
					  JOIN campaign c ON c.id = cp.campaign_id
					 WHERE user_id = '. $_SESSION['loggedUser'] ;
	if ($results = mysqli_query($link, $photo_query)) {	
		$i = 0;
		while( $info =  mysqli_fetch_assoc($results) ){
			$photos[$i]['id'] = $info['id'];
			$photos[$i]['type'] = $info['type'];
			$photos[$i]['approval_status'] = $info['approval_status'];
			$photos[$i]['campaign_id'] = $info['campaign_id'];
			
			$i++;
		};
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
	
	
	function photo_count($campaign_id){
		global $photos;
		
		$total_photos = 0;
		foreach($photos as $photo){
			if( $photo['campaign_id'] == $campaign_id){
				$total_photos++;
			}
		}
		
		return $total_photos;
	}
	
	function twitter_photos($campaign_id){
		global $photos;
		
		$twitter_total = 0;
		foreach($photos as $photo){
			if( $photo['campaign_id'] == $campaign_id){
				if( $photo['type'] == 1){
					$twitter_total++;
				}
			}
		}
		
		return $twitter_total;
	}

	function instagram_photos($campaign_id){
		global $photos;
		
		$instagram_total = 0;
		foreach($photos as $photo){
			if( $photo['campaign_id'] == $campaign_id){
				if( $photo['type'] == 2){
					$instagram_total++;
				}
			}
		}
		
		return $instagram_total;
	}
	function google_photos($campaign_id){
		global $photos;
		
		$instagram_total = 0;
		foreach($photos as $photo){
			if( $photo['campaign_id'] == $campaign_id){
				if( $photo['type'] == 3){
					$instagram_total++;
				}
			}
		}
		
		return $instagram_total;
	}
	function facebook_photos($campaign_id){
		global $photos;
		
		$instagram_total = 0;
		foreach($photos as $photo){
			if( $photo['campaign_id'] == $campaign_id){
				if( $photo['type'] == 4){
					$instagram_total++;
				}
			}
		}
		
		return $instagram_total;
	}
	
	function need_approval($campaign_id){
		global $photos;
		
		$approval_total = 0;
		foreach($photos as $photo){
			if( $photo['campaign_id'] == $campaign_id){
				if( $photo['approval_status'] == ""){
					$approval_total++;
				}
			}
		}
		
		return $approval_total;
	}
?>

<?php include_once('header.php'); ?>
	<h1>Your Campaigns</h1>
	
	<?php 
		if( count($campaigns) >= 1):
			foreach($campaigns as $campaign): ?>
			<?php if($campaign['deleted'] == 0) :?>
            <div class="campaign-snapshot">
    			<ul <?php echo $campaign['archived'] == 1 ? "class='deactivated'" : "" ; ?>>
    				<li><a href="http://www.getdasher.com/dasher-tools/photo_display.php?id=<?php echo $campaign['id'] ?>">
                        #<?php echo $campaign['hashtag']; ?></a></li>
    				<li><span class="analyitic-digit"><?php echo need_approval($campaign['id']); ?></span> New Photos</li>
    				<li><span class="analyitic-digit"><?php echo photo_count($campaign['id']); ?></span> Photos Gathered</li>
    				<li><img src='http://getdasher.com/wp-content/uploads/2014/02/twitter-24-black.png' /><?php echo twitter_photos($campaign['id']); ?> <img src='http://getdasher.com/wp-content/uploads/2014/02/instagram-24-black.png' /><?php echo instagram_photos($campaign['id']); ?><img src='http://getdasher.com/wp-content/uploads/2014/02/googleplus-24-black.png' /><?php echo google_photos($campaign['id']); ?><img src='http://getdasher.com/wp-content/uploads/2014/02/facebook-24-black.png' /><?php echo facebook_photos($campaign['id']); ?></li>
                </ul>
                
                <ul>
                    <li <?php if ($campaign['archived'] == 1) { echo "style='display:none;'"; } ?> >
                        <a href="http://www.getdasher.com/dasher-tools/photo_display.php?id=<?php echo $campaign['id']; ?>"><div class="button button-view">View</div></a></li>
			        <li <?php if ($campaign['archived'] == 1) { echo "style='display:none;'"; } ?> >
                        <a href="" class="deactivate" id="<?php echo $campaign['id']; ?>"><div class="button campaign-display-buttons">Deactivate</div></a></li>
                   <li <?php if ($campaign['archived'] == 0) { echo "style='display:none;'"; } ?>>
                       <a href="" class="activate" id="<?php echo $campaign['id']; ?>"> <div class="button button-activate" >Activate</div></a></li>
					 <li>
	                        <a href="" class="delete" id="<?php echo $campaign['id']; ?>"><div class="button campaign-display-buttons">Delete</div></a></li>
                </ul>   
                    
                    
            </div>
			<?php endif; endforeach; ?>
			<a href="http://www.getdasher.com/dasher-tools/campaign_create.php" class="iframe-fancy"><div class="add-campaign">
                <div class="plus-sign"></div>
                <div class="new-campaign-text">Add Campaign</div>
            </div>

		<?php else: ?>
				<p>You don't have any campaigns set up yet.</p>
				<a href="http://www.getdasher.com/dasher-tools/campaign_create.php" class="iframe-fancy"><div class="add-campaign" style="float:none; margin:auto;">
	                <div class="plus-sign"></div>
	                <div class="new-campaign-text">Add Campaign</div>
	            </div>
		<?php endif; ?>
						
<?php include_once('footer.php'); ?>