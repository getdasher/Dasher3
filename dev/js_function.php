<?php
session_start();
ini_set('display_errors', 1);
include('classes/class.photo.php');
include('classes/class.campaign.php');
if($_GET['type'] == "approve"){
	$image = new photo($_GET['id']);
	$image->approve();
}

if($_GET['type'] == "deny"){
	$image = new photo($_GET['id']);
	$image->deny();
}
if($_GET['type'] == "deactivate"){
	$campaign = new campaign($_GET['id']);
	$campaign->archiveCampaign();
}
if($_GET['type'] == "delete"){
	$campaign = new campaign($_GET['id']);
	$campaign->deleteCampaign();
}
if($_GET['type'] == "activate"){
	$campaign = new campaign($_GET['id']);
	$campaign->unarchiveCampaign();
}
?>
