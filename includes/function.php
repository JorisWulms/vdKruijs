<?php
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
	  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
	  $r = hexdec(substr($hex,0,2));
	  $g = hexdec(substr($hex,2,2));
	  $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
       
        $right_links    = $current_page + 3;
        $previous       = $current_page - 1; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
       
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }  
            $first_link = false; //set first link to false
        }
       
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active"><a>'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active"><a>'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }
               
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
                $next_link = ($current_page > $total_pages) ? $total_pages : $current_page+1;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
        }
       
        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}
function BlogCatItems($Categorie, $Selected)
{
	$content = "<select name='$Categorie'>";
	global $res1;
	$q = "SELECT * FROM blog_cat bc, blog_cat_language bcl WHERE bcl.catID = bc.catID AND bcl.language_id='2'";
	$result = mysqli_query($res1, $q);

	while ($row = mysqli_fetch_assoc($result))
	{
		$content .= "<option value='" . $row["catID"] . "'";
		if ($Selected == $row["catID"])
		{
			$content .= "selected=\"selected\"";
		}
		$content .=">" . $row["naam"] .
			"</option>";
	}

	$content .= "</select>";

	return $content;
}

function ShopCatItems($Categorie, $Selected)
{
	$content = "<select name='$Categorie'>";
	global $res1;
	$q = "SELECT * FROM `affiliate_shops_cat`";
	$result = mysqli_query($res1, $q);

	while ($row = mysqli_fetch_assoc($result))
	{
		$content .= "<option value='" . $row["Categorie"] . "'";
		if ($Selected == $row["Categorie"])
		{
			$content .= "selected=\"selected\"";
		}
		$content .=">" . $row["CATNaam"] .
			"</option>";
	}

	$content .= "</select>";

	return $content;
}

function allPlugins($id, $fullWidth = ''){
	global $res1;
	$getAllPlugins = mysqli_query($res1, "SELECT * FROM plugin ORDER BY naam ASC");
	
	echo '<select name="plugin"'.$fullWidth.'>
			<option value="">-</option>';
		while($resAllPlugins = mysqli_fetch_assoc($getAllPlugins)){
			if($resAllPlugins['id'] == $id){
				$selected = ' selected';
			}else{
				$selected = '';
			}
			echo '<option value="'.$resAllPlugins['id'].'"'.$selected.'>'.$resAllPlugins['naam'].'</option>';
		}
		
	echo '</select>';
}

function getAffiliateBanner($location){
	global $res1;
	$getAffiliateBanner = mysqli_query($res1, "SELECT * 
											   FROM affiliate_banner
											   LEFT JOIN affiliate_banner_locatie
											   ON affiliate_banner.bannerID = affiliate_banner_locatie.bannerID
											   WHERE affiliate_banner_locatie.locatie = '".$location."'
											   ORDER BY Rand()");
	$resAffiliateBanner = mysqli_fetch_assoc($getAffiliateBanner);
	if($resAffiliateBanner){
		if($resAffiliateBanner['script']){
			return $affiliateBanner = $resAffiliateBanner['script'];
		}else{
			return $affiliateBanner = '<a href="'.$resAffiliateBanner['url'].'" target="_blank" rel="nofollow">'.$resAffiliateBanner['image'].'</a>';
		}
	}
}

function save_image($img,$fullpath){
    $ch = curl_init ($img);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10);
    curl_setopt($ch, CURLOPT_CURLOPT_TIMEOUT,60);
    $rawdata=curl_exec($ch);
    curl_close ($ch);
   
    if(file_exists($fullpath)){
        unlink($fullpath);
    }
    $fp = fopen($fullpath,'x');
    fwrite($fp, $rawdata);
    fclose($fp);
}

function createthumb($url,$size=''){
    $url = preg_replace('#^https?://#', '', rtrim($url,'/'));   
   
    $img = preg_replace("/[^A-Za-z0-9 ]/", '', $url);
    $img_file = DIR_SYSTEM.'/images/thumbs/'.$img.'.jpg';
   /* $remote_img = 'http://www.bedrijfstelefoongids.nl/screenshots/getImage.php?url=http://'.$url;

    if (is_file($img_file)){
        if (getimagesize($remote_img) > getimagesize('images/thumbs/'.$img.'.jpg')){
            unlink($img_file);
            @save_image($remote_img,$img_file);
        }
    } else {
        @save_image($remote_img,$img_file);
    }*/
	if(is_file($img_file)){
		echo '<img src="images/thumbs/'.$img.'.jpg" alt="'.filesize('images/thumbs/'.$img.'.jpg').'" '.$size.'>';
	}
}

