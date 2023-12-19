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

.categoryText{
	float:left;
	width:100%;
	margin: 0 0 0 0;
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