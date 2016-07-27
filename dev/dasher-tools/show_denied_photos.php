<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");

	$sql="UPDATE users
			 SET archived_photos = 0";
		
   if (!mysqli_query($link, $sql))
     {
     die('Error: ' . mysqli_error($link));
     }
  
?>