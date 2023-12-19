<?php

error_reporting(0);
if ($_SERVER['REMOTE_ADDR'] == '77.174.163.233'){
	error_reporting(E_ALL);
	ini_set("display_errors",1);
}else{
	error_reporting(0);
	ini_set("display_errors",0);
}

ob_start();
session_start();

require_once ('includes/prefs.php');

require_once (DIR_SYSTEM . 'includes/database.php');
require_once (DIR_SYSTEM . 'includes/settings.php');
require_once (DIR_SYSTEM . 'includes/phpmailer/class.phpmailer.php');
//require_once (DIR_SYSTEM . 'includes/phpInputFilter/class.inputfilter.php');
require_once (DIR_SYSTEM . 'includes/session.inc.php');
require_once (DIR_SYSTEM . 'includes/function.php');
require_once (DIR_SYSTEM . 'includes/image.php');

if(empty($_SESSION['language_id'])){
	$_SESSION['language_id'] = 2;
}

if(!empty($_GET['lang'])){
	$_SESSION['language_id'] = $_GET['lang'];
	header('Location: '.SITEURL);
}

if(!empty($_GET["a"])){
	if(strstr($_GET["a"], ".html")){
		$request = substr($_GET["a"], 0, strlen($_GET["a"]) - 5);
	}else{
		if(NOTFOUND == 1){
			header ('HTTP/1.1 301 Moved Permanently');
			header ('Location: '.SITEURL);
			exit();
		}else{
			header("HTTP/1.1 404 Not Found"); 
			include("404.php");
			exit();
		}
	}
}

if(isset($request)){
	$array = explode("/", $request);
}else{
	$array = explode("/","");
}

if( isset($_GET["a"]) && !in_array($_GET["a"],array("","index")) && strpos($_GET["a"],".html") === false) {
	if(NOTFOUND == 1){
		header ('HTTP/1.1 301 Moved Permanently');
		header ('Location: '.SITEURL);
		exit();
	}else{
		header("HTTP/1.1 404 Not Found"); 
		include("404.php");
		exit();
	}
}


if (preg_match('@\?@i',$_SERVER['REQUEST_URI'])){
	if(NOTFOUND == 1){
		header ('HTTP/1.1 301 Moved Permanently');
		header ('Location: '.SITEURL);
		exit();
	}else{
		header("HTTP/1.1 404 Not Found"); 
		include("404.php");
		exit();
	}
}

if ($array[0]==""){
	$array[0]="index";
}

