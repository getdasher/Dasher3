<?php
ini_set('display_errors', 1);
require_once('classes/class.database.php');
$database = new database('users');
$hashQuery = $database->query("SELECT `value` FROM `hash_count` WHERE `id` = 1");
$hash_results = $database->getRows($hashQuery);
$currentCount = $hash_results[0]['value'];
echo $currentCount; 
?>