<?php
$getBannerSettings = mysqli_query($res1 ,"SELECT * FROM settings_banner");
$resBannerSettings = mysqli_fetch_assoc($getBannerSettings);

// Add class to banner block on followup pages
$additionPage = "";
if($array[0]!="" && $array[0]!="index"){
	$additionPage = " pageBanner";
}

////////////////////////////
// CUSTOM BANNER PER PAGE //
////////////////////////////
	if($resBannerSettings['layoutType']==7){
		$getPageBanners = mysqli_query($res1, "SELECT * FROM slider_page WHERE rewrite = '".$array[0]."' ORDER BY Rand()");
		$resPageBanners = mysqli_fetch_assoc($getPageBanners);
		
		// If a page has a specific banner
		if(mysqli_num_rows($getPageBanners)){
			$resBanner = mysqli_query($res1 ,"SELECT * FROM slider WHERE bannerID = ".$resPageBanners['bannerID']." ORDER BY Rand() LIMIT 1");
			$rowBanner = mysqli_fetch_assoc($resBanner);
			
			// Background color
			$bannerBackgroundColor = ($rowBanner['bannerBackground'] ? 'background-color:'.$rowBanner['bannerBackground'].';' : '');
			
			// Padding to top and bottom of banner if the banner has no overlay
			$bannerPadding = ($rowBanner['bannerOverlay'] ? '' : 'padding:'.$rowBanner['bannerPadding'].' 0;');
			
			// Banner overlay (including padding)
			$bannerOverlay = ($rowBanner['bannerOverlay'] ? '<div class="bannerOverlay" style="padding:'.$rowBanner['bannerPadding'].' 0;background-color:rgba('.implode(',',hex2rgb($rowBanner['bannerOverlayColor'])).','.$rowBanner['bannerOverlayOpacity'].');">' : '');
			$closeBannerOverlay = ($rowBanner['bannerOverlay'] ? '</div>' : '');
			
			echo '<div id="banner" class="customBannerPerPage'.$additionPage.'" style="background-image: url(images/banners/'.$rowBanner['bannerSrc'].');background-size:cover;'.$bannerBackgroundColor.$bannerPadding.'">';
				echo $bannerOverlay;
					echo '<div class="container">';
						if($rowBanner['topTextNL']=="" && $rowBanner['bottomTextNL']==""){
							echo '<span style="width:100%;float:left;text-align:center;">'.getAffiliateBanner(3).'</span>';
						}else{
							echo '<span class="bannerBig">'.$rowBanner['topTextNL'].'</span>';
							echo '<span class="bannerSmall">'.$rowBanner['bottomTextNL'].'</span>';

							if($rowBanner['bannerLinkNL']!="" && $rowBanner['bannerButtonNL']!=""){
								echo '<a href="'.$rowBanner['bannerLinkNL'].'" class="bannerButton">'.$rowBanner['bannerButtonNL'].'</a>';
							}
						}
					echo '</div>';
				echo $closeBannerOverlay;
		}else{
			// Default banner if it doesn't have a page specific banner
			echo '<div class="fullWidthContainer" id="banner"></div>';
		}
	}


///////////////////
// CUSTOM BANNER //
///////////////////
	if($resBannerSettings['layoutType']==6){
		$resBanner = mysqli_query($res1 ,"SELECT * FROM slider ORDER BY Rand() LIMIT 1");
		$rowBanner = mysqli_fetch_assoc($resBanner);
	}

	
