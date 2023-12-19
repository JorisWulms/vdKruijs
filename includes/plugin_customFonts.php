<?php
$getFont = mysqli_query($res1, "SELECT fontFamily1, fontFamily2
								FROM settings_style");
$resFont = mysqli_fetch_assoc($getFont);

// Default fonts that do not require the google fonts API
$defaultFonts = array('Arial','Calibri','Helvetica','Verdana','Georgia','Palatino','Times New Roman','Impact','Tahoma');

if(!in_array($resFont['fontFamily1'],$defaultFonts)){
	// Open Sans Condensed does not have a default 400 font-weight, so we have to make a custom request for that
	($resFont['fontFamily1'] == 'Open+Sans+Condensed' ? $resFont['fontFamily1']='Open+Sans+Condensed:300,700': $resFont['fontFamily1'] = $resFont['fontFamily1']);
	
	echo '<link href="https://fonts.googleapis.com/css?family='.$resFont['fontFamily1'].'" rel="stylesheet" type="text/css">';
}
if(!in_array($resFont['fontFamily2'],$defaultFonts)){
	// Open Sans Condensed does not have a default 400 font-weight, so we have to make a custom request for that
	($resFont['fontFamily2'] == 'Open+Sans+Condensed' ? $resFont['fontFamily2']='Open+Sans+Condensed:300,700': $resFont['fontFamily2'] = $resFont['fontFamily2']);
	
	echo '<link href="https://fonts.googleapis.com/css?family='.$resFont['fontFamily2'].'" rel="stylesheet" type="text/css">';
}