function checkRewrite($rewrite, $language_id)
{
	global $res1;
	$exists = false;

	$q = mysqli_query($res1,"SELECT * FROM sitetree_language WHERE rewrite = '".realescape($rewrite)."' AND language_id ='".(int)$language_id."'");
	if(mysqli_num_rows($q)) {
		$exists = true;
	}

	return $exists;
}

//d-m-Y H:i
function GetTime($Date)
{
	$Date = explode("-",$Date);
	$Date2 = explode(" ",$Date[2]);

	$Date[2] = $Date2[0];
	$Date2 = $Date2[1];
	
	$Date2 = explode(":",$Date2);

	return mktime($Date2[0],$Date2[1],0,$Date[1],$Date[0],$Date[2]);
	
}

//$_FILES['image'] moet het plaatje zijn!
function UploadImage($UploadsDirectory, $ID)
{
	//Image
	if ($_FILES['image']['name'] != "")
	{
		//Settings
		$fieldname = 'image';
		$error = "";

		//Make a name
		$uploadFilename = $UploadsDirectory . $_FILES[$fieldname]['name'];
		$FileName = $_FILES[$fieldname]['name'];

		//Duplicate name cheak
		if (file_exists($uploadFilename))
		{
			//Rename the file
			for ($i = 0; i < 10000; $i++)
			{
				$uploadFilename = $UploadsDirectory . $i . $_FILES[$fieldname]['name'];
				$FileName = $i . $_FILES[$fieldname]['name'];

				if (!file_exists($uploadFilename))
					break;
			}
		}

		//Cheak if it is valid
		$extensie = explode(".", $uploadFilename);
		$extensie = $extensie[count($extensie) - 1];

		if ($extensie == "png" || $extensie == "jpg" || $extensie == "gif")
		{
			if (move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename))
			{
				$q = "UPDATE blogs SET foto_locatie='".realescape($FileName)."' WHERE blogID='" . (int)$ID . "'";

				if (mysqli_query($q))
					$_SESSION['success'] = 'De foto is met succes toegevoegd.';

				return false;
			}
			else
			{
				$error .= "Geen rechten om het plaatje te verplaatsen. ";
			}
		}
		else
		{
			$error .= "Alleen PNG, JPG en GIF plaatjes zijn toegestaat. ";
		}

		return $error;
	}
}

//$_FILES['image'] moet het plaatje zijn!
function UploadLogo($UploadsDirectory)
{
//Image
	if ($_FILES['image']['name'] != "")
	{
		//Settings
		$fieldname = 'image';
		$error = "";

		//Make a name
		$uploadFilename = $UploadsDirectory . $_FILES[$fieldname]['name'];
		$FileName = $_FILES[$fieldname]['name'];

		//Duplicate name cheak
		/*if (file_exists($uploadFilename))
		{
			//Rename the file
			for ($i = 0; i < 10000; $i++)
			{
				$uploadFilename = $UploadsDirectory . $i . $_FILES[$fieldname]['name'];
				$FileName = $i . $_FILES[$fieldname]['name'];

				if (!file_exists($uploadFilename))
					break;
			}
		}*/

		//Cheak if it is valid
		$extensie = explode(".", $uploadFilename);
		$extensie = $extensie[count($extensie) - 1];

		if ($extensie == "png" || $extensie == "jpg" || $extensie == "gif")
		{
			if (move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename))
			{
				$q = "UPDATE `settings_general` SET `logo` = '" . realescape($FileName) .
					"' WHERE `id` = '1'";
				if (mysqli_query($q))
					$_SESSION['success'] = 'De foto is met succes toegevoegd.';

				return false;
			}
			else
			{
				$error .= "Geen rechten om het plaatje te verplaatsen. ";
			}
		}
		else
		{
			$error .= "Alleen PNG, JPG en GIF plaatjes zijn toegestaat. ";
		}

		return $error;
	}
}

