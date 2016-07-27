<?php
	
$link = mysqli_connect("localhost","dasher_server","JpShTNNSec9N5dW7", "dasher-260");	
	
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "https://graph.facebook.com/fql/?access_token=446129668847368|2f52a77bbee18c1ff715741bf6d5ff61&q=SELECT+mention_count+FROM+keyword_insights+WHERE+term='papenusa'+AND+country='US'",
));
// Send the request & save response to $resp
$resp1 = curl_exec($curl);
$resp1 = mysqli_real_escape_string($link, $resp1);

// Close request to clear up some resources
curl_close($curl);

$curl2 = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl2, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "https://graph.facebook.com/fql/?access_token=446129668847368|2f52a77bbee18c1ff715741bf6d5ff61&q=SELECT+location_results+FROM+keyword_insights+WHERE+term='papaenusa'+AND+country='US'",
));
// Send the request & save response to $resp
$resp2 = curl_exec($curl2);
$resp2 = mysqli_real_escape_string($link, $resp2);

// Close request to clear up some resources
curl_close($curl2);


$curl3 = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl3, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "https://graph.facebook.com/fql/?access_token=446129668847368|2f52a77bbee18c1ff715741bf6d5ff61&q=SELECT+age_gender_results+FROM+keyword_insights+WHERE+term='papaenusa'",
));
// Send the request & save response to $resp
$resp3 = curl_exec($curl3);
$resp3 = mysqli_real_escape_string($link, $resp3);

// Close request to clear up some resources
curl_close($curl2);


$query = 'INSERT INTO `popefacebook2`(`rawcount`, `location`, `gender`) VALUES ("'.$resp1.'", "'.$resp2.'", "'.$resp3.'")';
echo $query;
if (mysqli_query($link, $query)) {
    echo "Your request has been received.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
?>