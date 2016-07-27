<?php

class Database
{

    public $mysqli;
    
    private $result;
    
    public function __construct($database)
    {
        $this->mysqli = mysqli_connect("localhost","dasher_server","JpShTNNSec9N5dW7", $database);
        
        if (mysqli_connect_error()) {
            //$err_msg = "Connect failed: " . mysqli_connect_error();
            $this->notify($err_msg);
        }
    }
    
    /**
     * Check if we are connected to a database instance.
     *
     * @return bool
     */
    public function isConnected()
    {
        return $this->mysqli->ping();
    }
    
    /**
     * Pass in a string sequel query and get a mysqli result.
     * @param string
     * @return mysqli_result
     */
    public function query($sql)
    {
        $this->result = $this->mysqli->query($sql);

        if( !$this->result ){
            $this->notify();
        }

        return $this->result;
    }
    
    /**
     * Determine if a sql result has rows.
     * @param mysqli_result
     * @return bool
     */
    public function hasRows($sql_result = null)
    {
        if( !$sql_result ){
            $sql_result = $this->result;
        }
        
        $numRows = $sql_result->num_rows;
        
        if( $numRows > 0 ){
            return true;
        }
        
        return false;
    }
    
    /**
     * Pass in a sql result and get the total number of rows.
     * @param mysqli_result
     * @return num or bool
     */
    public function numRows($sql_result)
    {
        $numRows = $sql_result->num_rows;
        
        if( !$numRows ){
            return false;
        }
        
        return $numRows;
    }

    
    /**
     * Pass in the query string or mysqli_result and get an array of the returned rows. 
     * @param string or mysqli_result
     * @return array
     */
    public function getRows($arg)
    {
        $result = $this->resulter($arg);
        
        if( !$this->hasRows($result) ){
            return array();
        }
        
        $rows = array();
        while( $row = $result->fetch_array(MYSQLI_BOTH) ){
            $rows[] = $row;
        }
        
        return $rows;
    }
    
    /**
     * Pass in the query string or mysqli_result and get an array of the first row returned. 
     * @param string or mysqli_result
     * @return array
     */
    public function getRow($arg)
    {
        $result = $this->resulter($arg);
        return $this->hasRows() ? $result->fetch_assoc() : false;
    }
    
    /**
     * Escape a string for the database.
     * @param string
     * @return string
     */
    public function escape($value)
    {
        return $this->mysqli->escape_string($value);
    }
    
    /**
     * Return the id of the last row insterted into the database.
     * 
     * @return num
     */
    public function lastId()
    {
        return $this->mysqli->insert_id;
    }

    /**
     * Error notification.
     */
    private function notify($err_msg = null)
    {
        if( $err_msg == null ){
            //$err_msg = $this->mysqli->error;
        }
              
        //echo "<p style='border:5px solid red;background-color:#fff;padding:5px;'><strong>Database Error:</strong><br/>$err_msg</p>";
        
        //echo "<pre>";
        //debug_print_backtrace();
        //echo "</pre>";
        //exit;
    
    }
    
    /**
     * Returns a mysqli_result.
     * @param string or mysqli_result
     * @return mysqli_result
     */
    private function resulter($arg)
    {
        if( $arg instanceof mysqli_result ){
           
            return $arg;
        }elseif( is_string($arg) ){
            $this->query($arg);

            if( $this->result instanceof mysqli_result ){
                return $this->result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
   public function hashData($string){
		return md5($string);
   }
   
}

function getPlatformCount($campaign_id, $platform){
		$count_database = new database($_COOKIE["userdatabase"]);
		$count_query = 'SELECT COUNT(*) FROM campaign_photos cp JOIN photos p ON cp.photo_id = p.id JOIN campaign c ON c.id = cp.campaign_id WHERE p.type = '.$platform.' && cp.campaign_id =  '.$campaign_id;
		$result = $count_database->query($count_query);
		$count = $count_database->getRow($result);
		return $count['COUNT(*)'];
	}