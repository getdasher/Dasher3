<?php
include_once('class.database.php');

function createCampaign($hashtag, $facebook){
	$hashtag = str_replace('#', '', $hashtag);
	$hashDB = new database($_COOKIE["userdatabase"]);
	$hashDB2 = new database("users");
	$hashtag = $hashDB->escape($hashtag);
	$hashQuery = 'SELECT `hashtag` FROM `campaign` WHERE `hashtag` = "'.$hashtag.'"';
	$hashQuery2 = 'SELECT `campaign` FROM `users` WHERE `id` = '.$_COOKIE['userid'];
	$hashCheck = $hashDB->query($hashQuery);
	$hashCheck2 = $hashDB2->query($hashQuery2);
	$hashCheckResult = $hashDB2->getRow($hashCheck2);
	if($hashCheckResult['campaign'] != 'true'){
					$session = curl_init();
					$customer_id = $_COOKIE['userid']; // You'll want to set this dynamically to the unique id of the user associated with the event
					$customerio_url = 'https://track.customer.io/api/v1/customers/'.$_COOKIE['userid'].'/events';
					
					$site_id = '3cb9a8a90558f2a2f041';
					$api_key = '6dc9af926edaf57c5722';

					$data = array("name" => "create_campaign");

					curl_setopt($session, CURLOPT_URL, $customerio_url);
					curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
					curl_setopt($session, CURLOPT_HEADER, false);
					curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($session, CURLOPT_VERBOSE, 1);
					curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
					curl_setopt($session, CURLOPT_POSTFIELDS,http_build_query($data));

					curl_setopt($session,CURLOPT_USERPWD,$site_id . ":" . $api_key);

					if(ereg("^(https)",$request)) curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);

					curl_exec($session);
					curl_close($session);
					$hashQuery3 = 'UPDATE `users` SET `campaign` = "true" WHERE `id` = '.$_COOKIE['userid'];
					$hashCheck3 = $hashDB2->query($hashQuery3);
	}
	if($hashDB->numRows($hashCheck) == 0){
		$hashQuery4 = 'INSERT into `campaign` (`hashtag`, `facebook`) VALUES ("'.$hashtag.'", "'.$facebook.'")';
		$hashCheck4 = $hashDB->query($hashQuery4);
		$db_id = $hashDB->lastId();
		$userQuery = "SELECT * FROM `users` WHERE `ID` = ".$_COOKIE['userid'];
		$_GET['userId'] = $_COOKIE['userid'];
		require_once('hashtags-new.php');
		$user = $hashDB2->getRow($userQuery);
		if($_COOKIE['usertype'] == "sub"){
			$ids = unserialize($user['sub_tags']);
			$queryIds = array();
				foreach($ids as $id){
					$queryIds[] = $id;
				}
			$queryIds[] = $db_id;
			$outIds = serialize($queryIds);
			$idsQuery = "UPDATE `users` SET `sub_tags` = '".$outIds."' WHERE `id` = ".$_COOKIE['userid'];
			$idsUpdate = $hashDB2->query($idsQuery);
		}
	}
	else{
		echo "Looks like you've already created that hashtag.";
	}
}

class Campaign
{
    public $id;
    public $hashtag;
    public $created_by;
    public $is_active;
    
    public function __construct($campaignId = null, $campaign_details = array())
    {
        $this->id           = $campaignId;
        $this->hashtag      = null;
        $this->created_by   = null;
        $this->is_active    = false;
        
        if( !is_null($campaignId) ){
            $this->findById($campaignId);
        }
        
        if( count($campaign_details) > 0){
            $this->hashtag = $campaign_details['hashtag'];
            $this->created_by = $campaign_details['created_by'];
            $this->is_active = $campaign_details['is_active'];
        }
    }
    
    public function findById($campaignId)
    {
        $db = new database($_COOKIE['userdatabase']);
        $campaignId = $db->escape($campaignId);
        
        $sql = "SELECT id, hashtag, archived FROM campaign WHERE id = $campaignId";
        
        $campaignDetails = $db->getRow($sql); 
        
        //TODO: make better error system
        if($campaignDetails === false){
            die("Campaign does not exist.");
        }
        
        $this->hashtag          = $campaignDetails['hashtag'];
        $this->is_active        = $campaignDetails['archived'];
      
    }
    
    public function archiveCampaign($campaignId = null)
    {
         $db = new database($_COOKIE['userdatabase']);
        
        if( is_null($campaignId) ){
            $campaignId = $this->id;
        }
        
        $sql = "UPDATE campaign SET archived = 1 WHERE id = $campaignId ";
        
        $db->query($sql);
        
        return true;
    }
	
    public function unarchiveCampaign($campaignId = null)
    {
         $db = new database($_COOKIE['userdatabase']);
        
        if( is_null($campaignId) ){
            $campaignId = $this->id;
        }
        
        $sql = "UPDATE campaign SET archived = 0 WHERE id = $campaignId ";
        
        $db->query($sql);
        
        return true;
    }
    
    public function deleteCampaign($campaignId = null)
    {
         $db = new database($_COOKIE['userdatabase']);
        
        if( is_null($campaignId) ){
            $campaignId = $this->id;
        }
        
		$del1 = 'DELETE campaign_photos, photos
		FROM campaign_photos
		INNER JOIN photos 
		      ON photos.id = campaign_photos.photo_id
		WHERE campaign_photos.campaign_id = '.$campaignId;

		$del2 = 'DELETE FROM `campaign_photos` WHERE `campaign_id` = '.$campaignId;

		$del3 = 'DELETE FROM `campaign` WHERE `id` = '.$campaignId;
        
        $db->query($del1);
		$db->query($del2);
		$db->query($del3);
		
		if($_COOKIE['usertype'] == "sub"){
			$ids = unserialize($user['sub_tags']);
			$queryIds = array();
				foreach($ids as $id){
					if($id != $campaignId){
					$queryIds[] = $id;
					}
				}
			$outIds = serialize($queryIds);
			$idsQuery = "UPDATE `users` SET `sub_tags` = '".$queryIds."' WHERE `id` = ".$_COOKIE['userid'];
			$idsUpdate = $hashDB2->query($idsQuery);
		}
        
        return true;
        
    } 
}

?>