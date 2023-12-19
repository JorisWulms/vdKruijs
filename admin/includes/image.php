<?php
function resize($filename, $width, $height) {
	if (!file_exists(DIR_USERFILES . $filename) || !is_file(DIR_USERFILES . $filename)) {
		return;
	} 
	
	$info = pathinfo($filename);
	$extension = $info['extension'];
	
	$old_image = $filename;
	$new_image = 'cache/' . substr($filename, 0, strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;
	
	if (!file_exists(DIR_USERFILES . $new_image) || (filemtime(DIR_USERFILES . $old_image) > filemtime(DIR_USERFILES . $new_image))) {
		$path = '';
		
		$directories = explode('/', dirname(str_replace('../', '', $new_image)));
		
		foreach ($directories as $directory) {
		
			$path = $path . '/' . $directory;
			
			if (!file_exists(DIR_USERFILES . $path)) {
				@mkdir(DIR_USERFILES . $path, 0777);
			}		
		}
		
		$image = new Image(DIR_USERFILES . $old_image);
		$image->resize($width, $height);
		$image->save(DIR_USERFILES . $new_image);
	}

	return HTTP_USERFILES . $new_image;
	
}
?>