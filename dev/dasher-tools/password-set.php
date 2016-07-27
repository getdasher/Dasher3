<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");
	include_once('header.php'); 
?>
	
	<h1>Password Set</h1>
	<?php
	if(isset($_POST['user_id'])){ 
		$user_id = $_POST['user_id'];
		$password = md5($_POST['password']);
		$sql= "UPDATE users SET password='".$password."' WHERE ID='".$user_id."'";
		if (!mysqli_query($link, $sql)){
	     	die('Error: ' . mysqli_error($link));
	    }
		else{ 
			echo "Your password has been reset. Visit the login page to enter your new credentials.";
	} 
	} else { 

	//update to include current user id
	$campaign_query = 'SELECT * FROM `verification_codes` WHERE `change_key` = "'.$_GET['key'].'"';
	if ($results = mysqli_query($link, $campaign_query)) {
		while ($info =  mysqli_fetch_assoc($results) ){
			$user_id = $info['user_id'];
			$timeStamp = strtotime($info['timestamp']);
			$creationTime = date('m/d/Y h:i:s a', strtotime('+30 minutes', $timeStamp));	
			$date = date('m/d/Y h:i:s a', time());
			
			if($creationTime > $date){ ?>
				<form method="POST" class="retrieve-login" onSubmit="javascript: checkMatch();">
					<input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>" />
					<input type="password" name="password" id="password" placeholder="Password" value="" />
					<input type="password" name="passConfirm" id="passConfirm" placeholder="Confirm Password" value="" />
					<input type="submit" value="Update" name="submit" class="button" />
				</form> 
				<script type="text/javascript">
					function checkMatch(){
						$password = jQuery('.password').value();
						$checkPass = jQuery('.passConfirm').value();
						if($password == $checkPass){
							return true;
						}
						else{
							alert("Passwords don't match.");
							return false;
						}
					}
				</script>
				<?php
			}
			else{
				echo "Your Key has expired or another error occurred.  Please contact us or attempt to reset your password from the login screen again.";
			}
		};
	}
	else{
		echo "<br /> Your Key has expired or another error occurred.  Please contact us or attempt to reset your password from the login screen again.";
	}
	?>
	
						
<?php  } include_once('footer.php'); ?>