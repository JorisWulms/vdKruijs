<?php
	header("Content-type: text/css; charset: UTF-8");
	require_once ('../includes/prefs.php');
	require_once (DIR_SYSTEM . 'includes/database.php');
	
	/* GENERAL SETTINGS */
	$getGeneralStyles = mysqli_query($res1 ,"SELECT * FROM settings_style");
	$resGeneralStyles = mysqli_fetch_assoc($getGeneralStyles);
	
	$mainFontFamily = $resGeneralStyles['fontFamily1'] ? 'font-family:\''.str_replace('+',' ',$resGeneralStyles['fontFamily1']).'\', sans-serif;' : '';
	$subFontFamily = $resGeneralStyles['fontFamily2'] ? 'font-family:\''.str_replace('+',' ',$resGeneralStyles['fontFamily2']).'\', sans-serif;' : '';
	$mainFontSize = $resGeneralStyles['fontSize'] ? 'font-size:'.$resGeneralStyles['fontSize'].';' : '';
	$mainFontWeight = $resGeneralStyles['fontWeight'] ? 'font-weight:'.$resGeneralStyles['fontWeight'].';' : '';
	$mainFontColor = $resGeneralStyles['fontColor'] ? 'color:'.$resGeneralStyles['fontColor'].';' : '';
	$titleColor = $resGeneralStyles['titleColor'] ? 'color:'.$resGeneralStyles['titleColor'].';' : '';
	$linkColor = $resGeneralStyles['linkColor'] ? 'color:'.$resGeneralStyles['linkColor'].';' : '';
	
	$headerBorder = $resGeneralStyles['headerBorder'] ? 'border-bottom: 1px solid'.$resGeneralStyles['headerBorder'].';' : '';
	$headerBackground = $resGeneralStyles['headerBackground'] ? 'background:'.$resGeneralStyles['headerBackground'].';' : '';
	$headerFixed = $resGeneralStyles['headerFixed'] ? 'position:fixed;' : '';
	
	$menuBackground = $resGeneralStyles['menuBackground'] ? 'background:'.$resGeneralStyles['menuBackground'].';' : '';
	$menuColor = $resGeneralStyles['menuColor'] ? 'color:'.$resGeneralStyles['menuColor'].';' : '';
	
	// Check for fullwidth menu
	if($resGeneralStyles['menuFullWidth']){
		$menuItemPadding = $resGeneralStyles['menuItemPadding'] ? $resGeneralStyles['menuItemPadding'] : '';
	}else{
		$menuItemPadding = '';
	}
	
	$menuItemBorder = $resGeneralStyles['menuBorders'] ? 'border-right: 1px solid '.$resGeneralStyles['menuBorders'].';' : '';
	$menuUlBorder = $resGeneralStyles['menuBorders'] ? 'border-left: 1px solid '.$resGeneralStyles['menuBorders'].';' : '';	
	
	if($resGeneralStyles['centerLogo']){
		$centerLogo = '';
	}else{
		$centerLogo = '
			#header #logo{
				width:30%;
				margin: 0;
				text-align:left;
			}
			#header #logo img{
				float:left;
				display:block;
			}
		';
	}	
	
	$menuHoverColor = $resGeneralStyles['menuHoverColor'] ? 'color:'.$resGeneralStyles['menuHoverColor'].';' : '';
	$menuCapitals = $resGeneralStyles['menuCapitals'] ? 'text-transform:uppercase;' : '';
	
	$siteWidth = $resGeneralStyles['siteWidth'] ? 'max-width:'.$resGeneralStyles['siteWidth'].';' : '';
	// NOG MEE BEZIG, IS VOOR NIET DE VASTE 100% BREEDTE VAN DE HELE SITE OM GEDEELTELIJKE CONTAINERS TE MAKEN
	$siteContainerWidth = $resGeneralStyles['siteContainerWidth'] ? 'max-width:'.$resGeneralStyles['siteContainerWidth'].';' : '';
	$siteBackground = $resGeneralStyles['siteBackground'] ? 'background:'.$resGeneralStyles['siteBackground'].';' : '';
	$siteLineheight = $resGeneralStyles['siteLineheight'] ? 'line-height:'.$resGeneralStyles['siteLineheight'].';' : '';
	
	$h1size = $resGeneralStyles['h1size'] ? 'font-size:'.$resGeneralStyles['h1size'].';' : '';
	$h1weight = $resGeneralStyles['h1weight'] ? 'font-weight:'.$resGeneralStyles['h1weight'].';' : '';
	
	$h2size = $resGeneralStyles['h2size'] ? 'font-size:'.$resGeneralStyles['h2size'].';' : '';
	$h2weight = $resGeneralStyles['h2weight'] ? 'font-weight:'.$resGeneralStyles['h2weight'].';' : '';
	
	$h3size = $resGeneralStyles['h3size'] ? 'font-size:'.$resGeneralStyles['h3size'].';' : '';
	$h3weight = $resGeneralStyles['h3weight'] ? 'font-weight:'.$resGeneralStyles['h3weight'].';' : '';
	
	$footerBackground = $resGeneralStyles['footerBackground'] ? 'background:'.$resGeneralStyles['footerBackground'].';' : '';
	$footerColor = $resGeneralStyles['footerColor'] ? 'color:'.$resGeneralStyles['footerColor'].';' : '';
	$footerBorder = $resGeneralStyles['footerBorder'] ? 'border-top: 1px solid'.$resGeneralStyles['footerBorder'].';' : '';
	
	/* TEXT BLOCK SETTINGS */
	$textBlockBackground = $resGeneralStyles['textBlockBackground'] ? 'background:'.$resGeneralStyles['textBlockBackground'].';' : ''; 
	$textBlockColor = $resGeneralStyles['textBlockColor'] ? 'color:'.$resGeneralStyles['textBlockColor'].';' : ''; 
	
	/* BANNER SETTINGS */
	$getBannerStyles = mysqli_query($res1 ,"SELECT * FROM settings_banner");
	$resBannerStyles = mysqli_fetch_assoc($getBannerStyles);
	
	$bannerButtonBackgroundColor = $resBannerStyles['buttonBackgroundColor'];
	$bannerButtonColor = $resBannerStyles['buttonColor']; 
	
	$bannerBigSize = $resBannerStyles['title1_size'];
	$bannerBigColor = $resBannerStyles['title1_color'];
	$bannerBigUppercase = $resBannerStyles['title1_uppercase'] ? 'text-transform:uppercase;' : '';
	$bannerBigBackground = $resBannerStyles['title1_background'] ? 'background-color:'.$resBannerStyles['title1_background'].';' : '';

	$bannerSmallSize = $resBannerStyles['title2_size'];
	$bannerSmallColor = $resBannerStyles['title2_color'];
	$bannerSmallUppercase = $resBannerStyles['title2_uppercase'] ? 'text-transform:uppercase;' : '';
	$bannerSmallBackground = $resBannerStyles['title2_background'] ? 'background-color:'.$resBannerStyles['title2_background'].';' : '';
	
	/* NOTICE SETTINGS */
	$getNoticeSettings = mysqli_query($res1 ,"SELECT * FROM settings_notice");
	$resNoticeSettings = mysqli_fetch_assoc($getNoticeSettings);
	
	$noticeBackgroundColor = $resNoticeSettings['colorScheme'] ? 'background:rgba('.implode(',',hex2rgb($resNoticeSettings['colorScheme'])).',0.85);' : ''; 
	$noticeMainColor = $resNoticeSettings['colorScheme']; 
	$noticeTextColor = $resNoticeSettings['noticeTextColor']; 
	
	/* POPUP SETTINGS */
	$getPopupSettings = mysqli_query($res1 ,"SELECT * FROM settings_popup WHERE id = 1");
	$resPopupSettings = mysqli_fetch_assoc($getPopupSettings);
	
	$popupSize = $resPopupSettings['popupSize'];
	$popupTextColor = $resPopupSettings['popupTextColor'];
	$popupBorderRadius = $resPopupSettings['popupBorderRadius'];
	$popupCloseBg = $resPopupSettings['popupCloseBg'];
	$popupCloseColor = $resPopupSettings['popupCloseColor'];
	
	/* RANDOM BLOG SETTINGS */
	$getBlogSettings = mysqli_query($res1 ,"SELECT * FROM settings_blogs");
	$resBlogSettings = mysqli_fetch_assoc($getBlogSettings);
	
	$randomBlogMainColor = $resBlogSettings['randomMainColor'];
	$randomBlogSubColor = $resBlogSettings['randomSubColor'];
	$randomBlogTxtColor = $resBlogSettings['randomTxtColor'];
	$randomBlogTitleSize = $resBlogSettings['randomTitleSize'];
	$randomBlogTitleColor = $resBlogSettings['randomTitleColor'];
	$randomBlogFadeColor = hex2rgb($resBlogSettings['randomMainColor']);
	
	/* NEWS SETTINGS */
	$getNewsSettings = mysqli_query($res1 ,"SELECT * FROM settings_nieuws");
	$resNewsSettings = mysqli_fetch_assoc($getNewsSettings);
	
	$newsButtonBackground = $resNewsSettings['buttonColor'];
	$newsButtonColor = $resNewsSettings['buttonTextColor'];
	$newsButtonBorderRadius = $resNewsSettings['buttonBorderRadius'];
	
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	
?>
/* DEFAULTS */
*,*:before,*:after{
	box-sizing:border-box;
}