$checkPages = mysqli_query($res1, "SELECT * 
								   FROM sitetree 
								   LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id
								   WHERE sitetree_language.rewrite = '" . realescape($array[0]) ."' 
								   AND sitetree_language.language_id='".$_SESSION['language_id']."' 
								   AND sitetree.visible = 1");
								   
if(mysqli_num_rows($checkPages) && empty($array[1])){
	while ($row = mysqli_fetch_assoc($checkPages)){
		$id = $row['id'];
		$parent = $row['parent'];
		$title = $row['title'];
		$seodesc = $row['seodesc'];
		$seokey = $row['seokey'];
		if ($row['seotitle']!=""){
			$seotitle = $row['seotitle'];
		} else {
			$seotitle = $row['title'].' | '.SITENAAM;
		}
	}
}elseif($array[0] == BLOG_PATH){
	$row = false;
	
	$checkBlogs = mysqli_query($res1 ,"SELECT * 
									   FROM blogs_language 
								       WHERE rewrite = '" . realescape($array[1]) . "'");
	if(mysqli_num_rows($checkBlogs)){
		$row = mysqli_fetch_assoc($checkBlogs);	
		$id = $row['blogID'];
		if($row["seotitle"]==""){
			$seotitle = $row["naam"].' | '.SITENAAM;
		}else{
			$seotitle = $row["seotitle"];
		}
		$seodesc = $row["seodesc"];
		$seokey = $row["seokey"];
	}else{
		$checkBlogCats = mysqli_query($res1 ,"SELECT * FROM blog_cat_language WHERE rewrite = '".realescape($array[1])."'");
		if(mysqli_num_rows($checkBlogCats))
		{	
			$id = $row['catID'];
			$row = mysqli_fetch_assoc($checkBlogCats);
			if($row["seotitle"]==""){
				$seotitle = $row["naam"].' | '.SITENAAM;
			}else{
				$seotitle = $row["seotitle"];
			}
			$seodesc = $row["seodesc"];
			$seokey = $row["seokey"];			
		}
	}
	
	if(!$row)
	{
		if(NOTFOUND == 1){
			header ('HTTP/1.1 301 Moved Permanently');
			header ('Location: '.SITEURL);
			exit();
		}else{
			header("HTTP/1.1 404 Not Found"); 
			include("404.php");
			exit();
		}
	}
}elseif($array[0] == LINKSYS_PATH){
	$row = false;	
	$checkLinksys = mysqli_query($res1 ,"SELECT * FROM linksys_link WHERE rewrite = '" . realescape($array[1]) . "'");
	if(mysqli_num_rows($checkLinksys)){
		$row = mysqli_fetch_assoc($checkLinksys);	
		$id = $row['id'];
		$seotitle = $row["title"].' | '.SITENAAM;
		$seodesc = $row["shortdesc"];
		$seokey = $row["searchwords"];
	}else{
		$result = mysqli_query($res1 ,"SELECT * FROM linksys_cat WHERE rewrite = '".$array[1]."'");
		if(mysqli_num_rows($result))
		{	
			$id = $row['id'];
			$row = mysqli_fetch_assoc($result);
			if($row["seotitle"]==""){
				$seotitle = $row["title"].' | '.SITENAAM;
			}else{
				$seotitle = $row["seotitle"];
			}
			$seodesc = $row["seodesc"];
			$seokey = $row["seokey"];			
		}
	}
	
	if(!$row)
	{
		if(NOTFOUND == 1){
			header ('HTTP/1.1 301 Moved Permanently');
			header ('Location: '.SITEURL);
			exit();
		}else{
			header("HTTP/1.1 404 Not Found"); 
			include("404.php");
			exit();
		}
	}
}elseif($array[0] == NEWS_PATH && isset($array[1])){
	$row = false;	
	$checkNews = mysqli_query($res1 ,"SELECT * FROM  news_language WHERE rewrite = '" . realescape($array[1]) . "'");
	if(mysqli_num_rows($checkNews)){
		$row = mysqli_fetch_assoc($checkNews);	
		$id = $row['id'];
		if($row["seotitle"]==""){
			$seotitle = $row["title"].' | '.SITENAAM;
		}else{
			$seotitle = $row["seotitle"];
		}
		$seodesc = $row["seodesc"];
		$seokey = $row["seokey"];
	}
	
	if(!$row)
	{
		if(NOTFOUND == 1){
			header ('HTTP/1.1 301 Moved Permanently');
			header ('Location: '.SITEURL);
			exit();
		}else{
			header("HTTP/1.1 404 Not Found"); 
			include("404.php");
			exit();
		}
	}
}else{
	if(NOTFOUND == 1){
		header ('HTTP/1.1 301 Moved Permanently');
		header ('Location: '.SITEURL);
		exit();
	}else{
		header("HTTP/1.1 404 Not Found"); 
		include("404.php");
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//NL" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
	<head>
		<base href="<?=SITEURL?>">
		<!-- Mobile Specific Metas -->
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
		<?php
		if ($seotitle!=""){
			echo ' <title>'.utf8_encode($seotitle).'</title>
			<meta name="description" content="'.utf8_encode($seodesc).'" />
			<meta name="keywords" content="'.utf8_encode($seokey).'" />';
		}else{
			echo '<title>'.utf8_encode($title).' | '.SITENAAM.'</title>
			<meta name="description" content="" />
			<meta name="keywords" content="" />';
		 }
		?>

        <!-- JQUERY -->
		<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
		
		<!-- JS FILES NEEDED AT TOP -->
		<script src="js/mTruncate.js" type="text/javascript"></script>
		
		<!--[if lt IE 9]>
		<link href="css/style-ie8.css" rel="stylesheet" type="text/css" />
		<![endif]-->


		<!-- FONT FILES -->
		<?php include('includes/plugin_customFonts.php'); ?>
		
		<?php include('includes/plugin_headerTags.php'); ?>
		<?php include('includes/plugin_richData.php'); ?>
		
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Ek+Mukta:400,500,600,700" rel="stylesheet">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script>
		  var map;
		  var myLatLng = {lat: 51.2041188, lng: 5.7430005};
		  function initMap() {
			map = new google.maps.Map(document.getElementById('mapsContainer'), {
			  center: myLatLng,
			  zoom: 14
			});
			var marker = new google.maps.Marker({
			  position: myLatLng,
			  map: map,
			  title: 'van de Kruijs garageboxen & opslag'
			});
		  }
		</script>
	</head>
	<body>
		<div id="container">
			<div id="fullContainer">
				<div id="headerContainer">
					<div id="logo">
						<a href="/"><img src="images/logo.png" alt="Logo"/></a>
					</div>					
					<div class="menudivider">
						<div class="contactPhone">
							<span><a href="https://www.vd-kruijs.nl/contact.html">CONTACT</a></span><br/>
							<i class="fa fa-phone"></i>
							<p><a href="tel:0625010024">06 - 2501 0024</a></p>
						</div>
					</div>
				</div>

								<?php
				if ($array[0]=="" || $array[0]=="index"){
					include ("includes/module_homepage.php");
				}elseif ($array[0]==BLOG_PATH && $array[1]!=""){
					include ("includes/module_blog.php");
				}elseif ($array[0]==LINKSYS_PATH && $array[1]!=""){
					include ("includes/module_linksys.php");
				} else {
					include ("includes/module_page.php");
				}
				?>
					<div id="footer">
						<div id="footerContent">
						<div class="footerVertical">
							<p class="verticalHeader">CONTACT</p>
							<p class="verticalContent"><a href="contact.html">Afspraak maken</a></p>
						</div>
						<div class="footerVertical">
							<p class="verticalHeader">LOCATIES</p>
							<p class="verticalContent">Stramproy</p>
						</div>
						<div class="footerVertical">
							<p class="verticalHeader">OVER VANDEKRUIJS</p>
							<a href="blog/opslagruimte-huren.html">Opslag huren</a><br/>
							<a href="https://www.vd-kruijs.nl/webpartner-overzicht.html">Webpartner-overzicht</a></br>
							<a href="https://www.vd-kruijs.nl/privacy.html">Privacy</a>
							</p>
						</div> 
						<div class="footerVertical">
							<p class="verticalHeader">CONTACT</p>
							<p class="verticalContent">
								Vd-Kruijs.nl</br>
								Ellerweg 6 / Ellerweg 7b </br>
								6039 RD Stramproy</br>
								Gemeente Weert
							</p>
						</div>
					</div>
				</div>
				
			</div>	
		</div>	
				<?php include ("includes/plugin_notice.php");?>
		<?php include ("includes/plugin_popup.php");?>
		
		<!-- MISC. VAR. -->
		<input type="hidden" name="maxLines" value="<?=$array[0]?>" />
		
		<!-- CSS FILES -->
		<link href="css/animate.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/raleway.css" />
		<link rel="stylesheet" href="css/lightbox.css" />
		<link rel="stylesheet" href="css/jquery.bxslider.css" />
		
		<!-- CSS FILE FOR CUSTOM STUFF -->
		<link rel="stylesheet" href="css/customStyle.css" />
		
		<!-- JS FILES -->
		<script src="js/calculateMenu.js" type="text/javascript"></script>
		<script src="js/calculateTop.js" type="text/javascript"></script>
		<script src="js/calculateBlogImage.js" type="text/javascript"></script>
		<script src="js/mobileMenu.js" type="text/javascript"></script>
		
		<script src="js/jquery.bxslider.min.js" type="text/javascript"></script>
		<script src="js/jquery.bpopup.min.js" type="text/javascript"></script>
		<script src="js/jquery.cookie.js" type="text/javascript"></script>
		<script src="js/lightbox.js" type="text/javascript"></script>
		
		<?php 
			$getLayoutState = mysqli_query($res1, "SELECT layoutTypeRandom FROM settings_blogs");
			$resLayoutState = mysqli_fetch_assoc($getLayoutState);
			if($resLayoutState['layoutTypeRandom'] == 3){
				echo '<script src="js/masonry.pkgd.min.js"></script>';
				echo '<script type="text/javascript">
						$(window).load(function(){
							$(".columnBlock").masonry({
								itemSelector: ".blockThree",
								columnWidth: ".blockThree",
								gutter: ".gutter-sizer",
								percentPosition: true
							});
						});
					  </script>';
			}
		?>
	</body>
</html>