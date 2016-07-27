$currentSrc = "";
jQuery(document).ready(function(){
	jQuery('.dasher2').html('<div style="margin:auto; width:200px; text-align:center; font-family: Arial; color:#F0F0F0; margin-top:100px;"><img src="http://app.getdasher.com/images/ajax-loader.gif" /><br /><br /><img src="http://app.getdasher.com/images/logo-header.png" /></div>');
	var shortUrl = 'https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyAecnykZycK_zuDWEq-Tmnt7Wj0m7kIAs8&shortUrl='+currentSrc;
		
	$id = 0;
	$vars = "";
	jQuery.get( shortUrl, function( data ) {
				$i = 0;
			  for(key in data) {
			    if(data.hasOwnProperty(key)) {
			        if($i == 3){
					$currentSrc = value;
					var idIndex = $currentSrc.indexOf('?id=');
					$vars = $currentSrc.substring(idIndex);
					$vars = $vars.replace(/#/g, '%23');
					$url = "http://app.getdasher.com/filmstrip2/index.php"+$vars;
					jQuery.get( $url, function( data ) {
					  jQuery('.dasher2').html(data);
					});
					}
					var value = data[key];
					$i++;
			    }
			}
	});
	
});