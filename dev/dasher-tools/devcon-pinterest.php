<?php
include('simple_html_dom.php');
$currentQuery = $_GET['q'];
$currentQuery = str_replace('#', '', $currentQuery);
$currentQuery = str_replace('%23', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace('%20', '+', $currentQuery);
$currentQuery = str_replace(' ', '+', $currentQuery);
$getLink = 'http://pinterest.com/search/pins/?q='.$currentQuery;
$html = file_get_html($getLink);
// Find all images 
$imageArray = array();
$c = 0;
foreach($html->find('[class=pin]') as $element) {

	   $imgSrc = $element->getAttribute('data-closeup-url');
	   $imgDataID = $element->getAttribute('data-id');
       $imageArray[$imgDataID] = $imgSrc;
	   $descArray[$imgDataID] = strip_tags($element->children(1));
	   $linker = $element->children(3)->children(1)->children(1);
	   $linker = str_replace('href="','href="http://www.pinterest.com', $linker);
	   $linksArray[$imgDataID] =  $linker;
	   
}
$pinResult = array_unique($imageArray); ?>
<?php
$i = 0;
foreach ($pinResult as $key => $result){ 
$captions = $descArray[$key];
$captions = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1#<a href="https://pinterest.com/search/pins/?q=%23\2" target="_blank">\2</a>', $captions);
$captions = preg_replace('/(^|\s)@(\w*[a-zA-Z_]+\w*)/', '\1#<a href="https://pinterest.com/search/pins/?q=%23\2" target="_blank">\2</a>', $captions);
?>
<dl class="gallery-item">
			<dt class="gallery-icon">
				<a href="<?php echo $result; ?>" class="backer" target="_blank" style="background-image:url(<?php echo $result; ?>);"></a><div class="hoverdata"><a href="http://www.pinterest.com" target="_blank"><img src="<?php echo "http://www.getdasher.com/wp-content/uploads/2013/06/pinterest-24.png";  ?>" width="20px" height="20px" class="icon" /></a><?php echo $linksArray[$key]; ?><div class="userDescription"><?php echo $captions; ?></div></div>
			</dt></dl>
<?php $i++;} 
?>