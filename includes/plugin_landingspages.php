<?php
	// Specific landingspages under other pages
	$sqlLanding = "SELECT * 
			FROM sitetree 
			LEFT OUTER JOIN sitetree_language 
			ON sitetree_language.id=sitetree.id 
			WHERE sitetree_language.language_id='".$_SESSION['language_id']."' 
			AND sitetree.parent=".$id." 
			AND sitetree.visible=1 
			AND sitetree.navigatie=2 
			ORDER BY sitetree.ordering ASC";
	$getLanding = mysqli_query($res1 ,$sqlLanding);
	
	// Random langspages that do not have a parent
	$sqlRandom = "SELECT * 
			FROM sitetree 
			LEFT OUTER JOIN sitetree_language 
			ON sitetree_language.id=sitetree.id 
			WHERE sitetree_language.language_id='".$_SESSION['language_id']."' 
			AND sitetree.visible=1 
			AND sitetree.navigatie=2 
			ORDER BY Rand() ASC
			LIMIT 10";
	$getRandom = mysqli_query($res1 ,$sqlRandom);
	
	if($getLanding && mysqli_num_rows($getLanding)){
		while ($resLanding = mysqli_fetch_assoc($getLanding)) {
			echo '<a href="'.$resLanding['rewrite'].'.html">'.$resLanding['title'].'</a>';
		}
	}else{
		while ($resRandom= mysqli_fetch_assoc($getRandom)) {
			echo '<a href="'.$resRandom['rewrite'].'.html">'.$resRandom['title'].'</a>';
		}
	}