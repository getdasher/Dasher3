<?php
	header('Access-Control-Allow-Origin: *');
    header("Content-type: text/css; charset: UTF-8");
?>

/* =Mobile
----------------------------------------------- */

@font-face {
    font-family: 'socicon';
    src: url('https://d1izxxwzxt2tzz.cloudfront.net/socicon-webfont.eot');
    src: url('https://d1izxxwzxt2tzz.cloudfront.net/socicon-webfont.eot?#iefix') format('embedded-opentype'),
         url('https://d1izxxwzxt2tzz.cloudfront.net/socicon-webfont.woff') format('woff'),
         url('https://d1izxxwzxt2tzz.cloudfront.net/socicon-webfont.ttf') format('truetype'),
         url('https://d1izxxwzxt2tzz.cloudfront.net/socicon-webfont.svg#sociconregular') format('svg');
    font-weight: normal;
    font-style: normal;
}

.socicon {
    font-family: 'socicon' !important;
	color: #<?php echo $_GET['color']; ?>;
}

@media (max-width: 960px) {
  #content{width:100%;}
  .img-set, .camp-photo {
    width: 45%;
    padding: 2%;
    float: left;
  }
  .members-area .campaign-snapshot {
width: 42%;
margin-top: 40px;
padding: 10px;
padding-top: 30px;
margin-right: 3%;
float: left;
background-color: #fff;
border-radius: 7px;
border: 1px solid #a5a5a5;
}
}

@media (max-width: 760px){
	.header-body{
  	width:100%;
  }  
 
}

@media (max-width: 550px){
	.img-set, .camp-photo {
    width: 88%;
    padding: 2%;
    float: left;
  }
  .widget-code{
    float:left;
    width:40%;
    height:35px;
    margin-right:20px;
    font-size:12px;
  }
  .to-campaign-photos{
   float:left;
   width:40%;
   height:35px;
   font-size:12px;
  }
  
  .to-new-photos {
		float:left;
   width:40%;
   height:35px;
   font-size:12px;
    margin-top:0;
	}
  .right-buttons{
    float:none;
  }
  
  .header-button {
    background-color: #FFF;
    width: 100px;
    height: 23px;
    color: #d9581e;
    font-family: <?php echo $_GET['font'] ?>;
    font-size: 13px;
    text-transform: uppercase;
    webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    float: right;
    padding-top: 5px;
    margin-top: -45px;
   }
  
  .members-area .campaign-snapshot {
    width: 88%;
    margin-top: 40px;
    padding: 10px;
    padding-top: 30px;
    margin-right: 3%;
    float: left;
    background-color: #fff;
    border-radius: 7px;
    border: 1px solid #a5a5a5;
    margin-left:10px;
  }
  
  .members-area .add-campaign {
    width: 88%;
    margin-top: 0px;
    padding: 10px;
    margin-right: 3%;
    float: left;
    border: none;
    color: #d9581e;
    font-family: <?php echo $_GET['font'] ?>;
    font-size: 13px;
    text-transform: uppercase;
  }
 input[type=text] {
    width: 80%;
    height: 40px;
    margin-bottom: 10px;
    }
    
  input[type="submit"]{
      width:80%;
      height:20px;
      font-size:12px;
      margin:0;
  }
  
  .login-form-left{
    float:none;
    }
  
  .login-form-right {
   	background:none;
    float:none;
    width: 200px;
    height: 100px;
    border-top-right-radius: 7px;
    border-bottom-right-radius: 7px;
  }
  .login-form-right input[type=submit]{
    	margin-top: 20px;
			margin-left: 50px;
    }
  
  .login-form input[type=checkbox]{
    margin-top:67px;
    }
  
  	.login-form {
        width: 220px;
    	margin-left:20px;
        display: block;
        margin: auto;
        font-family: <?php echo $_GET['font'] ?>;
        font-style: italic;
        font-size: 12px;
        color: #b0b8c2;
        }
  
  	.footer-body{
    	width:100%;
  	}
}

.tou-ul li{
	margin-left: 83px;
	text-align: left;
	list-style-type: disc;
	width:auto;
	padding-top:5px;
	padding-bottom:5px;
}
.tou-ul li:last-child{
	border:none;
	padding-bottom:20px;
}
.tou-ul{
	border:none;
}
.tou-ul:last-child{
	margin-top:10px;
}
.tou-ul:last-child li{
	padding:0;
}

.approve input[type=radio]{
  display:none;
}
.decline input[type=radio]{
  display:none;
}
.approve{float:left; width:129px;}
.decline{float:left; width:129px;}
.approve{float:left; width:129px; cursor:pointer;}
.decline{float:left; width:129px; cursor:pointer; padding-top: 1px; padding-left: 6px;}

.panel {
    position: relative;
}

