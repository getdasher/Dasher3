<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");

	$sql="UPDATE campaign 
			 SET deleted = 1 
		   WHERE ID = " . $_GET['id'];
	
   if (!mysqli_query($link, $sql))
     {
     die('Error: ' . mysqli_error($link));
     }
  
?>