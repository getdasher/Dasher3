<?php
	ini_set('display_errors', 1);
	require_once('/classes/class.database.php');
	$database = new database('users');
	$userQuery = $database->query("SELECT * FROM `users`");
	$results = $database->getRows($userQuery);
	foreach($results as $result){
		$databaseName = "dasher-".$result['ID'];
		$currentID = $result['ID'];
		$database2 = new database($databaseName);
		$query2 = $database2->query("SELECT * FROM `campaign` WHERE `archived` != 1 && `deleted` != 1");
		$results2 = $database2->getRows($query2);
			foreach ($results2 as $camps){
				$_GET['q'] = $camps['ID'];
				$_GET['user'] = $currentID;
				$_GET['database'] = $databaseName;
				$instagram = '/libs/instagram-gather4.php';
				$twitter = '/libs/twitter-gather4.php';
				$googleplus = '/libs/googleplus4.php';
				$facebook = '/libs/facebook4.php';
				include $instagram;
				include($twitter);
				include($facebook);
				include($googleplus);
			}
	}
	
?>