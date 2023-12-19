<?php
// GET THE BLOG SETTINGS
$getBlogSettings = mysqli_query($res1 ,"SELECT * FROM settings_blogs");
$resBlogSettings = mysqli_fetch_assoc($getBlogSettings);

$getBlogs = mysqli_query($res1 ,"SELECT *, 
						 blog_cat_language.naam AS catnaam, 
						 blogs_language.naam AS blognaam, 
						 blogs_language.beschrijving AS blogbeschrijving, 
						 blogs_language.rewrite AS rewrite
						 FROM blogs_language
						 LEFT JOIN blogs
						 ON blogs_language.blogID = blogs.blogID
						 LEFT JOIN blog_cat_language
						 ON blogs.catID = blog_cat_language.catID
						 WHERE blogs.catID != 0
						 AND blogs.visable = 1
						 ORDER BY Rand() 
						 LIMIT ".$resBlogSettings['randomAmt']."");
						 
// BLOCKS LAYOUT 1 - FANCY HOVER BLOCKS		 
if($resBlogSettings['layoutTypeRandom'] == 1){

	$blogsOutput = '';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		// Remove the H1 from blog description
		$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
		$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
		
		$blogsOutput .='
		<a class="blockOne" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
			<span class="category">'.$resBlogs['catnaam'].'</span>
			<span class="image" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center /cover no-repeat;"></span>
			<span class="shortText">
				<span class="title">'.$resBlogs['blognaam'].'</span>
				<span class="text">'.strip_tags($displayText).'...</span>
			</span>
			<span class="fadeText"></span>
		</a>';
	}
?>
	<div id="blocksOne">
		<div class="container">
			<div class="rowOne">
				<?=$blogsOutput?>
			</div>
		</div>
	</div>
<?php 
} 

// BLOCKS LAYOUT 2 - IMAGE TEXT BUTTON		 
if($resBlogSettings['layoutTypeRandom'] == 2){	
	$blogsOutput = '';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		// Remove the H1 from blog description
		$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
		$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
		
		$blogsOutput .='
		<div class="blockTwo">
			<span class="image" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center no-repeat;"></span>
			<span class="title">'.$resBlogs['blognaam'].'</span>
			<p class="text">'.strip_tags($displayText).'...</p>
			<a href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">Lees meer</a>
		</div>';
	}
?>
	<div id="blocksTwo">
		<div class="container">
			<div class="rowTwo">
				<?=$blogsOutput?>
			</div>
		</div>
	</div>
<?php 
} 

// BLOCKS LAYOUT 3 - COLUMNS 
if($resBlogSettings['layoutTypeRandom'] == 3){

	$blogsOutput = '';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		$i = mt_rand(0,200);
		$varRandTxtAmt = $resBlogSettings['randomTxtAmt'] + $i;
		
		// Remove the H1 from blog description
		$displayText = substr($resBlogs['blogbeschrijving'],0,$varRandTxtAmt);
		$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
	
		$blogsOutput .='
		<a class="blockThree" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">
			<span class="image"><img src="images/blog/'.$resBlogs['foto_locatie'].'" alt="'.$resBlogs['blognaam'].'" /></span>
			<span class="shortText">
				<span class="title">'.$resBlogs['blognaam'].'</span>
				<span class="text">'.strip_tags($displayText).'...</span>
			</span>
		</a>
		<div class="gutter-sizer"></div>';
	}
?>
	<div id="blocksThree">
		<div class="container">
			<div class="columnBlock">
				<?=$blogsOutput?>
			</div>
		</div>
	</div>
<?php 
} 
// BLOCKS LAYOUT 4 - FANCY HOVER BLOCKS	V2	 
if($resBlogSettings['layoutTypeRandom'] == 4){
	$blogsOutput = '';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		// Remove the H1 from blog description
		$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
		$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
		
		$blogsOutput .='
		<a class="blockFour" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center no-repeat;">
			<span class="shortText">
				<span class="title">'.$resBlogs['blognaam'].'</span>
				<span class="text">'.strip_tags($displayText).'...</span>
			</span>
		</a>';
	}
?>
	<div id="blocksFour">
		<div class="container">
			<div class="rowOne">
				<?=$blogsOutput?>
			</div>
		</div>
	</div>
<?php 
}

// BLOCKS LAYOUT 5 - HALF OM HALF EN EEN HELE
if($resBlogSettings['layoutTypeRandom'] == 5){
	
	$blogsOutput = '';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		// Remove the H1 from blog description
		$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
		$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
		
		$blogsOutput .='
		<div class="blockFive">
			<a  class="blogImg" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html" style="background: url(images/blog/'.$resBlogs['foto_locatie'].') center center no-repeat;"></a>
			<span class="shortText">
				<span class="title"><a href>'.$resBlogs['blognaam'].'</a></span>
				<span class="category">'.$resBlogs['catnaam'].'</span>
				<span class="text">'.strip_tags($displayText).'...</span>
				<a class="blogLink" href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html">Lees meer</a>
			</span>
		</div>
		';
	}
?>
	<div id="blocksFive">
		<div class="container">
			<div class="rowOne">
				<?=$blogsOutput?>
			</div>
		</div>
	</div>
<?php 
}
// BLOCKS LAYOUT 6 - CUSTOM RANDOM BLOGS
if($resBlogSettings['layoutTypeRandom'] == 6){
	
	$blogsOutput = '';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		// Remove the H1 from blog description
		$displayText = substr($resBlogs['blogbeschrijving'],0,$resBlogSettings['randomTxtAmt']);
		$displayText = preg_replace('#<h([1-6])(.*?)<\/h[1-6]>#si', '', $displayText);
		
		$blogsOutput .='';
	}
}

// BLOCKS LAYOUT 7 - 5 small BLOCKS
if($resBlogSettings['layoutTypeRandom'] == 7){
	
	$blogsOutput = '<ul>';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		$blogsOutput .='
		<a href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html" style="background-image: url(images/blog/'.$resBlogs['foto_locatie'].');" class="linksysCatBlock ">
			<span>'.$resBlogs['blognaam'].'</span>
		</a>
		';
	}
	$blogsOutput .= '</ul>';
?>
	<div id="blocksSeven">
		<div class="container">
			<div class="linksys_overview">
				<?=$blogsOutput?>
			</div>
		</div>
	</div>
<?php 
}

// BLOCKS LAYOUT 8 - FULLWIDTH ROW
if($resBlogSettings['layoutTypeRandom'] == 8){
	
	$blogsOutput = '';
	while($resBlogs = mysqli_fetch_assoc($getBlogs)){
		$blogsOutput .='
		<a href="'.BLOG_PATH.'/'.$resBlogs['rewrite'].'.html" style="background-image: url(images/blog/'.$resBlogs['foto_locatie'].');">
			<span class="roundFX"></span>
			<span class="blogName">'.$resBlogs['blognaam'].'</span>
		</a>
		';
	}
?>
	<div id="blocksEight">
		<?=$blogsOutput?>
	</div>
<?php 
}