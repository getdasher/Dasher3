<?php
	ini_set("display_errors", 1);
	session_start();
	require_once ("connect.php");
	include_once('header.php'); 
	
	if(isset($_POST['contact-name'])){
		$namer = $_POST['contact-name'];
		$email = $_POST['email'];
		$body = $_POST['inquiry'];
		$topic = $_POST['topic'];
		include('mail-contact.php');
		echo "Your inquiry has been submitted. We will be in touch soon.";
	}
	else {
?>
	
<h1>Terms of Use</h1>
<h4>A few simple terms to remember:<h4>
<p>
Casey Ferguson, Adam Vauthier, Joshua Hill D.B.A. Dasher<br />
615 Ash St<br />
Anaconda, MT USA 59711<br />
</p>
<ul class="tou-ul">
<li>Individual social network user’s photos, uploads, and posts are the property of that particular user.</li>
<li>Dasher is great for campaigns and contests, but be sure you’re only re-displaying photos that users have agreed to post in participation with the campaign or contest.</li>
<li>Dasher re-displays information, more specifically images, and their respective “post” text associated with hashtags established by DASHER’s users (you).</li>
<li>DASHER utilizes Google+, Instagram, Facebook, & Twitter API connections to aggregate information and as such, you agree to the following individual network terms of service:
<ul class="tou-ul">
	<li><a href="https://www.google.com/url?q=https%3A%2F%2Fwww.facebook.com%2Flegal%2Fterms&sa=D&sntz=1&usg=AFQjCNHqfApMfF0vZRgcuDfy-A0RKoU_XQ">Facebook</a></li>
	<li><a href="https://www.google.com/url?q=https%3A%2F%2Ftwitter.com%2Ftos&sa=D&sntz=1&usg=AFQjCNFUmondq33nZ-8wfbw7hsmkcDLsRQ">Twitter</a></li>
	<li><a href="http://www.google.com/url?q=http%3A%2F%2Finstagram.com%2Flegal%2Fterms%2F&sa=D&sntz=1&usg=AFQjCNFLdOKMSdn665gyzAaO7v7ZMtcf1A">Instagram</a></li>
	<li><a href="http://www.google.com/+/policy/pagesterm.html">Google+</a></li>
	<li><a href="http://www.google.com/+/policy/contestspolicy.html">Google+ Contests</a></li>
</ul>
</ul>
<br /><br />
<h3>Full Dasher Terms and Conditions:</h3>
<iframe src="https://docs.google.com/document/d/1JhZbiKf7XZNljVrHEFrXGJ9sdFhPzDsM9z67wWJ0vEw/pub?embedded=true" width="800" height="200"></iframe>
<form style="width:400px; margin-left:85px; margin-top:10px;">
<input type="checkbox" value="acceptTerms" name="tou" style="display:inline-block;"> I agree to the Full Dasher Terms and Conditions.
<input class="button button-view" type="submit" value="Continue" style="width:150px; margin-top:20px; margin-left:0px; background-color: #d9581e;
" />
</form>
						
<?php } include_once('footer.php'); ?>