body{
	<?=$mainFontFamily?>
	<?=$mainFontSize?>
	<?=$mainFontWeight?>
	<?=$mainFontColor?>
	<?=$siteBackground?>
	<?=$siteLineheight?>
}

h1,h2,h3{
	<?=$titleColor?>
	<?=$subFontFamily?>
}

h1{
	<?=$h1size?>
	<?=$h1weight?>
}

h2{
	<?=$h2size?>
	<?=$h2weight?>
}

h3{
	<?=$h3size?>
	<?=$h3weight?>
}

a{
	<?=$linkColor?>
}

img{
	max-width:100%;
}

.container{
	<?=$siteWidth?>
}

.fullWidthContainer{
	float:left;
	width:100%;
}

.centerText{
	text-align:center;
}

.marginTopBot{
	margin:20px 0;
}

.mTruncate-hidden {
    display: none;
}

.displayFlex{
	display:flex;
	float:left;
	width:100%;
}

/* COLUMNS */
.col_66{
	float:left;
	width: 66.666666666666%;
}

.col_33{
	float:left;
	width: 33.333333333333%;
}

.col_50{
	float:left;
	width: 50%;
}

/* PADDINGS */
.blockPadding{
	padding:20px;
}

.sidePadding{
	padding: 0 20px;
}

.vertPadding{
	padding: 20px 0;
}

.rightPadding{
	padding-right: 20px;
}

.leftPadding{
	padding-left: 20px;
}

/* BACKGROUNDS */
.bgLightGray{
	background: #eee;
}

.bgGray{
	background: #ccc;
}

.bgDarkGray{
	background: #aaa;
}

/* HEADER */
#topHeader{
	background:#efefef;
}
#topHeader span.topLink{
	float:right;
	padding:8px 15px;
	text-decoration:none;
	color:#444;
	border-right: 1px solid #ddd;
}
#topHeader span.topLink:hover{
	background:#fff;
}
#topHeader span.topLink:active{
	background:#ddd;
}
#topHeader a{
	text-decoration:none;
}
.topLinkExtra:before,
.topLinkExtra::before{
	padding:0 5px 0 5px;
	content: " - "
}
#header{
	<?=$headerFixed?>
	float:left;
	width:100%;
	z-index:2;
	<?=$headerBorder?>
	<?=$headerBackground?>
}

#header #logo{
	float:left;
	width:100%;
	margin: 0 0 0px 0;
	padding: 20px 0;
	text-align:center;
}

@media (min-width: 760px) {
	<?=$centerLogo?>
}

/* NAVIGATION */
#navigation ul{
	float:right;
	width:100%;
	margin:0;
	padding:0;
	list-style:none;
	position:relative;
	<?=$menuUlBorder?>
}

#navigation ul li{
	float:left;
	margin:0;
	position:relative;
}

#navigation ul li a{
	float:left;
	padding-left:15px;
	padding-right:15px;
	padding-top: <?=$menuItemPadding?>;
	padding-bottom: <?=$menuItemPadding?>;
	text-decoration:none;
	<?=$menuCapitals?>
	<?=$menuItemBorder?>
}


#navigation ul li a:active{
	background: rgba(0,0,0,0.3);
}

#navigation ul li ul{
	display:none;
	list-style:none;
	/*max-width:100%;*/
	position:absolute;
	padding:0;
	margin:0;
	left:0;
	border-top: 1px dashed #e5e5e5;
	<?=$menuBackground?>
}

#navigation ul li ul li{
	width:100%;
	float:left;
}

#navigation ul li ul li a{
	width:100%;
	padding: 10px 20px;
	transition: background 0.3s;
	border-bottom: 1px dashed #e5e5e5;
	border-left: 0px solid #e5e5e5;
	border-right: 0px solid #e5e5e5;
}

#navigation ul li ul li a:hover{
	background: rgba(255,255,255,0.3);
}

#navigation ul li ul li a:active{
	background: rgba(0,0,0,0.3);
}

#navigation ul li:hover ul{
	display:block;
}

@media (min-width: 760px) {
	#header #navigation ul{
		max-width:70%;
		width:auto;
	}
}

#header #fullNavigation{
	<?=$menuBackground?>
	float:left;
	width:100%;
}
#header #fullNavigation #navigation ul{
	width:100%;
	float:left;
	max-width:100%;
}

#header #navigation ul{
	<?=$menuBackground?>
	<?=$menuFullWidth?>
}

#header #navigation ul a{
	<?=$menuColor?>	
}

