<?php
ini_set('display_errors', 1);
session_start();
require_once('classes/class.database.php');

$userType = $_GET['sub'];
switch ($userType) {
    case 1:
        $PlanName = "Basic Plan";
		$num_galleries = 1;
		$num_tags = 5;
		$basicButton = "Current Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
    case 2:
        $PlanName = "Business Plan";
		$num_galleries = 3;
		$num_tags = 15;
		$basicButton = "Select Plan";
		$businessButton = "Current Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
    case 3:
        $PlanName = "Pro Plan";
		$num_galleries = 'Unlimited';
		$num_tags = 'Unlimited';
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Current Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
	case 4:
        $PlanName = "Basic Yearly Plan";
		$num_galleries = 1;
		$num_tags = 5;
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Current Plan";
		$businessYear = "Select Plan";
		$proYear = "Select Plan";
        break;
	case 5:
        $PlanName = "Business Yearly Plan";
		$num_galleries = 3;
		$num_tags = 15;
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Current Plan";
		$proYear = "Select Plan";
        break;
    case 6:
        $PlanName = "Pro Yearly Plan";
		$num_galleries = 'Unlimited';
		$num_tags = 'Unlimited';
		$basicButton = "Select Plan";
		$businessButton = "Select Plan";
		$proButton = "Select Plan";
		$basicYear = "Select Plan";
		$businessYear = "Select Plan";
		$proYear = "Current Plan";
        break;
}

$database = new database($_COOKIE['userdatabase']);
$userDB = new database('users');

$tags_query = "SELECT * FROM `campaign` WHERE `archived` != 1";
$tags_results = $database->query($tags_query);
$tags_count = $database->numRows($tags_results);
if($tags_count > $num_tags){
	$tags_off = "UPDATE `campaign` SET `archived` = 1";
	$off_result = $database->query($tags_off);
	$tags_on = "UPDATE `campaign` SET `archived` = 0 ORDER BY `ID` ASC LIMIT ".$num_tags;
	$on_result = $database->query($tags_on);
}

$gal_query = "SELECT * FROM `galleries` WHERE `status` = 1";
$gal_results = $database->query($gal_query);
$gal_count = $database->numRows($gal_results);
if($gal_count > $num_galleries){
	$gal_off = "UPDATE `galleries` SET `status` = 0";
	$off_result = $database->query($gal_off);
	$gal_on = "UPDATE `galleries` SET `status` = 1 ORDER BY `ID` ASC LIMIT ".$num_galleries;
	$on_result = $database->query($gal_on);
}

$user_query = "UPDATE `users` SET `user_type` = ".$userType;
$user_results = $userDB->query($user_query);
?>