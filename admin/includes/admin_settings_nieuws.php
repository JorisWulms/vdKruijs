<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_nieuws
								  SET newspath='".escape($_POST['newspath'])."',
								  pluginTextAmt='".escape($_POST['pluginTextAmt'])."',
								  overviewTextAmt='".escape($_POST['overviewTextAmt'])."',
								  pluginAmt='".escape($_POST['pluginAmt'])."',
								  buttonColor='".escape($_POST['buttonColor'])."',
								  buttonTextColor='".escape($_POST['buttonTextColor'])."',
								  buttonBorderRadius='".escape($_POST['buttonBorderRadius'])."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=settings_nieuws'); 
			}
		break;
	}	
}
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_nieuws");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuws instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_nieuws&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_nieuws&route=save" id="form">
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="2">Selecteer de hoofdpagina waar de nieuwsmodule zicht op bevindt</td></tr>
			</thead>
			<tbody>
				<tr>
					<td class="left">
						<select name="newspath" class="fullwidth">	
							<option value="">-</option>
							<?php
								$getPages = mysqli_query($res1, "SELECT * FROM sitetree_language ORDER BY id");
								while($resPages = mysqli_fetch_assoc($getPages)){
									if($resPages['rewrite'] == $resSettings['newspath']){
										$selected = ' selected="selected"';
									}else{
										$selected = '';
									}
									echo '<option value="'.$resPages['rewrite'].'"'.$selected.'>'.$resPages['title'].'</option>';
								}
							?>
						</select>
					</td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_nieuws&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="4">Variabele nieuws settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>Hoeveelheid tekst zichtbaar bij plugin</strong></td>
					<td class="left" width="240"><strong>Hoeveelheid tekst zichtbaar bij overzicht</strong></td>
					<td class="left" width="240"><strong>Maximale hoeveelheid items bij plugin</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="number" name="pluginTextAmt" class="fullwidth" placeholder="pluginTextAmt" value="<?=$resSettings['pluginTextAmt']?>" /></td>
					<td class="left"><input type="number" name="overviewTextAmt" class="fullwidth" placeholder="overviewTextAmt" value="<?=$resSettings['overviewTextAmt']?>" /></td>
					<td class="left"><input type="number" name="pluginAmt" class="fullwidth" placeholder="pluginAmt" value="<?=$resSettings['pluginAmt']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_nieuws&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>

		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="4">Style nieuws settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>Button: achtergrondkleur</strong></td>
					<td class="left" width="240"><strong>Button: tekst kleur</strong></td>
					<td class="left" width="240"><strong>Button: border radius ( 'none' of een getal+'px' )</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="buttonColor" class="fullwidth colorPicker" placeholder="buttonColor" value="<?=$resSettings['buttonColor']?>" /></td>
					<td class="left"><input type="text" name="buttonTextColor" class="fullwidth colorPicker" placeholder="buttonTextColor" value="<?=$resSettings['buttonTextColor']?>" /></td>
					<td class="left"><input type="text" name="buttonBorderRadius" class="fullwidth" placeholder="buttonBorderRadius" value="<?=$resSettings['buttonBorderRadius']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_nieuws&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>