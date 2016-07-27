<?php
ini_set('display_errors', 1);
require_once('header.php');
$dbUsers = new database('users');
if(isset($_POST['user_id'])){
	echo $_POST['user_id'];
	$tags = serialize($_POST['hashtag']);
	$query = "UPDATE `users` SET `sub_tags` = '".$tags."' WHERE `ID` = ".$_POST['user_id'];
	$updateResult = $dbUsers->query($query);
	//print_r($updateResult);
?>
<div class="modal-header">Update User</div>
<p style="margin-top:50px;">
<?php
echo $_POST['user_name']."'s Account has been updated.";
?>
</p><button class="close_window" style="float:right;">Close Window</button>
<script>
	jQuery('.close_window').click(function(){
		parent.location.reload();
	});
</script>
<?php
}
else{
$dbCamps = new database($_COOKIE['userdatabase']);
if($_COOKIE['usertype'] == "sub"){
$ids = unserialize($user['sub_tags']);
$queryIds = "";
	$j = 0;
	foreach($ids as $id){
		if($j != 0){
		$queryIds .= " || `ID` = ".$id;
		}
		else{
		$queryIds .= " `ID` = ".$id;
		$j++;
		}
	}
$query = 'SELECT * FROM `campaign` WHERE'.$queryIds;
$campaigns = $dbCamps->query($query);
}
else{
$campaigns = $dbCamps->query('SELECT * FROM `campaign`');
}

$userQuery = "SELECT * FROM `users` WHERE `email_address` = '".$_GET['id']."'";
$userUpdate = $dbUsers->getRow($userQuery);

$sub_tags = unserialize($userUpdate['sub_tags']);

 ?>
<div class="modal-header">Update User</div>
<p style="margin-top:50px;">
	<form action="" method="post" style="width:300px;">
			<?php echo $userUpdate['user_name']; ?>'s Account
			<p>Email: <?php echo $userUpdate['email_address']; ?></p>
			Hashtags:<br />
			<input type="hidden" name="user_id" value="<?php echo $userUpdate['ID'];?>" />
			<input type="hidden" name="user_name" value="<?php echo $userUpdate['user_name'];?>" />
			<ul>
			<?php $i = 0; foreach($campaigns as $hashtag){ ?>
			<li>
			<input type="checkbox" name="hashtag[]" value="<?php echo $hashtag['ID']; ?>" <?php foreach($sub_tags as $tag){ if($tag == $hashtag['ID']){echo "checked=checked";}} ?>><span><?php echo $hashtag['hashtag']; ?></span>
			</li>
			<?php } ?>
			</ul>
			<div style="clear:both;"></div>
			<input type="submit" class="action_buton" value= "Update User"><button style="float:right; width:100% !important;" class="delete-user">Delete User</button>
			<button class="close_window" style="width:100% !important; margin-top:10px; clear:both; float:left;">Close</button> 
	</form>
	<div style="clear:both;"></div>
</p>
<div style="clear:both;"></div>
<script>
	jQuery('.close_window').click(function(e){
		e.preventDefault();
		parent.$.fancybox.close();
	});
	jQuery('.delete-user').click(function(e){
		e.preventDefault();
		if (confirm('Are you sure you want remove this user? This action is irreversible.')) {
		    $.get( "delete_user.php", { id: "<?php echo $userUpdate['ID'];?>"} )
			  .done(function( data ) {
			    parent.location.reload();
			  });
		} else {
		    // Do nothing!
		}

	});
</script>
<?php
}
 require_once('footer.php'); ?>