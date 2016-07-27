<?php

// Make a MySQL Connection
require_once('connect.php');


$campaignsQuery = 'SELECT * FROM `campaign` WHERE `archived` = 0';
if ($result3 = mysqli_query($link, $campaignsQuery)) {	 
}
else{
	  printf("Error: %s\n", mysqli_error($link));
	echo "<br />";
}

while($row = $result3->fetch_array())
{
$id = $row['ID'];

$twitter = "http://www.getdasher.com/dasher-tools/twitter.php?q=".$id;
$facebook = "http://www.getdasher.com/dasher-tools/facebook.php?q=".$id;
$google = "http://www.getdasher.com/dasher-tools/googleplus.php?q=".$id;
$instagram = "http://www.getdasher.com/dasher-tools/instagram-gather.php?q=".$id;


$twittered = file_get_contents($twitter);
$instagram = file_get_contents($instagram);
$googled = file_get_contents($google);
$facebooked = file_get_contents($facebook);
}

?>