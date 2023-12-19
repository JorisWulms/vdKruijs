<?php
require_once ('prefs.php');
require_once (DIR_SYSTEM . 'includes/database.php');
require_once (DIR_SYSTEM . 'includes/settings.php');

if (is_ajax()) {
	$rewrite = (!empty($_POST['r']) ? $_POST['r'] : '');
	$array = '';
	
	if(!empty($rewrite)){
		$getMaxLines = mysqli_query($res1, "SELECT leesmeerAantal, rewrite 
										    FROM sitetree 
										    LEFT OUTER JOIN sitetree_language 
										    ON sitetree_language.id=sitetree.id 
										    WHERE sitetree_language.rewrite = '".mysqli_real_escape_string($res1,$rewrite)."'");
		if($getMaxLines && mysqli_num_rows($getMaxLines)){
			$row = mysqli_fetch_assoc($getMaxLines);
			$maxLines = $row['leesmeerAantal'];
		}
	}
	
	$array = $maxLines;
	
	$return = json_encode($array);
	echo $return;
}

//Function to check if the request is an AJAX request
function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}