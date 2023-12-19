<?php
	$uploadErr = false;
	$errMsg = "";
	$dir = DIR_GALLERYFILES;
	$maxImageWidth = 1024;
	$maxImageHeight = 768;
	function resizeImage($image, $width, $height)
	{
		$imageInfo = getimagesize($image);
		$imageType = $imageInfo[2];
		switch($imageType)
		{
			case(IMAGETYPE_JPEG):
				$resource = imagecreatefromjpeg($image);
			break;
			case(IMAGETYPE_PNG):
				$resource = imagecreatefrompng($image);
			break;
			case(IMAGETYPE_GIF):
				$resource = imagecreatefromgif($image);
			break;
			default:
				return false;
			break;
		}
		$imgWidth = imagesx($resource);
		$imgHeight = imagesy($resource);
		if($imgWidth >= $imgHeight){
			$newWidth = $width;
			$newHeight = $imgHeight * ((1 / $imgWidth) * $newWidth);
		}else{
			if($imgHeight > $imgWidth){
				$newHeight = $height;
				$newWidth = $imgWidth * ((1 / $imgHeight) * $newHeight);
			}
		}
		$newImage = imagecreatetruecolor($newWidth, $newHeight);
		if(imagecopyresampled($newImage, $resource, 0, 0, 0, 0, $newWidth, $newHeight, $imgWidth, $imgHeight)){
			return $newImage;
		}
		return false;
	}
	function validateImage($img)
	{
		if($img["name"] != ''){
			$allowedExtensions = array("png","jpg","bmp","jpeg","gif");
			if(in_array(end(explode(".", strtolower($img["name"]))), $allowedExtensions)){
				$filesize = $img['size'];
				if($filesize < 5000000){
					return true;
				}else{
					$uploadErr = true;
					$errMsg = "Toevoegen mislukt: de afbeelding is te groot.(maximaal 5MB)";
				}
			}else{
				$uploadErr = true;
				$errMsg = "Toevoegen mislukt: dit bestandsformaat is niet toegestaan.";
			}
		}
		return false;
	}
  if (isset($_POST['editfoto'])) {
    $imageid = $_POST['id'];
	$img = $_FILES["url"];
	$qRes = mysqli_query($res1 ,"SELECT COUNT(*) as cnt FROM project_galerij WHERE galerijid = '".$imageid."'");
	$cnt = mysqli_result($qRes, 0);
	if($img["name"] == ''){
		if($cnt == 0){
			mysqli_query($res1 ,"INSERT INTO project_galerij(galerijid, projectid)VALUES('".$imageid."', '".$_POST['project']."')");
		}else{
			mysqli_query($res1 ,"UPDATE project_galerij SET projectid = '".$_POST['project']."' WHERE galerijid = '".$imageid."'");
		}
		mysqli_query($res1 ,"UPDATE galerij SET descr = '".$_POST['desc']."', visible = '".$_POST['visible']."' WHERE id = '".$imageid."'");
	}else{
		if(validateImage($img)){
			$dest = $dir.$img["name"];
			if(move_uploaded_file($img["tmp_name"], $dest)){
				$newImg = resizeImage($dest, $maxImageWidth, $maxImageHeight);
				if($newImg != false){
					if(imagejpeg($newImg, $dest)){
						if($cnt == 0){
							mysqli_query($res1 ,"INSERT INTO project_galerij(galerijid, projectid)VALUES('".$imageid."', '".$_POST['project']."')");
						}else{
							mysqli_query($res1 ,"UPDATE project_galerij SET projectid = '".$_POST['project']."' WHERE galerijid = '".$imageid."'");
						}
						mysqli_query($res1 ,$query = "UPDATE galerij SET url = '".$img["name"]."', descr = '".$_POST['desc']."', visible = '".$_POST['visible']."' WHERE id = '".$imageid."'");
					}
				}
			}else{
				$uploadErr = true;
				$errMsg = "Bewerken mislukt: kon het bestand niet verplaatsen.";
			}
		}
	}
  }
  if (isset($_POST['addfoto'])) {
	$failed = "";
	for($i = 0; $i < count($_FILES["url"]["name"]); $i++){
		foreach($_FILES["url"] as $key => $value){
			$img[$key] = $value[$i];
		}
		if(validateImage($img)){
			$dest = $dir.$img["name"];
			if(move_uploaded_file($img["tmp_name"], $dest)){
				$newImg = resizeImage($dest, $maxImageWidth, $maxImageHeight);
				if($newImg != false){
					if(imagejpeg($newImg, $dest)){
						mysqli_query($res1 ,"INSERT INTO galerij(id, descr, url, ordering, visible) VALUES (NULL, '".$_POST['desc'][$i]."', '".$img["name"]."', '0', '".$_POST['visible'][$i]."')");
						$id = mysqli_insert_id($res1);
						mysqli_query($res1 ,"INSERT INTO project_galerij(galerijid, projectid)VALUES('".$id."', '".$_POST['project'][$i]."')");
					}else{
						$uploadErr = true;
					}
				}else{
					$uploadErr = true;
				}
			}else{
				$uploadErr = true;
			}
		}
		if($uploadErr){
			$failed .= " | ".$img["name"]."";
		}
	}
	if($uploadErr){
		$errMsg = "Toevoegen mislukt: kon de volgende bestanden niet verplaatsen: ".$failed;
	}
	
	
	
	
	
  }
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					$imgRes = mysqli_query($res1 ,"SELECT url FROM galerij WHERE id ='". $value."'");
					$file = mysqli_fetch_assoc($imgRes);
					if($file['url'] != ''){
						unlink($dir.$file['url']);
                        unlink($dir.'thumbnail/'.$file['url']);
					}
					mysqli_query($res1 ,"DELETE FROM project_galerij WHERE galerijid = '".$value."'");
					mysqli_query($res1 ,"DELETE FROM galerij WHERE id='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De foto is met succes verwijderd.';
					header('Location: index.php?action=photo');
				}
			}
		break;	
		case "order":
			foreach($_POST['order'] as $key => $value){
				if(is_numeric($value)){
					$query = "UPDATE galerij SET ordering = '".$value."' WHERE id = '".$key."'";
					mysqli_query($res1 ,$query);
				}
			}
			$_SESSION['success'] = 'Afbeeldingen zijn gesorteerd.';
			header('Location: index.php?action=photo');
		break;
	}	
}

