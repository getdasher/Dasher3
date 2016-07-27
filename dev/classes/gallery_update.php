<?php
ini_set('display_errors', 1);
session_start();
require_once('class.database.php');
	$db = new database($_COOKIE['userdatabase']);
	$updateQuery = "UPDATE `galleries` SET `status`=".$_GET['state']." WHERE ID = ".$_GET['id'];
	echo $udateQuery;
	$result = $db->query($updateQuery);
?>