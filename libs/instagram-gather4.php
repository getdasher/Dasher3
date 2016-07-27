<?php
set_time_limit(100);
ini_set('display_errors', 0);
session_start();

$_SESSION['imageCountI'] = 0;
$campaignID = $_GET["q"];
$databaseName = $_GET['database'];
$instaRuns = 0;
unset($_SESSION['maxID']);

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
//-- Include our library
require_once ('instagram/instaphp.php');
//-- Get an instance of the Instaphp object


while($instaRuns < 5){
//-- Get the response for Popular media
if(isset($_SESSION['maxID'])){
	$api = Instaphp\Instaphp::Instance();
	if(isset($currentQuery) && $_SESSION['maxID'] != "" && $currentQuery != ""){
	$response = $api->Tags->Recent($currentQuery,array('client_id' => 'bfe0e54e09c84f999a42ede0ae7318ea', 'max_tag_id' => $_SESSION['maxID']));
}
	//echo $_SESSION['maxID'];
}
else{
	$api = Instaphp\Instaphp::Instance();
	$response = $api->Tags->Recent($currentQuery, array(), '');
}
$_SESSION['maxID'] = $response->pagination->next_max_id;
//$_SESSION['nextURL'] = $response->pagination->next_url;
$_SESSION['minID'] = $response->pagination->next_min_id;


//-- Check if an error was returned from the API
if (empty($response->error)){
    foreach ($response->data as $item){ 
	
	$instagram_post_id = $item->id;
	$instagram_post_link = $item->link;
	$instagram_username = $item->user->username;
	$image_url = $item->images->standard_resolution->url;
	$thumbnail_url = $item->images->thumbnail->url;
	$instagram_user_id = $item->user->id;
	$captions = $item->caption->text;
	$captions = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $captions);
	$captions = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1#<a href="http://statigr.am/tag/\2" target="_blank">\2</a>', $captions);
	$captions = preg_replace('/(^|\s)@(\w*[a-zA-Z_]+\w*)/', '\1#<a href="http://statigr.am/tag/\2" target="_blank">\2</a>', $captions);
	$captions = urlencode($captions);
	$capCheck = stripos($captions, $currentQuery);
	$createTime = $item->created_time;
	
	if($capCheck !== FALSE){
	$query = "INSERT INTO photos(`post_id`, `type`, `photo_url`, `thumb_url`, `user_name`, `service_link`, `captions`, `service_id`, `user_link`, `stamp`) VALUES ('$instagram_post_id', 2, '$image_url', '$thumbnail_url', '$instagram_username', '$instagram_post_link', '$captions', '$instagram_user_id', '$instagram_post_link', $createTime)";

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
}
$instaRuns++;
}	
?>