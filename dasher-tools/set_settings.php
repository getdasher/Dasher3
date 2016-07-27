<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");
    
    $name = $_POST{'name'};
    $email = $_POST{'email'};
    $password = $_POST{'new_password_1'};
    $user_id = 1;

	$sql="UPDATE users
			 SET Email = '{$email}'
           WHERE ID = {$user_id}";
                 
     if (!mysqli_query($link, $sql))
       {
       die('Error: ' . mysqli_error($link));
       }
       
       header("Location: /settings.php");
	 
?>