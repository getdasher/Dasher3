<?php
ini_set("display_errors", 1);
require_once ("Oauth.php");
session_start();
require_once ("connect.php");



$_SESSION["startID"] = 0;
$_SESSION['link'] = $link;
$_SESSION["imageCount"] = 0;
$_SESSION['passes'] = 0;
$_SESSION["galleryImages"] = array();
$_SESSION['currentQuery'] = '';
$bearer_token = get_bearer_token();
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
$currentQuery = str_replace("#", "", $currentQuery);
$currentQuery = str_replace("@", "", $currentQuery);
$results1 = search_for_a_term($bearer_token, $currentQuery, "recent", 100, $_SESSION["startID"]);
$tweets1 = json_decode($results1);
exportTweets($tweets1);

while($_SESSION["imageCount"] < 30 && $_SESSION['passes'] < 10){
$results2 = search_for_a_term($bearer_token, $currentQuery, "recent", 100, $_SESSION["startID"]);
$tweets2 = json_decode($results2);
exportTweets($tweets2);
}


function exportTweets($tweets){
	$i = 0;
foreach($tweets as $tweeters){
	foreach ($tweeters as $tweet){
		$id = $tweet->id_str;
		if(isset($id)){
		$_SESSION["startID"] = $id;
		}
		$entities = $tweet->entities;
		$text = $tweet->text;
		$user = $tweet->user;
		$media = $entities->media;
		if(isset($media)){
			$mediaImage = $media[0]->media_url;
			if(isset($mediaImage)){
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["image"] = $mediaImage;
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["caption"] = "";
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["caption"] = mysqli_real_escape_string($_SESSION['link'], $text);
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["user"] = $user;
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["id"] = $id;
				$_SESSION["imageCount"]++;
			}
		}
	}
}
$_SESSION['passes']++;
}

 foreach($_SESSION["galleryImages"] as $galleryImage){
	$userLink = "http://twitter.com/".$galleryImage["user"]->screen_name;
	$userName = $galleryImage["user"]->name;
	$serviceId = $galleryImage["user"]->id;
	$serviceLink = "https://twitter.com/".$userName."/statuses/".$galleryImage["id"];
  	$query = 'INSERT IGNORE INTO `photos` (`post_id`, `photo_url`, `type`, `captions`, `user_link`, `user_name`, `service_link`, `service_id`) VALUES ("'.$galleryImage["id"].'", "'.$galleryImage["image"].'", 1, "'.$galleryImage["caption"].'", "'.$userLink.'", "'.$userName.'", "'.$serviceLink.'", "'.$serviceId.'")';

		if ($result = mysqli_query($link, $query)) {
		}
		else{
			  printf("Error: %s\n", mysqli_error($link));
			echo "<br />";
		}

	$query5 = 'SELECT `id` FROM `photos` WHERE `photo_url` = "'.$galleryImage["image"].'"';

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