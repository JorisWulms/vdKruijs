	<span id="menuToggle">
	<span class="linecont">
		<span></span>
		<span></span>
		<span></span>
	</span>
	<span class="nav">Navigatie</span>
</span>
	<?php

		$getAllNavs = mysqli_query($res1, "SELECT * 
		FROM navigation
		WHERE navigationID = 3
		ORDER BY ordering");
		
		// Check if a full width menu has been chosen
		if(MENU!="fullWidth"){
		$containerNav = ' class="containerNav"';
		}else{
				$containerNav = ' class="fullNav"';
		}

		echo '<ul'.$containerNav.'>';
		while($resAllNavs = mysqli_fetch_assoc($getAllNavs)){
		$blogRewrite = '';
		$linksysRewrite = '';
		$rewrite = '';

		if($resAllNavs['blogCatID']){
		$blogRewrite = BLOG_PATH.'/';
		}

		if($resAllNavs['linksysCatID']){
		$linksysRewrite = LINKSYS_PATH.'/';
		}

		if($resAllNavs['rewrite']!="index" && $resAllNavs['rewrite']!=""){
		$rewrite = $resAllNavs['rewrite'].'.html';
		}else{
		$rewrite = '/';
		}

		$getChildPages = '';
		// Get child pages if there are any
		if($resAllNavs['sitetreeID']!=0){
		$getChildPages = mysqli_query($res1, "SELECT *
						FROM sitetree_language
						LEFT JOIN sitetree
						ON sitetree_language.id = sitetree.id
						WHERE sitetree.parent = ".$resAllNavs['sitetreeID']);
		}
		echo '<li><a href="'.$blogRewrite.$linksysRewrite.$rewrite.'"><span>'.$resAllNavs['title'].'</span></a>';
		// Add dropdownmenu if child pages exist
		if($getChildPages!=''){
		if(mysqli_num_rows($getChildPages)){
		echo '<ul>';
		while($resChildPages = mysqli_fetch_assoc($getChildPages)){
		echo '<li><a href="'.$resChildPages['rewrite'].'"><span>'.$resChildPages['title'].'</span></a></li>';
		}
		echo '</ul>';
		}
		}
		echo '</li>';
		}
		echo '</ul>';	
	?>