<?php
ini_set('display_errors', 1);
include('classes/class.database.php');
include('classes/class.photo.php');
include('classes/class.campaign.php');

$offset = $_GET['offset'];
$currentView = $_GET['type'];

$type="NULL";

if($currentView == 'new'){
	$type = "NULL";
}
elseif($currentView == 'approved'){
	$type = "1";
}
else{
	$type = '0';
}

$database = $_COOKIE['userdatabase'];
$dbCamps = new database($database);

$add_query = 'SELECT *
					 FROM campaign_photos cp
	 				 JOIN photos p ON cp.photo_id = p.id
					WHERE `campaign_id` = '.$_GET['id'].' AND `approval_status` = "'.$type.'" AND photo_url != ""
					ORDER BY cp.id ASC LIMIT '.$offset.', 100';
$photos = $dbCamps->getRows($add_query);

$photoitems = array();

foreach($photos as $photoitem){
	$photograph = new photo($photoitem['photo_id']);
	$photoitems[] = $photograph;
}

$output = "";

foreach($photoitems as $photo) : ?>
 	<?php $typeImage = typeImage($photo->type);
	 $caps = str_replace("'", '', urldecode($photo->photoCaptions));
     $output .= '<div class="img-set" id="image_ID_'.$photo->id.'" >		
		<a href="'.$photo->photoUrl.'" class="fancybox" fancy-title=\' '.$typeImage.'<a href="'.$photo->photoUserLink.'" target="_blank">'.$photo->photoUser.'</a><br />'.$caps.'<br /><a href='.$photo->photoService.'" target="_blank">View the Post</a>\'>
			<li class="blank-photo" style="background-image:url(); overflow:hidden; width:100%; height:181px; background-size:cover;" data-original="'.$photo->photoUrl.'" ><i class="fa fa-search" out="'.$photo->photoUrl.'"></i></li>
		</a>
		<div class="hoverdata" style="display: none;">
				
				<div class="userNameTwitter">'.$typeImage.'<a href="'.urlencode($photo->photoUserLink).'" target="_blank">'.$photo->photoUser.'</a></div>
				<div class="userDescription">'.urldecode($photo->photoCaptions).'<br /><a href="'.$photo->photoService.'" target="_blank">View the Post</a></div>
		</div>
		<li>
		<form action="">
			<label class="approve" name="approve_'.$photo->id.'" imgid="'.$photo->id.'" value="approve">
			<input type="radio" name="approve_'.$photo->id.'" imgid="'.$photo->id.'" value="approve" ><i class="fa fa-check"></i>
			</label>
			<label class="decline" name="approve_'.$photo->id.'" imgid="'.$photo->id.'" value="deny">
			<input type="radio" name="approve_'.$photo->id.'" imgid="'.$photo->id.'" value="deny" ><i class="fa fa-times"></i>
			</label>
		</form>
		<div style="clear:both;"></div>
		</li>
    </div>';
endforeach;

echo $output;
?>