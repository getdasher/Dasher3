<?php
ini_set('display_errors', '1');
$BASE_URL = "dashboard.getdasher.com";
include('header.php');
unset($_SESSION['gallery-edit-id']);
$dbCamps = new database($_COOKIE['userdatabase']);
if($_COOKIE['usertype'] == "sub"){
$i = 0;
$ids = unserialize($user['sub_tags']);
$queryIds = "";
	foreach($ids as $id){
		$queryIds .= " || `ID` = ".$id;
	}

$query = 'SELECT * FROM `campaign` WHERE `archived` != 1'.$queryIds;
$campaigns = $dbCamps->query($query);
}
else{
$campaigns = $dbCamps->query('SELECT * FROM `campaign` WHERE `archived` != 1');
}

?>
<script type="text/javascript">

function arraySearch(arr,val) {
    for (var i=0; i<arr.length; i++)
        if (arr[i].indexOf(val) != -1)                    
            return i;
    return false;
  }

	<?php if(isset($_GET['edit'])){
		$galleryID = $_GET['edit'];
		$_SESSION['gallery-edit-id'] = $_GET['edit'];
		$gallery = $dbCamps->query('SELECT * FROM `galleries` WHERE `ID` = '.$galleryID);
		$galleryInfo = $dbCamps->getRow($gallery); ?>
		$galleryId = '<?php echo $_GET['edit']; ?>'; <?php
	} ?>
	
	$userId = '<?php echo $_COOKIE['userid']; ?>';
	$tags = [];
	$type = "";
	$iconOn = false;
	$hashDisplay = false;
	$hashTitle = "";
	$dataName = "";
	$logoDisplay = false;
	$currentStep = 1;
	$hexColor = "#000000";
	$icons = [];
	$logoFile = "";
	$fontChoice = "";
	$siteColor = "light";
	$currentSrc = "";
	$tag = [];
	<?php if(isset($galleryInfo['code'])){ ?>
	var shortUrl = 'https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyAecnykZycK_zuDWEq-Tmnt7Wj0m7kIAs8&shortUrl=<?php echo $galleryInfo['code']; ?>';

	var request = new XMLHttpRequest();
	request.open('GET', shortUrl, true);

	request.onload = function() {
	  if (request.status >= 200 && request.status < 400) {
	    // Success!
	    var data = JSON.parse(request.responseText);
			$i = 0;
		  for(key in data) {
		    if(data.hasOwnProperty(key)) {
		        if($i == 2){
				var value = data[key];
				$currentSrc = value;
				$startPoint = $currentSrc.indexOf('?');
				$startPoint = $startPoint + 1;
				if($currentSrc.indexOf('fullgallery.js') != -1){
					$type = 'fullgallery';
					$('.widget-preview').css('border', 'solid 2px #fff');
					$('.masonry-preview').css('border', 'solid 2px #fff');
					$('.fullgallery-preview').css('border', 'solid 2px #f4922e');
				}
				if($currentSrc.indexOf('filmstrip.js') != -1){
					$type = 'filmstrip';
					$('.fullgallery-preview').css('border', 'solid 2px #fff');
					$('.masonry-preview').css('border', 'solid 2px #fff');
					$('.widget-preview').css('border', 'solid 2px #f4922e');
				}
				if($currentSrc.indexOf('masonry.js') != -1){
					$type = 'masonry';
					$('.fullgallery-preview').css('border', 'solid 2px #fff');
					$('.widget-preview').css('border', 'solid 2px #fff');
					$('.masonry-preview').css('border', 'solid 2px #f4922e');
				}
				$currentSrc = $currentSrc.slice($startPoint);
				$elementsArray = $currentSrc.split("&");
				$dataNameId = arraySearch($elementsArray, 'dataName=');
				$dataNameCheck = $elementsArray[$dataNameId].replace('dataName=', '');
				if($dataNameCheck != ''){
				$dataName = $dataNameCheck;
				}
				$id = arraySearch($elementsArray, 'tags=');
				$tagItems = $elementsArray[$id].replace('tags=', '');
				if($tagItems.indexOf('-') == -1){
				$tag[0] = $tagItems;
				$tags = $tag;
				}
				else{
				$tag = $tagItems.split('-');
				$tags = $tag;
				}
				jQuery('.hash-checkbox').each(function(){
					for (var i=0; i<$tag.length; i++){
					if(jQuery(this).val() == $tag[i]) {
						jQuery(this).attr('checked', 'checked');
					}
				}
				});
				$hashId = arraySearch($elementsArray, 'hash=');
				$hash = $elementsArray[$hashId].replace('hash=', '');
				if($hash != ''){
					$('.hashtag-title').val(decodeURI($hash));
					$hashTitle = decodeURI($hash);
					$('.title-checkbox').attr('checked', 'checked');
					$hashDisplay = true;
					$( ".hashtag-title" ).prop( "disabled", false );
					$('.title-checkbox').next().next('.slide-opacity').css('opacity', '1');
				}
				$logoId = arraySearch($elementsArray, 'logo=');
				$logoCheck = $elementsArray[$logoId].replace('logo=', '');
				if($logoCheck != ''){
					$logoFile = $logoCheck;
					$(".upload-preview").html('<img width="100" src="/uploads/'+$logoFile+'" />');
					$logoDisplay = true;
					$('.logo-checkbox').trigger('click');
				}
				$iconsId = arraySearch($elementsArray, 'icons=');
				$iconsCheck = $elementsArray[$iconsId].replace('icons=', '');
				if($iconsCheck != ''){
					$('#iconsbox1').attr('checked', 'checked');
					$('.icon-selector .slide-opacity').css('opacity', '1');
					$twitterIc = $iconsCheck.indexOf('a');
					$instagramIc = $iconsCheck.indexOf('x');
					$facebookIc = $iconsCheck.indexOf('b');
					$googleIc = $iconsCheck.indexOf('c');
					$iconOn = true;
					if($twitterIc != -1){
						jQuery('#icona').attr('checked', 'checked');
						if($icons[0] == undefined){
							$icons=['a'];
						}
						else{
						$icons.push('a');
						}
					}
					if($instagramIc != -1){
						jQuery('#iconb').attr('checked', 'checked');
						if($icons[0] == undefined){
							$icons=['x'];
						}
						else{
						$icons.push('x');
						}
					}
					if($facebookIc != -1){
						jQuery('#iconc').attr('checked', 'checked');
						if($icons[0] == undefined){
							$icons=['b'];
						}
						else{
						$icons.push('b');
						}
					}
					if($googleIc != -1){
						jQuery('#icond').attr('checked', 'checked');
						if($icons[0] == undefined){
							$icons=['c'];
						}
						else{
						$icons.push('c');
						}
					}
				}
			 $fontId = arraySearch($elementsArray, 'font=');
			 $fontCheck = $elementsArray[$fontId].replace('font=', '');
			 if($fontCheck != ''){
				$fontChoice = decodeURI($fontCheck);
				$option = ".font-select select option[value='"+$fontChoice+"']";
				$($option).attr('selected', 'selected');
			 }
			
			 $colorId = arraySearch($elementsArray, 'color=');
			 $colorCheck = $elementsArray[$colorId].replace('color=', '');
			 if($colorCheck != ''){
				$hexColor = '#'+$colorCheck;
				$('.ink-blot .fa-tint').css('color', $hexColor);
				$('.ink-blot').css('border-color', $hexColor);
				$('.config-step4 .color-selector input[type=text]').css('color', $hexColor);
				$('.config-step4 .color-selector input[type=text]').css('border-color', $hexColor);
				$('.config-step4 .color-selector input[type=text]').attr('value', $hexColor);
				$hexColor = $colorCheck;
				
			 }
			 $siteColorId = arraySearch($elementsArray, 'siteColor=');
			 $siteColorCheck = $elementsArray[$siteColorId].replace('siteColor=', '');
			 if($siteColor != ''){
				$siteColor = $siteColor;
				if($siteColor == 'dark'){
					$('.dark-checkbox').attr('checked', 'checked');
				}
			 }
				
			}
				$i++;
		}
	  }
	}
	};
	request.onerror = function() {
	  // There was a connection error of some sort
	};
	
	request.send();
	<?php } ?>
	$(document).ready(function(){
		
		$( "#ajax-upload-id-1417453469913" ).prop( "disabled", true );
		$( ".hashtag-title" ).prop( "disabled", true );
		$( ".icon-checkbox" ).prop( "disabled", true );
		
		$('.hash-checkbox').click(function(){
			$posCheck = $tags.indexOf($(this).attr('value'));
			if($(this).is(':checked')){
				if($posCheck == -1){
					$tags.push($(this).attr('value'));
				}
			}
			else{
				if($posCheck != -1){
					$tags.splice($posCheck);
				}
			}
		});
		$('.config-next').click(function(){
			$currentStep = $currentStep +1;
			$newLeft = "#item"+$currentStep;
			$('.current-item').removeClass('current-item');
			$($newLeft).addClass('current-item');
			$('.configurizer-alert').fadeOut();
			if($currentStep <= 5){
				$('.config-prev').css('opacity', '1');
				$('.config-prev').css('cursor', 'pointer');
				$('.current-step').fadeToggle(function(){
				$('.current-step').removeClass('current-step');
				$newStep = '.config-step'+$currentStep;
				$($newStep).fadeToggle();
				$($newStep).addClass('current-step');
				if($currentStep >= 5){
					$('.config-next').css('opacity', '.5');
					$('.config-next').css('cursor', 'auto');
				}
				if($currentStep == 4){
					$('.config-next').html('FINISH <i class="fa fa-angle-down"></i>');
				}
				if($currentStep == 5){
					if($tags[0] == null || $dataName == ""){
						$('.config-prev').css('opacity', '.5');
						$('.config-prev').css('cursor', 'auto');
						$('.config-next').html('NEXT <i class="fa fa-angle-down"></i>');
						$('.config-next').css('opacity', '1');
						$('.config-next').css('cursor', 'pointer');
						$newLeft = "#item1";
						$('.current-item').removeClass('current-item');
						$($newLeft).addClass('current-item');
						$('.current-step').fadeToggle(function(){
						$('.current-step').removeClass('current-step');
						$newStep = '.config-step1';
						$($newStep).fadeToggle();
						$($newStep).addClass('current-step');
						$('.configurizer-alert').html('Please choose one or more hashtags to include in the gallery and set a Gallery Name.');
						$('.configurizer-alert').fadeIn();
						$currentStep = 1;
					});
				}
					else if($type == ""){
						$('.config-prev').css('opacity', '1');
						$('.config-prev').css('cursor', 'pointer');
						$('.config-next').html('NEXT <i class="fa fa-angle-down"></i>');
						$('.config-next').css('opacity', '1');
						$('.config-next').css('cursor', 'pointer');
						$newLeft = "#item2";
						$('.current-item').removeClass('current-item');
						$($newLeft).addClass('current-item');
						$('.current-step').fadeToggle(function(){
						$('.current-step').removeClass('current-step');
						$newStep = '.config-step2';
						$($newStep).fadeToggle();
						$($newStep).addClass('current-step');
						$('.configurizer-alert').html('Please choose a gallery type.');
						$('.configurizer-alert').fadeIn();
						$currentStep = 2;
					});
				}
					else{
					$tagsOut = "";
					for (index = 0; index < $tags.length; ++index) {
						if(index == 0){
					    $tagsOut = $tags[index];
						}
						else{
							$tagsOut = $tagsOut+"-"+$tags[index];
						}
					}
					$iconsOut = "";
					for (index = 0; index < $icons.length; ++index) {
						if(index == 0){
					    $iconsOut = $icons[index];
						}
						else{
					    $iconsOut = $iconsOut+"-"+$icons[index];
						}
					}
					$codeOut = 'http://app.getdasher.com/'+$type+'.js?id=<?php echo $_COOKIE['userid']; ?>&tags='+$tagsOut+'&logoC='+$logoDisplay+'&logo='+$logoFile+'&hashC='+$hashDisplay+'&dataName='+$dataName+'&hash='+$hashTitle+'&iconC='+$iconOn+'&icons='+$iconsOut+'&font='+$fontChoice+'&color='+$hexColor+'&siteColor='+$siteColor;
					makeShort($codeOut);
				}
			}
			});
		}
		else{
			$currentStep = 5;
		}
		});
		$('.config-prev').click(function(){
			$currentStep = $currentStep-1;
			$newLeft = "#item"+$currentStep;
			$('.current-item').removeClass('current-item');
			$($newLeft).addClass('current-item');
				if($currentStep > 0){
				$('.config-next').css('opacity', '1');
				$('.current-step').fadeToggle(function(){
				$('.current-step').removeClass('current-step');
				$newStep = '.config-step'+$currentStep;
				$($newStep).fadeToggle();
				$($newStep).addClass('current-step');
				if($currentStep <= 1){
					$('.config-prev').css('opacity', '.5');
					$('.config-prev').css('cursor', 'auto');
				}
				if($currentStep == 4){
					$('.config-next').html('NEXT <i class="fa fa-angle-down"></i>');
					$('.config-next').css('opacity', '1');
					$('.config-next').css('cursor', 'pointer');
				}
		});
		}
		else{
			$currentStep = 1;
		}
		});
		
		$('.nav-item').click(function(){
			$currentStep = $(this).attr('step');
			$newLeft = "#item"+$currentStep;
			$('.current-item').removeClass('current-item');
			$($newLeft).addClass('current-item');
			$('.configurizer-alert').fadeOut();
			if($currentStep <= 5){
				$('.config-prev').css('opacity', '1');
				$('.config-prev').css('cursor', 'pointer');
				$('.current-step').fadeToggle(function(){
				$('.current-step').removeClass('current-step');
				$newStep = '.config-step'+$currentStep;
				$($newStep).fadeToggle();
				$($newStep).addClass('current-step');
				if($currentStep >= 5){
					$('.config-next').css('opacity', '.5');
					$('.config-next').css('cursor', 'auto');
				}
				if($currentStep == 4){
					$('.config-next').html('FINISH <i class="fa fa-angle-down"></i>');
				}
				if($currentStep == 5){
					if($tags[0] == null){
						$('.config-prev').css('opacity', '.5');
						$('.config-prev').css('cursor', 'auto');
						$('.config-next').html('NEXT <i class="fa fa-angle-down"></i>');
						$('.config-next').css('opacity', '1');
						$('.config-next').css('cursor', 'pointer');
						$newLeft = "#item1";
						$('.current-item').removeClass('current-item');
						$($newLeft).addClass('current-item');
						$('.current-step').fadeToggle(function(){
						$('.current-step').removeClass('current-step');
						$newStep = '.config-step1';
						$($newStep).fadeToggle();
						$($newStep).addClass('current-step');
						$('.configurizer-alert').html('Please choose one or more hashtags to include in the gallery.');
						$('.configurizer-alert').fadeIn();
						$currentStep = 1;
					});
				}
					else if($type == ""){
						$('.config-prev').css('opacity', '1');
						$('.config-prev').css('cursor', 'pointer');
						$('.config-next').html('NEXT <i class="fa fa-angle-down"></i>');
						$('.config-next').css('opacity', '1');
						$('.config-next').css('cursor', 'pointer');
						$newLeft = "#item2";
						$('.current-item').removeClass('current-item');
						$($newLeft).addClass('current-item');
						$('.current-step').fadeToggle(function(){
						$('.current-step').removeClass('current-step');
						$newStep = '.config-step2';
						$($newStep).fadeToggle();
						$($newStep).addClass('current-step');
						$('.configurizer-alert').html('Please choose a gallery type.');
						$('.configurizer-alert').fadeIn();
						$currentStep = 2;
					});
				}
					else{
					$tagsOut = "";
					for (index = 0; index < $tags.length; ++index) {
						if(index == 0){
					    $tagsOut = $tags[index];
						}
						else{
							$tagsOut = $tagsOut+"-"+$tags[index];
						}
					}
					$iconsOut = "";
					for (index = 0; index < $icons.length; ++index) {
						if(index == 0){
					    $iconsOut = $icons[index];
						}
						else{
					    $iconsOut = $iconsOut+"-"+$icons[index];
						}
					}
					$codeOut = 'http://app.getdasher.com/'+$type+'.js?id=<?php echo $_COOKIE['userid']; ?>&tags='+$tagsOut+'&logoC='+$logoDisplay+'&logo='+$logoFile+'&hashC='+$hashDisplay+'&dataName='+$dataName+'&hash='+$hashTitle+'&iconC='+$iconOn+'&icons='+$iconsOut+'&font='+$fontChoice+'&color='+$hexColor+'siteColor='+$siteColor;
					makeShort($codeOut);
				}
			}
			});
		}
		else{
			$currentStep = 5;
		}
		});
		
		
		$('.logo-checkbox, .title-checkbox, .icons-checkbox').click(function(){
			if($(this).is(':checked')){
				$(this).next('.slide-opacity').css('opacity', '1');
			}
			else{
				$(this).next('.slide-opacity').css('opacity', '.5');
			}
		});
		$('.widget-preview').click(function(){
			$('.fullgallery-preview, .masonry-preview, .widget2-preview').css('border', '2px solid #fff');
			$(this).css('border', 'solid 2px #f4922e');
			$type = "filmstrip";
		});
		$('.widget2-preview').click(function(){
			$('.fullgallery-preview, .masonry-preview, .widget-preview').css('border', '2px solid #fff');
			$(this).css('border', 'solid 2px #f4922e');
			$type = "filmstrip2";
		});
		$('.fullgallery-preview').click(function(){
			$('.widget-preview, .masonry-preview, .widget2-preview').css('border', '2px solid #fff');
			$(this).css('border', 'solid 2px #f4922e');
			$type = "fullgallery";
		});
		$('.masonry-preview').click(function(){
			$('.widget-preview, .fullgallery-preview, .widget2-preview').css('border', '2px solid #fff');
			$(this).css('border', 'solid 2px #f4922e');
			$type = "masonry";
		});
		$('.icons-checkbox').click(function(){
			if($(this).is(':checked')){
				$iconOn = true;
				$( ".icon-checkbox" ).prop( "disabled", false );
				$(this).next().next('.slide-opacity').css('opacity', '1');
			}
			else{
				$iconOn = false;
				$( ".icon-checkbox" ).prop( "disabled", true );
				$(this).next().next('.slide-opacity').css('opacity', '.5');
			}
		});
		$('.title-checkbox').click(function(){
			if($(this).is(':checked')){
				$hashDisplay = true;
				$( ".hashtag-title" ).prop( "disabled", false );
				$(this).next().next('.slide-opacity').css('opacity', '1');
			}
			else{
				$hashDisplay = false;
				$( ".hashtag-title" ).prop( "disabled", true );
				$(this).next().next('.slide-opacity').css('opacity', '.5');
			}
		});
		$('.hashtag-title').change(function(){
				$hashTitle = $('.hashtag-title').val();
				$hashTitle = encodeURI($hashTitle);
		});
		$('.database-name').change(function(){
				$dataName = $('.database-name').val();
		});
		$('.logo-checkbox').click(function(){
			if($(this).is(':checked')){
				$logoDisplay = true;
				$(this).next().next('.slide-opacity').css('opacity', '1');
			}
			else{
				$logoDisplay = false;
				$(this).next().next('.slide-opacity').css('opacity', '.5');
			}
		});
		$('.icon-checkbox').click(function(){
			$posCheck = $icons.indexOf($(this).attr('value'));
			if($(this).is(':checked')){
				if($posCheck == -1){
					$icons.push($(this).attr('value'));
				}
			}
			else{
				if($posCheck != -1){
					$icons.splice($posCheck);
				}
			}
		});
		$('.ink-blot').colpick({
			layout:'hex',
			color:'fff',
			submit: false,
			onChange:function(hsb,hex,rgb,el,bySetColor) {
				$newColor = "#"+hex;
				$('.ink-blot .fa-tint').css('color', $newColor);
				$('.ink-blot').css('border-color', $newColor);
				$('.config-step4 .color-selector input[type=text]').css('color', $newColor);
				$('.config-step4 .color-selector input[type=text]').css('border-color', $newColor);
				$('.config-step4 .color-selector input[type=text]').attr('value', $newColor);
				$hexColor = hex;
			}
		});
		$('#hex-choice').change(function(){
			$newColor = $(this).val();
			$('.ink-blot .fa-tint').css('color', $newColor);
			$('.ink-blot').css('border-color', $newColor);
			$('.config-step4 .color-selector input[type=text]').css('color', $newColor);
			$('.config-step4 .color-selector input[type=text]').css('border-color', $newColor);
			$('.config-step4 .color-selector input[type=text]').attr('value', $newColor);
			$hexColor = $newColor.replace('#', '');
		});
		$('.font-select').change(function(){
			$currentOption = $(this).find(":selected").text();
			WebFont.load({
		                    google: { 
		                           families: [$currentOption] 
		                     } 
		    });
			$('.font-preview').css('font-family', $currentOption);
			$fontChoice = $currentOption;
		});
		
		$('.widget-upload').click(function(){
			$("#uploader").click();
		});
		$('#uploader').change(function() {
		    ajaxFileUpload();
		});
		$(".widget-upload").uploadFile({
			url:"http://app.getdasher.com/upload.php",
			onSuccess:function(files,data,xhr)
			{
				$fileOut = data.replace('[', '');
				$fileOut = $fileOut.replace(']', '');
				$fileOut = $fileOut.replace('"', '');
				$fileOut = $fileOut.replace('"', '');
				var myVar;
				myVar = setTimeout(function(){$('.ajax-file-upload-statusbar').fadeToggle('slow'); clearTimeout(myVar);}, 3000);
				$(".upload-preview").html('<img width="100" src="/uploads/'+$fileOut+'" />');
				$logoFile = $fileOut;

			},
			fileName:"myfile"
		});
		$('.dark-checkbox').change(function(){
			if($(this).prop('checked')) {
				$siteColor = "dark";
			}
			else{
				$siteColor = "light";
			}
		});
	});
