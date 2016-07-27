<?php
ini_set('display_errors', 1);
require_once 'src/facebook.php';
$campaignID = $_GET["q"];

$user = 0;
$currentFacebook ="";
$databaseName = $_GET['database'];

$database = new database($databaseName);
$query3 = 'SELECT * FROM `campaign` WHERE `id` = '.$campaignID;
$hashtagResult = $database->query($query3);
if($database->numRows($hashtagResult) > 0){
	$currentQueryArray =  $database->getRow($hashtagResult);
	$_GET['currentQuery'] = $currentQueryArray['facebook'];
	$_GET['currentHash'] = $currentQueryArray['hashtag'];
}
else{
	  printf("Error: %s\n", mysqli_error($link));
	echo "<br />";
}

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '446129668847368',
  'secret' => '2f52a77bbee18c1ff715741bf6d5ff61',
));


$currentQuery = str_replace('#', '', $_GET['currentHash']);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '', $currentQuery);
$currentQuery = str_replace(' ', '', $currentQuery);
$imageCount = 0;
$imagePost = array();

$responseItem = "/".$_GET['currentQuery']."/feed";
$response = $facebook->api($responseItem);
$posts = $response['data'];

foreach($posts as $post){
	$stringCheck = "#".$currentQuery;
	$hashCheck = stripos($post['message'], $stringCheck);
	if(isset($post['object_id'])){
		print_r($post);
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

if($post['object_id']){
$photos_object_id = $post['object_id'];
$photos_object_query = "/".$_GET['currentQuery']."/albums";
$photos_object_response = $facebook->api($photos_object_query);
$photos_object = $photos_object_response['data'];
foreach($photos_object as $album){
	$album_id = $album['id'];
	$album_object_query = "/".$album_id."/photos";
	$album_object_response = $facebook->api($album_object_query);
	//print_r($album_object_response['data']);
	$album_object = $album_object_response['data'];
	foreach($album_object as $album){
			//print_r($album);
			$imageCount++;
			$imagePost[$imageCount]['user_name'] = $album['from']['name'];
			$imagePost[$imageCount]['user_url'] = "http://facebook.com/".$album['from']['id'];
			$imagePost[$imageCount]['user_id'] = $album['from']['id'];
			$imagePost[$imageCount]['captions'] = '';
			$imagePost[$imageCount]['post_link'] = '';
			$imagePost[$imageCount]['post_id'] = $album['id'];
			$imagePost[$imageCount]['image_link'] = $album['images'][0]['source'];
			$imagePost[$imageCount]['image_thumb'] = $album['images'][0]['source'];
	}
}
}
}
foreach($imagePost as $imageArray){

if($imageArray['image_link'] != ''){	

$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`) VALUES ('".$imageArray['post_id']."', 4, '".$imageArray['image_link']."', '".$imageArray['image_thumb']."', '".$imageArray['user_name']."', '".$imageArray['post_link']."', '".$database->escape($imageArray['captions'])."', '".$imageArray['user_id']."', '".$imageArray['user_url']."')";

    if($result = $database->query($query)){
	print_r($result);
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