.card {
    -o-transition: all .7s !important;
    -ms-transition: all .7s !important;
    -moz-transition: all .7s !important;
    -webkit-transition: all .7s !important;
    transition: all .7s !important;
    -webkit-backface-visibility: hidden !important;
    -ms-backface-visibility: hidden !important;
    -moz-backface-visibility: hidden !important;
    backface-visibility: hidden !important;
    position: absolute !important;
}

.front {
	display: block !important;
    z-index: 2;
}

.back {
    z-index: 1 !important;
    -webkit-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);  
    transform: rotateY(-180deg);  
   display:block;
height:100% !important;
width: 100% !important;
background-color:#<?php echo $_GET['color']; ?> !important;
}

.panel:hover .front {
    z-index: 1 !important;
    -webkit-transform: rotateY(180deg);
    -ms-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);
    transform: rotateY(180deg);
}

.panel:hover .back {
    z-index: 2 !important;   
    -webkit-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
    transform: rotateY(0deg);
}

.panel {
	background:none !important;
}
<?php if($_GET['color'] == "FFFFFF"){ $backColor = "000000"; } else{ $backColor = 'FFFFFF'; } ?>
.back span{
    position: absolute;
       bottom: 20px;
	   padding-right:20px;
	   font-style:italic;
       left: 20px;
font-size:13px;
line-height: 18px;
width: 90%;
word-wrap:break-word;
font-family: <?php echo $_GET['font'] ?>;
color:#<?php echo $backColor; ?> !important;
}

.fancybox-title a{
	color:#<?php echo $backColor; ?> !important;
}
.back span a{
	color:#FFF !important;
	position:relative !important;
	padding:5px !important;
	display: inline !important;
	text-decoration: underline;
}
.back span br{
	padding: 0 !important;
	margin: 0 !important;
}
.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
.galleryview .site-branding img{float:left;}
.galleryview .site-branding img:first-child{padding-top:20px;}
.custom_logo{
	background-image:url(http://app.getdasher.com/uploads/<?php echo $_GET['logo']; ?>);
	width:200px;
	height:150px;
	background-position:center;
	background-size:contain;
	margin:auto;
	margin-top:10px;
	background-repeat:no-repeat;
}
.hash-title{
	font-family: <?php echo $_GET['font'] ?>;
    font-style: italic;
	color:#<?php echo $_GET['color']; ?>;
	width:200px;
	margin:auto;
	margin-top:2px;
	margin-bottom:20px;
	margin-top:20px;
	font-size:25px;
	text-align:center;
}
.galleryview #content{width:1100px; position:relative; background:none;}
.header-body{width:1100px;}
.gallery_banner{
	margin-left: 210px;
	position: absolute;
	z-index: 1000;
	top: 0;
}
.galleryview .site-branding{
	width:1100px;
}
.network-icons{
	width:200px;
	text-align:center;
	margin:auto;
	margin-bottom:30px;
}
.network-icons .icon{
	margin-right:10px;
}
.galleryview .site-branding .gallery_logo{
	float:right; width:159px; margin-top:0px;
}
		.fancybox-title-over-wrap {
		position: absolute;
		bottom: 0;
		left: 0;
		width: 96%;
		color: #fff;
		padding: 10px;
		background: #000;
		background: rgba(0, 0, 0, .8);
		}
	  .ui-tooltip, .arrow:after {
	    background: #000;
		background: rgba(0, 0, 0, .8);
		border:none;
	  }
	.ui-tooltip a{
		color:#d9581e;
	}
	.tooltip{font-family: <?php echo $_GET['font'] ?>;}
	  .ui-tooltip {
	    padding: 5px 10px;
	    color: white;
	    border-radius: 5px;
	    font-family: <?php echo $_GET['font'] ?>;
		font-size: 15px;
		font-style: italic;
	    box-shadow: 0;
	
	  }
	  .arrow {
	    width: 70px;
	    height: 16px;
	    overflow: hidden;
	    position: absolute;
	    left: 50%;
	    margin-left: -35px;
	    bottom: -16px;
	  }
	  .arrow.top {
	    top: -16px;
	    bottom: auto;
	  }
	  .arrow.left {
	    left: 20%;
	  }
	  .arrow:after {
	    content: "";
	    position: absolute;
	    left: 20px;
	    top: -20px;
	    width: 25px;
	    height: 25px;
	    box-shadow: 6px 5px 9px -9px black;
	    -webkit-transform: rotate(45deg);
	    -moz-transform: rotate(45deg);
	    -ms-transform: rotate(45deg);
	    -o-transform: rotate(45deg);
	    tranform: rotate(45deg);
	  }
	  .arrow.top:after {
	    bottom: -20px;
	    top: auto;
	  }
	.dasher-branding{
		width:auto !important;
		-moz-box-shadow: none !important;
			-webkit-box-shadow: none !important;
			box-shadow: none !important;
	}