	
	var position = currentSrc.indexOf('?');
	if(position != -1){
		currentSrc = currentSrc.slice(0, position);
	}
	var shortUrl = 'https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyAecnykZycK_zuDWEq-Tmnt7Wj0m7kIAs8&shortUrl='+currentSrc;
	
	var myVar = setInterval(function(){ myTimer() }, 1000);

	function myTimer() {
	    if (typeof jQuery == 'undefined') {  
		    // jQuery is not loaded
		} else {
		    myStopFunction();
			jQuery('.dasher2').html('<div style="margin:auto; width:200px; text-align:center; font-family: Arial; color:#F0F0F0; margin-top:100px;"><img src="http://app.getdasher.com/images/ajax-loader.gif" /><br /><br /><img src="http://app.getdasher.com/images/logo-header.png" /></div>');

			var request = new XMLHttpRequest();
			request.open('GET', shortUrl, true);

			request.onload = function() {
			  if (request.status >= 200 && request.status < 400) {
			    // Success!
			    var data = JSON.parse(request.responseText);
					$i = 0;
				  for(key in data) {
				    if(data.hasOwnProperty(key)) {
				        if($i == 3){
						$currentSrc = value;
						var idIndex = $currentSrc.indexOf('?id=');
						$vars = $currentSrc.substring(idIndex);
						$url = "http://app.getdasher.com/fullgallery/masonry.php"+$vars;
						$url = $url.replace('#', '');
						console.log($url);
						jQuery.get( $url, function( data ) {
						  jQuery('.dasher2').html(data);
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

			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-48470910-2', 'auto');
			ga('send', 'pageview');
		}
	}

	function myStopFunction() {
	    clearInterval(myVar);
	}
