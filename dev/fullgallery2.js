jQuery('.dasher2').html('<div style="margin:auto; width:200px; text-align:center; font-family: Arial; color:#F0F0F0; margin-top:100px;"><img src="http://app.getdasher.com/images/ajax-loader.gif" /><br /><br /><img src="http://app.getdasher.com/images/logo-header.png" /></div>');
var scripts = document.getElementsByTagName('script');
var currentSrc = document.currentScript.src;
			$currentSrc = currentSrc;
			var idIndex = $currentSrc.indexOf('?id=');
			$vars = $currentSrc.substring(idIndex);
			$url = "http://app.getdasher.com/fullgallery/index2.php"+$vars;
			$url = $url.replace('#', '');
			console.log($url);
			jQuery.get( $url, function( data ) {
			  jQuery('.dasher2').html(data);
			});