///////////////////////////////
// PARALLAX CONTAINER BANNER //
///////////////////////////////
	if($resBannerSettings['layoutType']==5){
		$resBanner = mysqli_query($res1 ,"SELECT * FROM slider ORDER BY Rand() LIMIT 1");
		$rowBanner = mysqli_fetch_assoc($resBanner);
		echo '
		<div id="bannerContent">
			<div class="container">
				<div class="row staticBanner parallax" id="banner" style="background: url(images/banners/'.$rowBanner['bannerSrc'].') center center /cover no-repeat;'.($rowBanner['bannerOverlay'] ? '' : 'padding:'.$rowBanner['bannerPadding'].' 0;').'">
					'.($rowBanner['bannerOverlay'] ? '<div class="bannerOverlay" style="padding:'.$rowBanner['bannerPadding'].' 0;background-color:rgba('.implode(',',hex2rgb($rowBanner['bannerOverlayColor'])).','.$rowBanner['bannerOverlayOpacity'].');">' : '');
					if($rowBanner['topTextNL']=="" && $rowBanner['bottomTextNL']==""){
						echo getAffiliateBanner(3);
					}else{
						echo '<span class="bannerBig">'.$rowBanner['topTextNL'].'</span>';
						echo '<span class="bannerSmall">'.$rowBanner['bottomTextNL'].'</span>';

						if($rowBanner['bannerLinkNL']){
							echo '<a href="'.$rowBanner['bannerLinkNL'].'" class="bannerButton">Lees meer</a>';
						}
					}
					echo ($rowBanner['bannerOverlay'] ? '</div>' : '').'
				</div>
			</div>
		</div>
		';
	}

///////////////////////////////
// FULL PAGE PARALLAX BANNER //
///////////////////////////////
	if($resBannerSettings['layoutType']==4){
		$resBanner = mysqli_query($res1 ,"SELECT * FROM slider ORDER BY Rand() LIMIT 1");
		$rowBanner = mysqli_fetch_assoc($resBanner);

		echo '<div id="banner" class="fullBannerParallax'.$additionPage.'" style="background: url(images/banners/'.$rowBanner['bannerSrc'].') center center /cover no-repeat;'.($rowBanner['bannerOverlay'] ? '' : 'padding:'.$rowBanner['bannerPadding'].' 0;').'">
			'.($rowBanner['bannerOverlay'] ? '<div class="bannerOverlay" style="padding:'.$rowBanner['bannerPadding'].' 0;background-color:rgba('.implode(',',hex2rgb($rowBanner['bannerOverlayColor'])).','.$rowBanner['bannerOverlayOpacity'].');">' : '').'
			<div class="container">';
				if($rowBanner['topTextNL']=="" && $rowBanner['bottomTextNL']==""){
					echo '<span style="width:100%;float:left;text-align:center;">'.getAffiliateBanner(3).'</span>';
				}else{
					echo '<span class="bannerBig">'.$rowBanner['topTextNL'].'</span>';
					echo '<span class="bannerSmall">'.$rowBanner['bottomTextNL'].'</span>';

					if($rowBanner['bannerLinkNL']){
						echo '<a href="'.$rowBanner['bannerLinkNL'].'" class="bannerButton">Lees meer</a>';
					}
				}
			echo '</div>
			'.($rowBanner['bannerOverlay'] ? '</div>' : '').'
		</div>';

	}

/////////////////////////////
// FULL PAGE STATIC BANNER //
/////////////////////////////
	if($resBannerSettings['layoutType']==3){
		$resBanner = mysqli_query($res1 ,"SELECT * FROM slider ORDER BY Rand() LIMIT 1");
		$rowBanner = mysqli_fetch_assoc($resBanner);

		echo '<div id="banner" class="fullBanner'.$additionPage.'" style="background: url(images/banners/'.$rowBanner['bannerSrc'].') center center /cover no-repeat;'.($rowBanner['bannerOverlay'] ? '' : 'padding:'.$rowBanner['bannerPadding'].' 0;').'">';
			echo ($rowBanner['bannerOverlay'] ? '<div class="bannerOverlay" style="padding:'.$rowBanner['bannerPadding'].' 0;background-color:rgba('.implode(',',hex2rgb($rowBanner['bannerOverlayColor'])).','.$rowBanner['bannerOverlayOpacity'].');">' : '');
			echo '<div class="container">
					<div class="row">';
					if($rowBanner['topTextNL']=="" && $rowBanner['bottomTextNL']==""){
						echo '<span style="width:100%;float:left;text-align:center;">'.getAffiliateBanner(3).'</span>';
					}else{
						echo '<span class="bannerBig">'.$rowBanner['topTextNL'].'</span>';
						echo '<span class="bannerSmall">'.$rowBanner['bottomTextNL'].'</span>';

						if($rowBanner['bannerLinkNL']){
							echo '<a href="'.$rowBanner['bannerLinkNL'].'" class="bannerButton">Lees meer</a>';
						}
					}
			echo '</div>
			</div>
			'.($rowBanner['bannerOverlay'] ? '</div>' : '').'
		</div>';
	}