</script>
<script type="text/javascript">
function makeShort(longUrl) 
{
    var request = gapi.client.urlshortener.url.insert({
      'resource': {'longUrl': longUrl}
    });
    request.execute(function(response) 
    {
 
        if(response.id != null)
        {
            str ="<b>Long URL:</b>"+longUrl+"<br>";
            str +="<b>Short URL:</b> <a href='"+response.id+"'>"+response.id+"</a><br>";
			
			sendGallery(<?php echo $_COOKIE['userid']; ?>, response.id, $dataName);
        }
        else
        {
            alert("error: creating short url n"+ response.error);
        }
 
    });
 }
function load()
{
    //Get your own Browser API Key from  https://code.google.com/apis/console/
    gapi.client.setApiKey('AIzaSyAS3f7U4vQUtzkrT6WrA79k7sMO0O1e_hY');
    gapi.client.load('urlshortener', 'v1');
 
}
window.onload = load;
 
</script>
<script src="https://apis.google.com/js/client.js"></script>
<div class="configurizer-alert"></div>
<div class="config-navigation-left">
	<div class="nav-item current-item" id="item1" step="1">Name &amp; Hashtags</div>
	<div class="nav-item" id="item2" step="2">Gallery Type</div>
	<div class="nav-item" id="item3" step="3">Elements</div>
	<div class="nav-item" id="item4" step="4">Font &amp; Color</div>
	<div class="nav-item" id="item5" step="5">Finish</div>
