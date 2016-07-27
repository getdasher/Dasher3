<?php
require_once ('Oauth.php');
session_start();

// Make a MySQL Connection
require_once('connect.php');

$_SESSION['startID'] = 0;
$_SESSION['imageCount'] = 0;
$_SESSION['galleryImages'] = array();

$campaignID = $_GET["q"];

$bearer_token = get_bearer_token();
$query3 = 'SELECT `hashtag` FROM `campaign` WHERE `id` = '.$campaignID;
if ($result3 = mysqli_query($link, $query3)) {	 
	$currentQueryArray =  mysqli_fetch_row($result3);
	$_SESSION['currentQuery'] = $currentQueryArray[0];
}
else{
	  printf("Error: %s\n", mysqli_error($link));
	echo "<br />";
}


$currentQuery = $_SESSION['currentQuery'];
$currentQuery = str_replace('#', '', $currentQuery);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '', $currentQuery);
$currentQuery = str_replace(' ', '', $currentQuery);
$results1 = search_for_a_term($bearer_token, $currentQuery, 'recent', 100, $_SESSION['startID']);
$tweets1 = json_decode($results1);
print_r($tweets1);

while($_SESSION['imageCount'] < 30){
$results2 = search_for_a_term($bearer_token, $currentQuery, 'recent', 100, $_SESSION['startID']);
$tweets2 = json_decode($results2);
exportTweets($tweets2);
}


function exportTweets($tweets){
	$i = 0;
foreach($tweets as $tweeters){
	foreach ($tweeters as $tweet){
		$id = $tweet->id_str;
		if(isset($id)){
		$_SESSION['startID'] = $id;
		}
		$entities = $tweet->entities;
		$media = $entities->media;
		if(isset($media)){
			$mediaImage = $media[0]->media_url;
			if(isset($mediaImage)){
				$_SESSION['galleryImages'][$_SESSION['imageCount']]['image_url'] = $mediaImage;
				$_SESSION['galleryImages'][$_SESSION['imageCount']]['tweet_id'] = $id;
				$screenName = $tweet->user->name;
				$_SESSION['galleryImages'][$_SESSION['imageCount']]['screen_name'] = $screenName;
				$_SESSION['galleryImages'][$_SESSION['imageCount']]['post_link'] = 'http://twitter.com/'.$screenName.'/statuses/'.$id;
				$caption = $tweet->text;
				$_SESSION['galleryImages'][$_SESSION['imageCount']]['caption'] = htmlentities($caption);
				$userID = $tweet->user->id_str;
				$_SESSION['galleryImages'][$_SESSION['imageCount']]['userid'] = $userID;
				$_SESSION['galleryImages'][$_SESSION['imageCount']]['user_link'] = 'http://twitter.com/'.$screenName;
				$_SESSION['imageCount']++;
			}
			
		$i++;
		
		}
	}
}
}


$k = 0;
foreach($_SESSION['galleryImages'] as $imageArray){
	$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`) VALUES ('".$imageArray['tweet_id']."', 1, '".$imageArray['image_url']."', '', '".$imageArray['screen_name']."', '".$imageArray['post_link']."', '".mysqli_real_escape_string($link, $imageArray['caption'])."', '".$imageArray['userid']."', '".$imageArray['user_link']."')";
	
	if ($result = mysqli_query($link, $query)) {
		$k++;
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}

$query5 = 'SELECT `id` FROM `photos` WHERE `photo_url` = "'.$imageArray['image_url'].'"';

if ($result5 = mysqli_query($link, $query5)) {
	$currentQueryArray5 =  mysqli_fetch_row($result5);
	$photoID = $currentQueryArray5[0];
	
	if($photoID){
	$query6 = 'SELECT `id` FROM `campaign_photos` WHERE `photo_id` = '.$photoID.' AND `campaign_id` = "'.$campaignID.'"';
	if ($result6 = mysqli_query($link, $query6)) {
			$currentQueryArray6 =  mysqli_fetch_row($result6);
			if(!isset($currentQueryArray6) || $currentQueryArray6 == ""){
				$query2 = 'INSERT INTO `campaign_photos` (`photo_id`, `campaign_id`) VALUES ('.$photoID.', '.$campaignID.')';
				if ($result2 = mysqli_query($link, $query2)) {
				}
				else{
					printf("Error: %s\n", mysqli_error($link));
					echo "<br />";
				}
			}
	}
	else{
		echo $query6;
	}

	}
}
else{
	  printf("Error: %s\n", mysqli_error($link));
	echo "<br />";
}

}
?>