#header #navigation ul li a:hover{
	<?=$menuHoverColor?>
	background: rgba(255,255,255,0.3);
}
#header #navigation ul li ul{
	max-width:none;
	min-width:100px;
}
#menuToggle {
    cursor: pointer;
    display: none;
    float: right;
    padding: 12px;
    width: 20%;
	background: rgba(0,0,0,0.4);
}
#menuToggle span.linecont {
    float: right;
    max-width: 55px;
    padding: 5px 0 0;
    width: 100%;
}
#menuToggle span.nav {
    color: #fff;
    display: none;
    float: left;
    font-weight: bold;
    padding: 1px 0 0;
    text-align: left;
    text-transform: uppercase;
    width: 80%;
}
#menuToggle span.linecont span {
    background: #fff none repeat scroll 0 0;
    float: left;
    height: 2px;
    margin: 0 0 5px;
    width: 100%;
}
#navigation span.nav {
    color: #fff;
    cursor: pointer;
    display: none;
    float: left;
    font-size: 18px;
    font-weight: 300;
    padding: 12px 0;
    text-align: left;
    text-transform: uppercase;
    width: 80%;
}

#header #navigation.mobile-menu ul{
	border-left:0px;
}

#navigation.mobile-menu ul{
    display: none;
	border-left:0px;
}
#navigation.mobile-menu ul{
    float: left;
    width: 100%;
}
#navigation.mobile-menu ul li {

    border-top: 1px solid rgba(255,255,255,0.5);
    float: left;
    width: 100%;
}
#navigation.mobile-menu ul li ul{
	top:0 !important;
	position:relative;
}
#navigation.mobile-menu ul li a {
    float: left;
    width: 100%;
    border-left: 0 none;
    border-right: 0 none;
}
#navigation.mobile-menu ul.containerNav li a{
	padding:10px 0 !important;
	text-align:center;
}
#navigation.mobile-menu ul li:hover ul {
    display: none;
}

/* MAIN CONTENT */
#mainContent{
	padding: 30px 0;
	float:left;
	width:100%;
}

#bannerContent{
	padding: 0;
	margin: 30px 0 0px 0;
	float:left;
	width:100%;
}

.bannerOverlay{
	float:left;
	width:100%;
}

/* BANNER */
#bannerSlider{
	float:left;
	width:100%;
	position:relative;
	z-index:1;
}

#bannerSlider .banner{
	float:left;
	width: 100%;
	background-size: cover !important;
}

#bannerSlider .banner .bannerBig{
	float:left;
	width:100%;
	font-size: <?=$bannerBigSize?>;
	line-height:1em;
	font-weight: bold;
	<?=$bannerBigUppercase?>
	padding: 0 15%;
	color: <?=$bannerBigColor?>;
	<?=$bannerBigBackground?>;
}

#bannerSlider .banner .bannerSmall{
	float:left;
	width:100%;
	padding: 0 15%;	
	margin:8px 0 0 0;
	font-size: <?=$bannerSmallSize?>;
	color: <?=$bannerSmallColor?>;
	<?=$bannerSmallUppercase?>
	<?=$bannerSmallBackground?>;
}

#bannerSlider .banner .bannerButton{
	margin: 20px 0 0 15%;
}

/* STATIC BANNER */
.staticBanner{
	float:left;
	width:100%;
	margin: 0 0 0px 0;
	text-align:center;
	position:relative;
}

.staticBanner{
	float:left;
	width: 100%;
	background-size: cover !important;
}

.staticBanner.parallax{
	background-attachment: fixed !important;
}

.staticBanner .bannerBig{
	float:left;
	width:100%;
	font-size: <?=$bannerBigSize?>;
	line-height:1em;
	font-weight: bold;
	<?=$bannerBigUppercase?>
	padding: 0 15%;
	color: <?=$bannerBigColor?>;
	<?=$bannerBigBackground?>;
}

.staticBanner .bannerSmall{
	float:left;
	width:100%;
	padding: 0 15%;	
	font-size: <?=$bannerSmallSize?>;
	color: <?=$bannerSmallColor?>;
	<?=$bannerSmallUppercase?>
	<?=$bannerSmallBackground?>;
}

.staticBanner .bannerButton{
	margin: 20px 35% 0;
	width:30%;
}

/* FULL BANNER */
.fullBanner{
	float:left;
	width:100%;
	margin: 0 0 0 0;
}

.fullBanner .bannerBig{
	float:left;
	width:100%;
	font-size: <?=$bannerBigSize?>;
	line-height:1.2em;
	font-weight: bold;
	<?=$bannerBigUppercase?>
	color: <?=$bannerBigColor?>;
	<?=$bannerBigBackground?>;
}

.fullBanner .bannerSmall{
	float:left;
	width:100%;
	font-size: <?=$bannerSmallSize?>;
	color: <?=$bannerSmallColor?>;
	<?=$bannerSmallUppercase?>
	<?=$bannerSmallBackground?>;
}


/* FULL BANNER */
.fullBannerParallax{
	float:left;
	width:100%;
	margin: 0 0 0 0;
	background-attachment:fixed !important;
}

.fullBannerParallax .bannerBig{
	float:left;
	width:100%;
	font-size: <?=$bannerBigSize?>;
	font-weight: bold;
	line-height:1em;
	<?=$bannerBigUppercase?>;
	color: <?=$bannerBigColor?>;
	<?=$bannerBigBackground?>;
}

.fullBannerParallax .bannerSmall{
	float:left;
	width:100%;
	font-size: <?=$bannerSmallSize?>;
	color: <?=$bannerSmallColor?>;
	<?=$bannerSmallUppercase?>
	margin: 10px 0 0 0;
	<?=$bannerSmallBackground?>;
}

/* DEFAULT BANNER TITLES */
.bannerBig{
	float:left;
	width:100%;
	font-size: <?=$bannerBigSize?>;
	line-height:1.2em;
	font-weight: bold;
	<?=$bannerBigUppercase?>
	color: <?=$bannerBigColor?>;
	<?=$bannerBigBackground?>;
}

.bannerSmall{
	float:left;
	width:100%;
	font-size: <?=$bannerSmallSize?>;
	color: <?=$bannerSmallColor?>;
	<?=$bannerSmallUppercase?>
	<?=$bannerSmallBackground?>;
}


/* BANNER BUTTON */

.bannerButton{
	float:left;
	padding: 8px 15px;
	color:<?=$bannerButtonColor?>;
	background: <?=$bannerButtonBackgroundColor?>;
	text-transform:uppercase;
	text-decoration:none;
	margin:30px 0 0 0;
	transition: transform 0.3s;
}

.bannerButton:hover{
	transform: scale(1.05);
	color:#fff;
}

.bannerButton:active{
	transform: scale(0.8);
}

/* TEXT */
#text{
	background: #fff;
	border-radius: 6px;
	padding: 0 20px;
	margin: 30px 0 0 0;
}

#text p{
	color:#444;
}

.readMore{
	float:right;
	<?=$linkColor?>
	cursor:pointer;
}

#textLoose{
	float:left;
	width:100%;
	padding: 20px 0;
	<?=$textBlockBackground?>
	<?=$textBlockColor?>
	margin: 0 0 20px 0;
}

