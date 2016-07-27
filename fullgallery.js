$currentSrc = "";
	var shortUrl = 'https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyAecnykZycK_zuDWEq-Tmnt7Wj0m7kIAs8&shortUrl='+currentSrc;
	console.log(currentSrc);
	$scriptURL= "";
	$scriptURL = 'script[src="'+scriptSrc+'"]';
	console.log($scriptURL);

var request = new XMLHttpRequest();
request.open('GET', shortUrl, true);

request.onload = function() {
  if (request.status >= 200 && request.status < 400) {
    var data = JSON.parse(request.responseText);
		$i = 0;
	  for(key in data) {
	    if(data.hasOwnProperty(key)) {
	        if($i == 3){
			$currentSrc = value;
			var idIndex = $currentSrc.indexOf('?id=');
			$vars = $currentSrc.substring(idIndex);
			$url = "http://app.getdasher.com/fullgallery/index.php"+$vars;
			$url = $url.replace('#', '');
			jQuery.get( $url, function( data ) {
				jQuery($scriptURL).each(function(){
					jQuery('.dasher2').html(data);
				});
			});
			}
			var value = data[key];
			$i++;
	    }
	}
  } else {
    // We reached our target server, but it returned an error

  }
};

request.onerror = function() {
  // There was a connection error of some sort
};

request.send();