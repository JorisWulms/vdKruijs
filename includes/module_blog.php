
<div id="bannerContainer2">
<div id="bannerContent">
						<b>AL EEN GARAGEBOX TE HUUR VANAF €80 PER MAAND!</b>
						<a href="contact.html" class="bannerButton">MEER INFO? INFORMEER NU! </a>
					</div>	
</div>
<div id="menu">
	<ul>
		<?php include("includes/module_nav.php"); ?>
	</ul>
</div>

<div id="contentContainer">
<?php
error_reporting(0);

//GET SETTINGS
$getBlogSettings = mysqli_query($res1 ,"SELECT * FROM settings_blogs");
$resBlogSettings = mysqli_fetch_assoc($getBlogSettings);

//GET CONTENT
$getBlogCatContent = mysqli_query($res1 ,"SELECT * 
								  FROM blog_cat_language 
								  LEFT JOIN blog_cat
								  ON blog_cat_language.catID = blog_cat.catID
								  WHERE rewrite = '".$array[1]."'");

if(mysqli_num_rows($getBlogCatContent)){
	//BLOG CATEGORY CONTENT
	$resBlogCatContent = mysqli_fetch_assoc($getBlogCatContent);
	
	// Get all blogs within category
	$getBlogs = mysqli_query($res1 ,"SELECT *, 
							 blogs_language.naam AS blognaam, 
							 blogs_language.beschrijving AS blogbeschrijving, 
							 blogs_language.rewrite AS rewrite
							 FROM blogs_language
							 LEFT JOIN blogs
							 ON blogs_language.blogID = blogs.blogID
							 WHERE blogs.catID = ".$resBlogCatContent['catID']."
							 AND blogs.visable = 1
							 ORDER BY blogs.ordering");
							 
	// FULL PAGE BLOGCAT TEXT - FULL PAGE BLOGS
	if($resBlogSettings['layoutTypeCategory']==1){
		echo '<div class="categoryText fullPage">';
			echo '<div class="truncateCat">'.$resBlogCatContent['beschrijving'].'</div>';
			echo '<div class="fullWidthContainer">'.$resBlogCatContent['extraItem'].'</div>';
		echo '</div>';
		echo '<div class="blogsContainer fullPage">';	
		while($resBlogs = mysqli_fetch_assoc($getBlogs)){
			// Remove the H1 from blog description
			$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
			$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
				echo '<a class="blogOverviewBlog" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
						<span class="shortText">
							<span class="title">'.$resBlogs['blognaam'].'</span>
							<span class="text">'.strip_tags($displayText).'...</span>
						</span>
						<span class="blogOverviewImage" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center /cover no-repeat;"></span>
						<span class="readMore">Lees verder</span>
					  </a>';
		}
		echo '</div>';
	}
	
	// HALF PAGE BLOGCAT TEXT - HALF PAGE BLOGS
	if($resBlogSettings['layoutTypeCategory']==2){
		echo '<div class="categoryText halfPage">';
			echo '<div class="truncateCat">'.$resBlogCatContent['beschrijving'].'</div>';
			echo '<div class="fullWidthContainer">'.$resBlogCatContent['extraItem'].'</div>';
		echo '</div>';
		echo '<div class="blogsContainer halfPage">';	
		while($resBlogs = mysqli_fetch_assoc($getBlogs)){
			// Remove the H1 from blog description
			$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
			$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
				echo '<a class="blogOverviewBlog" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
						<span class="shortText">
							<span class="title">'.$resBlogs['blognaam'].'</span>
							<span class="text">'.strip_tags($displayText).'...</span>
						</span>
						<span class="blogOverviewImage" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center /cover no-repeat;"></span>
						<span class="readMore">Lees verder</span>
					  </a>';
		}
		echo '</div>';
	}
	
	// 2/3 PAGE BLOGCAT TEXT - 1/3 PAGE BLOGS
	if($resBlogSettings['layoutTypeCategory']==3){
		echo '<div class="categoryText twoThirdPage">';
			echo '<div class="truncateCat">'.$resBlogCatContent['beschrijving'].'</div>';
			echo '<div class="fullWidthContainer">'.$resBlogCatContent['extraItem'].'</div>';
		echo '</div>';
		echo '<div class="blogsContainer twoThirdPage">';	
		while($resBlogs = mysqli_fetch_assoc($getBlogs)){
			// Remove the H1 from blog description
			$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
			$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
				echo '<a class="blogOverviewBlog" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
						<span class="blogOverviewImage" style="margin: 0 0 15px 0;background: url(images/blog/'.$resBlogs['foto_locatie'].') center center /cover no-repeat;"></span>
						<span class="shortText">
							<span class="title">'.$resBlogs['blognaam'].'</span>
							<span class="text">'.strip_tags($displayText).'...</span>
						</span>
					<span class="readMore">Lees verder</span>
				</a>';
		}
		echo '</div>';
	}
	
	// 2/3 PAGE BLOGCAT TEXT - 1/3 PAGE BLOGS NO IMAGE
	if($resBlogSettings['layoutTypeCategory']==4){
		echo '<div class="categoryText twoThirdPage noImage">';
			echo '<div class="truncateCat">'.$resBlogCatContent['beschrijving'].'</div>';
			echo '<div class="fullWidthContainer">'.$resBlogCatContent['extraItem'].'</div>';
		echo '</div>';
		echo '<div class="blogsContainer twoThirdPage noImage">';	
		while($resBlogs = mysqli_fetch_assoc($getBlogs)){
			// Remove the H1 from blog description
			$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
			$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
				echo '<a class="blogOverviewBlog" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
						<span class="shortText">
							<span class="title">'.$resBlogs['blognaam'].'</span>
							<span class="text">'.strip_tags($displayText).'...</span>
						</span>
						<span class="blogOverviewImage" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center /cover no-repeat;"></span>
						<span class="readMore">Lees verder</span>
					  </a>';
		}
		echo '</div>';
	}

	// 2/3 PAGE BLOGCAT TEXT - 1/3 PAGE BLOGS NO TEXT
	if($resBlogSettings['layoutTypeCategory']==5){
		echo '<div class="categoryText twoThirdPage noText">';
			echo '<div class="truncateCat">'.$resBlogCatContent['beschrijving'].'</div>';
			echo '<div class="fullWidthContainer">'.$resBlogCatContent['extraItem'].'</div>';
		echo '</div>';
		echo '<div class="blogsContainer twoThirdPage noText">';	
		while($resBlogs = mysqli_fetch_assoc($getBlogs)){
			// Remove the H1 from blog description
			$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
			$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
				echo '<a class="blogOverviewBlog" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
						<span class="shortText">
							<span class="title">'.$resBlogs['blognaam'].'</span>
							<span class="text">'.strip_tags($displayText).'...</span>
						</span>
						<span class="blogOverviewImage" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center /cover no-repeat;"></span>
						<span class="readMore">Lees verder</span>
					  </a>';
		}
		echo '</div>';
	}
	
	// 2/3 PAGE BLOGS LEFT - 1/3 PAGE BLOGCAT TEXT RIGHT
	if($resBlogSettings['layoutTypeCategory']==6){
		echo '<div class="categoryText twoThirdPage ticketLeft">';
			echo '<div class="truncateCat">'.$resBlogCatContent['beschrijving'].'</div>';
			echo '<div class="fullWidthContainer">'.$resBlogCatContent['extraItem'].'</div>';
		echo '</div>';
		echo '<div class="blogsContainer twoThirdPage ticketLeft">';	
		while($resBlogs = mysqli_fetch_assoc($getBlogs)){
			// Remove the H1 from blog description
			$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
			$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
				echo '<a class="blogOverviewBlog" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
						<span class="shortText">
							<span class="title">'.$resBlogs['blognaam'].'</span>
							<span class="text">'.strip_tags($displayText).'...</span>
						</span>
						<span class="blogOverviewImage" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center /cover no-repeat;"></span>
						<span class="readMore">Lees verder</span>
					  </a>';
		}
		echo '</div>';
	}
	
	// CUSTOM PAGE LAYOUT
	if($resBlogSettings['layoutTypeCategory']==7){
		while($resBlogs = mysqli_fetch_assoc($getBlogs)){
			// Remove the H1 from blog description
			$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
			$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
		}
	}
	
	// READ MORE ON CATEGORY PAGE
	if($resBlogCatContent['leesmeer']==1){
		?>
		<script type="text/javascript">
		$(function(){
			$(".truncateCat").mtruncate({
				maxLines: <?=$resBlogCatContent['leesmeerAantal']?>,
				expandText: '<span class="readMore">> Lees meer</span>',
				collapseText: '<span class="readMore">< Lees minder</span>'
			});	
		});
		</script>
		<?php
	}
}else{
	//BLOG PAGE CONTENT
	$getBlogContent = mysqli_query($res1 ,"SELECT *, 
								   blogs_language.beschrijving AS beschrijving,
								   blogs_language.naam AS naam,
								   blog_cat_language.rewrite AS catrewrite,
								   blogs_language.extraItem AS extraItem,
								   blog_cat_language.extraItem AS catExtra
								   FROM blogs_language
								   LEFT JOIN blogs
								   ON blogs_language.blogID = blogs.blogID
								   LEFT JOIN blog_cat_language
								   ON blogs.catID = blog_cat_language.catID
								   WHERE blogs_language.rewrite = '".$array[1]."'
									");
	$resBlogContent = mysqli_fetch_assoc($getBlogContent);
	
	
	
	// BLOG LAYOUT 1 - lap tekst link
	if($resBlogSettings['layoutTypeBlog'] == 1){
		if($resBlogContent['foto_locatie']!=""){ 
			echo '<img class="blogImage" src="images/blog/'.$resBlogContent['foto_locatie'].'" alt="'.$resBlogContent['naam'].'" />';
		}
		//Create box for plugin if there is one.
		if($resBlogContent['plugin']!=""){
			$getCorrectPlugin = mysqli_query($res1, "SELECT * 
											  FROM plugin
											  WHERE id = '".$resBlogContent['plugin']."'");
			$resCorrectPlugin = mysqli_fetch_assoc($getCorrectPlugin);
			
			// Load plugins that can be placed next to the text.
			if($resCorrectPlugin['pluginSize']==0){
				echo '<div class="pluginBox '.$resCorrectPlugin['plugin'].'">';
					include('includes/plugin_'.$resCorrectPlugin['plugin'].'.php');
				echo '</div>';
				echo $resBlogContent['beschrijving'];
				if($resBlogContent['modified']!='0000-00-00 00:00:00'){ 
					echo '<br/>Laatst gewijzigd: '.$resBlogContent['modified'];
				}
			// Load plugins that need to have fullwidth.
			}elseif($resCorrectPlugin['pluginSize']==1){
				echo $resBlogContent['beschrijving'];
				if($resBlogContent['modified']!='0000-00-00 00:00:00'){ 
					echo '<br/>Laatst gewijzigd: '.$resBlogContent['modified'];
				}
				echo '<div class="pluginBox '.$resCorrectPlugin['plugin'].'">';
					include('includes/plugin_'.$resCorrectPlugin['plugin'].'.php');
				echo '</div>';
			// Some plugins are not available, so just show the default text.
			}else{
				echo $resBlogContent['beschrijving'];
				if($resBlogContent['modified']!='0000-00-00 00:00:00'){ 
					echo '<br/>Laatst gewijzigd: '.$resBlogContent['modified'];
				}
			}
		// If no plugin is selected, just read the default text	
		}else{
			echo $resBlogContent['beschrijving'];
			echo '<div style="float:left;width:100%;">'.(!empty($resBlogContent['extraItem']) ? $resBlogContent['extraItem'] : '').'</div>';
		}
		
		echo '<a href="'.BLOG_PATH.'/'.$resBlogContent['catrewrite'].'.html">Terug naar overzicht</a>';
	}
	
	
	
	// BLOG LAYOUT 2 - 2/3tekst 1/3 random Blogs zelfde cat
	if($resBlogSettings['layoutTypeBlog'] == 2){
		echo '<div id="textfield"> ';
			// Check if there is an image
			if($resBlogContent['foto_locatie']!="" && $resBlogContent['extraItem']==""){ 
				echo '<img class="blogImage" src="images/blog/'.$resBlogContent['foto_locatie'].'" alt="'.$resBlogContent['naam'].'" />';
			}
			echo $resBlogContent['beschrijving'];
			if($resBlogContent['modified']!='0000-00-00 00:00:00'){ 
				echo '<br/>Laatst gewijzigd: '.$resBlogContent['modified'].'<br/>';
			}
			echo '<div style="float:left;width:100%;">'.(!empty($resBlogContent['extraItem']) ? $resBlogContent['extraItem'] : '').'</div>';
			echo '<a href="'.BLOG_PATH.'/'.$resBlogContent['catrewrite'].'.html" class="readMore">Terug naar overzicht</a>';
		echo '</div>';
		
		
		// Get all blogs in same category
		$getBlogsInCat = mysqli_query($res1 ,"SELECT *, 
							 blogs_language.naam AS blognaam, 
							 blogs_language.beschrijving AS blogbeschrijving, 
							 blogs_language.rewrite AS rewrite
							 FROM blogs_language
							 LEFT JOIN blogs
							 ON blogs_language.blogID = blogs.blogID
							 WHERE blogs.catID = ".$resBlogContent['catID']."
							 AND blogs.visable = 1
							 ORDER BY blogs.ordering");
							 
		echo '<div class="containerblogs">';
		
			while($resBlogsInCat = mysqli_fetch_assoc($getBlogsInCat)){
				// Remove the H1 from blog description
				$displayText = substr($resBlogsInCat['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
				$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
				
				echo '
				<div class="layoutTypeBlog2">
					<a href="'.BLOG_PATH.'/'.$resBlogsInCat['rewrite'].'.html">
							<span class="shortText">
								<span class="title">'.$resBlogsInCat['blognaam'].'</span>
								<span class="text">'.strip_tags($displayText).'...</span>
							</span>';
							if($resBlogsInCat['foto_locatie']!=""){ 
								echo '<img class="blogImage" src="images/blog/'.$resBlogsInCat['foto_locatie'].'" alt="'.$resBlogsInCat['naam'].'" />';
							}
				echo'<span class="blogOverviewImage" style="background: url(images/blog/'.$resBlogsInCat['foto_locatie'].') center center /cover no-repeat;"></span>
						<span class="readMore">Lees verder</span>
					</a>
				</div>';
			}		
		
		echo '</div>';
	}
	
	// BLOG LAYOUT 3 - CUSTOM BLOG PAGE LAYOUT
	if($resBlogSettings['layoutTypeBlog'] == 3){

	}
	
	// STRUCTURED DATA
	if(!empty($resBlogContent['foto_locatie']) && file_exists(DIR_IMAGE.$resBlogContent['foto_locatie'])){
		list($imgwidth, $imgheight) = getimagesize(DIR_IMAGE.$resBlogContent['foto_locatie']);
	}else{
		$imgwidth = 696;
		$imgheight = 200;
	}
	
	if(!empty($resSettings['logo']) && file_exists(DIR_USERFILES.$resSettings['logo'])){
		list($logowidth, $logoheight) = getimagesize(DIR_USERFILES.$resSettings['logo']);
		$structuredLogo = ', "logo": {
							  "@type": "ImageObject",
							  "url": "'.LOGO.'",
							  "width": '.$logowidth.',
							  "height": '.$logoheight.'
							}';
	}else{
		$structuredLogo = '';
	}
	
	if($resBlogContent['modified']!='0000-00-00 00:00:00'){ 
		$structuredModified = '"dateModified": "'.$resBlogContent['modified'].'",';
	}else{
		$structuredModified = '';
	}
	echo '
	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "NewsArticle",
	  "mainEntityOfPage": {
		"@type": "WebPage",
		"@id": "http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'"
	  },
	  "headline": "'.$resBlogContent['naam'].'",
	  "image": {
		"@type": "ImageObject",
		"url": "'.HTTP_IMAGE.$resBlogContent['foto_locatie'].'",
		"height": '.$imgheight.',
		"width": '.$imgwidth.'
	  },
	  "datePublished": "'.$resBlogContent['datum'].'",
	  '.$structuredModified.'
	  "author": {
		"@type": "Organization",
		"name": "'.SITENAAM.'"
	  },
	   "publisher": {
		"@type": "Organization",
		"name": "'.SITENAAM.'"
		'.$structuredLogo.'
	  }
	}
	</script>
	
	';
	
}
?>
</div>