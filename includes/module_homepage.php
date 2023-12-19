<?php
	$sql = "SELECT * FROM sitetree LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id WHERE sitetree_language.rewrite = '".$array[0]."' AND sitetree_language.language_id='".$_SESSION['language_id']."'";
	$res = mysqli_query($res1 ,$sql);
	$row = mysqli_fetch_assoc($res);
	
	if($row['leesmeer']==1){
		$truncate = "textTruncate";
	}else{
		$truncate = "";
	}

	if(LINKLOCATION=="top"){ 
		echo '<div class="homeTopLinks">';
			include('includes/plugin_linkbuilding.php'); 
		echo '</div>';
	}elseif(LINKLOCATION=="right"){ 
		echo '<div class="homeRightLinks">';
			include('includes/plugin_linkbuilding.php'); 
		echo '</div>';
	}elseif(getAffiliateBanner(5)!=""){
		echo '<div style="float:right;margin: 0 0 20px 20px;">'.getAffiliateBanner(5).'</div>';
	}

	if ($row['exttemp']!=""){
		include ($row['exttemp'].".php");
	}
	
	if(LINKLOCATION=="bottom"){ 
		echo '<div class="homeBottomLinks">';
			include('includes/plugin_linkbuilding.php'); 
		echo '</div>';
	}
?>
					<?php include("includes/plugin_banners.php");?>
					<div id="bannerContent">
						<b>AL EEN GARAGEBOX TE HUUR VANAF €80 PER MAAND!</b>
						<a href="contact.html" class="bannerButton">MEER INFO? INFORMEER NU! </a>
					</div>	
				</div>
				<div id="menu" class="">
					<ul>
						<?php include("includes/module_nav.php"); ?>
					</ul>
				</div>
				<div id="advantageContainer">
					<div id="advantages">
						<div class="advantage">
							<div class="advantageImage">
								<img src="images/kalender.png"/>
							</div>	
							<p>Goed bereikbaar & 7 dagen per week toegang</p>
						</div>
						<div class="advantage">
							<div class="advantageImage">
								<img src="images/boom.png"/>
							</div>	
							<p>Net onderhouden terrein</p>
						</div>
						<div class="advantage">
							<div class="advantageImage">
								<img src="images/klok.png"/>
							</div>	
							<p>Flexibele huurtermijn</p>
						</div>
						<div class="advantage">
							<div class="advantageImage">
								<img src="images/sleutel.png"/>
							</div>	
							<p>Individuele pincode en slot</p>
						</div>
						<div class="advantage">
							<div class="advantageImage">
								<img src="images/camera.png"/>
							</div>	
							<p>24/7 terrein- & camerabewaking</p>
						</div>
					</div>	
				</div>
				<div id="introTextContainer">
					<div id="introHdivider">
						<div class="introText">
							<?php 
								if ($row['bigtext']!=""){
									echo $row['bigtext'];
									}
							?>
						</div>
					</div>
					<div id="introHdivider">
						<img src="images/opslag.jpeg" alt="Opslag"/>
					</div>
				</div>
				<div id="reviewContainer">
					<div id="reviews">
						<div class="review">
							<div class="reviewImg img1">
							
							</div>
							<p class="reviewName">Caroline</p>
							<p class="reviewText">"Erg blij geweest met mijn tijdelijke opslagruimte. Kwam zeer goed van pas tijdens de verbouwing en verhuizing."</p>
						
						</div>
						<div class="review">
							<div class="reviewImg img2">
							
							</div>
							<p class="reviewName">Richard</p>
							<p class="reviewText">"De opslagruimte was snel geregeld en ik werd vriendelijk te woord gestaan."</p>
							
						</div>
						
					</div>	
					<!--<div id="readStoriesButton">
						<div id="readStories">
							<a class="reviewButton orange" href=""><p>LEES MEER</p><i class="fa fa-chevron-right"></i></a>
						</div>
					</div>-->
				</div>
				<div id="orderContainer">
					<div id="orders">	
						<a href=""><div class="orderHdivider greBack">
							<p> 1. KIES UW BOX</p>
						</div></a>
						<a href=""><div class="orderHdivider">
							<p> 2. OFFERTE</p>
						</div></a>
						<div class="orderBox">
							<div class="size">
								<p>S</p>
							</div>
							<p class="capacity">
								+/- 30m<sup>2</sup>
							</p>
							<a class="reviewButton green centerButton" href="contact.html"><p>NEEM CONTACT OP</p>
							<i class="fa fa-chevron-right"></i></a>
						</div>
						<div class="orderBox">
							<div class="size">
								<p>M</p>
							</div>
							<p class="capacity">
								+/- 50m<sup>2</sup>
							</p>
							<a class="reviewButton green centerButton" href="contact.html"><p>NEEM CONTACT OP</p>
							<i class="fa fa-chevron-right"></i></a>
						</div>
						<div class="orderBox">
							<div class="size">
								<p>L</p>
							</div>
							<p class="capacity">
								+/- 100m<sup>2</sup>
							</p>
							<a class="reviewButton green centerButton" href="contact.html"><p>NEEM CONTACT OP</p>
							<i class="fa fa-chevron-right"></i></a>
						</div>
						<div class="orderBox">
							<div class="size">
								<p>XL</p>
							</div>
							<p class="capacity">
								+/- 200m<sup>2</sup>
							</p>
							<a class="reviewButton green centerButton" href="contact.html"><p>NEEM CONTACT OP</p>
							<i class="fa fa-chevron-right"></i></a>
						</div>
					</div>	
				</div>
				<div id="mapsFullContainer">
					<div id="mapsContainer">

					</div>
					<div id="mapsOverlay">
						<p class="orangeHeader">Van de Kruijs Garageboxen & Opslag </p>
						<p class="mapText">Ellerweg 6</br>6039 RD, Stramproy</br>Weert, Limburg</p>
					</div>
				</div>	
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQS_dhUBYTUS7OmDpLj2EgMz5dND2Ders&callback=initMap"
						async defer>
				</script>
