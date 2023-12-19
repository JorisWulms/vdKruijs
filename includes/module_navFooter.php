<?php
	$getFooterItems = mysqli_query($res1 ,"SELECT * 
										   FROM navigation
										   WHERE navigationID = 1
										   ORDER BY ordering");
								   
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
		echo '<a href="'.$blogRewrite.$linksysRewrite.$rewrite.'">'.$resFooterItems['title'].'</a> | ';
	}