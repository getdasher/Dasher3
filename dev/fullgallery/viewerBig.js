jQuery(document).ready(function(){
	$id = 0;
	var scripts = document.getElementsByTagName('script');

	for(var i=0; i<scripts.length; i++){
	   	var currentSrc = scripts[i].src;
	   	var indexTest = currentSrc.indexOf('http://app.getdasher.com/viewerBig.js');
	   	if(indexTest != -1){
			var idIndex = currentSrc.indexOf('?id=');
			idIndex = idIndex + 4;
			$id = currentSrc.substring(idIndex);
			var idIndex2 = currentSrc.indexOf('&id2=');
			idIndex2 = idIndex2+5;
			$id2 = currentSrc.substring(idIndex2);
			$id2 = $id2.replace('"', '');
			$id2 = $id2.replace('”', '');
		}
	}
	
	$url = "http://app.getdasher.com/bozone/index.php";
	jQuery.get( $url, function( data ) {
	  jQuery('.dasher2').html(data);
	});
});