// Linksys upload script
function UploadImageLinksys($UploadsDirectory, $ID)
{
	//Image
	if ($_FILES['image']['name'] != "")
	{
		//Settings
		$fieldname = 'image';
		$error = "";

		//Make a name
		$uploadFilename = $UploadsDirectory . $_FILES[$fieldname]['name'];
		$FileName = $_FILES[$fieldname]['name'];

		//Duplicate name cheak
		if (file_exists($uploadFilename))
		{
			//Rename the file
			for ($i = 0; i < 10000; $i++)
			{
				$uploadFilename = $UploadsDirectory . $i . $_FILES[$fieldname]['name'];
				$FileName = $i . $_FILES[$fieldname]['name'];

				if (!file_exists($uploadFilename))
					break;
			}
		}



		//Cheak if it is valid
		$extensie = explode(".", $uploadFilename);
		$extensie = $extensie[count($extensie) - 1];

		if ($extensie == "png" || $extensie == "jpg" || $extensie == "gif")
		{
			if (move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename))
			{
				$q = "UPDATE linksys_cat SET imagelocation='".realescape($FileName)."' WHERE linksysCatID='" . (int)$ID . "'";
				if (mysqli_query($q))
					$_SESSION['success'] = 'De foto is met succes toegevoegd.';
				return false;
			}

			else
			{
				$error .= "Geen rechten om het plaatje te verplaatsen. ";
			}
		}

		else
		{
			$error .= "Alleen PNG, JPG en GIF plaatjes zijn toegestaat. ";
		}

		return $error;
	}
}

// Nodig voor quotes e.d. in inputs
function realescape($sql){
    if (get_magic_quotes_gpc())
    {
        return $sql;
    }
    else
    {
        global $res1; 
        return mysqli_real_escape_string($res1, $sql);
    }
}

// Nodig voor browse in admin
function reloadajax()
{
	global $msg;

	?>
	<script type="text/javascript">
	$(function() {
			function runEffect(){
					$("#effect").show('blind','','fast',callback);
			};

			//callback function to bring a hidden box back
			function callback(){
			$("#effect").html('<?=$msg?>');
					setTimeout(function(){
							$("#effect:visible").removeAttr('style').hide().fadeOut();
					}, 3000);
			};

			//set effect from select menu value
			window.onload = function() {
					runEffect();
					return false;
			};

			$("#effect").hide();
	});
	</script>
	<?php 
}

// Nodig voor error messages
function error()
{
global $msg;

?>
	<script type="text/javascript">
	$(function() {
		function runEffect(){
				$("#error").show('blind','','normal',callback);
		};

		//callback function to bring a hidden box back
		function callback(){
		$("#error").html('<p style="text-align:center;font-weight:bold;z-index:1002;padding-top:30px;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;z-index:1002;"></span><?=$msg?></p>');
				setTimeout(function(){
						$("#error").fadeOut("slow");
				}, 8000);
		};

		//set effect from select menu value
		window.onload = function() {
				runEffect();
				return false;
		};
	});
	</script>
<?php 
}

// Wordt wel nog ergens voor gebruikt.. ?
function mosRedirect($url, $msg = '')
{
global $mainframe;

// specific filters
$iFilter = new InputFilter();
$url = $iFilter->process($url);
if (!empty($msg))
{
    $msg = $iFilter->process($msg);
} //if (!empty($msg))
//if (!empty($msg))

// Strip out any line breaks and throw away the rest
$url = preg_split("/[\r\n]/", $url);
$url = $url[0];

if ($iFilter->badAttributeValue(array('href', $url)))
{
    $url = $GLOBALS['mosConfig_live_site'];
} //if ($iFilter->badAttributeValue(array('href', $url)))
//if ($iFilter->badAttributeValue(array('href', $url)))

if (trim($msg))
{
    if (strpos($url, '?'))
    {
        $url .= '&mosmsg=' . urlencode($msg);
    } //if (strpos($url, '?'))
    //if (strpos($url, '?'))
    else
    {
        $url .= '?mosmsg=' . urlencode($msg);
    } //else
    //else
} //if (trim($msg))

if (headers_sent())
{
    echo "<script>document.location.href='$url';</script>\n";
} //if (headers_sent())
//if (headers_sent())
else
{
    // clear output buffer
    @ob_end_clean();
    header('HTTP/1.1 301 Moved Permanently');
    header("Location: " . $url);
} //else
//else
exit();
} //if (trim($msg))
//function mosRedirect($url, $msg = '')

