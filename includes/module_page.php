<?php
$res = mysqli_query($res1 ,"SELECT * FROM sitetree LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id WHERE sitetree_language.rewrite = '".$array[0]."' AND sitetree_language.language_id='".$_SESSION['language_id']."'");
$row = mysqli_fetch_assoc($res);

//Is readmore active?
if($row['leesmeer']==1){
	$truncate = "customTruncate";
}else{
	$truncate = "";
}

// Get a banner here if there is one
if(getAffiliateBanner(5)!=""){
	echo '<div style="float:right;margin: 0 0 20px 20px;">'.getAffiliateBanner(5).'</div>';
}

// Show text & extra item


// Show plugin if any are selected

?>
<script type="text/javascript">
	$(function(){
		$(".customTruncate").mtruncate({
			maxLines: <?=$row['leesmeerAantal']?>,
			expandText: '<span class="readMore">> Lees meer</span>',
			collapseText: '<span class="readMore">< Lees minder</span>'
		});	
	});	
</script>
		<link rel="stylesheet" href="css/stylesafe.php" />
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="css/skeleton.css" />
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
	<div id="contentContainer">
		<?php if ($row['exttemp']!=""){
			$getCorrectPlugin = mysqli_query($res1, "SELECT *  FROM plugin WHERE id = '".$row['exttemp']."'");
			$resCorrectPlugin = mysqli_fetch_assoc($getCorrectPlugin);
			include('includes/plugin_'.$resCorrectPlugin['plugin'].'.php');
				}
				
			if ($row['bigtext']!="" && !isset($array[1])){
				echo $row['bigtext'];
			}
			if(isset($row['lpintro'])){
				echo $row['lpintro'];
			}
		?>
	</div>