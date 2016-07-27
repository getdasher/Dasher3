<?php
    header("Content-type: text/css; charset: UTF-8");
?>

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

.dasher2 img{
	border:none;
}

.socicon {
    font-family: 'socicon' !important;
	color: #<?php echo $_GET['color']; ?>;
}

/** RESET AND LAYOUT
===================================*/

.bx-wrapper {
	position: relative;
	margin: 0 auto;
	padding: 0;
	*zoom: 1;
}

.bx-wrapper img {
	max-width: 100%;
	display: block;
}

/** THEME
===================================*/

.bx-wrapper .bx-viewport {
	border:  none;
	background: none;
	
	/*fix other elements on the page moving (on Chrome)*/
	-webkit-transform: translatez(0);
	-moz-transform: translatez(0);
    	-ms-transform: translatez(0);
    	-o-transform: translatez(0);
    	transform: translatez(0);
}

.bx-wrapper .bx-pager,
.bx-wrapper .bx-controls-auto {
	position: absolute;
	bottom: -30px;
	width: 100%;
}

/* LOADER */

.bx-wrapper .bx-loading {
	min-height: 50px;
	background: url(images/bx_loader.gif) center center no-repeat #fff;
	height: 100% !important;
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 2000;
}

/* PAGER */

.bx-wrapper .bx-pager {
	text-align: center;
	font-size: .85em;
	font-family: Arial;
	font-weight: bold;
	color: #666;
	padding-top: 20px;
}

.bx-wrapper .bx-pager .bx-pager-item,
.bx-wrapper .bx-controls-auto .bx-controls-auto-item {
	display: inline-block;
	*zoom: 1;
	*display: inline;
}

.bx-wrapper .bx-pager.bx-default-pager a {
	background: #666;
	text-indent: -9999px;
	display: block;
	width: 10px;
	height: 10px;
	margin: 0 5px;
	outline: 0;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {
	background: #000;
}

/* DIRECTION CONTROLS (NEXT / PREV) */

<?php if ($_GET['siteColor'] == "light"){ ?>

.bx-wrapper .bx-prev {
	left: -22px;
	background: url(images/controls.png) no-repeat 0 -32px;
}

.bx-wrapper .bx-next {
	right: -25px;
	background: url(images/controls.png) no-repeat -43px -32px;
}

<?php } else { ?>
	.bx-wrapper .bx-prev {
		left: -22px;
		background: url(images/controls2.png) no-repeat 0 -32px;
	}

	.bx-wrapper .bx-next {
		right: -25px;
		background: url(images/controls2.png) no-repeat -43px -32px;
	}
<?php } ?>

.bx-wrapper .bx-prev:hover {
	background-position: 0 0;
}

.bx-wrapper .bx-next:hover {
	background-position: -43px 0;
}

.bx-wrapper .bx-controls-direction a {
	position: absolute;
	top: 50%;
	margin-top: -16px;
	outline: 0;
	width: 32px;
	height: 32px;
	text-indent: -9999px;
	z-index: 9999;
}

.bx-wrapper .bx-controls-direction a.disabled {
	display: none;
}

/* AUTO CONTROLS (START / STOP) */

.bx-wrapper .bx-controls-auto {
	text-align: center;
}

.bx-wrapper .bx-controls-auto .bx-start {
	display: block;
	text-indent: -9999px;
	width: 10px;
	height: 11px;
	outline: 0;
	background: url(images/controls.png) -86px -11px no-repeat;
	margin: 0 3px;
}

.bx-wrapper .bx-controls-auto .bx-start:hover,
.bx-wrapper .bx-controls-auto .bx-start.active {
	background-position: -86px 0;
}

.bx-wrapper .bx-controls-auto .bx-stop {
	display: block;
	text-indent: -9999px;
	width: 9px;
	height: 11px;
	outline: 0;
	background: url(images/controls.png) -86px -44px no-repeat;
	margin: 0 3px;
}

.bx-wrapper .bx-controls-auto .bx-stop:hover,
.bx-wrapper .bx-controls-auto .bx-stop.active {
	background-position: -86px -33px;
}

/* PAGER WITH AUTO-CONTROLS HYBRID LAYOUT */

.bx-wrapper .bx-controls.bx-has-controls-auto.bx-has-pager .bx-pager {
	text-align: left;
	width: 80%;
}

.bx-wrapper .bx-controls.bx-has-controls-auto.bx-has-pager .bx-controls-auto {
	right: 0;
	width: 35px;
}

/* IMAGE CAPTIONS */

.bx-wrapper .bx-caption {
	position: absolute;
	bottom: 0;
	left: 0;
	background: #666\9;
	background: rgba(80, 80, 80, 0.75);
	width: 100%;
}

.bx-wrapper .bx-caption span {
	color: #fff;
	font-family: Arial;
	display: block;
	font-size: .85em;
	padding: 10px;
}
.bx-pager{
	display:none;
}
.dasher-logo{
	width: 330px;
	margin:auto;
	display:block;
	margin-top:12px;
	z-index: 100000;
	position: relative;
}
.bx-wrapper .slide{
	cursor:pointer;
	cursor: pointer;
  max-height: 150px !important;
  overflow: hidden;
}
.bx-wrapper .title{
	color: #CCC;
	font-size: 12px;
	height: 67px;
	overflow: hidden;
	padding: 5px;
	line-height: 16px;
	margin-top: -77px;
	position: absolute;
	background: rgba(0, 0,0, .6);
	display:none;
}
.bx-wrapper .title a{
	color:#CCC;
}
.bx-wrapper .title .icon{
	float:left;
}
.custom_logo{
	background-image:url(http://app.getdasher.com/uploads/<?php echo $_GET['logo']; ?>);
	width: 200px;
	height: 150px;
	background-position: center;
	background-size: contain;
	margin: auto;
	margin-top: 10px;
	background-repeat: no-repeat;
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
.network-icons{
	width:200px;
	text-align:center;
	margin:auto;
	margin-bottom:10px;
}
.network-icons .icon{
	margin-right:10px;
}
.galleryview .site-branding .gallery_logo{
	float:right; width:159px; margin-top:0px;
}
a.dasher-logo{
	text-decoration:none;
	width:141px;
}