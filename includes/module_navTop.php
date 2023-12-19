<?php
	$getFooterItems = mysqli_query($res1 ,"SELECT * 
										   FROM navigation
										   WHERE navigationID = 4
										   ORDER BY ordering");
										   
	if($array[0]=="" || $array[0]=="index" && LINKLOCATION=="topHeader"){
		$getLinks = mysqli_query($res1 ,"SELECT * FROM linkbuilding");
		$otherCheck = mysqli_num_rows($getLinks);
	}else{
		$otherCheck = 0;
	}
	if(mysqli_num_rows($getFooterItems) || $otherCheck > 0){
		echo '<div class="fullWidthContainer" id="topHeader">
				<div class="container">';
		while($resFooterItems = mysqli_fetch_assoc($getFooterItems)){
			$blogRewrite = '';
			$linksysRewrite = '';
			$rewrite = '';
			
			if($resFooterItems['blogCatID']){
				$blogRewrite = BLOG_PATH.'/';
			}
			
			if($resFooterItems['linksysCatID']){
				$linksysRewrite = LINKSYS_PATH.'/';
			}

			if($resFooterItems['rewrite']!="index" && $resFooterItems['rewrite']!=""){
				$rewrite = $resFooterItems['rewrite'].'.html';
			}else{
				$rewrite = '/';
			}
			echo '<a href="'.$blogRewrite.$linksysRewrite.$rewrite.'">'.$resFooterItems['title'].'</a>';
		}
		if(isset($getLinks)){
			while($resLinks = mysqli_fetch_assoc($getLinks)){
				echo '<span class="topLink"><a href="'.$resLinks['url'].'" target="_blank">'.$resLinks['anchortext'].'</a> <span class="topLinkExtra">'.$resLinks['extraText'].'</span></span>';
			}
		}
		echo '</div>
			</div>';
	}