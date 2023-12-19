<?php
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_general");
$resSettings = mysqli_fetch_assoc($getSettings);

$getSettingsMenu = mysqli_query($res1 ,"SELECT menuFullWidth, headerFixed FROM settings_style");
$resSettingsMenu = mysqli_fetch_assoc($getSettingsMenu);

$getSettingsLinkbuilding = mysqli_query($res1 ,"SELECT * FROM settings_linkbuilding");
$resSettingsLinkbuilding = mysqli_fetch_assoc($getSettingsLinkbuilding);

$getSettingsNews = mysqli_query($res1 ,"SELECT * FROM settings_nieuws");
$resSettingsNews = mysqli_fetch_assoc($getSettingsNews);

if($resSettingsMenu['menuFullWidth']){
	define('MENU','fullWidth');
}else{
	define('MENU','');
}

if($resSettingsMenu['headerFixed']){
	define('HEADERFIXED','class="headerFixed"');
}else{
	define('HEADERFIXED','');
}

if($resSettingsLinkbuilding['position']==1){
	define('LINKLOCATION','footer');
}elseif($resSettingsLinkbuilding['position']==2){
	define('LINKLOCATION','right');
}elseif($resSettingsLinkbuilding['position']==3){
	define('LINKLOCATION','bottom');
}elseif($resSettingsLinkbuilding['position']==4){
	define('LINKLOCATION','topHeader');
}elseif($resSettingsLinkbuilding['position']==5){
	define('LINKLOCATION','top');
}

define('SITEMAP',$resSettings['sitemap']);
define('SITENAAM',$resSettings['websitename']);
define('SITEURL',$resSettings['websiteurl']);
define('SITEMAIL',$resSettings['emailaddress']);
define('SITEMAILBCC',$resSettings['bccaddress']);
define('BLOG_PATH',$resSettings['blogpath']);
define('LINKSYS_PATH',$resSettings['linksyspath']);
define('LOGO',HTTP_USERFILES.$resSettings['logo']);
define('NOTFOUND',$resSettings['notFound']);
define('NEWS_PATH', $resSettingsNews['newspath']);