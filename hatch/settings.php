<?php
	ini_set("display_errors", 1);
	require_once ("connect.php");

    //change to current user id!!!!!!
	$settings_query = 'SELECT archived_photos
						 FROM users
						WHERE id = 1' ;
                        
    $settings = array();
                        
	if ($results = mysqli_query($link, $settings_query)) {	
       while($info =  mysqli_fetch_assoc($results)){
            
		$settings['archived_photos'] = $info['archived_photos'];
        
		}
        
    }
    
    //change to current user id!!!!!!
    $profile_query = 'SELECT name, Email, Password
                        FROM users
                       WHERE id = 1';
                       
    $profile = array();
    
    if( $results = mysqli_query($link, $profile_query)){
        while($info = mysqli_fetch_assoc($results)){
            $profile['name'] = $info['name'];
            $profile['email'] = $info['Email'];
            $profile['password'] = $info['Password'];
        }
    }
    
	
	
?>

