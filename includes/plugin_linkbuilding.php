<?php
	if($array[0]=="" || $array[0]=="index"){
		($resSettingsLinkbuilding['extraPosition']==2 ? $extraPos = ' nextToAnchor' : $extraPos = '');
		$getLinks = mysqli_query($res1 ,"SELECT * FROM linkbuilding");
		if(mysqli_num_rows($getLinks)){
			while($resLinks = mysqli_fetch_assoc($getLinks)){
				echo '<div class="extraLink'.$extraPos.'"><a href="'.$resLinks['url'].'" target="_blank">'.$resLinks['anchortext'].'</a>'.(!empty($resLinks['extraText']) ? '<span>'.$resLinks['extraText'].'</span>' : '' ).'</div>';
			}
		}
	}
?>