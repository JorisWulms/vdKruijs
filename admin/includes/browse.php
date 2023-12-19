<?php

ini_set("display_errors", 0);
error_reporting(E_ALL);

require_once ('../../includes/prefs.php');


require_once (DIR_SYSTEM . 'includes/image.php');
require_once (DIR_SYSTEM . ADMIN_PATH . '/includes/image.php');

function encode($data) {
	if (function_exists('json_encode')) {
		return json_encode($data);
	} else {
		switch (gettype($data)) {
			case 'boolean':
				return $data ? 'true' : 'false';
			case 'integer':
			case 'double':
				return $data;
			case 'resource':
			case 'string':
				return '"' . str_replace(array("\r", "\n", "<", ">", "&"), array('\r', '\n', '\x3c', '\x3e', '\x26'), addslashes($data)) . '"';
			case 'array':
				if (empty($data) || array_keys($data) === range(0, sizeof($data) - 1)) {
					$output = array();
					
					foreach ($data as $value) {
						$output[] = Json::encode($value);
					}
					
					return '[ ' . implode(', ', $output) . ' ]';
				}
			case 'object':
				$output = array();
				
				foreach ($data as $key => $value) {
					$output[] = Json::encode(strval($key)) . ': ' . Json::encode($value);
				}
				
				return '{ ' . implode(', ', $output) . ' }';
			default:
				return 'null';
		}
	}
}

$directory = HTTP_USERFILES . 'userfiles/';

if (isset($_GET['field'])) {
	$field = $_GET['field'];
} else {
	$field = '';
}

if (isset($_GET['CKEditorFuncNum'])) {
	$fckeditor = TRUE;
} else {
	$fckeditor = FALSE;
}



if (isset($_GET['directory'])) {	
	$json = array();
	
	if (isset($_POST['directory'])) {
		$directories = glob(rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['directory']), '/') . '/*', GLOB_ONLYDIR); 
		
		if ($directories) {
			$i = 0;
		
			foreach ($directories as $directory) {
				$json[$i]['data'] = basename($directory);
				$json[$i]['attributes']['directory'] = substr($directory, strlen(DIR_USERFILES . 'userfiles/'));
				
				$children = glob(rtrim($directory, '/') . '/*', GLOB_ONLYDIR);
				
				if ($children)  {
					$json[$i]['children'] = ' ';
				}
				
				$i++;
			}
		}		
	}

	echo encode($json);	
}

if (isset($_GET['files'])){
	$json = array();
	
	
	if (isset($_POST['directory']) && $_POST['directory']) {
		$directory = DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['directory']);
	} else {
		$directory = DIR_USERFILES . 'userfiles/';
	}
	
	$allowed = array(
		'.jpg',
		'.jpeg',
		'.png',
		'.gif'
	);
	

	$files = glob(rtrim($directory, '/') . '/*');
	
	if (is_array($files)){
	foreach ($files as $file) {
		if (is_file($file)) {
			$ext = strrchr($file, '.');
		} else {
			$ext = '';
		}	
		
		if (in_array(strtolower($ext), $allowed)) {
			$size = filesize($file);

			$i = 0;

			$suffix = array(
				'B',
				'KB',
				'MB',
				'GB',
				'TB',
				'PB',
				'EB',
				'ZB',
				'YB'
			);

			while (($size / 1024) > 1) {
				$size = $size / 1024;
				$i++;
			}
				
			$json[] = array(
				'file'     => substr($file, strlen(DIR_USERFILES . 'userfiles/')),
				'filename' => basename($file),
				'size'     => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
				'thumb'    => resize(substr($file, strlen(DIR_USERFILES)), 100, 100)
			);
		}
	}
	}
	
	echo encode($json);	
}	

