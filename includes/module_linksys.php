<?php
//GET CONTENT
$getContent = mysqli_query($res1 ,"SELECT * 
								  FROM linksys_cat 
								  WHERE linksys_cat.rewrite = '".$array[1]."'");

if(mysqli_num_rows($getContent)){
	//LINKSYS CATEGORY CONTENT
	$resContent = mysqli_fetch_assoc($getContent);
	
	echo '<div class="linksysText">';
		echo '<img src="'.HTTP_IMAGE.$resContent['imagelocation'].'" style="float:right;margin: 0 0 20px 20px;max-width:300px;" />';
		echo $resContent['description'];
	echo '</div>';
	
	// Get all links within category
	$getLinks = mysqli_query($res1 ,"SELECT *, 
							 linksys_link.title AS title, 
							 linksys_link.rewrite AS rewrite
							 FROM linksys_link
							 LEFT JOIN linksys_cat
							 ON linksys_cat.id = linksys_link.category
							 WHERE linksys_link.category = ".$resContent['id']);
	echo '<div class="linksContainer">';
		while($resLinks = mysqli_fetch_assoc($getLinks)){
			echo '<div class="singleLink">';
				echo '<div class="linksysLeft">';
					echo createthumb($resLinks['url'],'');
				echo '</div>';
				echo '<div class="linksysRight">';
					echo '<span class="linkTitle">'.$resLinks['title'].'</span>';
					echo '<span class="linkShortDesc">'.$resLinks['shortdesc'].'</span>';
					echo '<a class="linkRewrite" href="'.LINKSYS_PATH.'/'.$resLinks['rewrite'].'.html">Meer over '.$resLinks['title'].'</a>';
				echo '</div>';
			echo '</div>';
		}
	echo '</div>';
}else{
	//LINK CONTENT
	$getLinkContent = mysqli_query($res1 ,"SELECT *, 
									linksys_link.title AS title, 
									linksys_link.rewrite AS rewrite,
									linksys_cat.rewrite AS catrewrite
									FROM linksys_link
									LEFT JOIN linksys_cat
									ON linksys_cat.id = linksys_link.category
									WHERE linksys_link.rewrite = '".$array[1]."'
									");
	$resLinkContent = mysqli_fetch_assoc($getLinkContent);
	$follow = '';
	
	($resLinkContent['ownsite'] ? $follow = '' : $follow = 'rel="nofollow"');
	
	if(!empty($resLinkContent['returnlink'])){
		$bl_check = new backlinkChecker( $resLinkContent['returnlink'], '<a href="javascript:void(0);">Wereldweer</a>' ); 
		$bl_check->get_contents(); 
		$bl_check->fetch_links(); 
		if ( $bl_check->check() === FALSE ) { 
			echo 'Backlink not found.'; 
		}else{ 
			echo 'Backlink found'; 
		}
	}
	
	
	// LINK LAYOUT
	echo '<div class="linksysDetail">';
		echo '<div class="linksysLeft">';
			echo createthumb($resLinkContent['url'],'');
		echo '</div>';
		echo '<div class="linksysRight">';
			echo '<h1>'.$resLinkContent['title'].'</h1>';
			echo '<span class="linkRow"><strong>URL:</strong> <a href="http://'.$resLinkContent['url'].'" target="_blank" '.$follow.'>'.$resLinkContent['title'].'</a></span>';
			echo '<span class="linkRow"><strong>Omschrijving:</strong><br/>'.$resLinkContent['longdesc'].'</span>';
			echo '<span class="linkRow"><strong>Zoekwoorden: </strong>'.$resLinkContent['searchwords'].'</span>';
			echo '<span class="linkRow"><strong>Plaats: </strong>'.$resLinkContent['place'].', '.$resLinkContent['province'].'</span>';
			echo '<span class="linkRow"><strong>Contactpersoon: </strong><a href="mailto:'.$resLinkContent['email'].'">'.$resLinkContent['contact'].'</span>';
			echo '<a href="'.LINKSYS_PATH.'/'.$resLinkContent['catrewrite'].'.html" class="linkRewrite">Terug naar overzicht</a>';
		echo '</div>';
	echo '</div>';
}