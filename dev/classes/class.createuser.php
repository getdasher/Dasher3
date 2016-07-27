<?php
include('class.database.php');

function check_username($username){
	$dbUserCheck = new database('users');
	$check_query = "SELECT * FROM `users` WHERE `email_address` = '".$username."'";
	$checkUser = $dbUserCheck->query($check_query);
	if($dbUserCheck->hasRows($checkUser) == false){
		return true;
	}
	else{
		return false;
	}
}

function generate_password() {
	    $pass = md5($_POST['password']);
	    return $pass; //turn the array into a string
}

function create_user(){
	$email = $_POST['email'];
	$name = $_POST['name'];
	$temp_pass = generate_password($_POST['password']);
	
	if(check_username($email) == true){
		$user_query = 'INSERT INTO `users` (`user_name`, `email_address`, `password`, `trial_stamp`, `walkthrough`) VALUES ("'.$name.'", "'.$email.'", "'.$temp_pass.'", now(), false )';
		$dbUser = new database('users');
		$dbUser->query($user_query);
		$db_id = $dbUser->lastId();
		build_database($db_id);
		$session = curl_init();

		$customer_id = $db_id; // You'll want to set this dynamically to the unique id of the user
		$customerio_url = 'https://track.customer.io/api/v1/customers/';
		$site_id = '3cb9a8a90558f2a2f041';
		$api_key = '6dc9af926edaf57c5722';

		$data = array("email" => $email, "first_name" => $name, "created_at" => time());

		curl_setopt($session, CURLOPT_URL, $customerio_url.$customer_id);
		curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($session, CURLOPT_HTTPGET, 1);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($session, CURLOPT_VERBOSE, 1);
		curl_setopt($session, CURLOPT_POSTFIELDS,http_build_query($data));

		curl_setopt($session,CURLOPT_USERPWD,$site_id . ":" . $api_key);

		if(ereg("^(https)",$request)) curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);

		curl_exec($session);
		curl_close($session);
	}
}

function create_sub_user(){
	$email = $_POST['email'];
	$name = $_POST['name'];
	$temp_pass = generate_password($_POST['password']);
		$user_query = "UPDATE `users` SET `user_name`= '".$name."', `password` = '".$temp_pass."' WHERE `email_address`='".$email."'";
		echo $user_query;
		$dbsubUser = new database('users');
		$query = $dbsubUser->query($user_query);
		$session = curl_init();

		$customer_id = $db_id; // You'll want to set this dynamically to the unique id of the user
		$customerio_url = 'https://track.customer.io/api/v1/customers/';
		$site_id = '3cb9a8a90558f2a2f041';
		$api_key = '6dc9af926edaf57c5722';

		$data = array("email" => $email, "first_name" => $name, "created_at" => time());

		curl_setopt($session, CURLOPT_URL, $customerio_url.$customer_id);
		curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($session, CURLOPT_HTTPGET, 1);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($session, CURLOPT_VERBOSE, 1);
		curl_setopt($session, CURLOPT_POSTFIELDS,http_build_query($data));

		curl_setopt($session,CURLOPT_USERPWD,$site_id . ":" . $api_key);

		if(ereg("^(https)",$request)) curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);

		curl_exec($session);
		curl_close($session);
		header('Location: http://app.getdasher.com/login/?out=Thanks for signing up! Please sign in.');
}

function build_database($id){
//Create Database on Server
	$table_name = 'dasher-'.$id;
	$databse_query = "CREATE DATABASE IF NOT EXISTS `$table_name` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";
	$con=mysqli_connect("localhost","dasher_server","JpShTNNSec9N5dW7");
	$con->query($databse_query);
	$db = new database($table_name);

	//Create Campaigns Table
	$campaign_table_query = "CREATE TABLE IF NOT EXISTS `campaign` (
	  `ID` int(11) NOT NULL AUTO_INCREMENT,
	  `hashtag` varchar(200) NOT NULL,
	  `facebook` varchar(200) NOT NULL,
	  `archived` int(11) NOT NULL DEFAULT '0',
	  `deleted` int(11) NOT NULL,
	  PRIMARY KEY (`ID`)
	)" ;
	$db->query($campaign_table_query);

	// Create Campaign Photos Table
	$compaign_photos_query = "CREATE TABLE IF NOT EXISTS `campaign_photos` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `photo_id` int(11) NOT NULL,
	  `campaign_id` int(11) NOT NULL,
	  `approval_status` varchar(200) default 'NULL',
	  PRIMARY KEY (`id`)
	)" ;
	$db->query($compaign_photos_query);

	//Create Photos Table
	$photos_table_query = "CREATE TABLE IF NOT EXISTS `photos` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `post_id` varchar(100) NOT NULL,
	  `type` int(11) NOT NULL,
	  `photo_url` varchar(700) NOT NULL,
	  `thumb_url` varchar(1000) NOT NULL,
	  `user_name` varchar(100) NOT NULL,
	  `service_link` varchar(1000) NOT NULL,
	  `captions` text NOT NULL,
	  `service_id` varchar(100) NOT NULL,
	  `user_link` varchar(1000) NOT NULL,
	  `stamp` int(11) NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE (`photo_url`)
	)" ;
	$db->query($photos_table_query);
	
	$gallery_table_query = "CREATE TABLE IF NOT EXISTS `galleries` (
	  `ID` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(200) NOT NULL,
	  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `code` varchar(200) NOT NULL,
	  `status` int(11) NOT NULL,
	  PRIMARY KEY (`ID`),
	  UNIQUE KEY `code` (`code`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2";
	$db->query($gallery_table_query);
}
?>