if (isset($_GET['upload'])){
	$json = array();

	if (isset($_POST['directory'])) {
		if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
			if ((strlen(utf8_decode($_FILES['image']['name'])) < 3) || (strlen(utf8_decode($_FILES['image']['name'])) > 255)) {
				$json['error'] = 'Waarschuwing: Bestandsnaam moet minimaal 4 en maximaal 255 tekens zijn!';
			}
				
			$directory = rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['directory']), '/');
			
			if (!is_dir($directory)) {
				$json['error'] = 'Waarschuwing: Selecteer een map!';
			}
			
			if ($_FILES['image']['size'] > 300000) {
				$json['error'] = 'Waarschuwing: Het bestand is te groot. Het bestand moet minder dan 300kb zijn en de hoogte of breedte niet meer dan 1000px!';
			}
			
			$allowed = array(
				'image/jpeg',
				'image/pjpeg',
				'image/png',
				'image/x-png',
				'image/gif',
				'application/x-shockwave-flash'
			);
					
			if (!in_array($_FILES['image']['type'], $allowed)) {
				$json['error'] = 'Waarschuwing: Onjuist bestand formaat (soort)!';
			}
			
			$allowed = array(
				'.jpg',
				'.jpeg',
				'.gif',
				'.png',
				'.flv'
			);
					
			if (!in_array(strtolower(strrchr($_FILES['image']['name'], '.')), $allowed)) {
				$json['error'] = 'Waarschuwing: Onjuist bestand formaat (soort)!';
			}

			
			if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = 'error_upload_' . $_FILES['image']['error'];
			}			
		} else {
			$json['error'] = 'Waarschuwing: Selecteer een bestand!';
		}
	} else {
		$json['error'] = 'Waarschuwing: Selecteer een map!';
	}

//	if (!$this->user->hasPermission('modify', 'common/filemanager')) {
//		$json['error'] = 'Waarschuwing: Toegang geweigerd!';  
//	}

	if (!isset($json['error'])) {	
		if (@move_uploaded_file($_FILES['image']['tmp_name'], $directory . '/' . basename($_FILES['image']['name']))) {		
			$json['success'] = 'Succes: Bestand is toegevoegd!';
		} else {
			$json['error'] = 'Waarschuwing: Het bestand kon niet worden toegevoegd om onbekende reden!';
		}
	}


		echo encode($json);	
}

if (isset($_GET['create'])) {
			
	$json = array();
	
	if (isset($_POST['directory'])) {
		if (isset($_POST['name']) || $_POST['name']) {
			$directory = rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['directory']), '/');							   
			
			if (!is_dir($directory)) {
				$json['error'] = 'Waarschuwing: Selecteer een map!';
			}
			
			if (file_exists($directory . '/' . str_replace('../', '', $_POST['name']))) {
				$json['error'] = 'Waarschuwing: Een bestand of map met deze naam bestaat al!';
			}
		} else {
			$json['error'] = 'Waarschuwing: Geef een andere naam!';
		}
	} else {
		$json['error'] = 'Waarschuwing: Selecteer een map!';
	}
	
//	if (!$this->user->hasPermission('modify', 'common/filemanager')) {
//		$json['error'] = $this->language->get('error_permission');  
//	}
	
	if (!isset($json['error'])) {	
		mkdir($directory . '/' . str_replace('../', '', $_POST['name']), 0777);
		
		$json['success'] = 'Succes: Map is aangemaakt!';
	}	
	

	echo encode($json);	
}

if (isset($_GET['delete'])) {
	
	$json = array();
	
	if (isset($_POST['path'])) {
		$path = rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['path']), '/');
		 
		if (!file_exists($path)) {
			$json['error'] = 'Waarschuwing: Selecteer een map of bestand!';
		}
		
		if ($path == rtrim(DIR_USERFILES . 'userfiles/', '/')) {
			$json['error'] = 'Waarschuwing: U kunt deze map niet verwijderen!';
		}
	} else {
		$json['error'] = 'Waarschuwing: Selecteer een map of bestand!';
	}
	
	if (!isset($json['error'])) {
		if (is_file($path)) {
			unlink($path);
		} elseif (is_dir($path)) {
			recursiveDelete($path);
		}
		
		$json['success'] = 'Succes: Bestand of map is verwijderd!';
	}				
	
	
	echo encode($json);
}

function recursiveDelete($directory) {
	if (is_dir($directory)) {
		$handle = opendir($directory);
	}
	
	if (!$handle) {
		return FALSE;
	}
	
	while (false !== ($file = readdir($handle))) {
		if ($file != '.' && $file != '..') {
			if (!is_dir($directory . '/' . $file)) {
				unlink($directory . '/' . $file);
			} else {
				recursiveDelete($directory . '/' . $file);
			}
		}
	}
	
	closedir($handle);
	
	rmdir($directory);
	
	return TRUE;
}

