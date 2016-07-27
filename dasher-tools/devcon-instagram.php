<?php
session_start();
$_SESSION['imageCountI'] = 0;
$currentQuery = 'bigskydevcon';
//-- Include our library
include_once 'instagram/instaphp.php';

//-- Get an instance of the Instaphp object
$api = Instaphp\Instaphp::Instance();

//-- Get the response for Popular media
$response = $api->Tags->Search($currentQuery);
print_r($response->data);

//-- Check if an error was returned from the API
if (empty($response->error)){
	$i = 0;
    foreach ($response->data as $item){ 
		?>
	<dl class="gallery-item">
			<dt class="gallery-icon"> <?php 
			
			$captions = $item->caption->text;
			$captions = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $captions);
			$captions = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1#<a href="http://statigr.am/tag/\2" target="_blank">\2</a>', $captions);
  			$captions = preg_replace('/(^|\s)@(\w*[a-zA-Z_]+\w*)/', '\1#<a href="http://statigr.am/tag/\2" target="_blank">\2</a>', $captions);
			$result = $item->images->standard_resolution->url;
        printf('<a href="%s" class="backer" target="_blank" style="background-image:url(%s);"></a><div class="hoverdata"><a href="http://instagram.com" target="_blank"><img src="http://www.vauthierferguson.com/Dasher/wp-content/uploads/2013/06/instagram-24.png" width="20px" height="20px" class="icon" /></a><div class="userNameInstagram"><a href = "http://www.instagram.com/%s" target="_blank">%s</a></div><div class="userDescription">%s</div></div>', $item->images->standard_resolution->url, $item->images->thumbnail->url, $item->user->username, $item->user->username, $captions);?>
		</dt></dl><?php $i++; $_SESSION['imageCountI']++;
	}
}	
?>