/* EXTRA LINKS */
.extraLink{
	float:left;
	width:100%;
}
.extraLink span{
	float:left;
	width:100%;
	padding:10px;
	border-bottom:1px dashed #ccc;
	border-right:1px dashed #ccc;
	border-left:1px dashed #ccc;
	text-align:center;
}
.extraLink.nextToAnchor{
	float:left;
	width: auto;
}
.extraLink.nextToAnchor a{
	float:left;
	width: auto;
	background:none;
	padding:0;
}
.extraLink.nextToAnchor a:hover{
	color:#F7941E;
}
.extraLink.nextToAnchor span{
	border:0;
	float:left;
	padding:0;
	width:auto;
	height:auto;
	text-align:left;
	margin:0 0 0 5px;
	background:none;
}

.extraLink.nextToAnchor span::before{
	content: " - ";
}

.homeTopLinks{
	float:left;
	width:100%;
	margin: 0px 0 20px 0px;
}
.homeTopLinks a{
	float:left;
	padding:8px 12px;
	text-decoration:none;
	background: #ddd;
	color:#444;
	width:100%;
	text-align:center;
	
}
.homeTopLinks a:hover{
	background:<?=$resGeneralStyles['menuBackground']?>;
	color:#fff;
}
.homeTopLinks .extraLink{
	height:95px;
	width:19%;
	margin:0 1.25% 10px 0;
}
.homeTopLinks .extraLink.nextToAnchor{
	width:auto;
	height:auto;
}
.homeTopLinks .extraLink.nextToAnchor:nth-of-type(5n){
	float:left;
	margin:0 10px 10px 0;
}
.homeTopLinks .extraLink.nextToAnchor a{
	padding:10px;
	border:0;
	background: <?=$resGeneralStyles['menuBackground']?>;
	color:#fff;
	margin:0;
	width:auto;
	float:left;
}
.homeTopLinks .extraLink.nextToAnchor a:hover{
	text-decoration:underline;
}
.homeTopLinks .extraLink.nextToAnchor span{
	padding:10px 0;
	background:none;
	width:auto;
	height:auto;
}

.homeBottomLinks{
	float:left;
	width:100%;
	margin: 20px 0 0px 0px;
}
.homeBottomLinks a{
	float:left;
	padding:10px 15px;
	text-decoration:none;
	background:#fff;
	text-align:center;
	border: 1px solid <?=$resGeneralStyles['menuBackground']?>;
	margin: 0 10px 0 0;
	width:100%;
}
.homeBottomLinks a:hover{
	background: <?=$resGeneralStyles['menuBackground']?>;
	color:#fff;
	text-decoration:none;
}
.homeBottomLinks .extraLink{
	width:19%;
	margin:0 1.25% 10px 0;
}
.homeBottomLinks .extraLink span{
	height:60px;
	border:0;
	background:rgba(<?=implode(',',hex2rgb($resGeneralStyles['menuBackground']))?>,0.25);
}
.homeBottomLinks .extraLink:nth-of-type(5n){
	float:right;
	margin:0 0 10px 0;
}
.homeBottomLinks .extraLink.nextToAnchor{
	width:auto;
}
.homeBottomLinks .extraLink.nextToAnchor:nth-of-type(5n){
	float:left;
	margin:0 10px 10px 0;
}
.homeBottomLinks .extraLink.nextToAnchor a{
	padding:10px;
	border:0;
	background: <?=$resGeneralStyles['menuBackground']?>;
	color:#fff;
	margin:0;
	width:auto;
	float:left;
}
.homeBottomLinks .extraLink.nextToAnchor a:hover{
	text-decoration:underline;
}
.homeBottomLinks .extraLink.nextToAnchor span{
	padding:10px 0;
	background:none;
	width:auto;
	height:auto;
}


.homeRightLinks{
	float:right;
	width:30%;
	padding:10px 0 0 0;
}
.homeRightLinks a{
	float:left;
	padding:8px 12px;
	text-decoration:none;
	background: #ddd;
	color:#444;
	width:100%;
	text-align:center;
}

.homeRightLinks a:hover{
	background: <?=$resGeneralStyles['menuBackground']?>;
	color:#fff;
}
.homeRightLinks .extraLink{
	margin:0 0 10px 0;
}
.homeRightLinks .extraLink.nextToAnchor{
	width:100%;
	border-bottom:1px solid #ccc;
	padding:0 0 10px 0;
}
.homeRightLinks .extraLink.nextToAnchor a{
	float:left;
	padding:10px;
	background: <?=$resGeneralStyles['menuBackground']?>;
	color:#fff;
}
.homeRightLinks .extraLink.nextToAnchor a:hover{
	text-decoration:underline;
}
.homeRightLinks .extraLink.nextToAnchor span{
	padding:10px 0;
}
.homeRightLinks+div{
	float:left;
	width:70%;
	padding:0 30px 0 0;
}

/* FOOTERLINKS */
.footerLinks{
	float:left;
	width:100%;
	margin:10px 0 0 0;
	text-align:center;
}

.footerLinks .extraLink{
	float:left;
	width: 20%;
	text-align:left;
}
.footerLinks .extraLink a{
	float:left;
	width: 100%;
	background:none;
	padding:0 10px 0 0;
}
.footerLinks .extraLink a:hover{
	color:#F7941E;
}
.footerLinks .extraLink span{
	border:0;
	float:left;
	padding:0 10px 0 0;
	width: 100%;
	height:auto;
	text-align:left;
	margin:0 0 0 0;
	background:none;
}

.footerLinks .extraLink span::before{
	content: none;
}



.footerLinks .extraLink.nextToAnchor:after{
	content: ' | ';
	padding:0 8px 0 8px;
}

.footerLinks .extraLink.nextToAnchor{
	width: auto;
	text-align:left;
}
.footerLinks .extraLink.nextToAnchor a{
	width: auto;
	padding:0;
}
.footerLinks .extraLink.nextToAnchor a:hover{
	color:#F7941E;
}
.footerLinks .extraLink.nextToAnchor span{
	width: auto;
	text-align:left;
	padding:0;
}

.footerLinks .extraLink.nextToAnchor span::before{
	content: ' - ';
	padding:0 4px 0 8px;
}

@media screen and (max-width: 1020px) {
	.homeBottomLinks .extraLink{
		width:48.5%;
	}
	.homeTopLinks .extraLink{
		width:48.5%;
	}
}
@media screen and (max-width: 700px) {
	.homeRightLinks{
		width:100%;
	}
	.homeRightLinks + div{
		width:100%;
		padding:0;
	}
}
@media screen and (max-width: 500px) {
	.homeBottomLinks .extraLink{
		width:100%;
		margin:0 0 10px 0;
	}
	.homeBottomLinks a{
		margin:0;
	}
	.homeBottomLinks .extraLink span{
		height:auto;
	}
	
	.homeTopLinks .extraLink{
		width:100%;
		margin:0 0 10px 0;
	}
	.homeTopLinks a{
		margin:0;
	}
	.homeTopLinks .extraLink span{
		height:auto;
	}
}

/* BLOCK LAYOUTS */
#blocksOne, #blocksTwo, #blocksThree, #blocksFour{
	float:left;
	width:100%;
	margin: 0 0 30px 0;
}

.rowOne, .rowTwo{
	float:left;
	width:100%;
}