</div>
<div class="config-wrapper">
<div class="config-step1 current-step">
<h1>Gallery Name</h1>
<p>This is only for dashboard use.  It will not appear on the gallery's display.</p>
<input type="text" name="database-name" class="database-name" <?php if(isset($galleryInfo)){echo 'Value="'.$galleryInfo['name'].'"';} else {echo 'placeholder="Enter Name"';} ?>" />
<p>&nbsp;</p>
<h1>Hashtags</h1>
<p>Your gallery can display photos from any of your hashtag campaigns. Select one or more.</p>
<?php
if($dbCamps->numRows($campaigns) > 0){
	$i = 0;
	$campaign_data = $dbCamps->getRows($campaigns);
	foreach($campaign_data as $campaign){ ?>
	<input type="checkbox" class="faChkSqr hash-checkbox" id="hashtag-<?php echo $i; ?>" name="hashtag-<?php echo $i; ?>" value="<?php echo $campaign['ID']; ?>"><label for="hashtag-<?php echo $i; ?>">#<?php echo $campaign['hashtag']; ?></label>		
	<?php $i++; }
}
else{
	echo "Please create your first campaign.";
}
?>
</div>
<div class="config-step2">
	<h1>Layout</h1>
	<p>Choose the designer layout that best fits your site.</p>
	<div class="config-widget-select">
		<div class="widget-preview"></div>
	</div>
	<div class="config-widget2-select">
		<div class="widget2-preview"></div>
	</div>
	<div class="config-fullgallery-select">
		<div class="fullgallery-preview"></div>
	</div>
	<div class="config-masonry-select">
		<div class="masonry-preview"></div>
	</div>
	<div style="clear:both;"></div>
