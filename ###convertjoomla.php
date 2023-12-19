<?php
setlocale(LC_ALL, 'en_US.UTF8');
function toAscii($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}

function seo($name){
	return toAscii(html_entity_decode($name));
}

function encodeUrlParam($titel) {
		$url_data = str_replace('&amp;', '&', $titel);
		$url_data = seo($url_data);
		return $url_data;

}


$res1 = mysql_connect('localhost', 'crossim_hghnew', '5UtAWy0P') or die(mysql_error());
mysql_select_db('crossim_hghnew', $res1) or die('Kon datbase niet selecteren: ' . mysql_error());



$res = mysql_query("SELECT * FROM jos_content");
while ($row = mysql_fetch_assoc($res)){
    $query = mysql_query("INSERT INTO sitetree SET visible=0");
    $siteid = mysql_insert_id();
    
    $query1 = mysql_query("INSERT INTO sitetree_language SET language_id='2', id='".$siteid."', title='".$row['title']."',rewrite='".encodeUrlParam($row['title'])."',bigtext='".mysql_real_escape_string($row['introtext'])."',seodesc='".mysql_real_escape_string($row['metadesc'])."',seokey='".mysql_real_escape_string($row['metakey'])."'");
}

?>