/////////////////////////////
// CONTAINER SLIDER BANNER //
/////////////////////////////
	if($resBannerSettings['layoutType']==2){
		$resBanner = mysqli_query($res1 ,"SELECT * FROM slider ORDER BY bannerOrder");

		echo '<div id="bannerContent">
				<div class="container">
					<div id="banner">
						<div class="row" id="bannerSlider">';
							while($rowBanner = mysqli_fetch_assoc($resBanner)){
								echo '<span class="banner" style="background: url(images/banners/'.$rowBanner['bannerSrc'].') center center no-repeat;'.($rowBanner['bannerOverlay'] ? '' : 'padding:'.$rowBanner['bannerPadding'].' 0;').'">';
									echo ($rowBanner['bannerOverlay'] ? '<div class="bannerOverlay" style="padding:'.$rowBanner['bannerPadding'].' 0;background-color:rgba('.implode(',',hex2rgb($rowBanner['bannerOverlayColor'])).','.$rowBanner['bannerOverlayOpacity'].');">' : '');
									echo '<span class="bannerBig">'.$rowBanner['topTextNL'].'</span>';
									echo '<span class="bannerSmall">'.$rowBanner['bottomTextNL'].'</span>';

									if($rowBanner['bannerLinkNL']){
									echo '<a href="'.$rowBanner['bannerLinkNL'].'" class="bannerButton">Lees meer</a>';
									}

									echo ($rowBanner['bannerOverlay'] ? '</div>' : '');
								echo '</span>';
							}
				  echo '</div>
					</div>
				</div>
			</div>';
	}

/////////////////////////////
// CONTAINER STATIC BANNER //
/////////////////////////////
	if($resBannerSettings['layoutType']==1){
		$resBanner = mysqli_query($res1 ,"SELECT * FROM slider ORDER BY Rand() LIMIT 1");
		$rowBanner = mysqli_fetch_assoc($resBanner);
		
		// Padding to top and bottom of banner if the banner has no overlay
		$bannerPadding = ($rowBanner['bannerOverlay'] ? '' : 'padding:'.$rowBanner['bannerPadding'].' 0;');
		
		// Banner overlay (including padding)
		$bannerOverlay = ($rowBanner['bannerOverlay'] ? '<div class="bannerOverlay" style="padding:'.$rowBanner['bannerPadding'].' 0;background-color:rgba('.implode(',',hex2rgb($rowBanner['bannerOverlayColor'])).','.$rowBanner['bannerOverlayOpacity'].');">' : '');
		$closeBannerOverlay = ($rowBanner['bannerOverlay'] ? '</div>' : '');
			
		echo '<div id="bannerContent">
				<div class="container">
					<div class="row staticBanner" id="banner" style="background: url(images/banners/'.$rowBanner['bannerSrc'].') center center /cover no-repeat;'.$bannerPadding.'">';
					echo $bannerOverlay;
						if($rowBanner['topTextNL']=="" && $rowBanner['bottomTextNL']==""){
							echo getAffiliateBanner(3);
						}else{
							echo '<span class="bannerBig">'.$rowBanner['topTextNL'].'</span>';
							echo '<span class="bannerSmall">'.$rowBanner['bottomTextNL'].'</span>';

							if($rowBanner['bannerLinkNL']){
								echo '<a href="'.$rowBanner['bannerLinkNL'].'" class="bannerButton">Lees meer</a>';
							}
						}
					echo $closeBannerOverlay.'
					</div>
				</div>
			</div>';
	}

///////////////
// NO BANNER //
///////////////
	if($resBannerSettings['layoutType']==0){
		echo '<div class="fullWidthContainer" id="banner"></div>';
	}