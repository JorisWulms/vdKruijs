<?php

if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM linkbuilding WHERE id='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De pagina is met succes verwijderd.';
					header('Location: index.php?action=linkbuilding'); 
				}
			}
		break;	
		case "save":

			mysqli_query($res1 ,"START TRANSACTION");
			
			mysqli_query($res1 ,"DELETE FROM linkbuilding");
			
			if (isset($_POST['id'])){
				foreach ($_POST['id'] as $id => $tmp){
					$query = mysqli_query($res1 ,"INSERT INTO linkbuilding SET url='".$_POST['url'][$id]."', anchortext = '".$_POST['anchortext'][$id]."', extraText = '".$_POST['extraText'][$id]."'");
				}
			}	
			
			mysqli_query($res1 ,"COMMIT");
			
			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=linkbuilding'); 
			}
		break;
		case "savesettings":
			$query = mysqli_query($res1 ,"UPDATE settings_linkbuilding
								  SET position = '".(int)$_POST['position']."',
								  extraPosition = '".(int)$_POST['extraPosition']."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=linkbuilding'); 
			}
	}	
}
$getLinks = mysqli_query($res1 ,"SELECT * FROM linkbuilding");

$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_linkbuilding");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Linkbuilding links op homepage</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=linkbuilding&route=save'); $('#form').submit();" class="green_btn"><span>Links Opslaan</span></a>
		<a onclick="$('#savesettings').attr('action', 'index.php?action=linkbuilding&route=savesettings'); $('#form').submit();" class="green_btn"><span>Settings Opslaan</span></a>
		<span id="copyButton" class="green_btn">Voeg link toe</span>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=linkbuilding&route=savesettings" id="savesettings">
		<table class="list">
			<thead>
				<tr>
					<td class="left" width="240"><strong>Waar moeten de linkjes komen?</strong></td>
					<td class="left" width="240"><strong>Waar moet de extra tekst komen?</strong></td>
					<td class="left" width="240"></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<input type="hidden" name="id" value="1" />
					<td class="left">
						<select name="position">
							<option value="1" <?php if($resSettings['position']==1){ echo 'selected="selected"'; } ?>>In de footer</option>
							<option value="2" <?php if($resSettings['position']==2){ echo 'selected="selected"'; } ?>>In blok rechts langs home tekst</option>
							<option value="3" <?php if($resSettings['position']==3){ echo 'selected="selected"'; } ?>>Onder de home text</option>
							<option value="4" <?php if($resSettings['position']==4){ echo 'selected="selected"'; } ?>>In de topheader</option>
							<option value="5" <?php if($resSettings['position']==5){ echo 'selected="selected"'; } ?>>Boven de home text</option>
						</select>
					</td>
					<td class="left">
						<select name="extraPosition">
							<option value="1" <?php if($resSettings['extraPosition']==1){ echo 'selected="selected"'; } ?>>Onder de link</option>
							<option value="2" <?php if($resSettings['extraPosition']==2){ echo 'selected="selected"'; } ?>>Langs de link</option>
						</select>
					</td>
					<td>
						<a onclick="$('#form').attr('action', 'index.php?action=linkbuilding&route=savesettings'); $('#savesettings').submit();" class="green_btn"><span>Settings opslaan</span></a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<form method="post" action="index.php?action=linkbuilding&route=save" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="240"><strong>URL</strong></td>
					<td class="left" width="240"><strong>Anchortext</strong></td>
					<td class="left" width="240"><strong>Extra tekst</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php while($resLinks = mysqli_fetch_assoc($getLinks)){ ?>
				<tr class="copyMe">
					<td class="left" width="1" style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $resLinks['id']; ?>" /></td>
					<input type="hidden" name="id[]" value="<?php echo $resLinks['id']; ?>]" />
					<td class="left"><input type="text" name="url[]" class="fullwidth" placeholder="http://www.voorbeeld.nl" value="<?=$resLinks['url']?>" /></td>
					<td class="left"><input type="text" name="anchortext[]" class="fullwidth" placeholder="De tekst tussen de <a>" value="<?=$resLinks['anchortext']?>" /></td>
					<td class="left"><input type="text" name="extraText[]" class="fullwidth" placeholder="Begeleidende tekst" value="<?=$resLinks['extraText']?>" /></td>
					<td class="left"><span class="deleteCopy red_btn">Verwijder link</span></td>
				</tr>
				<?php } ?>
				<?php
				if(!mysqli_num_rows($getLinks)){
				?>
				<tr class="copyMe">
					<td class="left" width="1" style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $resLinks['id']; ?>" /></td>
					<input type="hidden" name="id[]" value="<?php echo $resLinks['id']; ?>]" />
					<td class="left"><input type="text" name="url[]" class="fullwidth" placeholder="http://www.voorbeeld.nl" value="<?=$resLinks['url']?>" /></td>
					<td class="left"><input type="text" name="anchortext[]" class="fullwidth" placeholder="De tekst tussen de <a>" value="<?=$resLinks['anchortext']?>" /></td>
					<td class="left"><input type="text" name="extraText[]" class="fullwidth" placeholder="Begeleidende tekst" value="<?=$resLinks['extraText']?>" /></td>
					<td class="left"><span class="deleteCopy red_btn">Verwijder link</span></td>
				</tr>
				<?php
					}
				?>
				<tr>
					<td class="left" colspan="5" style="text-align:center;">Vergeet niet de links op te slaan na het verwijderen!</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>