if (isset($_GET['move'])) {
	
	$json = array();
	
	if (isset($_POST['from']) && isset($_POST['to'])) {
		$from = rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['from']), '/');
		
		if (!file_exists($from)) {
			$json['error'] = 'Waarschuwing: Bestand of map bestaat niet!';
		}
		
		if ($from == DIR_USERFILES . 'userfiles') {
			$json['error'] = 'Waarschuwing: Kan uw standaard map niet wijziging!';
		}
		
		$to = rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['to']), '/');

		if (!file_exists($to)) {
			$json['error'] = 'Waarschuwing: Verplaatsen naar map bestaat niet!';
		}	
		
		if (file_exists($to . '/' . basename($from))) {
			$json['error'] = 'Waarschuwing: Een bestand of map met deze naam bestaat al!';
		}
	} else {
		$json['error'] = 'Waarschuwing: Selecteer een map!';
	}
	
	if (!isset($json['error'])) {
		rename($from, $to . '/' . basename($from));
		
		$json['success'] = 'Succes: Bestand of map is verplaatst!';
	}
	
	echo encode($json);
	
}	

if (isset($_GET['copy'])) {
	
	$json = array();
	
	if (isset($_POST['path']) && isset($_POST['name'])) {
		if ((strlen(utf8_decode($_POST['name'])) < 3) || (strlen(utf8_decode($_POST['name'])) > 255)) {
			$json['error'] = 'Waarschuwing: Bestandsnaam moet minimaal 4 en maximaal 255 tekens zijn!';
		}
			
		$old_name = rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['path']), '/');
		
		if (!file_exists($old_name) || $old_name == DIR_USERFILES . 'userfiles') {
			$json['error'] = 'Waarschuwing: U kunt het bestand of de map niet kopi&euml;ren!';
		}
		
		if (is_file($old_name)) {
			$ext = strrchr($old_name, '.');
		} else {
			$ext = '';
		}		
		
		$new_name = dirname($old_name) . '/' . str_replace('../', '', $_POST['name'] . $ext);
																		   
		if (file_exists($new_name)) {
			$json['error'] = 'Waarschuwing: Een bestand of map met deze naam bestaat al!';
		}			
	} else {
		$json['error'] = 'Waarschuwing: Selecteer een map of bestand!';
	}
	
	
	if (!isset($json['error'])) {
		if (is_file($old_name)) {
			copy($old_name, $new_name);
		} else {
			recursiveCopy($old_name, $new_name);
		}
		
		$json['success'] = 'Succes: Bestand of map is gekopieerd!';
	}

	echo encode($json);	
}

function recursiveCopy($source, $destination) { 
	$directory = opendir($source); 
	
	@mkdir($destination); 
	
	while (false !== ($file = readdir($handle))) {
		if (($file != '.') && ($file != '..')) { 
			if (is_dir($source . '/' . $file)) { 
				recursiveCopy($source . '/' . $file, $destination . '/' . $file); 
			} else { 
				copy($source . '/' . $file, $destination . '/' . $file); 
			} 
		} 
	} 
	
	closedir($directory); 
} 

if (isset($_GET['folders'])) {
	echo recursiveFolders(DIR_USERFILES . 'userfiles/');	
}


function recursiveFolders($directory) {
	$output = '';
	
	$output .= '<option value="' . substr($directory, strlen(DIR_USERFILES . 'userfiles/')) . '">' . substr($directory, strlen(DIR_USERFILES . 'userfiles/')) . '</option>';
	
	$directories = glob(rtrim(str_replace('../', '', $directory), '/') . '/*', GLOB_ONLYDIR);
	
	foreach ($directories  as $directory) {
		$output .= recursiveFolders($directory);
	}
	
	return $output;
}

if (isset($_GET['rename'])) {
	
	$json = array();
	
	if (isset($_POST['path']) && isset($_POST['name'])) {
		if ((strlen(utf8_decode($_POST['name'])) < 3) || (strlen(utf8_decode($_POST['name'])) > 255)) {
			$json['error'] = 'Waarschuwing: Bestandsnaam moet minimaal 4 en maximaal 255 tekens zijn!';
		}
			
		$old_name = rtrim(DIR_USERFILES . 'userfiles/' . str_replace('../', '', $_POST['path']), '/');
		
		if (!file_exists($old_name) || $old_name == DIR_USERFILES . 'userfiles') {
			$json['error'] = 'Waarschuwing: U kunt deze map niet hernoemen!';
		}
		
		if (is_file($old_name)) {
			$ext = strrchr($old_name, '.');
		} else {
			$ext = '';
		}		
		
		$new_name = dirname($old_name) . '/' . str_replace('../', '', $_POST['name'] . $ext);
																		   
		if (file_exists($new_name)) {
			$json['error'] = 'Waarschuwing: Een bestand of map met deze naam bestaat al!';
		}			
	}
	
	
	if (!isset($json['error'])) {
		rename($old_name, $new_name);
		
		$json['success'] = 'Succes: Bestand of map is hernoemd!';
	}

	echo encode($json);	
}


?>