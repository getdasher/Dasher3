<?php
ini_set('display_errors', 1);
require_once 'src/facebook.php';



$currentQuery = str_replace('#', '', 'thetenamproject');
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
$response = $facebook->api("/search?q=".$currentQuery."&type=post&metadata=1");
$posts = $response['data'];
print_r($posts);

foreach($posts as $post){
	print_r($posts);
	$stringCheck = "#".$currentQuery;
	$hashCheck = strpos($post['caption'], $stringCheck);
	if(isset($post['object_id']) && $hashCheck !== FALSE){
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
?>