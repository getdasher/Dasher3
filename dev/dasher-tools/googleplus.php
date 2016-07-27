<?php
ini_set('display_errors', 1);
session_start();

// Make a MySQL Connection
require_once('connect.php');

$campaignID = $_GET["q"];
$passes = 0;

$query3 = 'SELECT `hashtag` FROM `campaign` WHERE `id` = '.$campaignID;
if ($result3 = mysqli_query($link, $query3)) {	 
	$currentQueryArray =  mysqli_fetch_row($result3);
	$_SESSION['currentQuery'] = $currentQueryArray[0];
}
else{
	  printf("Error: %s\n", mysqli_error($link));
	echo "<br />";
}

$currentQuery = str_replace('#', '', $_SESSION['currentQuery']);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '', $currentQuery);
$currentQuery = str_replace(' ', '', $currentQuery);
echo $currentQuery;
$imageCount = 0;
$imagePost = array();

$plusPosts = file_get_contents("https://www.googleapis.com/plus/v1/activities?query=".$currentQuery."&maxResults=20&orderBy=recent&key=AIzaSyDBTfrt5JBeUTyrKo5miBQAAIht9muhgn8");
$posts = json_decode($plusPosts);

$nextToken = $posts->nextPageToken;

foreach($posts->items as $post){
	foreach ($post->object->attachments as $objects){
	$imagePost[$imageCount]['user_name'] = $post->actor->displayName;
	$imagePost[$imageCount]['user_url'] = $post->actor->url;
	$imagePost[$imageCount]['user_id'] = $post->actor->id;
	$imagePost[$imageCount]['captions'] = $link->real_escape_string($post->title);
	$imagePost[$imageCount]['post_link'] = $post->url;
	$imagePost[$imageCount]['post_id'] = $post->id;
	$imagePost[$imageCount]['image_link'] = $objects->image->url;
	$imageCount++;
	}	
	$passes++;
}

while($imageCount < 30 && $nextToken != ""  && $passes < 10){
	$plusPosts = file_get_contents("https://www.googleapis.com/plus/v1/activities?query=".$currentQuery."&maxResults=20&orderBy=recent&pageToken=".$nextToken."&key=AIzaSyDBTfrt5JBeUTyrKo5miBQAAIht9muhgn8");
	
	$nextToken = $posts->nextPageToken;
	
	$posts = json_decode($plusPosts);
	foreach ($post->object->attachments as $objects){
	$imagePost[$imageCount]['user_name'] = $post->actor->displayName;
	$imagePost[$imageCount]['user_url'] = $post->actor->url;
	$imagePost[$imageCount]['user_id'] = $post->actor->id;
	$imagePost[$imageCount]['captions'] = $link->real_escape_string($post->title);
	$imagePost[$imageCount]['post_link'] = $post->url;
	$imagePost[$imageCount]['post_id'] = $post->id;
	$imagePost[$imageCount]['image_link'] = $objects->image->url;
	$imageCount++;
	}
	$passes++;
}


foreach($imagePost as $imageArray){
$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`) VALUES ('".$imageArray['post_id']."', 3, '".$imageArray['image_link']."', '', '".$imageArray['user_name']."', '".$imageArray['post_link']."', '".mysqli_real_escape_string($link, $imageArray['captions'])."', '".$imageArray['user_id']."', '".$imageArray['user_link']."')";
	$query2 = 'INSERT INTO `campaign_photos` (`photo_id`, `campaign_id`) VALUES (LAST_INSERT_ID(), '.$campaignID.')';
	
		if ($result = mysqli_query($link, $query)) {
		}
		else{
			  printf("Error: %s\n", mysqli_error($link));
			echo "<br />";
		}

	$query5 = 'SELECT `id` FROM `photos` WHERE `photo_url` = "'.$imageArray['image_link'].'"';

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