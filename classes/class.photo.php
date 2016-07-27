<?php
require_once('classes/class.database.php');
class Photo
{
    public $id;
    public $approved;
    public $type;
    public $photoUrl;
    public $photoCaptions;
    public $photoService;
    public $photoUser;
    public $photoUserLink;
    
    public function __construct($photoId = null)
    {
        $this->id               = $photoId;
        $this->approved         = null;
        $this->type             = null;
        $this->photoUrl         = null;
        $this->photoCaptions    = null;
        $this->photoService     = null;
        $this->photoUser        = null;
        $this->photoUserLink    = null;

        if(!is_null($photoId)){
            $this->findById($photoId);
        }
    }
    
    private function findById($photoId)
    {
        $db = new Database($_COOKIE["userdatabase"]);
        
        $photoId = $db->escape($photoId);
        
        $sql = "SELECT id, post_id, type, photo_url, thumb_url, user_name, service_link, captions, service_id, user_link FROM photos WHERE id = {$photoId} ";
        
        $photoDetails = $db->getRow($sql); 
        
        //TODO: make better error system
        if($photoDetails === false){
            //echo "Photo does not exist.";
        }
        
        $this->type             = $photoDetails['type'];
        $this->photoUrl         = $photoDetails['photo_url'];
        $this->photoCaptions    = $photoDetails['captions'];
        $this->photoService     = $photoDetails['service_link'];
        $this->photoUser        = $photoDetails['user_name'];
        $this->photoUserLink    = $photoDetails['user_link'];
        
        $sql_approval = "SELECT approval_status FROM campaign_photos WHERE photo_id = {$photoId}";
        
        $approval = $db->getRow($sql_approval);
		if($approval['approval_status'] != "NULL"){
        $this->approved = $approval['approval_status'];
		}
		else{
			$this->approved = "mezzo";
		}
	
        
        
    }
    

    public function approve()
    {
        $db = new Database($_COOKIE["userdatabase"]);
        
        $sql = "UPDATE campaign_photos SET approval_status = 1 WHERE photo_id = {$this->id}";
        $result = $db->query($sql);
        
        if(!$result){
            return false;
        }
        return true;
    }
    
    public function deny()
    {
        $db = new Database($_COOKIE["userdatabase"]);
        
        $sql = "UPDATE campaign_photos SET approval_status = 0 WHERE photo_id = {$this->id}";
        $result = $db->query($sql);
        
        if(!$result){
            return false;
        }
        return true;
    }
    
}

function typeImage($type){
	switch ($type) {
	  case 1:
	    return '<a href="http://twitter.com" target="_blank" ><img src = "http://app.getdasher.com/images/twitter-24.png" /></a>';
	    break;
	  case 2:
	    return '<a href="http://instagram.com" target="_blank" ><img src = "http://app.getdasher.com/images/instagram-24.png" /></a>';
	    break;
	  case 3:
	    return '<a href="http://googleplus.com" target="_blank" ><img src = "http://app.getdasher.com/images/googleplus-24.png" /></a>';
	    break;
  	  case 4:
  	   return '<a href="http://facebook.com" target="_blank" ><img src = "http://app.getdasher.com/images/facebook-24.png" /></a>';
  	    break;
	}
}
    
?>