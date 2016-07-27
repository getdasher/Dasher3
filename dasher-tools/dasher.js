jQuery(document).ready(function(){
	
	//APPROVE PHOTO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START
	
	jQuery('.approve').click(function(event){
		$that = jQuery(this);
		$image = jQuery(this).parent().parent().find('id');
		$imageEdit = jQuery(this).parent().parent().find('.current-approval-status');
		$str = jQuery(this).attr('imgid');
		$table = jQuery(this).attr('imgtbl');
		$imgset = jQuery(this).parent().parent().parent(".img-set");
		
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
		xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	  	  $imgset.hide();
	    }
	  }
	xmlhttp.open("GET","http://www.getdasher.com/dasher-tools/approve_photo.php?id="+$str,true);
	xmlhttp.send();

	});
	
	//APPROVE PHOTO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END

	//DECLINE PHOTO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START
	
	jQuery('.decline').click(function(event){
		$that = jQuery(this);
		$image = jQuery(this).parent().parent().find('id');
		$imageEdit = jQuery(this).parent().parent().find('.current-approval-status');
		$str = jQuery(this).attr('imgid');
		$table = jQuery(this).attr('imgtbl');
		$imgset = jQuery(this).parent().parent().parent(".img-set");
		
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
		xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	  	  $imgset.hide();
	    }
	  }
		xmlhttp.open("GET","http://www.getdasher.com/dasher-tools/deny_photo.php?id="+$str,true);
		xmlhttp.send();
	});
	
	//DECLINE PHOTO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	//DEACTIVATE CAMPAIGN:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START
	
	jQuery('.deactivate').click(function(event){
		event.preventDefault();
		$that = jQuery(this);
		$id = jQuery(this).attr('id');
		
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				//toggle opacity
				$that.parent("li").parent("ul").prev().addClass("deactivated");
				//toggle what buttons are displayed
				$that.parent("li").toggle();
				$that.parent("li").prev().toggle();
				$that.parent("li").next().toggle();
		    }
         
		  }
		  
		xmlhttp.open("GET","http://www.getdasher.com/dasher-tools/deactivate_campaign.php?id="+$id,true);
		xmlhttp.send();
	});
	
	//DEACTIVATE CAMPAIGN:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	
	//DELETE CAMPAIGN:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START
	
	jQuery('.delete').click(function(event){
		event.preventDefault();
		var answer = confirm ("Are you sure you want to delete this campaign?  This action is not reversible.")
		if (answer){
		$that = jQuery(this);
		$id = jQuery(this).attr('id');
		
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				$that.parent().parent().parent(".campaign-snapshot").css('display', 'none');
		    }
         
		  }
		  
		xmlhttp.open("GET","http://www.getdasher.com/dasher-tools/delete_campaign.php?id="+$id,true);
		xmlhttp.send();
		}
		else {
			
		}
	});
	
	//DELETE CAMPAIGN:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	//ACTIVATE CAMPAIGN:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START
	
	jQuery('.activate').click(function(event){
		event.preventDefault();
		$that = jQuery(this);
		$id = jQuery(this).attr('id')
		
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				//toggle opacity
				$that.parent("li").parent("ul").prev().removeClass("deactivated");
				//toggle what buttons are displayed
				$that.parent("li").toggle();
				$that.parent("li").prev().toggle();
				$that.parent("li").prev().prev().toggle();
		    }
		  }
		  
		xmlhttp.open("GET","http://www.getdasher.com/dasher-tools/activate_campaign.php?id="+$id,true);
		xmlhttp.send();
	});
	
	//ACTIVATE CAMPAIGN:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	//HIDE DENIED PHOTOS:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START

	
	
	//HIDE DENIED PHOTOS:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	
	
	
	//SHOW DENIED PHOTOS:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	
	jQuery(document).ready(function($){
		jQuery('.fancybox').fancybox({
			type : 'image',
			afterLoad: function() {
		        this.title = this.element.attr('fancy-title');
		    },
			helpers : {
			        title: {
			            type: 'over'
			        }
			    }
		});
		jQuery('.iframe-fancy').fancybox({'type' : 'iframe', minHeight : '200px'});
		
		$(".to-campaign-photos").click(function() {
		   $('#new_photos').fadeToggle('fast');
		   $('#photo_album').fadeToggle('fast');
		   $('.to-campaign-photos').fadeToggle('fast', 'linear', function(){ $('.to-new-photos').fadeToggle('fast'); });
		});
		$(".to-new-photos").click(function() {
		   $('#new_photos').fadeToggle('fast');
		   $('#photo_album').fadeToggle('fast');
		   $('.to-new-photos').fadeToggle('fast', 'linear', function(){ $('.to-campaign-photos').fadeToggle('fast'); });
		});
	});
	
		});
		
		
jQuery(document).ready(function(){
	    jQuery(".blank-photo").lazyload({
		      effect : "fadeIn"
		  });
	   jQuery('.img-set').hover(
	  function () {

	    jQuery(this).find(".hoverdata").fadeToggle('fast');
	  },
	  function () {
	    jQuery(this).find(".hoverdata").fadeToggle('fast');
	  });
	});
	
	jQuery(document).ready(function(){
		   jQuery('.camp-photo').hover(
		  function () {

		    jQuery(this).find(".hoverdata").fadeToggle('fast');
		  },
		  function () {
		    jQuery(this).find(".hoverdata").fadeToggle('fast');
		  });
});