function showproject($id){
    $output = '';
    $res = mysqli_query($res1 ,"SELECT * FROM project ORDER BY naam ASC");
    while ($row = mysqli_fetch_assoc($res)){
        $output.='<option value="'.$row['id'].'"';
        if ($id == $row['id']){
            $output.= ' selected="selected"';
        }
        $output.='>'.$row['naam'].'</option>';
    }
    return $output;
}

$filter = array();

if (isset($_GET['filter_project'])){
	$filter[] = "pg.projectid='".$_GET['filter_project']."'";
	$url.='&filter_project='.$_GET['filter_project'];
}
if (isset($_GET['filter_descr'])){
	$filter[] = "g.descr LIKE '%".$_GET['filter_descr']."%'";
	$url.='&filter_descr='.$_GET['filter_descr'];
}

$showRecords = 20;

if(isset($_GET['pag'])) {

  $pagina = $_GET['pag'];
  $_SESSION['pag']=$pagina;

   if ($_SESSION['pag']==1){
   $start = 0;
   }else{
   $start = $_SESSION['pag'] * $showRecords - $showRecords;
   }
} else {

  $pagina = 1;
  $start = 0;

}


$tResult = mysqli_query($res1 ,"SELECT * FROM galerij g, project_galerij pg WHERE pg.galerijid = g.id ".(count( $filter ) ? "\nAND " . implode( ' AND ', $filter ) : "")."");
$totaal = mysqli_num_rows($tResult);

if($tResult && $totaal > 0) {
  $pages = ceil($totaal / $showRecords);
} else {
  $pages = 0;
}