/* FIRST BLOCK LAYOUT */
.blockOne{
	float:left;
	width:100%;
	border-bottom: 1px solid #fff;
	height: 300px;
	overflow:hidden;
	position:relative;
}

.blockOne .category{
	float:left;
	width:75%;
	padding: 15px 0;
	text-align:center;
	text-transform: uppercase;
	color:<?=$randomBlogTxtColor?>;
	background: <?=$randomBlogSubColor?>;
	position:absolute;
	left:0;
	top:0;
	transition: all 0.3s;
}

.blockOne .image{
	float:left;
	width:100%;
	height: 160px;
	transition: all 0.3s;
}

.blockOne .shortText{
	float:left;
	width:100%;
	padding: 15px;
	color:<?=$randomBlogTxtColor?>;
	background: <?=$randomBlogMainColor?>;
	transition: all 0.3s;
}

.blockOne .shortText .title{
	float:left;
	width:100%;
	text-transform:uppercase;
	font-size: <?=$randomBlogTitleSize?>;
	color: <?=$randomBlogTitleColor?>;
	margin: 0 0 10px 0;
}

.blockOne .shortText .text{
	float:left;
	width:100%;
}

.blockOne .fadeText{
	background: -moz-linear-gradient(top, rgba(<?=implode(',',$randomBlogFadeColor);?>,0) 0%, rgba(<?=implode(',',$randomBlogFadeColor);?>,1) 50%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(<?=implode(',',$randomBlogFadeColor);?>,0)), color-stop(50%,rgba(<?=implode(',',$randomBlogFadeColor);?>,1)));
	background: -webkit-linear-gradient(top, rgba(<?=implode(',',$randomBlogFadeColor);?>,0) 0%,rgba(<?=implode(',',$randomBlogFadeColor);?>,1) 50%);
	background: -o-linear-gradient(top, rgba(<?=implode(',',$randomBlogFadeColor);?>,0) 0%,rgba(<?=implode(',',$randomBlogFadeColor);?>,1) 50%);
	background: -ms-linear-gradient(top, rgba(<?=implode(',',$randomBlogFadeColor);?>,0) 0%,rgba(<?=implode(',',$randomBlogFadeColor);?>,1) 50%);
	background: linear-gradient(to bottom, rgba(<?=implode(',',$randomBlogFadeColor);?>,0) 0%,rgba(<?=implode(',',$randomBlogFadeColor);?>,1) 50%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00222222', endColorstr='#222222',GradientType=0 );
	bottom: 0;
    height: 25px;
    left: 0;
    position: absolute;
    right: 0;
	transition: all 0.3s;
}

.blockOne:hover .category{
	top: -80px;
}

.blockOne:hover .fadeText{
	opacity:0;
}

.blockOne:hover .image{
	height: 300px;
}

/* SECOND BLOCK LAYOUT */
.blockTwo{
	float:left;
	width:100%;
	margin: 0 0 30px 0;
	color:<?=$randomBlogTxtColor?>;
}

.blockTwo .image{
	float:left;
	width:100%;
	height: 180px;
	margin: 0 0 15px 0;
}

.blockTwo .title{
	float:left;
	width:100%;
	text-transform:uppercase;
	color:<?=$randomBlogTitleColor?>;
	font-size: <?=$randomBlogTitleSize?>;
	font-weight: bold;
	margin: 0 0 15px 0;
}

.blockTwo .text{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
}

.blockTwo a{
	float:left;
	padding: 9px 15px 8px 15px;
	border-radius: 3px;
	border: 1px solid <?=$randomBlogMainColor?>;
	color:<?=$randomBlogMainColor?>;
	text-transform:uppercase;
	text-decoration: none;
	transition: all 0.3s;
}

.blockTwo a:hover{
	color:#fff;
	background: <?=$randomBlogMainColor?>;
}

/* THIRD BLOCK LAYOUT */
#blocksThree .columnBlock{
	width:100%;
	max-width:1280px;
	float:left;
}

.blockThree{
	display:block;
	float:left;
	width:30%;
	background:#fff;
	margin-bottom:20px;
	background: gray;
}

.gutter-sizer{
	width: 3%; 
}

@media (max-width: 800px) {
	.blockThree{
		width:47%;
	}
}

@media (max-width: 500px) {
	.blockThree{
		width:100%;
	}
	.gutter-sizer{
		width: 0%; 
	}
}

.blockThree .image{
	float:left;
	width:100%;
}

.blockThree .shortText{
	background:#fff;
	padding:15px;
	float:left;
	width:100%;
}

.blockThree .shortText .title{
	color: #1eaedb;
	font-size: 1.3em;
	float:left;
	width:100%;
	margin: 0 0 10px 0;
}

.blockThree .shortText .text{
	float:left;
	width:100%;
	color: #444;
}

.blockThree .blockLogo{
	background: url(../images/logo.svg) no-repeat center center #eee;
	float:left;
	width:100%;
	height: 50px;
}

/* FOURTH BLOCK LAYOUT */
.blockFour{
	float:left;
	width:32%;
	margin: 0 2% 0 0;
	border-bottom: 1px solid #fff;
	height: 300px;
	overflow:hidden;
	position:relative;
	background-size:110% !important;
	transition: background 0.3s;
}

.blockFour:nth-of-type(3n){
	float:right;
	margin:0;
}

.blockFour:hover{
	background-size:120% !important;
}

.blockFour .shortText{
	float:left;
	width:100%;
	padding: 15px;
	color:<?=$randomBlogTxtColor?>;
	background: <?=$randomBlogMainColor?>;
	transition: all 0.3s;
	position:absolute;
	bottom:0;
}

.blockFour .shortText .title{
	float:left;
	width:100%;
	text-transform:uppercase;
	font-size: <?=$randomBlogTitleSize?>;
	color: <?=$randomBlogTitleColor?>;

}

.blockFour .shortText .text{
	float:left;
	width:100%;
	opacity:0;
	transition: all 0.3s;
	height:0;
}
.blockFour:hover .shortText .text{
	opacity:1;
	height: 45px;
	overflow:hidden;
	margin: 10px 0 0px 0;
}

/* FIFTH BLOCK LAYOUT */

#blocksFive{
	float:left;
	width:100%;
}
.blockFive{
	float:left;
	width:49%;
	margin:20px 2% 20px 0;
}
.blockFive:nth-of-type(3n + 2){
	margin:20px 0 20px 0;
}
.blockFive:nth-of-type(3n){
	width:100%;
}
.blockFive .blogImg{
	width:100%;
	background-size:cover !important;
	height:250px;
	float:left;
}
.blockFive .shortText{
	float:left;
	width:90%;
	padding:2%;
	margin:-40px 0 0  0;
	background:#fff;
}
.blockFive .title{
	float:left;
	width:100%;
}
.blockFive .title a{
	float:left;
	font-size: <?=$randomBlogTitleSize?>;
	color: <?=$randomBlogTitleColor?>;
	margin: 0 0 10px 0;
	text-decoration:none;
	line-height:35px;
	box-sizing:border-box;
	font-style: italic;
	font-weight:500;
	padding:0 0 3px 0;
}
.blockFive .title a:hover{
	border-bottom:3px solid <?=$randomBlogTitleColor?>;
	padding:0;
}
.blockFive .text{
	float:left;
	width:100%;
	margin:20px 0;
}
.blockFive .category{
	float:left;
	width:100%;
	font-size:0.8em;
}
.blogLink{
	text-decoration:none;
	background:<?=$randomBlogTitleColor?>;
	padding:10px;
	color:#fff;
	float:left;
}
.blogLink:hover{
	color:#fff;
	background:<?=$randomBlogMainColor?>;
}

