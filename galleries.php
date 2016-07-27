<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: text/javascript');
ini_set("display_errors", 1);
session_start();
require_once ("classes/class.database.php");
$user = $_GET['user'];
$id = $_GET['id'];
$databaseName = 'dasher-'.$user;
$script_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$dbGalleries = new database($databaseName);
$gallery = $dbGalleries->query('SELECT * FROM `galleries` WHERE `ID` = '.$id);
$galleryInfo = $dbGalleries->getRow($gallery);
if($galleryInfo['status'] == 1){
$code = $galleryInfo['code'];
$javascript = file_get_contents($code);
echo '	var currentSrc = "'.$code.'";';
echo '	var scriptSrc = "'.$script_link.'";';
if($code != ""){
	$javascript = str_replace('$currentSrc = "";', '', $javascript);
}
echo $javascript;
}
else{
	echo '	jQuery(\'.dasher2\').html(\'<div style="margin:auto; width:200px; text-align:center; font-family: Arial; color:#F0F0F0; margin-top:100px;"><img src="http://app.getdasher.com/images/logo-header.png" /></div>\');';
}
?>