$limit="LIMIT ".$start.",".$showRecords."";

$url = 'index.php?action=photo&clear=true';
if(isset($_GET['filter_project'])) {
	$url .= '&filter_project=' . $_GET['filter_project'];
}


$foto_id = isset($_GET['foto_id']);

$res = mysqli_query($res1 ,"SELECT *, g.id AS id, g.ordering AS ordering FROM galerij g INNER JOIN project_galerij pg ON pg.galerijid = g.id INNER JOIN project p ON p.id = pg.projectid ".(count( $filter ) ? "\nWHERE " . implode( ' AND ', $filter ) : "")." GROUP BY g.id ORDER BY p.id DESC, g.ordering ASC ".$limit);
if($uploadErr){
	echo("<script type=\"text/javascript\">alert('".$errMsg."');</script>");
} ?>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Galerij</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=photo_add&clear=true'" class="green_btn"><span>Nieuwe foto</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=photo&route=order'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a>
	</div>
</div>
<div class="content">
<form method="post" action="index.php?action=photo&route=delete" id="form" name="Form1">
<table class="list">
	<thead>
		<tr>
			<td width="1" style="text-align: center;"><input type="checkbox" onclick= "$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			<td class="left"><b>Foto</b></td>
			<td class="left"><b>Beschrijving</b></td>
			<td class="left"><b>Project</b></td>
			<td class="left"><b>Volgorde</b></td>  
			<td class="left"><b>Zichtbaar</b></td>
			<td class="right">Actie</td> 
		</tr>
	</thead>
	<tbody>
        <tr class="filter">
		<td></td>
		<td></td>
		<td><input type="text" value="" name="filter_descr"></td>
		<td><select name="filter_project" style="width:100px;"><option value="*" <?=(isset($_GET['filter_project']) && $_GET['filter_project']=="*")? 'selected="selected"' : ''?>></option><?=showproject(isset($_GET['filter_project']))?></select></td>
		<td></td>
		<td></td>
		<td class="right"><a onclick="filter();" class="gray_btn"><span>Filter</span></a></td>
	</tr>            
	<?php
	$pId = -1;
	while ($row = mysqli_fetch_object($res)){
	?>
		<?php
			if($pId != $row->projectid){
				$pId = $row->projectid;
				echo("<tr style=\"background-color:#cccccc;\"><td style=\"padding:10px;\" colspan=\"2\"><i>Project - ".$row->naam."</i></td><td style=\"padding:10px;\" colspan=\"2\"><i>".$row->beschrijving."</i></td><td></td><td></td><td></td><tr>");
			} ?>
		<tr>
            <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $row->id; ?>" /></td>
			<td valign="middle" class="left"><img src="<?=("../images/gallery/".$row->url)?>" width="100"> <?=$row->url?></td>
			<td valign="top" class="left"><?=$row->descr?></td>
			<td valign="top" class="left"><?=$row->naam?></td>
			<td valign="top" class="left"><input type="text" name="order[<?=$row->id?>]" value="<?=$row->ordering?>" size="4"></td>
			<td valign="top" class="left"><?=($row->visible ? 'Ja' : 'Nee')?></td>
			<td width="10%" class="right">[ <a href="index.php?action=photo_edit&id=<?=$row->id?>">Wijzigen</a> ]</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</form>
    <script type="text/javascript"><!--
function filter() {
	url = 'index.php?action=photo&clear=true';

	var filter_descr = $('input[name=\'filter_descr\']').prop('value');
	if (filter_descr) {
		url += '&filter_descr=' + encodeURIComponent(filter_descr);
	}

	var filter_project = $('select[name=\'filter_project\']').prop('value');
	if (filter_project != '*') {
		url += '&filter_project=' + encodeURIComponent(filter_project);
	}

	location = url;
}
//--></script>
<script type="text/javascript">
function setOrderSubmit()
{
	var form = document.getElementById('form');
	form.action = 'index.php?action=photo&route=order';
	form.submit();
}
</script>
