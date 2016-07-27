<?php
include('simple_html_dom.php');
$currentQuery = $_GET['q'];
$currentQuery = str_replace('#', '', $currentQuery);
$currentQuery = str_replace('@', '', $currentQuery);
$currentQuery = str_replace(' ', '+', $currentQuery);
$getLink = 'http://pinterest.com/search/pins/?q='.$currentQuery;
$html = file_get_html($getLink);
// Find all images 
$imageArray = array();
foreach($html->find('[class=pin]') as $element) {
	   $imgSrc = $element->getAttribute('data-closeup-url');
       $imageArray[] = $imgSrc;
}
$pinResult = array_unique($imageArray); ?>
<?php
foreach ($pinResult as $result){ ?>
<dl class="gallery-item">
			<dt class="gallery-icon">
				<a href="<?php echo $result; ?>" title="dasher-logo"><img style="max-height:200px;" src="<?php echo $result; ?>"></a>
			</dt></dl>
<?php } ?>