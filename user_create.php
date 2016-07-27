<?php
ini_set('display_errors',1);
include('classes/class.createuser.php');
include('classes/class.authorization.php');
if(isset($_POST['email'])){
	create_user();
	if(login($_POST['email'], $_POST['password']) == 3){
			header('Location: /campaign-display/');
		}
}
else{
	echo "ERROR";
}
?>