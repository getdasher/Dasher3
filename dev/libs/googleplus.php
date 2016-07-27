<?php
//ini_set('display_errors', 1);
session_start();

require_once('../classes/class.database.php');

$campaignID = $_GET["q"];
$passes = 0;

$database = new database('dasher-56');
$query3 = 'SELECT `hashtag` FROM `campaign` WHERE `id` = '.$campaignID;
$hashtagResult = $database->query($query3);
if($database->numRows($hashtagResult) > 0){
	$currentQueryArray =  $database->getRow($hashtagResult);
	$_SESSION['currentQuery'] = $currentQueryArray['hashtag'];
}

$currentQuery = str_replace('#', '', $_SESSION['currentQuery']);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '', $currentQuery);
$currentQuery = str_replace(' ', '', $currentQuery);
$imageCount = 0;
$imagePost = array();
$plusPosts = file_get_contents("https://www.googleapis.com/plus/v1/activities?query=".$currentQuery."&maxResults=20&orderBy=recent&key=AIzaSyDBTfrt5JBeUTyrKo5miBQAAIht9muhgn8");
$posts = json_decode($plusPosts);
print_r($posts);

$nextToken = $posts->nextPageToken;

foreach($posts->items as $post){
	foreach ($post->object->attachments as $objects){
	$imagePost[$imageCount]['user_name'] = $post->actor->displayName;
	$imagePost[$imageCount]['user_url'] = $post->actor->url;
	$imagePost[$imageCount]['user_id'] = $post->actor->id;
	$imagePost[$imageCount]['captions'] = $database->escape($post->title);
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
	$imagePost[$imageCount]['captions'] = $database->escape($post->title);
	$imagePost[$imageCount]['post_link'] = $post->url;
	$imagePost[$imageCount]['post_id'] = $post->id;
	$imagePost[$imageCount]['image_link'] = $objects->image->url;
	$imageCount++;
	}
	$passes++;
}

foreach($imagePost as $imageArray){
$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`) VALUES ('".$imageArray['post_id']."', 3, '".$imageArray['image_link']."', '', '".$imageArray['user_name']."', '".$imageArray['post_link']."', '".$database->escape($imageArray['captions'])."', '".$imageArray['user_id']."', '".$imageArray['user_link']."')";
	$query2 = 'INSERT INTO `campaign_photos` (`photo_id`, `campaign_id`) VALUES (LAST_INSERT_ID(), '.$campaignID.')';
	
		$result = $database->query($query);
		$photoID = $database->lastId();
		$query6 = 'SELECT `id` FROM `campaign_photos` WHERE `photo_id` = '.$photoID.' AND `campaign_id` = "'.$campaignID.'"';
		if ($result6 = $database->query($query6)) {
				$currentQueryArray6 =  mysqli_fetch_row($result6);
				if(!isset($currentQueryArray6) || $currentQueryArray6 == ""){
					$query2 = 'INSERT INTO `campaign_photos` (`photo_id`, `campaign_id`) VALUES ('.$photoID.', '.$campaignID.')';
					$result2 = $database->query($query2);
				}
		}
	}
?>