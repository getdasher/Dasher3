<?php 
require_once('header.php'); 

if(isset($_POST['getUsername'])){
	$user_query = 'SELECT * FROM `users` WHERE `email_address` = "'.$_POST['getUsername'].'"';
	if ($uers_result = mysqli_query($link, $user_query)) {	 
		$currentQueryArray =  mysqli_fetch_row($user_result);
		print_r($currentQueryArray);
	}
	else{
		  printf("Error: %s\n", mysqli_error($link));
		echo "<br />";
	}
}

?>
	<form method="POST">
		<p>Forget your username?</p>
		<input type="text" name="getUsername" placeholder="Email Address" />
		<p>Forget your password?</p>
		<input type="password" name="getPassword" placeholder="Username" />
		<input type="submit" value="Retrieve Information" name="submit" />
		<a href="forgot_info.php">Forgot Your Username or Password?</a>
	</form>
<?php require_once('footer.php'); ?>