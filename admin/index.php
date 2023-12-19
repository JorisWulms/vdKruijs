<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
ob_start();

require_once ('../includes/prefs.php');

require_once (DIR_SYSTEM . 'includes/database.php');
require_once (DIR_SYSTEM . 'includes/phpmailer/class.phpmailer.php');
//require_once (DIR_SYSTEM . 'includes/phpInputFilter/class.inputfilter.php');
require_once (DIR_SYSTEM . 'includes/session.inc.php');
require_once (DIR_SYSTEM . 'includes/function.php');
require_once (DIR_SYSTEM . 'includes/ThumbLib.inc.php');
require_once (DIR_SYSTEM . ADMIN_PATH . '/includes/filemanager/function-library.php');
require_once (DIR_SYSTEM . ADMIN_PATH . '/safe_admin.php');

  setlocale(LC_ALL, 'nld_nld');

  $action = urldecode(isset($_GET['action']) ? $_GET['action'] : "");
  $site_naam = "Administratie";

function escape($value) {
	global $res1;
	return realescape( $value);
}

$lres1 = mysqli_query($res1 , "SELECT * FROM text_languages ORDER BY id ASC");
while ($lrow = mysqli_fetch_array($lres1)){

	$languages[] = array(
		'languageID' => $lrow['id'],
		'code' =>  (strtolower($lrow['text_langcode'])),
		'name' => $lrow['text_language']
	);
	
}  
  
  
	if (isset($_SESSION['user_status']) && $_SESSION['user_status'] > 3){

		if ($action!=""){
			include ('includes/header.php');
			echo '<div class="box">';
			include ('includes/admin_'.$action.'.php');
		}else{
			include ('includes/header.php');
			echo '<div class="box">';
			include ('includes/admin_dashboard.php');
		}

	}else{
			include ('header.php');
			include('includes/admin_login.php');
			include ('footer.php');
	}
?>

</div>
</div>
</body>
</html>