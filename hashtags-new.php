<?php
	ini_set('display_errors', 0);
	require_once('classes/class.database.php');
	
	function exportTweets($tweets, $currentQuery){
		$_SESSION['startID'] = $tweets->search_metadata->max_id;
		$i = 0;
	foreach($tweets as $tweeters){
		foreach ($tweeters as $tweet){
			$createdAt = $tweet->created_at;
			$creation = strtotime($createdAt);
			$id = $tweet->id_str;
			if(isset($id)){
			$_SESSION['startID'] = $id;
			}
			$entities = $tweet->entities;
			$media = $entities->media;
			if(isset($media)){
				$mediaImage = $media[0]->media_url;
				$caption = $tweet->text;
				$caption = htmlentities($caption);
				$pos = strpos($caption, $currentQuery);
				$retweet = strpos($caption, 'RT ');
				if(isset($mediaImage)  && $pos !== false && $retweet === false){
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['image_url'] = $mediaImage;
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['tweet_id'] = $id;
					$screenName = $tweet->user->name;
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['screen_name'] = $screenName;
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['post_link'] = 'http://twitter.com/'.$screenName.'/statuses/'.$id;
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['caption'] = $caption;
					$userID = $tweet->user->id_str;
					$userLink = $tweet->user->screen_name;
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['userid'] = $userID;
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['user_link'] = 'http://twitter.com/'.$userLink;
					$_SESSION['galleryImages'][$_SESSION['imageCount']]['creation'] = $creation;
					$_SESSION['imageCount']++;
				}

			}
					$i++;
		}
	}
	$_SESSION['tweetRuns']++;
	}
	$userId = $_GET['userId'];
	$database = new database('users');
	$userQuery = $database->query("SELECT * FROM `users` WHERE ID = ".$userId);
	$results = $database->getRows($userQuery);
	foreach($results as $result){
		if($result['sub'] == 0){
		$databaseName = "dasher-".$result['ID'];
		$currentID = $result['ID'];
		$database2 = new database($databaseName);
		$query2 = $database2->query("SELECT * FROM `campaign` WHERE `archived` != 1");
		$results2 = $database2->getRows($query2);
			foreach ($results2 as $camps){
				$_GET['q'] = $camps['ID'];
				$_GET['user'] = $currentID;
				$_GET['database'] = $databaseName;
				$instagram = 'libs/instagram-gather4.php';
				$twitter = 'libs/twitter-gather4.php';
				$googleplus = 'libs/googleplus4.php';
				$facebook="";
				if($camps['facebook']){
					$facebook = "libs/facebook6.php";
				}
				try {
				include $instagram;
				}
				catch ( Exception $e ) {
				    // an error occurred
				    //echo $e->getMessage();
				}
				try {
				include($twitter);
				}
				catch ( Exception $e ) {
				    // an error occurred
				    //echo $e->getMessage();
				}
				
				$i++;
			}
		}
			
	}
?>