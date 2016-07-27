<?php
ini_set('display_errors', 0);
echo "<br />";
require_once ('Oauth.php');
session_start();
$_SESSION['startID'] = 0;
$_SESSION['imageCount'] = 0;
$_SESSION['counter'] = 0;
$bearer_token = get_bearer_token();
$currentQuery = $_GET['q'];
$currentQuery = str_replace("#", "", $currentQuery);
$currentQuery = str_replace("@", "", $currentQuery);
$currentQuery = "#".$currentQuery;
$currentQuery = urlencode($currentQuery);
$results1 = search_for_a_term($bearer_token, $currentQuery, "popular", 100, $_SESSION["startID"]);
$tweets1 = json_decode($results1);
exportTweets($tweets1);

while($_SESSION["imageCount"] < 6 && $_SESSION['pass'] < 100){
$results2 = search_for_a_term($bearer_token, $currentQuery, "popular", 100, $_SESSION["startID"]);
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
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["caption"] = $text;
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["user"] = $user;
				$_SESSION["galleryImages"][$_SESSION["imageCount"]]["id"] = $id;
				$_SESSION["imageCount"]++;
			}
		}
	}
}
$_SESSION['pass']++;
}

if( is_array($_SESSION['galleryImages'])){
$galleryImages = $_SESSION['galleryImages']; 
$i = 0;
 foreach($galleryImages as $galleryImage){ 
	if($i <= 3){
 ?>
  <dl class="gallery-item">
			<dt class="gallery-icon">
				<a href="<?php echo $galleryImage['image']; ?>" class="backer" titler="dasher-logo" target="_blank" style="background-image:url(<?php echo $galleryImage['image']; ?>)"></a><div class="hoverdata"><a href="http://www.twitter.com" target="_blank"><img src="<?php echo "http://www.getdasher.com/wp-content/uploads/2013/06/twitter-24.png";  ?>" width="20px" height="20px" class="icon" /></a><div class="userNameTwitter"><a href = "http://www.twitter.com/<?php echo $galleryImage['user']->id; ?>" target="_blank"><?php echo $galleryImage['user']->name; ?></a></div><div class="userDescription"><?php echo $galleryImage['caption']; ?></div></div>
			</dt></dl><?php $i++; 
}
 }
echo "<br /><br />";

}


?>