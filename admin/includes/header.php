<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<?php $sitename = str_replace('www.','',$_SERVER["SERVER_NAME"]); ?>
		<title>Admin Panel | <?=ucfirst(str_replace('www.','',$_SERVER['SERVER_NAME']))?></title>

		<!-- CSS FILES -->
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
		<link rel="stylesheet" type="text/css" href="js/jquery/ui/themes/ui-lightness/jquery-ui-1.8.13.custom.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="css/codemirror.css" />

		<!-- JS FILES -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery/jquery.alert.js"></script>
		<script type="text/javascript" src="js/jquery/tab.js"></script>
		<script type="text/javascript" src="js/colorpicker.js"></script>
		<script type="text/javascript" src="js/cross.js"></script>

		<!-- MOBILE META -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- FILEUPLOAD FILES -->
		<script src="fileupload/js/vendor/jquery.ui.widget.js"></script>
		<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
		<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
		<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="fileupload/js/jquery.iframe-transport.js"></script>
		<script src="fileupload/js/jquery.fileupload.js"></script>
		<script src="fileupload/js/jquery.fileupload-process.js"></script>
		<script src="fileupload/js/jquery.fileupload-image.js"></script>
		<script src="fileupload/js/jquery.fileupload-audio.js"></script>
		<script src="fileupload/js/jquery.fileupload-video.js"></script>
		<script src="fileupload/js/jquery.fileupload-validate.js"></script>
		<script src="fileupload/js/jquery.fileupload-ui.js"></script>
		<script src="fileupload/js/main.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				// Confirm Delete
				$('#form').submit(function(){
					if ($(this).attr('action').indexOf('delete',1) != -1) {
						if (!confirm ('Weet u het zeker dat u de selectie wilt verwijderen?')) {
							return false;
						}
					}
				});
			});
			
			$(document).ready(function(){
				 $('.colorPicker').ColorPicker({
					onSubmit: function(hsb, hex, rgb, el) {
						$(el).val('#'+hex);
						$(el).ColorPickerHide();
					},
					onBeforeShow: function () {
						$(this).ColorPickerSetColor(this.value);
					}
				 });
				 /*
				var header = $("#header");
				var headerHeight = header.height();
				
				var menu = $("#menu");
				var menuHeight = menu.height();
			
				$(window).scroll(function(){
					if ($(window).scrollTop() > headerHeight+20){
						$("#menu").css("position", "fixed");
						$("#menu").css("top", "0");
						$("#menu").css("transition", "none");
						$(".buttonsScroll").css("transition", "none");
						$(".buttonsScroll").css("display", "block");
						$(".buttonsScroll").css("top", menuHeight);
						$("#header").css("transition", "none");
						$("#header").css("margin-bottom", menuHeight);
					}else if ($(window).scrollTop() < headerHeight+20){
						$("#menu").css("position", "relative");
						$("#menu").css("top", "");
						$("#header").css("margin-bottom", 0);
						$(".buttonsScroll").css("display", "none");
					}
				 });*/
			 });
		</script>
	</head>
<body>
	<div id="container">
		<div id="left">
		<?php if ($_SESSION['user_status'] > 3){ ?>
		<div id="menu">
			<span class="backendLogo"><img src="images/logoCrossWhite.png" /></span>
			<ul class="nav left">
			<?php 
			$getAvailNav = mysqli_query($res1,"SELECT *, module.id AS id 
										 FROM module
										 JOIN module_koppel
										 ON module.id = module_koppel.moduleID
										 LEFT JOIN gebruikers
										 ON module_koppel.userID = gebruikers.id
										 WHERE gebruikers.id = '".$_SESSION['user_id']."'
										 AND module.parent = 0
										 AND module.visible = 1
										 GROUP BY module.id
										 ORDER BY module.ordening");
			
			while($resAvailNav = mysqli_fetch_assoc($getAvailNav)){
				if(isset($_GET['action']) && $resAvailNav['rewrite'] == $_GET['action']){
					$active = ' class="active"';
				}else{
					$active ='';
				}
				echo '<li'.$active.'><a class="top" href="index.php?action='.$resAvailNav['rewrite'].'&clear=true">'.$resAvailNav['title'].'</a>';
				
					$getAvailChildNav = mysqli_query($res1,"SELECT * 
											 FROM module
											 JOIN module_koppel
											 ON module.id = module_koppel.moduleID
											 LEFT JOIN gebruikers
											 ON module_koppel.userID = gebruikers.id
											 WHERE gebruikers.id = '".$_SESSION['user_id']."'
											 AND module.parent = '".$resAvailNav['id']."'
											 AND module.visible = 1
											 GROUP BY module.id
											 ORDER BY module.ordening");
					if(mysqli_num_rows($getAvailChildNav)!=0){
						echo '<ul>';
					}
					while($resAvailChildNav = mysqli_fetch_assoc($getAvailChildNav)){
						if(isset($_GET['action']) && $resAvailChildNav['rewrite'] == $_GET['action']){
							$active = ' class="active"';
						}else{
							$active ='';
						}
						echo '<li'.$active.'><a href="index.php?action='.$resAvailChildNav['rewrite'].'&clear=true">'.$resAvailChildNav['title'].'</a></li>';
					}
					if(mysqli_num_rows($getAvailChildNav)!=0){
						echo '</ul>';
					}
				echo '</li>';
			}
			?>
			</ul>
			<ul class="nav right">
				<li id="store"><a class="top" href="index.php?logout=YES">Uitloggen</a></li>
			</ul>

		</div>
		</div>
	<?php } ?>
	<div id="right">
		<div id="content">
			<?php 
			if (isset($_GET['clear']) && $_GET['clear'] == true){
				unset($_SESSION['error_warning']);
				unset($_SESSION['success']);
			}

			if (isset($_SESSION['error_warning'])) { ?>
				<div class="warning"><?php echo $_SESSION['error_warning']; ?></div>
			<?php 
			}
			if (isset($_SESSION['success'])) { ?>
				<div class="success"><?php echo $_SESSION['success']; ?></div>
			<?php 
			}
			?>