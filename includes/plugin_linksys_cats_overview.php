<?php
	$getLinksysCats = mysqli_query($res1,"SELECT * FROM linksys_cat");
	$looseCats = '<ul>';
	$fancyCats = '';
	$activeCat = '';
	$arrayCat = (!empty($array[1])) ? $array[1] : '' ;
	while($resLinksysCats = mysqli_fetch_assoc($getLinksysCats)){
		($resLinksysCats['rewrite'] == $arrayCat) ? $activeCat = 'activeCat' : $activeCat = '' ;
		$looseCats .= '<li><a class="'.$activeCat.'" href="'.LINKSYS_PATH.'/'.$resLinksysCats['rewrite'].'.html">'.$resLinksysCats['title'].'</a></li>';
		
		if($resLinksysCats['imagelocation']!=""){
			$background = 'style="background-image: url('.HTTP_IMAGE.'/'.$resLinksysCats['imagelocation'].');"';
		}else{
			$background = 'style="background-color: #202020;"';
		}
		$fancyCats .= '<a class="linksysCatBlock '.$activeCat.'" '.$background.' href="'.LINKSYS_PATH.'/'.$resLinksysCats['rewrite'].'.html"><span>'.$resLinksysCats['title'].'</span></a>';
	}
	$looseCats .= '</ul>';
	
	echo $looseCats;
	echo $fancyCats;