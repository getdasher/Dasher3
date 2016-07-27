jQuery(document).ready(function(){
	$id = 0;
	var scripts = document.getElementsByTagName('script');

	for(var i=0; i<scripts.length; i++){
	   	var currentSrc = scripts[i].src;
	   	var indexTest = currentSrc.indexOf('http://www.getdasher.com/dasher-tools/viewer2.js');
	   	if(indexTest != -1){
			var idIndex = currentSrc.indexOf('?id=');
			idIndex = idIndex + 4;
			$id = currentSrc.substring(idIndex);
		}
	}
	
	$url = "http://www.getdasher.com/dasher-tools/viewer2.php?id="+$id;
	jQuery.get( $url, function( data ) {
	  jQuery('.dasher').html(data);
	});
});