</div>
<div class="config-step3">
	<h1>Logo &amp; Elements</h1>
	<p>Your gallery can display photos from any of your hashtag campaigns. Select one or more.</p>
	<div class="logo-selector">
		<input type="checkbox" name="logo-slider" id="logo-checkbox1" class="faChkSlide logo-checkbox" value="logo" /><label for="logo-checkbox1" class="left-label">&nbsp;</label><div class = "slide-opacity"><label>DISPLAY A LOGO OR GRAPHIC</label><div class="widget-upload">UPLOAD <i class="fa fa-cloud-upload"></i></div><div class="upload-preview"></div><span class="upload-notice">Recommended: PNG file, 200x200px, 800kb Max</span></div><div class="clear"></div>
	</div>
	<div class="title-selector">
		<input type="checkbox" name="title-slider" id="titlebox1" class="faChkSlide title-checkbox" value="hash-title" /><label for="titlebox1" class="left-label">&nbsp;</label><div class = "slide-opacity">DISPLAY A #HASHTAG TITLE<br />
	<input type="text" name="hashtag-title" class="hashtag-title" placeholder="Enter Title" /></div><div class="clear"></div>
	</div>
	<div class="icon-selector">
	<input type="checkbox" name="icons-slider" id="iconsbox1" class="faChkSlide icons-checkbox" /><label for="iconsbox1" class="left-label">&nbsp;</label><div class = "slide-opacity">DISPLAY SOCIAL NETWORK ICONS<br />
		<div class="icon-checkboxes">
			<input type="checkbox" id="icona" class="faChkSqr icon-checkbox" value="a" /><label for="icona" class="left-label"><img src="/images/twitter-24-black.png" /></label>
			<input type="checkbox" id="iconb" class="faChkSqr icon-checkbox" value="x" /><label for="iconb" class="left-label"><img src="/images/instagram-24-black.png" /></label>
			<input type="checkbox" id="iconc" class="faChkSqr icon-checkbox" value="b" /><label for="iconc" class="left-label"><img src="/images/facebook-24-black.png" /></label>
			<input type="checkbox" id="icond" class="faChkSqr icon-checkbox" value="c" /><label for="icond" class="left-label"><img src="/images/googleplus-24-black.png" /></label>
		</div></div><div class="clear"></div>
	</div>
