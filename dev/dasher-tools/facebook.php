<?php
ini_set('display_errors', 1);
require 'src/facebook.php';
session_start();

// Make a MySQL Connection
require_once('connect.php');

$campaignID = $_GET["q"];

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
	if($post['object_id']){
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
				$imagePost[$imageCount]['captions'] = $photo['name'];
				$imagePost[$imageCount]['post_link'] = $photo['link'];
				$imagePost[$imageCount]['post_id'] = $photo['id'];
				$imagePost[$imageCount]['image_link'] = $photo['source'];
				$imagePost[$imageCount]['image_thumb'] = $photo['picture'];
			}
		}

	}
}

foreach($imagePost as $imageArray){

$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`) VALUES ('".$imageArray['post_id']."', 4, '".$imageArray['image_link']."', '".$imageArray['image_thumb']."', '".$imageArray['user_name']."', '".$imageArray['post_link']."', '".$imageArray['captions']."', '".$imageArray['user_id']."', '".$imageArray['user_url']."')";

if ($result = mysqli_query($link, $query)) {
}
else{
	  printf("Error: %s\n", mysqli_error($link));
	echo "<br />";
}

$query5 = 'SELECT `id` FROM `photos` WHERE `photo_url` = "'.$imageArray['image_link'].'"';
echo $query5;

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