/* SEVENTH BLOG LAYOUT - has layout of linksys cats*/
#blocksSeven{
	float:left;
	width:100%;
}

/* EIGHTH BLOG LAYOUT */
#blocksEight{
	float:left;
	width:100%;
	display:flex;
}

#blocksEight a{
	float:left;
	width:25%;
	background-color: <?=$randomBlogMainColor?>;
	background-size: cover;
	background-position: center center;
	position:relative;
	overflow:hidden;
}

#blocksEight a span.roundFX{
	position:absolute;
	width:300px;
	height:300px;
	transform: scale(0);
	-webkit-transform: scale(0);
	top:-150px;
	right:-150px;
	border-radius:100%;
	background: rgba(0,0,0,0.8);
	z-index:1;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	transition-delay: 0.3s;
	-webkit-transition-delay: 0.3s;
}

#blocksEight a span.blogName{
	opacity:0;
	float:left;
	width:100%;
	text-align:center;
	padding:100px 20px;
	color:#fff;
	position:relative;
	z-index:2;
	font-size: <?=$randomBlogTitleSize?>;
	transition: opacity 0.3s;
	-webkit-transition: opacity 0.3s;
	transition-delay: 0s;
	-webkit-transition-delay: 0s;
}

#blocksEight a:hover span.blogName{
	opacity:1;
	transition-delay: 0.3s;
	-webkit-transition-delay: 0.3s;
}

#blocksEight a:hover span.roundFX{
	transform: scale(4);
	-webkit-transform: scale(4);
	transition-delay: 0s;
	-webkit-transition-delay: 0s;
}

@media (max-width: 800px) {
	#blocksEight{
		display:block;
	}
	#blocksEight a{
		float:left;
		width:50%;
	}
}

/* CAT PAGE CSS */
.categoryText{
	float:left;
	width:100%;
	margin: 0 0 30px 0;
}

.blogsContainer{
	float:left;
	width:100%;
	padding: 0;
	margin: 0 0 30px 0;
	border-top: 1px dashed #ccc;
}

@media (min-width: 950px) {
	/* HALF PAGE BLOGCAT */
	.categoryText.halfPage{
		width:49%;
	}

	.blogsContainer.halfPage{
		float:right;
		width:49%;
	}

	.blogsContainer.halfPage a .blogOverviewImage{
		min-height:100px;
	}

	/* 2/3 PAGE BLOGCAT */
	.categoryText.twoThirdPage{
		width:69%;
	}

	.blogsContainer.twoThirdPage{
		float:right;
		width:29%;
	}

	.categoryText.twoThirdPage{
		width:69%;
	}

	.blogsContainer.twoThirdPage a .shortText{
		width:100%;
		padding:0;
	}

	.blogsContainer.twoThirdPage a .blogOverviewImage{
		width:100%;
		min-height:100px;
	}

	.blogsContainer.twoThirdPage.noText a .shortText .text{
		display:none;
	}

	.blogsContainer.twoThirdPage.noImage a .blogOverviewImage{
		display:none;
	}
	
	.categoryText.ticketLeft{
		float:right;
		width:39%;
	}
	
	.blogsContainer.ticketLeft{
		float:left;
		width:59%;
		border:none;
	}
	.blogsContainer.ticketLeft .blogOverviewBlog{
		float:left;
		padding:0;
		margin:1px 0 20px 0;
		border-top: 1px dashed #ccc;
		border-bottom: 1px dashed #ccc;
	}
	.blogsContainer.ticketLeft .shortText{
		float:right;
		padding: 20px 3% 0 !important;
		width:59%;
	}
	.blogsContainer.ticketLeft .blogOverviewImage{
		float:left;
		height:200px;
		width:40%;
		margin:-1px 0;
	
	}
	.blogsContainer.ticketLeft .readMore{
		float:right;
		margin:-40px 0 0;

	}
}

/* DEFAULT BLOG PAGE */
.blogsContainer a{
	float:left;
	width:100%;
	padding: 30px;
	border-bottom: 1px dashed #ccc;
	transition: background 0.3s;
	color:#444;
}

.blogsContainer a:hover{
	background:#eee;
}

@media (max-width: 950px) {
	.blogsContainer a .blogOverviewImage{
		min-height: 100px;
	}
}

.blogsContainer a .blogOverviewImage{
	float:right;
	width:20%;
}
.displayFlex{
	display:flex;
}
.blogsContainer a .shortText{
	float:left;
	width:80%;
	padding: 0 30px 0 0;
}

.blogsContainer a .title{
	float:left;
	width:100%;
	font-size: 1.5em;
	text-transform:uppercase;
	font-weight: bold;
	overflow:hidden;
	margin: 0 0 15px 0;
}

.blogsContainer a .readMore{
	float:left;
	padding: 8px 15px;
	color:#fff;
	background: <?=$randomBlogMainColor?>;
	margin: 20px 0 0 0;
	clear:left;
}

/* BLOG PAGE CSS */
.blogImage{
	float:right;
	margin: 0 0 20px 20px;
}

@media (min-width: 500px) {
	.blockOne{
		width: 50%;
		border-right: 1px solid #fff;
	}
	
	.blockOne:nth-of-type(2n){
		border-right: 0px solid #fff;
	}
	
	.blockOne:nth-of-type(3n){
		display:none;
	}
	
	.blockOne:nth-of-type(4n){
		display:none;
	}
	
	.blockTwo{
		width: 50%;
		padding: 0 2% 0 0;
	}
	
	.blockTwo:nth-of-type(2n){
		padding: 0 0 0 2%;
	}
	
	.blockTwo:nth-of-type(3n){
		display:none;
	}
}

@media (min-width: 750px) {
	.blockOne{
		width: 33.333333333%;
		border-bottom: 0px solid #fff;
		border-right: 1px solid #fff;
	}
	
	.rowOne{
		border-bottom: 1px solid #fff;
	}
	
	.blockOne:nth-of-type(2n){
		border-right: 1px solid #fff;
	}
	
	.blockOne:nth-of-type(3n){
		display:block;
	}
	
	.blockTwo{
		width: 33.333333333%;
	}
	
	.blockTwo:nth-of-type(2n){
		padding: 0 2% 0 0;
	}
	
	.blockTwo:nth-of-type(3n-1){
		padding: 0 1%;
	}
	
	.blockTwo:nth-of-type(3n){
		display:block;
		padding: 0 0 0 2%;
	}
}

@media (min-width: 1000px) {
	.blockOne{
		width:25%;
	}
	
	.blockOne:nth-of-type(4n){
		border-right: 0px;
		display:block;
	}
}