</div>
<div class="config-step4">
	<h1>Font &amp; Color</h1>
	<p>Choose the font and color that best represent your brand.</p>
	<div class="font-selector">
	<p>Google Fonts</p>
	<?php
				$googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyDBTfrt5JBeUTyrKo5miBQAAIht9muhgn8';
	            $fontContent = file_get_contents( $googleApi );
	            $content = json_decode($fontContent);
				
				echo '<div class="font-select"><select><option>Select Font</option>';
				foreach ($content->items as $item){
					echo '<option value="'.$item->family.'">'.$item->family.'</option>';
				}
				echo "</select></div>";
	?>
	<p class='font-preview'>Font Preview:<br />The Quick Brown Fox</p>
	<div class="color-selector">
		<p>Color. Use the color picker or enter a hex code.</p>
		<input type="text" placeholder="#000000" id="hex-choice" /><div class="ink-blot"><i class="fa fa-tint"></i></div>
		<div id="picker"></div>
	</div>
	<div class="dark-selector"><input type="checkbox" class="faChkSqr dark-checkbox" value="darksite" />My website has a dark background.<br /><p style="font-size:12px; margin-top: 2px; width:50%;">For example: If your website has a black or dark color as it's background, enable this checkbox. It will let Dasher know that it needs to display gallery controls that your visitors will be able to see.</p></div>
	</div>
	<div class="clear"></div>
</div>
<div class="config-step5">
	<h1>Finish &amp; Get Code</h1>
	<p>Copy and paste the code below to a page of your website.  This information is also stored in <a href="/galleries/">My Galleries</a></p>
	<p class="output-code" style="margin-bottom:20px; display:block;"><img src="http://app.getdasher.com/images/ajax-loader.gif" /></p>
	<p>Stuck? We can help. Check out the <a href="http://getdasher.com/faq/">Frequently Asked Questions</a> page or contact the team info@getdasher.com to get your gallery on your website.</p>
</div>
	<div class="config-navigation">
		<div class="config-next">NEXT <i class="fa fa-angle-down"></i></div>
		<div class="config-prev"><i class="fa fa-angle-up"></i></div>
	</div>
</div>
</div>
<?php
include('footer.php');
?>
