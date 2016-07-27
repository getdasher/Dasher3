
<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");
	$id = "";
	$hashtag = $_POST['hashtag'];
	$hashtag = str_replace('#', '', $hashtag);
	
	$query2 = "SELECT `ID` FROM `campaign` WHERE `user_id` = ".$_SESSION['loggedUser'];
	$results2 = mysqli_query($link, $query2);
	$num = mysqli_num_rows($results2);
	if($num){
		$campN = 'false';
	}
	else{
		$campN = 'true';
	}

	$sql="INSERT INTO campaign (`hashtag`, `user_id`) VALUES ('$hashtag', '$_POST[user_id]')";
	if (!mysqli_query($link, $sql))
     {
     die('Error: ' . mysqli_error($link));
     }

	$sql2="SELECT id FROM campaign WHERE `hashtag` = '$_POST[hashtag]'";
	if ($results = mysqli_query($link, $sql2)) {	
		while( $info =  mysqli_fetch_assoc($results) ){
			$id = $info['id'];
		};
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
	
	
	$twitter = "http://www.getdasher.com/dasher-tools/twitter.php?q=".$id;
	$facebook = "http://www.getdasher.com/dasher-tools/facebook.php?q=".$id;
	$instagram = "http://www.getdasher.com/dasher-tools/instagram-gather.php?q=".$id;
	$google = "http://www.getdasher.com/dasher-tools/googleplus.php?q=".$id;

	$twittered = file_get_contents($twitter);
	$instagram = file_get_contents($instagram);
	$facebooked = file_get_contents($facebook);
	$googled = file_get_contents($google);
	
	
  
	$link = 'Location: campaign_display.php?q='.$id.'&submitCamp='.$campN;
   header($link);

?>