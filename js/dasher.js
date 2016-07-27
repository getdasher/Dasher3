jQuery(document).ready(function(){
	
	//APPROVE PHOTO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START
	
	jQuery('.approve').click(function(event){
		$that = jQuery(this);
		$image = jQuery(this).attr('imgid');
		$imgSetName = "#image_ID_"+$image;
		$imgSet = jQuery($imgSetName);
		
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
		//$imgSet.fadeOut('fast');
		$imgSet.appendTo(jQuery("#approved-photos"));
		  $scrollPosition = jQuery(document).scrollTop();
		  $currentApproved = jQuery('.approved-count').html();
		  $currentApprovedNew = parseInt($currentApproved) + 1;
		  jQuery('.approved-count').html($currentApprovedNew);
		  jQuery(".approved-clear").appendTo(jQuery("#approved-photos"));
		  $scrollPosition = $scrollPosition - 1;
			if($scrollPosition < 0){
				$scrollPosition = 1;
			}
	  	  window.scrollTo(0, $scrollPosition);
	    }
		else{
		}
	  }
	xmlhttp.open("GET","/js_function.php?type=approve&id="+$image,true);
	xmlhttp.send();

	});
	
	//APPROVE PHOTO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END

	//DECLINE PHOTO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START
	
	jQuery('.decline').click(function(event){
		$that = jQuery(this);
		$image = jQuery(this).attr('imgid');
		$imgSetName = "#image_ID_"+$image;
		$imgSet = jQuery($imgSetName);
		
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
	  	  $imgSet.fadeOut('fast');
			$scrollPosition = jQuery(document).scrollTop();
			$scrollPosition = $scrollPosition - 1;
			if($scrollPosition < 0){
				$scrollPosition = 1;
			}
		window.scrollTo(0, $scrollPosition);
	    }
	  }
		xmlhttp.open("GET","/js_function.php?type=deny&id="+$image,true);
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
				$that.parent("li").parent("ul").parent().addClass("deactivated");
				//toggle what buttons are displayed
				$that.parent("li").toggle();
				$that.parent("li").prev().toggle();
				$that.parent("li").next().toggle();
		    }
         
		  }
		  
		xmlhttp.open("GET","/js_function.php?type=deactivate&id="+$id,true);
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
				$that.parent().parent(".campaign-snapshot").fadeToggle();
		    }
         
		  }
		  
		xmlhttp.open("GET","/js_function.php?type=delete&id="+$id,true);
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
				$that.parent("ul").parent().removeClass("deactivated");
				//toggle what buttons are displayed
				$that.parent("li").toggle();
				$that.parent("li").prev().toggle();
				$that.parent("li").prev().prev().toggle();
		    }
		  }
		  
		xmlhttp.open("GET","/js_function.php?type=activate&id="+$id,true);
		xmlhttp.send();
	});
	
	//NEW GALLERY::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	
	//HIDE DENIED PHOTOS:::::::::::::::::::::::::::::::::::::::::::::::::::::::::START

	
	
	//HIDE DENIED PHOTOS:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	
	
	
	//SHOW DENIED PHOTOS:::::::::::::::::::::::::::::::::::::::::::::::::::::::::END
	
	
	jQuery(document).ready(function($){
		$ideas = $('.ideas');
		$width = $( window ).width();
		if($width > 650){
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
		
	}
		if($width <= 650){
			$('.img-set').click(function(){
				if( $(this).find(".hoverdata").css('display') == "block" ){
					$(this).find(".hoverdata").fadeOut();
					$(this).find('.fa-search').fadeOut();
				} 
				if( $(this).find(".hoverdata").css('display') == "none" ){
					$(this).find(".hoverdata").fadeIn();
					$(this).find('.fa-search').fadeIn();
				}
			});
			$('.img-set .fa-search').click(function(){
				$newLoc = $(this).attr('out');
				window.location = $newLoc;
			});
			$('.img-set').each(function(){ $(this).find('a').find('li').unwrap(); });
			$( "#mobile-photo-nav" ).selectmenu({
				width: '100%',
				change: function( event, ui ) { 
					$shower = "#"+$('#mobile-photo-nav').val();
					if ($($shower).css('display') == 'none'){
							$('.current-list').fadeToggle("fast", function(){ 
								$('.current').removeClass('current');
								$('.current-list').css('display', 'none');
								$('.current-list').removeClass('current-list');
								$($shower).fadeToggle("fast", function(){
									$($shower).addClass('current-list');
									//$($newTab).addClass('current');
									window.scrollTo(1,1);
									window.scrollTo(0,0);
								});
							});
						}
					}
				});
		}
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
		
		if($('.show-mobile-nav').css('display') != 'none'){
			$(this).find('.fa-search').fadeToggle('fast');
		}
	    jQuery(this).find(".hoverdata").fadeToggle('fast');
	  },
	  function () {
		if($('.show-mobile-nav').css('display') != 'none'){
			jQuery(this).find('.fa-search').fadeToggle('fast');
		}
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

jQuery(document).ready(function(){
	$k = 0;
	$('.support-link a').fancybox({type: 'iframe', padding: 0, width:'300px', height:'430px', autoSize: false, closeBtn: false, iframe:{scrolling : 'no'}});
	$('.pricing_table .footer .popcontact').fancybox({type: 'iframe', padding: 0, width:'300px', height:'430px', autoSize: false, closeBtn: false, iframe:{scrolling : 'no'}});
	$('.account-update').fancybox({type: 'iframe', padding: 0, width:'400px', height:'430px', autoSize: false, closeBtn: false, iframe:{scrolling : 'no'}});
	$('.new-hashtag-button').click(function(event){
		event.preventDefault();
		if($activeCamps < $totalCamps){
			$('.new-hashtag-button').trigger('click');
		}
		else{
			jQuery.fancybox({'content':'Oops looks like you have the maximum allowed hashtags on your account.'});
		}
	});
	$('.new-hashtag-button').fancybox({type: 'iframe', padding: 0, width:'380px', height:'350px', autoSize: false, closeBtn: false, iframe:{scrolling : 'no'}});
	$('.fancybox-walk').fancybox({ padding: 0, closeBtn: false, closeClick: false, helpers : {overlay : {closeClick: false}},
		
	 afterShow: function () {
	           if($k == 0){
				$('.fancybox-next span').html('<i class="fa fa-chevron-right"></i>');
				$k++;
			}
			else if($k == 1){
				$('.fancybox-next span').html('<i class="fa fa-chevron-right"></i>');
				$k++;
			}
			else if($k == 2){
				$('.fancybox-next span').html('<i class="fa fa-chevron-right"></i>');
				$k++;
			}
			else if($k == 3){
				$('.fancybox-next span').html('LETS GO <i class="fa fa-chevron-right"></i>');
				$k++;
			}
	      },
	beforeShow: function() {
		if($k == 4){
			$.fancybox.close(true);
		}
	}
		
	});
	
//	$( '#nav li:has(ul)' ).doubleTapToGo();
	$('.show-mobile-nav').click(function(){
		//$(this).fadeToggle;
		//$('.hide-mobile-view').fadeToggle;
		$('nav').slideToggle();
		if($(this).hasClass('fa-bars')){
		$(this).removeClass('fa-bars').addClass('fa-close');
		}
		else {
		$(this).removeClass('fa-close').addClass('fa-bars');
		}	
	});
	  $("div.lazy").lazyload({
	        effect : "fadeIn",
			threshold : 200,
			event : "sporty"
	    });
 jQuery('.gallery-item').hover(
function (e) {
	e.preventDefault();
  jQuery(this).find(".hoverdata").fadeToggle('fast');
},
function () {
  jQuery(this).find(".hoverdata").fadeToggle('fast');
});

jQuery('.blank-photo').each(function(){
	var attr = jQuery(this).attr('data-original');
	if (attr == "") {
	    jQuery(this).parent().parent().hide();
	}
});

  });


	function sendGallery($id, $code, $title){
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
		$galleryId = xmlhttp.responseText;
		$outFinalURL = '&lt;div class="dasher2"&gt;&lt;script src="http://app.getdasher.com/galleries.php?id='+$galleryId+'&dataName='+$dataName+'&user='+$userId+'"&gt;&lt;/script&gt;&lt;/div&gt;';
		$(".output-code").html($outFinalURL);
	    }
		else{
		}
	  }
	$outFinalURL = "";
	$url = "/sendGallery.php?id="+$id+"&code="+$code+"&title="+$title;
	xmlhttp.open("GET",$url,true);
	xmlhttp.send();
	};