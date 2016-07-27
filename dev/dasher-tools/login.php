<?php 
require_once('header.php'); 
?>
	<h2>Welcome to Dasher</h2>
	<p>Sign in to start managing your photo stream and settings for your Dasher campaigns.</p>
	<?php if(isset($errorMessage)){ ?>
	<br /><p><span style="color:red;"><?php echo $errorMessage; ?></span></p>
	<?php } ?>
	<form method="POST" class="login-form">
		<div class="login-form-left">
		<h2>Sign In</h2>
		Please fill in your information:
		<input type="text" name="username" placeholder="Email Address" />
		<input type="password" name="password" placeholder="Password" />
		</div>
		<div class="login-form-right">
		<input type="submit" value="Login" name="submit" /><br />
		<input type="checkbox" name="remember" />Remember Me<br />
		</div>
	</form>
	<br>
	<a href="forgot_login.php" class="forgot iframe-fancy">Forgot Your Username or Password?</a>
<?php require_once('footer.php'); ?>