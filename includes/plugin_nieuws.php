<?php
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_nieuws");
$resSettings = mysqli_fetch_assoc($getSettings);

if(isset($array[1])){
$getNewsData = mysqli_query($res1 ,"SELECT * 
								FROM news n, news_language nl 
								WHERE nl.rewrite='".realescape($array[1])."' 
								AND nl.id = n.id 
								AND nl.language_id = '2'");


	$newsData = mysqli_fetch_assoc($getNewsData);
	echo $newsData['bigtext'];
	if($newsData['modified']!='0000-00-00'){ 
		echo '<br/>Laatst gewijzigd: '.$newsData['modified'].'<br/>';
	}
	echo '<a href="'.$array[0].'.html" class="red_button">Terug naar nieuwsoverzicht</a>';
}else{
// NEWS OVERVIEW
	$limit = '';
	$textLimit = '';
	
	if($array[0]!=NEWS_PATH){
		$limit = ' LIMIT '.$resSettings['pluginAmt'];
		$textLimit = $resSettings['pluginTextAmt'];
	}else{
		$textLimit = $resSettings['overviewTextAmt'];
	}
	$getNewsItems = mysqli_query($res1 ,"SELECT * FROM news n, news_language nl WHERE nl.id = n.id AND nl.language_id = '2' ORDER BY n.datum DESC".$limit."");
	
	while ($resNewsItems = mysqli_fetch_array($getNewsItems)){
		echo '<a class="newsItem" href="'.NEWS_PATH.'/'.$resNewsItems['rewrite'].'.html">';
			echo '<span class="newsLeft">';
				if($resNewsItems['foto_locatie']!=""){ echo '<img src="'.HTTP_NEWSIMAGE.'/'.$resNewsItems['foto_locatie'].'" />'; }
			echo '</span>';
			echo '<span class="newsRight">';
				echo '<span class="newsTitle">'.$resNewsItems['title'].'</span>';
				echo '<span class="newsDate">'.$resNewsItems['datum'].'</span>';
				echo '<span class="newsDesc">'.substr(strip_tags($resNewsItems['bigtext']),0,$textLimit).'...</span>';
			echo '</span>';
		echo '</a>';
	}
	if($array[0]!=NEWS_PATH){
		echo '<a class="viewNews" href="'.NEWS_PATH.'.html"><span>Bekijk al het nieuws</span></a>';
	}
}