/* BLOG LAYOUT 2 */
#textfield{
	width:65%;
	float:left;
	margin:0 2% 0 0;
}
.containerblogs{
	float:left;
	width:32%;
	
}
.layoutTypeBlog2{
	float:left;
	width:100%;
	padding:20px 0;
	border-top:2px dashed #8995A1;
	font-size: 1em;
}
.layoutTypeBlog2:last-of-type{
	float:left;
	border-bottom:2px dashed #8995A1;
	
}
.layoutTypeBlog2 a{
	float:left;
	width:100%;
	text-decoration:none;
	
	<?=$mainFontColor?>
}
.layoutTypeBlog2 .shortText{
	float:left;
	width:70%;
	padding:0 1% 0 0;
	
}
.layoutTypeBlog2 .shortText .title{
	float:left;
	width:100%;
	<?=$mainFontSize?>
	<?=$mainFontWeight?>
	<?=$mainFontColor?>
	margin:0  0 10px 0;
}
 .layoutTypeBlog2 .blogImage{
	float:left;
	height: 96px;
	width: 30%;;
	padding:0;
	margin:0 !important;
	background-size:cover;
}
 .layoutTypeBlog2 .readMore{
	float:left;
	background:<?=$randomBlogTitleColor?>;
	color:#fff;
	padding:2% 4.7%;
	margin:28px 0 0 0;
}
.layoutTypeBlog2 .readMore:hover{
	color:#fff;
	background:<?=$randomBlogMainColor?>;
}

.blogContainer.ticketLeft{
	float:left;
	width:49%;
}

/* PLUGIN BOXES */
.pluginBox{
	float:right;
	width:30%;
	clear:right;
	margin:20px 0 20px 20px;
	min-width:320px;
}

.pluginBox.landingspages a{
	float:left;
	opacity:0.8;
	margin: 0 10px 10px 0;
	text-decoration:none;
	<?=$footerBackground?>
	padding: 8px 16px 10px;
	<?=$footerColor?>
	border-radius:6px;
	transition: all 0.3s;
}

.pluginBox.landingspages a:hover{
	opacity:1;
}

.pluginBox.gallery, .pluginBox.productfeed, .pluginBox.randomBlogs, .pluginBox.shop{
	width:100%;
	margin:20px 0;
}

.pluginBox.randomBlogs .container{
	width:100%;
}

/* FOOTER */
#footer{
	float:left;
	width:100%;
	<?=$footerBorder?>
	padding: 20px 0;
	text-align:center;
	<?=$footerBackground?>
	<?=$footerColor?>
}

#footer a{
	<?=$footerColor?>
}

/* CONTACT CSS */

#mainContact{
	float:left;
	width:100%;
	margin:20px 0 0 0;
}

#mainContact .formTitle{
	float:left;
	width:100%;
	text-align:center;
	<?=$h2size?>
	<?=$h2weight?>
	margin: 0 0 20px 0;
}

#mainContact input[type="text"]{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
}

#mainContact textarea{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
}

#mainContact select{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
}

#mainContact label{
	cursor:pointer;
}

#mainContact label.checkbox{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
	font-weight: normal;
}

#mainContact label.radioButton{
	float:left;
	width:20%;
	margin: 0 0 15px 0;
	font-weight: normal;
}

#mainContact input[type="checkbox"], #mainContact input[type="radio"]{
	margin: 0 8px 0 0;
}

#mainContact input[type="submit"]{
	float:left;
	width:100%;
	padding:15px 0;
	height: auto;
	margin:0;
	background: <?=$randomBlogMainColor?>;
	border:1px solid <?=$randomBlogMainColor?>;
	line-height: 1em;
	font-size: 1.2em;
	color:#fff;
	transition: box-shadow 0.1s;
}

#mainContact input[type="submit"]:hover{
	box-shadow: 0px 0px 0 2px rgba(255,255,255,0.5) inset;
}

#mainContact input[type="submit"]:active{
	box-shadow: 0px 0px 0 30px rgba(255,255,255,0.5) inset;
}


/* PRODUCT FEED CSS */
.productsContainer{
	float:left;
	width:100%;
}

.productBlock{
	float:left;
	width:32%;
	padding:15px;
	border:1px solid #ccc;
	border-radius:3px;
	margin: 0 2% 20px 0;
}

.productBlock:nth-of-type(3n){
	float:right;
	margin: 0 0 20px 0;
}

.productTitle{
	float:left;
	width:100%;
	font-size: 1.5em;
	text-align:center;
	line-height: 1.2em;
	margin: 0 0 10px 0;
	height:80px;
	overflow:hidden;
}

.productImageContainer{
	float:left;
	width:100%;
	text-align:center;
	height:200px;
	overflow:hidden;
	margin: 0 0 10px 0;
}

.productImageContainer img{
	max-height:100%;
	max-width:100%;
}


.productPrice{
	float:left;
	width:100%;
	font-size: 2em;
	text-align:center;
	font-weight:bold;
	margin: 0 0 10px 0;
}

/* Notice CSS */
.notice{
	position:fixed;
	bottom:0;
	width:100%;
	text-align:center;
	padding:15px 80px;
	color:<?=$noticeTextColor?>;
	<?=$noticeBackgroundColor?>
	border-top:1px solid <?=$noticeMainColor?>;
}

#closeNotice{
	position:absolute;
	right:20px;
	right:20px;
	top: 15px;
	cursor:pointer;
}

#openNotice{
	position:fixed;
	right:20px;
	bottom: 0;
	cursor:pointer;
	padding: 10px;
	border-radius: 3px 3px 0 0;
	background: <?=$noticeMainColor?>;
	color:<?=$noticeTextColor?>;
}

/* POPUP CSS */
.popup{
	float:left;
	width:<?=$popupSize?>;
	color:<?=$popupTextColor?>; 
	<?=$siteWidth?>
	padding:20px;
	border-radius:<?=$popupBorderRadius?>;
	-webkit-border-radius:<?=$popupBorderRadius?>;
	background:#fff;
}

#closePopup{
	position:absolute;
	right:-5px;
	top: -5px;
	cursor:pointer;
	color: <?=$popupCloseColor?>;
	background: <?=$popupCloseBg?>;
	border-radius:<?=$popupBorderRadius?>;
	-webkit-border-radius:<?=$popupBorderRadius?>;
}

#closePopup span{
	float:left;
	width:100%;
	padding: 2px 10px;
	border-radius:<?=$popupBorderRadius?>;
	-webkit-border-radius:<?=$popupBorderRadius?>;
}

#closePopup:hover span{
	background: rgba(255,255,255,0.3);
}

#closePopup:active span{
	background: rgba(0,0,0,0.3);
}

/* GALLERY CSS */
.thumb {
    background-size: cover !important;
    cursor: pointer;
    float: left;
    height: 300px;
    width: 25%;
}

@media screen and (max-width: 700px) {
	.thumb{
		width:33.3333333%;
	}
}

@media screen and (max-width: 550px) {
	.thumb{
		width:50%;
	}
}

@media screen and (max-width: 360px) {
	.thumb{
		width:100%;
	}
}


/* NEWS OVERVIEW */
.newsItem{
	text-decoration:none;
	margin:0 0 0 0;
	padding: 20px;
	border-top: 1px solid #ddd;
	float:left;
	width:100%;
}

