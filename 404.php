<?php
	header("HTTP/1.1 404 Not Found"); 

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>404 pagina niet gevonden</title>

		<script src="https://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
		
		<?php include('includes/plugin_customFonts.php'); ?>
	</head>
	<body>

		<!-- HEADER -->
		<div id="header" style="position:relative;">
			<div class="container">
				<div class="row">
					<span id="logo"><img src="<?=LOGO?>" alt="" /></span>
				</div>
			</div>
			<?php if(MENU=="fullWidth"){ ?>
			<!-- FULL NAVIGATION -->
			<div id="fullNavigation" style="height:40px;">
				<div class="container">
					<div class="row">
					</div>
				</div>
			</div>
			<?php } ?>
		</div>

		
		<div id="textLoose">
			<div class="container">
				<div style="margin:20px 0;">
					<h1>Deze pagina bestaat helaas niet of niet meer</h1>
				</div>
			</div>
		</div>

		
		<!-- BOTTOM FOOTER -->
		<div id="footer">
			<div class="container">
				<div class="row">
					Copyright &copy; <?php echo date("Y"); ?> - <?=ucfirst(str_replace('www.','',$_SERVER['SERVER_NAME']))?>
				</div>
			</div>
		</div>
		
		<!-- CSS FILES -->
		<link href="css/animate.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="css/skeleton.css" />
		
		<!-- CSS FILE FOR CUSTOM STUFF -->
		<link rel="stylesheet" href="css/style.php" />
		<link rel="stylesheet" href="css/customStyle.css" />
		
		<!-- JS FILES -->
		<script src="js/calculateMenu.js" type="text/javascript"></script>
		<script src="js/calculateTop.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(window).load(function(){
				stickyFooter();
			});
			
			$(window).resize(function(){
				stickyFooter();
			});
			
			function stickyFooter(){
				var htmlHeight = $('html').outerHeight();
				var windowHeight = $(window).outerHeight();
				
				if(windowHeight > htmlHeight){
					$('#footer').css({
					  "position": "fixed",
					  "bottom": "0",
					  "left": "0"
					});
				}else{
					$('#footer').css({
					  "position": "relative",
					  "bottom": "0",
					  "left": "0"
					});
				}
			}
		</script>
	</body>
</html>