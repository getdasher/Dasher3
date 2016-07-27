<?php
ini_set('display_errors', 0);
include('header.php'); 
$dbUsers = new database('users');
$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
$user = $dbUsers->getRow($userQuery);
$userType = $user['user_type'];

$dbCamps = new database($_COOKIE['userdatabase']);
$activeQuery = "SELECT COUNT(*) FROM `campaign` WHERE `archived` = 0";
$results = $dbCamps->query($activeQuery);
$result = $dbCamps->getRow($results);
$numActive = $result['COUNT(*)'];
?>
<script>
$activeCamps = <?php if(isset($numActive)){echo $numActive;} ?>;
$totalCamps = <?php if(isset($num_tags)){echo $num_tags;} else{echo "''";} ?>;
</script>
<?php
if($_COOKIE['usertype'] == "sub"){
	if($user['sub_tags'] != ""){
$ids = unserialize($user['sub_tags']);
$j = 0;
$queryIds = "";
	foreach($ids as $id){
		if($j != 0){
		$queryIds .= " || `ID` = ".$id;
		}
		else{
		$queryIds .= " `ID` = ".$id;
		$j++;
		}
	}
$query = 'SELECT * FROM `campaign` WHERE '.$queryIds.' ORDER BY `ID` DESC';
$campaigns = $dbCamps->query($query);
}
else {
	$campaigns="subfalse";
}
}
else{
$campaigns = $dbCamps->query('SELECT * FROM `campaign` WHERE `deleted` != 1 ORDER BY `ID` DESC');
}
if($dbCamps->numRows($campaigns) > 0 || $campaigns != "subfalse"){
	$campaign_data = $dbCamps->getRows($campaigns);
	foreach($campaign_data as $campaign){ 
		
		$photo_query_new = 'SELECT COUNT(*)
							 FROM campaign_photos cp
			 				 JOIN photos p ON cp.photo_id = p.id
							WHERE `campaign_id` = '.$campaign['ID'].' AND `photo_url` != "" AND `approval_status` = "NULL"
							ORDER BY p.id DESC';
		$newResult = $dbCamps->query($photo_query_new);
		$newCount = $dbCamps->getRow($newResult);
		
		$photo_query_total = 'SELECT COUNT(*)
							 FROM campaign_photos cp
			 				 JOIN photos p ON cp.photo_id = p.id
							WHERE `campaign_id` = '.$campaign['ID'].' AND `photo_url` != ""
							ORDER BY p.id DESC';
		$totalResult = $dbCamps->query($photo_query_total);
		$totalCount = $dbCamps->getRow($totalResult);
		
		$classAdd = "";
		if($campaign['archived'] == 1){
			$classAdd = " deactivated";
		}
		
		
		?>
		<div class="campaign-snapshot<?php echo $classAdd; ?>">
		    			<ul class="snapshots">
		    				<li class="campaign-title"><a href="/hashtag-display/<?php echo $campaign['ID']; ?>/">#<?php echo $campaign['hashtag']; ?></a></li>
		    				<li class="snap-stat"><span class="analyitic-digit"><?php echo $newCount['COUNT(*)']; ?></span> New Photos</li>
		    				<li class="snap-stat"><span class="analyitic-digit"><?php echo $totalCount['COUNT(*)']; ?></span> Photos Gathered</li>
		    				<li class="snap-stat"><img src="http://app.getdasher.com/images/twitter-24-black.png"> <?php echo getPlatformCount($campaign['ID'], 1); ?> <img src="http://app.getdasher.com/images/instagram-24-black.png"> <?php echo getPlatformCount($campaign['ID'], 2); ?> <img src="http://app.getdasher.com/images/googleplus-24-black.png"> <?php echo getPlatformCount($campaign['ID'], 3); ?> <img src="http://app.getdasher.com/images/facebook-24-black.png"> <?php echo getPlatformCount($campaign['ID'], 4); ?> </li>
		                </ul>

		                <ul>
		                    <li>
		                        <a href="/hashtag-display/<?php echo $campaign['ID']; ?>/"><div class="button invert button-view">View</div></a></li>
					        <li>
		                        <a href="" class="deactivate<?php echo $classAdd; ?>" id="<?php echo $campaign['ID']; ?>"><div class="button invert campaign-display-buttons">Deactivate</div></a></li>
		                       <a href="" class="activate<?php echo $classAdd; ?>" id="<?php echo $campaign['ID']; ?>"> <div class="button invert button-activate">Activate</div></a></li>
			                        <a href="" class="delete" id="<?php echo $campaign['ID']; ?>"><div class="button invert campaign-display-buttons">Delete</div></a></li>
		                </ul>   


		            </div>
				
	<?php }
}
else{
	echo "Please create your first campaign.";
}
echo '</div>';
include('footer.php');
?>
