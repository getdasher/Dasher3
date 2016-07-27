<?php
ini_set('display_errors', 1);
session_start();
require_once('classes/class.database.php');
$db = new database($_COOKIE['userdatabase']);
$galleryQuery = "DELETE FROM `galleries` WHERE `ID` = ".$_GET['id'];
$result = $db->query($galleryQuery);
?>