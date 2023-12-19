<?php
require_once("imageclass.php");
  $id = isset($_GET['id']);


if (isset($_POST['editbanner'])) {

		$query = "SELECT bannerSrc FROM banners WHERE bannerID = '".$_POST["id"]."'";
		$banners = mysqli_fetch_assoc(mysqli_query($res1 ,$query));
		$path = "../images/banners/";
		
		if($_FILES["bannerSrc"]["name"] != ""){
			$name = $_FILES["bannerSrc"]["name"];
			$tmpname = $_FILES["bannerSrc"]["tmp_name"];
			$topImg = new Image($tmpname);
			$info = pathinfo($path.$name);
			$ext = strtolower($info["extension"]);
			$topname = "img_".$_POST['id'].".".$ext;
			$topFileReplaced = $topImg->save($path.$topname);
		}
      $query = mysqli_query($res1 ,"UPDATE slider 
									SET bannerLinkNL='" . escape($_POST['bannerLinkNL']) . "',
									topTextNL='" . escape($_POST['topTextNL']) . "',
									bottomTextNL='" . escape($_POST['bottomTextNL']) . "',
									bannerButtonNL='" . escape($_POST['bannerButtonNL']) . "',
									bannerOverlay='" . (int)$_POST['bannerOverlay'] . "',
									bannerPadding='" . escape($_POST['bannerPadding']) . "',
									bannerOverlayColor='" . escape($_POST['bannerOverlayColor']) . "',
									bannerOverlayOpacity='" . escape($_POST['bannerOverlayOpacity']) . "',
									bannerBackground='" . escape($_POST['bannerBackground']) . "',
									bannerFocus='" . escape($_POST['bannerFocus']) . "',
									bannerOrder='".(int)$_POST['bannerOrder']."'".($topFileReplaced ? ", bannerSrc = '".escape($topname)."'" : "")." 
									WHERE bannerID='" . (int)$_POST['id'] . "'");

		// Combine banners with pages
		mysqli_query($res1,"DELETE
							FROM slider_page
							WHERE bannerID = ".(int)$_POST['id']."");

		foreach($_POST['bannerPage'] as $value){
			mysqli_query($res1,"INSERT INTO slider_page
								SET bannerID = ".(int)$_POST['id'].",
								rewrite = '".$value."'");
		}
		
		if ($query == true) {
			$_SESSION['success'] = 'De banner is met succes gewijzigd.';
			header('Location: index.php?action=banner'); 
		}
}

if (isset($_POST['addbanner'])) {
  $q = "INSERT INTO slider 
		SET topTextNL='" . escape($_POST['topTextNL']) . "',
		bottomTextNL='" . escape($_POST['bottomTextNL']) . "',
		bannerButtonNL='" . escape($_POST['bannerButtonNL']) . "',
		bannerLinkNL='" . escape($_POST['bannerLinkNL']) . "',
		bannerOverlay='" . (int)$_POST['bannerOverlay'] . "',
		bannerPadding='" . escape($_POST['bannerPadding']) . "',
		bannerOverlayColor='" . escape($_POST['bannerOverlayColor']) . "',
		bannerOverlayOpacity='" . escape($_POST['bannerOverlayOpacity']) . "',
		bannerBackground='" . escape($_POST['bannerBackground']) . "',
		bannerFocus='" . escape($_POST['bannerFocus']) . "',
		bannerSrc='".escape($topname)."',
		bannerOrder='".(int)$_POST['bannerOrder']."'";
		
	$query = mysqli_query($res1 ,$q);
	$itemId = mysqli_insert_id($res1);

	$path = "../images/banners/";
	
	if($_FILES["bannerSrc"]["name"] != ""){
		$name = $_FILES["bannerSrc"]["name"];
		$tmpname = $_FILES["bannerSrc"]["tmp_name"];
		$topImg = new Image($tmpname);
		$info = pathinfo($path.$name);
		$ext = strtolower($info["extension"]);
		$topname = "img_".$itemId.".".$ext;
		$topFileReplaced = $topImg->save($path.$topname);
	}
	$q = "UPDATE slider SET bannerSrc='".escape($topname)."' WHERE bannerID='" . (int)$itemId . "'";
	mysqli_query($res1 ,$q);
	
	foreach($_POST['bannerPage'] as $value){
		mysqli_query($res1,"INSERT INTO slider_page
							SET bannerID = ".(int)$itemId.",
							rewrite = '".$value."'");
	}
	
    if ($query == true) {
  		$_SESSION['success'] = 'De banner is met succes toegevoegd.';
		header('Location: index.php?action=banner'); 
    }
}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					$query = mysqli_query($res1 ,"DELETE FROM slider WHERE bannerID='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De banner is succesvol verwijderd.';
					header('Location: index.php?action=banner'); 
				}
			}
		break;	
		case "save":
			if (isset($_POST['bannerOrder'])){
				foreach ($_POST['bannerOrder'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE slider SET bannerOrder='".$value."' WHERE bannerID = ".$id);
				}
			}	
				
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=banner'); 
			}
		break;
	}	
} ?>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Banners</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=banner_add&clear=true'" class="green_btn"><span>Nieuwe banner</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=banner&route=save'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder selectie</span></a>
	</div>
</div>

<div class="content">
	<form method="post" action="index.php?action=banner&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left"><strong>Link</strong></td>
					<td class="left"><strong>Bovenste tekst</strong></td>
					<td class="left"><strong>Onderste tekst</strong></td>
					<td class="left"><strong>Sortering</strong></td>
					<td class="left"><strong>Afbeelding</strong></td>
					<td class="right"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php
				$i=0;
				$res = mysqli_query($res1 ,"SELECT * FROM slider ORDER BY bannerOrder ASC");
				while ($banners = mysqli_fetch_assoc($res)){
				$i++; ?>
				<tr>
					<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $banners['bannerID']; ?>" /></td>
					<td class="left"><?=$banners['bannerLinkNL']?></td>
					<td class="left"><?=$banners['topTextNL']?></td>
					<td class="left"><?=$banners['bottomTextNL']?></td>
					<td  class="left">
						<input type="text" name="bannerOrder[<?=$banners['bannerID']?>]" value="<?=$banners['bannerOrder']?>" size="5">
					</td>
					<td class="left"><img height="150px" src="<?=($banners['bannerSrc'] != "" ? "../images/banners/".$banners['bannerSrc'] : "")?>" /></td>
					<td class="right"><a class="gray_btn" href='index.php?action=banner_edit&clear=true&id=<?=$banners['bannerID']?>'>Wijzig banner</a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</form>
</div>