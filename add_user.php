<?php
require_once('header.php'); ?>
<?php
ini_set('display_errors', 1);
if(isset($_POST['user_email'])){
	$new_email = $_POST['user_email'];
	$new_name = $_POST['user_name'];
	$tags = serialize($_POST['hashtag']);
	$users = new database('users');
	if(isset($_COOKIE['parentId'])){
	$userQuery = "INSERT INTO `users` (`user_name`, `email_address`, `sub`, `sub_tags`) VALUES ('".$new_name."','".$new_email."',".$_COOKIE['parentId'].",'".$tags."')";
	$userResult = $users->query($userQuery);
	$subId = mysqli_insert_id($users->mysqli);
		if(isset($user['sub_parents'])){
			$subs = unserialize($user['sub_parents']);
			$subs[] = $subId;
			$subs = serialize($subs);
			$userQuery2 = "UPDATE `users` SET `sub_parents` = '".$subs."' WHERE `ID` = ".$_COOKIE['userid'];
			$userResult2 = $users->query($userQuery2);
		}
		else{
			$subs = array($subId);
			$subs = serialize($subs);
			$userQuery2 = "UPDATE `users` SET `sub_parents` = '".$subs."' WHERE `ID` = ".$_COOKIE['userid'];
			$userResult2 = $users->query($userQuery2);
		}
	}
	else{
	$userQuery = "INSERT INTO `users` (`user_name`, `email_address`, `sub`, `sub_tags`) VALUES ('".$new_name."','".$new_email."',".$_COOKIE['userid'].",'".$tags."')";
	$userResult = $users->query($userQuery);
	}
	
	//require 'classes/class.smtp.php';

	date_default_timezone_set('Etc/UTC');

	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'adam.vauthier@gmail.com';                 // SMTP username
	$mail->Password = 'yblstfzlavyjhuri';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;
	$mail->From = 'info@getdasher.com';
	$mail->FromName = 'Dasher';

	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';

	//Set an alternative reply-to address
	$mail->addReplyTo('info@getdasher.com', 'Dasher');

	//Set who the message is to be sent to
	$mail->addAddress($new_email);

	//Set the subject line
	$mail->Subject = $user['user_name'].' Invited You To Their Dasher Account';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	
	$body = '<div bgcolor="#FFFFFF" style="font-family:\'Open Sans\',sans-serif;width:100%!important;min-height:100%;font-size:18px;line-height:1.6;color:#33373a;margin:0;padding:0">


	<table bgcolor="white" style="font-family:\'Open Sans\',sans-serif;width:100%;margin:0;padding:0">
	  <tbody><tr style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
	    <td style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"></td>
	    <td style="font-family:\'Open Sans\',sans-serif;display:block!important;max-width:600px!important;clear:both!important;margin:0 auto;padding:0">

	        <div style="font-family:\'Open Sans\',sans-serif;max-width:600px;display:block;margin:0 auto;padding:15px">
	        <table bgcolor="#ffffff" style="font-family:\'Open Sans\',sans-serif;width:100%;margin:0;padding:0">
	          <tbody><tr style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
	            <td style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><img src="https://ci6.googleusercontent.com/proxy/8i3xIqACsLhv-pGtC23Oxp3yQ-trflqbcLf5M27vlJBchKiGyNUR4n5tfONTWeMX80DODlWNMSmW_BWMJ8o1K2uxpt4=s0-d-e1-ft#http://app.getdasher.com/images/login-logo.jpg" style="font-family:\'Open Sans\',sans-serif;max-width:100%;margin:0;padding:0" class="CToWUd"></td>
	          </tr>
	        </tbody></table>
	        </div>

	    </td>
	    <td style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"></td>
	  </tr>
	</tbody></table>


	<table style="font-family:\'Open Sans\',sans-serif;width:100%;margin:0;padding:0">
	  <tbody><tr style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
	    <td style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"></td>
	    <td bgcolor="#FFFFFF" style="font-family:\'Open Sans\',sans-serif;display:block!important;max-width:600px!important;clear:both!important;margin:0 auto;padding:0">

	      <div style="font-family:\'Open Sans\',sans-serif;max-width:600px;display:block;margin:0 auto;padding:15px">
	      <table style="font-family:\'Open Sans\',sans-serif;width:100%;margin:0;padding:0">
	        <tbody><tr style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
	          <td style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
	             <div style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">Hi '.$new_name.'!<br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
	</div>
	<div style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">

	<div style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><span style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">'.$user['user_name'].' invited you to join their Dasher account.<br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><a href="http://app.getdasher.com/sub_signup.php?email='.$new_email.'" style="font-family:\'Open Sans\',sans-serif;color:#73360a;margin:0;padding:0" target="_blank">Click here</a> to get started. All you need is a password.<br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
<br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><a href="http://app.getdasher.com/sub_signup.php?email='.$new_email.'" style="font-family:\'Open Sans\',sans-serif;color:#73360a;margin:0;padding:0" target="_blank"><a href="http://app.getdasher.com/sub_signup.php?email='.$new_email.'" style="color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:200px;background:#ff6f0a;margin:0;padding:0" target="_blank">Activate Your Account</a><br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">
<br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><i style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">Dasher is the tool to easily build a gallery of your customers\' hashtag social pics and embed it right on your site. Images that appear in the gallery are approved by you.</i><br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">If you have any questions or experience any problems don\'t hesistate to email <a href="mailto:team@getdasher.com" style="font-family:\'Open Sans\',sans-serif;color:#73360a;margin:0;padding:0">team@getdasher.com</a>. We\'d be happy to help.<br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"><br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">Thanks!<br style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0">The Dasher Team</span></div>
	</div>

	          </td>
	        </tr>
	      </tbody></table>
	      </div>


	    </td>
	    <td style="font-family:\'Open Sans\',sans-serif;margin:0;padding:0"></td>
	  </tr>
	</tbody></table>
	</div>';
	$mail->msgHTML($body);
	
	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else { ?>
		<div class="modal-header">Add User</div>
		<p style="margin-top:50px; display:block;">
		<?php
	    echo $new_name." has been added to your account. They have received an email to finish setting up their account.";
		?>
		</p><button class="close_window" style="float:right;">Close Window</button>
		<div style="clear:both"></div>
		<script>
			jQuery('.close_window').click(function(){
				parent.location.reload();
			});
		</script><?php 
	}
	
	
}
else{
$dbCamps = new database($_COOKIE['userdatabase']);
if($_COOKIE['usertype'] == "sub"){
$ids = unserialize($user['sub_tags']);
$queryIds = "";
$j = 0;
	foreach($ids as $id){
		if($j != 0){
		$queryIds .= " || `ID` = ".$id;
		}
		else{
		$queryIds .= " `ID` = ".$id;
		$j++;
		}
	}
$query = 'SELECT * FROM `campaign` WHERE'.$queryIds;
$campaigns = $dbCamps->query($query);
}
else{
$campaigns = $dbCamps->query('SELECT * FROM `campaign`');
}
 ?>
<div class="modal-header">Add User</div>
<p style="margin-top:50px;">
	<form id="form1" action="" method="post">
		<input type="text" name="user_name" placeholder="Name" required />
		<input type="text" name="user_email" placeholder="Email" required />
			<h3>Users's Hashtags:</h3>
			<ul>
			<?php $i = 0; foreach($campaigns as $hashtag){ ?>
			<li>
			<input type="checkbox" name="hashtag[]" value="<?php echo $hashtag['ID']; ?>"><span><?php echo $hashtag['hashtag']; ?></span>
			</li>
			<?php } ?>
			</ul>
			<input type="submit" class="action_buton" value= "Add User"><button class="close_window" style="width:100% !important;">Cancel</button> 
			<div style="clear:both;"></div>
	</form>
	<div style="clear:both;"></div>
</p>
<div style="clear:both;"></div>
<script>
	jQuery('.close_window').click(function(e){
		e.preventDefault();
		parent.$.fancybox.close();
	});
	jQuery(document).ready(function(){
	$("#form1").validate();
	});
	</script>
</script>
<?php
}
 require_once('footer.php'); ?>