$(document).ready(function(){
var margin = $(".brickFlip1").width()/2;
var width=$(".brickFlip1").width();
var height=$(".brickFlip1").height();
$(".brickFlip2").stop().css({width:'0px',height:''+height+'px',marginLeft:''+margin+'px',opacity:'0.5'});
$("#reflection2").stop().css({width:'0px',height:''+height+'px',marginLeft:''+margin+'px'});
	$(".brickFlip1").click(function(){
		$(this).stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin+'px',opacity:'0.5'},{duration:500});
		window.setTimeout(function() {
		$(".brickFlip2").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'0px',opacity:'1'},{duration:500});
	},500);
	});
	$(".brickFlip2").click(function(){
		$(this).stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin+'px',opacity:'0.5'},{duration:500});
		window.setTimeout(function() {
		$(".brickFlip1").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'0px',opacity:'1'},{duration:500});
	},500);
	});
});