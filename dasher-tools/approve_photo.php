

<?php
	ini_set("display_errors", 1);
	require_once ("connect.php");

	$sql="UPDATE campaign_photos 
			 SET approval_status = 1 
		   WHERE photo_id = " . $_GET['id'];
	
   if (!mysqli_query($link, $sql))
     {
     die('Error: ' . mysqli_error($link));
     }
  
?>

