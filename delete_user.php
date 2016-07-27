<?php
ini_set('display_errors', 0);
require_once('classes/class.database.php');
if(isset($_GET['id'])){
	$id = $_GET['id'];
		$user_query = "DELETE FROM `users` WHERE `ID` = ".$id;
		$dbsubUser = new database('users');
		$query = $dbsubUser->query($user_query);
}
else{
	echo "ERROR";
}
?>