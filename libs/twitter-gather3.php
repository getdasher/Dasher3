<?php
session_start();
ini_set('display_errors', '1');
require_once __DIR__ . '/TwitterOAuth/TwitterOAuth.php';
require_once __DIR__ . '/TwitterOAuth/Exception/TwitterException.php';


use TwitterOAuth\TwitterOAuth;

date_default_timezone_set('UTC');

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
$_SESSION['galleryImages'] = array();

$campaignID = $_SESSION["q"];

$databaseName = "dasher-".$_SESSION['database'];

$database = new database('dasher-54');
$query3 = 'SELECT `hashtag` FROM `campaign` WHERE `id` = '.$campaignID;
$hashtagResult = $database->query($query3);
if($database->numRows($hashtagResult) > 0){
	$currentQueryArray =  $database->getRow($hashtagResult);
	$_SESSION['currentQuery'] = $currentQueryArray['hashtag'];
}

$currentQuery = $_SESSION['currentQuery'];
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
exportTweets($tweets1);

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