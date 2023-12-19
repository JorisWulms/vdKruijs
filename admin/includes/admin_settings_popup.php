<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_popup 
								  SET popupContent='".escape($_POST['popupContent'])."',
								  popupTextColor='".escape($_POST['popupTextColor'])."',
								  popupSize='".escape($_POST['popupSize'])."',
								  popupBorderRadius='".escape($_POST['popupBorderRadius'])."',
								  popupCloseBg='".escape($_POST['popupCloseBg'])."',
								  popupCloseColor='".escape($_POST['popupCloseColor'])."',
								  active='".$_POST['active']."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Popup succesvol bijgewerkt.';
				header('Location: index.php?action=settings_popup'); 
			}
		break;
	}	
}
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_popup");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Popup instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_popup&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_popup&route=save" id="form">
		<table>
			<thead>
				<tr>
					<td class="left" width="240"><strong>Popup content</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left">
						<textarea name="popupContent" placeholder="Content voor in de popup" id="editor" class="fullwidth"><?=$resSettings['popupContent']?></textarea>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="list">
			<thead>
				<tr>
					<td class="left" width="240"><strong>Tekst kleur</strong></td>
					<td class="left" width="240"><strong>Popup grootte</strong></td>
					<td class="left" width="240"><strong>Border radius</strong></td>
					<td class="left" width="240"><strong>Close button background</strong></td>
					<td class="left" width="240"><strong>Close button color</strong></td>
					<td class="left" width="240"><strong>Status</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left">
						<input type="text" name="popupTextColor" placeholder="Kleur van tekst in popup" class="colorPicker fullwidth" value="<?=$resSettings['popupTextColor']?>" />
					</td>
					<td class="left">
						<input type="text" name="popupSize" class="fullwidth" value="<?=$resSettings['popupSize']?>" />
					</td>
					<td class="left">
						<input type="text" name="popupBorderRadius" class="fullwidth" value="<?=$resSettings['popupBorderRadius']?>" />
					</td>
					<td class="left">
						<input type="text" name="popupCloseBg" placeholder="Bg color close button" class="colorPicker fullwidth" value="<?=$resSettings['popupCloseBg']?>" />
					</td>
					<td class="left">
						<input type="text" name="popupCloseColor" placeholder="Close button text color" class="colorPicker fullwidth" value="<?=$resSettings['popupCloseColor']?>" />
					</td>
					<td>
						<select name="active" style="width:100%;">
							<option value="0" <?php if($resSettings['active']==0){ echo 'selected="selected"'; } ?>>Inactief</option>
							<option value="1" <?php if($resSettings['active']==1){ echo 'selected="selected"'; } ?>>Actief</option>
						</select>
					</td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_popup&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
	CKEDITOR.replace('editor',
		{
			filebrowserBrowseUrl : 'includes/filemanager.php',
			filebrowserImageBrowseUrl : 'includes/filemanager.php',
			filebrowserFlashBrowseUrl :'includes/filemanager.php',
			filebrowserUploadUrl  :'includes/filemanager.php',
			filebrowserImageUploadUrl : 'includes/filemanager.php',
			filebrowserFlashUploadUrl : 'includes/filemanager.php'
		}
	);
</script>