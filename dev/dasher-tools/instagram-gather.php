<?php
ini_set('display_errors', 1);
session_start();

// Make a MySQL Connection
require_once('connect.php');


$_SESSION['imageCountI'] = 0;

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

$currentQuery = $_SESSION['currentQuery'];
$currentQuery = str_replace('#', '', $currentQuery);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '', $currentQuery);
$currentQuery = str_replace(' ', '', $currentQuery);
//-- Include our library
include_once 'instagram/instaphp.php';
//-- Get an instance of the Instaphp object
$api = Instaphp\Instaphp::Instance();

//-- Get the response for Popular media
$response = $api->Tags->Recent($currentQuery);

//-- Check if an error was returned from the API
if (empty($response->error)){
    foreach ($response->data as $item){ 
	
	$instagram_post_id = $item->id;
	$instagram_post_link = "http://www.instagram.com/".$item->user->username;
	$instagram_username = $item->user->username;
	$image_url = $item->images->standard_resolution->url;
	$thumbnail_url = $item->images->thumbnail->url;
	$instagram_user_id = $item->user->id;
	$captions = $item->caption->text;
	$captions = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $captions);
	$captions = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1#<a href="http://statigr.am/tag/\2" target="_blank">\2</a>', $captions);
	$captions = preg_replace('/(^|\s)@(\w*[a-zA-Z_]+\w*)/', '\1#<a href="http://statigr.am/tag/\2" target="_blank">\2</a>', $captions);
	$captions = urlencode($captions);
	
	$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`) VALUES ('$instagram_post_id', 2, '$image_url', '$thumbnail_url', '$instagram_username', '$instagram_post_link', '$captions', '$instagram_user_id', '$instagram_post_link')";
	
	if ($result = mysqli_query($link, $query)) {
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
	
	$query5 = 'SELECT `id` FROM `photos` WHERE `photo_url` = "'.$image_url.'"';

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
}	
?>