.newsItem:last-of-type{
	border-bottom: 1px solid #ddd;
}

.newsLeft{
	float:left;
	width:25%;
	margin: 0 5% 0 0;
}

.newsLeft img{
	display:block;
	max-width:100%;
}

.newsRight{
	float:right;
	width:70%;
}

.newsTitle{
	float:left;
	font-size:16px;
	color: #121212;
	font-family:'Oswald',sans-serif;
	line-height:1em;
}

.newsDate{
	float:right;
	color: #393533;
}

.newsDesc{
	float:left;
	width:100%;
	color: #4d4d4d;
}

.newsItem:hover{
	background: #ddd;
}

.viewNews{
	float:left;
	width:100%;
	color:<?=$newsButtonColor?>;
	border-radius: <?=$newsButtonBorderRadius?>;
	-webkit-border-radius: <?=$newsButtonBorderRadius?>;
	background: <?=$newsButtonBackground?>;
	<?=$subFontFamily?>
	line-height:1em;
	text-align:center;
	margin:20px 0 0 0;
	text-decoration: none;
}

.viewNews span{
	float:left;
	width:100%;
	padding: 15px 0;
	text-align:center;
	transition: background 0.3s;
}

.viewNews:hover{
	color:<?=$newsButtonColor?>;
	text-decoration:none;
}
.viewNews:hover span{
	background: rgba(255,255,255,0.2);
}
.viewNews:active span{
	background: rgba(0,0,0,0.2);
}

/* LINKSYS CSS */
.linksysText{
	float:left;
	width:100%;
}

.linksContainer{
	float:left;
	width:100%;
	border-top: 1px dashed #ccc;
}

.singleLink{
	float:left;
	width:100%;
	padding:20px 0;
	border-bottom: 1px dashed #ccc;
}

.singleLink .linksysLeft{
	float:left;
	width:20%;
	padding: 0 20px 0 0;
}

.singleLink .linksysRight{
	float:right;
	width:80%;
}

.linkTitle{
	float:left;
	width:100%;
	font-weight: bold;
	font-size:16px;
	margin: 0 0 15px 0;
}

.linkShortDesc{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
}

.linkRewrite{
	float:left;
	padding:10px 12px 12px;
	line-height:1em;
	border:1px solid <?=$resGeneralStyles['linkColor']?>;
	text-decoration:none;
	border-radius:3px;
	transition: all 0.3s;
}

.linkRewrite:hover{
	color:#fff;
	background:  <?=$resGeneralStyles['linkColor']?>;
}


.linkRow{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
}

/* ADD LINK PAGE */
.fancyInputs{
	float:left;
	width:100%;
}

.fancyInputs span{
	float:left;
	width:100%;
	margin: 0 0 15px 0;
}

.fancyInputs input, .fancyInputs textarea, .fancyInputs select{
	/*max-width:500px;*/
	width:100%;
}

.fancyInputs input[type="submit"]{
	float:left;
	width:100%;
	padding:15px 0;
	height: auto;
	margin:0;
	background: <?=$randomBlogMainColor?>;
	border:1px solid <?=$randomBlogMainColor?>;
	line-height: 1em;
	font-size: 1.2em;
	color:#fff;
	transition: box-shadow 0.1s;
}

.fancyInputs input[type="submit"]:hover{
	box-shadow: 0px 0px 0 2px rgba(255,255,255,0.5) inset;
}

.fancyInputs input[type="submit"]:active{
	box-shadow: 0px 0px 0 30px rgba(255,255,255,0.5) inset;
}

/* LINKSYS OVERVIEW */
.linksys_overview{
	float:left;
	width:100%;
}

.linksys_overview ul{
	float:left;
	width:100%;
	padding:0;
	margin:20px 0 10px;
	list-style:none;
}

.linksys_overview ul li{
	float:left;
	padding:0 10px;
	border-right: 2px solid #9D8E91;
	font-size:17px;
	margin:0 0 10px 0;
}

.linksys_overview ul li a{
	text-decoration:none;
	color: #888;
	transition: all 0.3s;
}

.linksys_overview ul li a.activeCat{
	color:#202020;
	border-bottom: 2px solid #9D8D90;
}

.linksys_overview ul li a:hover{
	color:#202020;
	border-bottom: 2px solid #9D8D90;
}

.linksys_overview a.linksysCatBlock{
	float:left;
	width:20%;
	border:1px solid #fff;
	padding:10px;
	height:160px;
	position:relative;
	background-size:cover;
	overflow:hidden;
	background-position: 0 0;
	background-repeat: no-repeat;
	background-color: #202020;
	transition: background-position 0.5s;
}

.linksys_overview a.linksysCatBlock:hover{
	background-position: 0 -20px;
}

.linksys_overview a.linksysCatBlock span{
	position: absolute;
	bottom:-100px;
	width:100%;
	text-align:left;
	padding:8px 12px;
	color:#fff;
	background:<?=$randomBlogMainColor?>;
	left:0;
	transition: bottom 0.3s;
}

.linksys_overview a.linksysCatBlock:hover span{
	bottom:0;
}

.linksys_overview a.linksysCatBlock.activeCat{
	background-position: 0 -20px;
}

.linksys_overview a.linksysCatBlock.activeCat span{
	bottom:0;
}

/* LINKSYS DETAILPAGE */

.linksysDetail{
	float:left;
	width:100%;
	border-bottom: 1px solid #555;
	padding: 0 0 20px 0;
}

.linksysDetail .linksysLeft{
	float:left;
	width:25%;
	padding: 0 20px 0 0;
}

.linksysDetail .linksysRight{
	float:right;
	width:75%;
}

@media screen and (max-width: 800px) {
	.linksys_overview a.linksysCatBlock{
		width:33.33333%;
	}
}

@media screen and (max-width: 600px) {
	.singleLink .linksysLeft{
		width:100%;
		padding: 0;
	}

	.singleLink .linksysRight{
		width:100%;
	}
	
	.linksysDetail .linksysLeft{
		width:100%;
		padding: 0;
	}

	.linksysDetail .linksysRight{
		width:100%;
	}
	
	.linksys_overview a.linksysCatBlock{
		width:50%;
	}
}

@media screen and (max-width: 400px) {
	.linksys_overview a.linksysCatBlock{
		width:100%;
	}
}


.productBlock{
	background:#fff;
}

.productBlock:hover{
	border: 1px solid #000;
}

.pagination{
	float:left;
	width:100%;
	list-style: none;
	padding:20px 0 0 0;
	margin:20px 0 0 0;
	border-top: 1px dashed #ccc;
}

.pagination li{
	float:left;
}

.pagination li a{
	float:left;
	padding:6px 12px;
	background: #171717;
	color:#fff;
	cursor:pointer;
	transition: background 0.3s;
	-webkit-transition: background 0.3s;
	margin: 0 10px 10px 0;	
}

.pagination li.active a{
	background: '.$resGeneralStyles['menuBackground'].';
	cursor:default;
}
.pagination li a:hover{
	text-decoration:none;
	background: '.$resGeneralStyles['menuBackground'].';
}
