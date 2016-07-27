<?php
session_start();
ini_set('display_errors', 1);
require 'src/facebook.php';
require_once('../classes/class.database.php');
$campaignID = $_GET["q"];

$user = 0;
$currentFacebook ="";

$database = new database('dasher-57');
$query3 = 'SELECT `hashtag` FROM `campaign` WHERE `id` = '.$campaignID;
$hashtagResult = $database->query($query3);
if($database->numRows($hashtagResult) > 0){
	$currentQueryArray =  $database->getRow($hashtagResult);
	$_SESSION['currentQuery'] = $currentQueryArray['hashtag'];
}

$database2 = new database('users');
$query4 = 'SELECT `facebook` FROM `users` WHERE `id` = '.$_COOKIE['userid'];
if ($result4 = $database2->query($query4)) {	 
	$currentQueryArray2 =  mysqli_fetch_row($result4);
	$currentFacebook = $currentQueryArray2[0];
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
$imageCount = 0;
$imagePost = array();



// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '446129668847368',
  'secret' => '2f52a77bbee18c1ff715741bf6d5ff61',
));
$response = $facebook->api("/search?q=%23".$currentQuery."&type=post&metadata=1");
$posts = $response['data'];

foreach($posts as $post){
	if(isset($post['object_id'])){
		$isAlbum = FALSE;
		$story =  $post['story'];
		if($story){
		$isAlbum = strpos($story, 'album');
		}
		$get2 = "/".$post['object_id']."/";
		$response2 = $facebook->api($get2);
		$images = $response2['images'];
		$imgSrc = $images[0]['source'];
		$imageCount++;
		
		$imagePost[$imageCount]['user_name'] = $post['from']['name'];
		$imagePost[$imageCount]['user_url'] = "http://facebook.com/".$post['from']['id'];
		$imagePost[$imageCount]['user_id'] = $post['from']['id'];
		$imagePost[$imageCount]['captions'] = $post['caption'];
		$imagePost[$imageCount]['post_link'] = $post['link'];
		$imagePost[$imageCount]['post_id'] = $post['id'];
		$imagePost[$imageCount]['image_link'] = $imgSrc;
		$imagePost[$imageCount]['image_thumb'] = $post['picture'];
		
		if($isAlbum !== FALSE){
			$albumLink = $post['link'];
			$aPosition = strpos($albumLink, 'a.');
			$aPosition = $aPosition + 2;
			$idHalf = substr($albumLink, $aPosition);
			$bPosition = strpos($idHalf, '.');
			$id = substr($idHalf, 0, $bPosition);
			$get3 = "/".$id."/?fields=photos";
			$response3 = $facebook->api($get3);
			foreach($response3['photos']['data'] as $photo){
				$imageCount++;
				$imagePost[$imageCount]['user_name'] = $photo['from']['name'];
				$imagePost[$imageCount]['user_url'] = "http://facebook.com/".$photo['from']['id'];
				$imagePost[$imageCount]['user_id'] = $photo['from']['id'];
				$imagePost[$imageCount]['captions'] =  $database->escape($photo['name']);
				$imagePost[$imageCount]['post_link'] = $photo['link'];
				$imagePost[$imageCount]['post_id'] = $photo['id'];
				$imagePost[$imageCount]['image_link'] = $photo['source'];
				$imagePost[$imageCount]['image_thumb'] = $photo['picture'];
			}
		}

	}
}
if($currentFacebook != ""){
$response2a = $facebook->api("/search?q=".$currentFacebook."&type=page&metadata=1");
$facebookID = $response2a['data'][0]['id'];
$response2 = $facebook->api("/".$facebookID."/photos/uploaded");
$posts2 = $response2['data'];
print_r($posts2);
foreach($posts2 as $post){
		
		//$tagPosition = strpos($post['name'], $currentQuery);
		if($tagPosition !== false){
		$imgSrc = $post['source'];
		$imageCount++;
		
		$imagePost[$imageCount]['user_name'] = $post['from']['name'];
		$imagePost[$imageCount]['user_url'] = "http://facebook.com/".$post['from']['id'];
		$imagePost[$imageCount]['user_id'] = $post['from']['id'];
		$imagePost[$imageCount]['captions'] = $post['name'];
		$imagePost[$imageCount]['post_link'] = $post['link'];
		$imagePost[$imageCount]['post_id'] = $post['id'];
		$imagePost[$imageCount]['image_link'] = $imgSrc;
		$imagePost[$imageCount]['image_thumb'] = $post['picture'];

	}
}
}

foreach($imagePost as $imageArray){

if($imageArray['image_link'] != ''){	

$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`) VALUES ('".$imageArray['post_id']."', 4, '".$imageArray['image_link']."', '".$imageArray['image_thumb']."', '".$imageArray['user_name']."', '".$imageArray['post_link']."', '".$database->escape($imageArray['captions'])."', '".$imageArray['user_id']."', '".$imageArray['user_url']."')";

    if($result = $database->query($query)){
	
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
	}
}
?>