function antiflood()
{
$antiflood_time = time() + 120;
$cookie = explode(",", $_COOKIE['antiflood']);

if ($cookie[1] >= 20)
{
    echo "<h1>Antiflood activated</h1>";

    echo "<p><b>Probeer het later opnieuw..</b></p>";
    exit();
} //if ($cookie[1] >= 20)
//if ($cookie[1] >= 5)
elseif ($cookie[0] == $_SERVER['PHP_SELF'])
{
    $cookie[1]++;
    setcookie("antiflood", $_SERVER['PHP_SELF'] . "," . $cookie[1], $antiflood_time);
} //elseif ($cookie[0] == $_SERVER['PHP_SELF'])
//elseif ($cookie[0] == $_SERVER['PHP_SELF'])
else
{
    setcookie("antiflood", "");
    setcookie("antiflood", $_SERVER['PHP_SELF'] . ",1", $antiflood_time);
} //else
//else
} //function antiflood()


function filename()
{
return $_ENV['PHP_SELF'];
} //function filename()
//function filename()

function s()
{
return $SID = C_SESS ? SID : '';
} //function s()
//function s()

define('C_PASSB', '16');
define('C_PASSS', '4');

function pregtrim($str)
{
return preg_replace("/[^\x20-\xFF]/", "", @strval($str));
} //function pregtrim($str)
//function pregtrim($str)

function template($text, $vars)
{
$msg = preg_replace("/{(\w+)}/e", "\$vars['\\1']", $text);
return $msg;
} //function template($text, $vars)
//function template($text, $vars)

function create_hash($str)
{
if (is_array($str))
{
    $str = array2string($str);
} //if (is_array($str))
//if (is_array($str))
$str = str_split($str);
$chunkStr = md5('een geheim woord met veel rare tekens #)%*Qfvdvdk8439312');

for ($i = 0; $i < count($str); $i++)
{
    $chunkStr .= md5($str[$i]);
} //for ($i = 0; $i < count($str); $i++)
//for ($i = 0; $i < count($str); $i++)

$str = md5(sha1(base64_encode($chunkStr)));
return $str;
} //function create_hash($str)
//function create_hash($str)

if (phpversion() < "5")
{
// define PHP5 functions if server uses PHP4

function str_split($text, $split = 1)
{
    if (!is_string($text))
        return false;
    if (!is_numeric($split) && $split < 1)
        return false;
    $len = strlen($text);
    $array = array();
    $s = 0;
    $e = $split;
    while ($s < $len)
    {
        $e = ($e < $len) ? $e : $len;
        $array[] = substr($text, $s, $e);
        $s = $s + $e;
    } //while ($s < $len)
    //while ($s < $len)
    return $array;
} //function str_split($text, $split = 1)
//function str_split($text, $split = 1)
} //if (phpversion() < "5")


function encodeUrlParam($string){

        $string = trim($string);

        if(ctype_digit($string)){

                return $string;

        }
        else {

                // replace accented chars
                $accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
                $string_encoded = htmlentities($string,ENT_NOQUOTES,'UTF-8');

                $string = preg_replace($accents,'$1',$string_encoded);

                // clean out the rest
                $replace = array('([\40])','([^a-zA-Z0-9-])','(-{2,})');
                $with = array('-','','-');
                $string = preg_replace($replace,$with,$string);

                $string = strtolower($string);

                //clean accents
                $string = str_replace(array("grave","acute","circ","cedil","uml"), array("","","","",""), $string);

                                //clean amp
                $string = str_replace("--", "-", $string);

        }

        return $string;

}

function mosMakePassword($length=8) {
        $salt                 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $makepass        = '';
        mt_srand(10000000*(double)microtime());
        for ($i = 0; $i < $length; $i++)
                $makepass .= $salt[mt_rand(0,61)];
        return $makepass;
}

/* CLASSES */
class backlinkChecker {
	
	var $url; 
	var $content; 
	var $links; 
	var $link_to_check; 
	var $found;
	
	function __construct( $url, $link_to_check ) { 
		$this->url = $url; 
		$this->link_to_check = $link_to_check; 
	}
	
	function set_link_to_check( $link ) {
		$this->link_to_check = $link; 
	}
	
	function get_contents() { 
	 $this->content = file_get_contents( $this->url ); 
	}  
	/*
	function fetch_links() {
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		preg_match_all( "/$regexp/siU", $this->content, $matches );
		$this->links = $matches;
		
		return $matches; 
	}*/
	
	function fetch_links() {
		$mystring = $this->content;
		$findme   = $this->link_to_check;
		$pos = strpos($mystring, $findme);
		$this->found = $pos;
		
		return $pos;
	}
	
	function check() {
		/*foreach( $this->links[2] as $key => $url ) {
			if ( $this->link_to_check == $url )
				return TRUE; 
		} */
		
		return $this->found;	
	}
	
} // end class