<?php
ini_set('display_errors', 1);
session_start();
require_once('../classes/class.database.php');
require_once __DIR__ . '/TwitterOAuth/TwitterOAuth.php';
require_once __DIR__ . '/TwitterOAuth/Exception/TwitterException.php';


use TwitterOAuth\TwitterOAuth;

date_default_timezone_set('UTC');


function exportTweets($tweets, $currentQuery){
	//print_r($tweets);
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
			print_r($tweet);
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


$config = array(
    'consumer_key'       => 'TYakYRdjEyciLaczZdTC6Ha3z', // API key
    'consumer_secret'    => 'iXx1BOLT9HEKvNSLtSsfqTR9bwc7bMGhx98rBa314giunH6Gyn', // API secret
    'oauth_token'        => '', // not needed for app only
    'oauth_token_secret' => '',
    'output_format'      => 'json'
);

$connection = new TwitterOAuth($config);
$bearer_token = $connection->getBearerToken();

$runs = 0;
$imageCount = 0;

$_SESSION['startID'] = 0;
$_SESSION['imageCount'] = 0;
$_SESSION['tweetRuns'] = 0;
$_SESSION['galleryImages'] = array();

$currentTweet = 0;
$campaignID = $_GET["q"];
$databaseName = $_GET['database'];
$database = new database($databaseName);
$query3 = 'SELECT `hashtag` FROM `campaign` WHERE `id` = '.$campaignID;
$hashtagResult = $database->query($query3);
if($database->numRows($hashtagResult) > 0){
	$currentQueryArray =  $database->getRow($hashtagResult);
	$_GET['currentQuery'] = $currentQueryArray['hashtag'];
}

$currentQuery = $_GET['currentQuery'];
$currentQuery = str_replace('#', '', $currentQuery);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '', $currentQuery);
$currentQuery = str_replace(' ', '', $currentQuery);


$params = array(
    'q' => $currentQuery,
	'count' => '100',
);

$results1 = $connection->get('search/tweets', $params);
$tweets1 = json_decode($results1);
exportTweets($tweets1, $currentQuery);

while($_SESSION['tweetRuns'] <= 10){
	$params = array(
	    'q' => $currentQuery,
		'count' => '100',
		'max_id' => $_SESSION['startID'],
	);
	print_r($params);
	$results1 = $connection->get('search/tweets', $params);
	$tweets1 = json_decode($results1);
	exportTweets($tweets1, $currentQuery);
}



$k = 0;

foreach($_SESSION['galleryImages'] as $imageArray){
	$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`, `stamp`) VALUES ('".$imageArray['tweet_id']."', 1, '".$imageArray['image_url']."', '', '".$imageArray['screen_name']."', '".$imageArray['post_link']."', '".$database->escape($imageArray['caption'])."', '".$imageArray['userid']."', '".$imageArray['user_link']."', '".$imageArray['creation']."')";
	
	if ($result = $database->query($query)) {
		$k++;
	}
	$photoID = $database->lastId();
	$query6 = 'SELECT `id` FROM `campaign_photos` WHERE `photo_id` = '.$photoID.' AND `campaign_id` = "'.$campaignID.'"';
	if ($result6 = $database->query($query6)) {
			$currentQueryArray6 =  mysqli_fetch_row($result6);
			if(!isset($currentQueryArray6) || $currentQueryArray6 == ""){
				$query2 = 'INSERT INTO `campaign_photos` (`photo_id`, `campaign_id`) VALUES ('.$photoID.', '.$campaignID.')';
				$imageCount++;
				if ($result2 = $database->query($query2)) {
				}
			}
	}

	}
?>