<?php
ini_set('display_errors', 1);
require_once ('Oauth.php');
session_start();
$_SESSION['startID'] = 0;
$_SESSION['imageCount'] = 0;
$bearer_token = get_bearer_token();
$currentQuery = $_GET['q'];
$currentQuery = str_replace('#', '', $currentQuery);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '', $currentQuery);
$currentQuery = str_replace(' ', '', $currentQuery);
$results1 = search_for_a_term($bearer_token, $currentQuery, 'recent', 100, $_SESSION['startID']);
$tweets1 = json_decode($results1);
exportTweets($tweets1);

while($_SESSION['imageCount'] < 30){
$results2 = search_for_a_term($bearer_token, $currentQuery, 'recent', 100, $_SESSION['startID']);
$tweets2 = json_decode($results2);
exportTweets($tweets2);
}


function exportTweets($tweets){
	$galleryImages = "";
foreach($tweets as $tweeters){
	foreach ($tweeters as $tweet){
		$id = $tweet->id_str;
		if(isset($id)){
		$_SESSION['startID'] = $id;
		}
		$textsArray[$id] = $tweet->text;
		$userArray[$id] = $tweet->user->screen_name;
		$entities = $tweet->entities;
		$media = $entities->media;
		if(isset($media)){
			$mediaImage = $media[0]->media_url;
			if(isset($mediaImage)){
				$galleryImages[$id] = $mediaImage;
			}
			
		$i++;
		}
	}
}

if( is_array($galleryImages)){
$galleryImages = array_unique($galleryImages); 
$i = 0;
 foreach($galleryImages as $key => $galleryImage){ 
 if($i < 4){
  $captions = $textsArray[$key];
  $captions = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $captions);
  $captions = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1#<a href="https://twitter.com/search?q=%23\2" target="_blank">\2</a>', $captions);
  $captions = preg_replace('/(^|\s)@(\w*[a-zA-Z_]+\w*)/', '\1#<a href="https://twitter.com/search?q=%23\2" target="_blank">\2</a>', $captions);

 ?>
  <dl class="gallery-item">
			<dt class="gallery-icon">
				<a href="<?php echo $galleryImage; ?>" class="backer" title="dasher-logo" target="_blank" style="background-image:url(<?php echo $galleryImage; ?>)"></a><div class="hoverdata"><a href="http://www.twitter.com" target="_blank"><img src="<?php echo "http://www.getdasher.com/wp-content/uploads/2013/06/twitter-24.png";  ?>" width="20px" height="20px" class="icon" /></a><div class="userNameTwitter"><a href = "http://www.twitter.com/<?php echo $userArray[$key]; ?>" target="_blank"><?php echo $userArray[$key]; ?></a></div><div class="userDescription"><?php echo $captions; ?></div></div>
			</dt></dl><?php $i++; $_SESSION['imageCount']++; 
}
 }
echo "<br /><br />";

}
}


?>