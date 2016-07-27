<?php
ini_set('display_errors', 1);
require('classes/class.createuser.php');
if(isset($_POST['email'])){
	create_sub_user();
}
else{
	echo "ERROR";
}
?>