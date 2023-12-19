<?php
require_once ('../../includes/prefs.php');

require_once (DIR_SYSTEM . 'includes/database.php');
require_once (DIR_SYSTEM . 'includes/function.php');

session_start();

if (is_ajax()) {
	if (!empty($_POST)) {
		$titel = $_POST['title'];
		$lang = $_POST['lang'];
		$rewrite = encodeUrlParam($titel);

		$json['check'] = checkRewrite($rewrite, $lang);
		$json['rewrite'] = $rewrite;

		echo json_encode($json);
	}
}
//Function to check if the request is an AJAX request
function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}