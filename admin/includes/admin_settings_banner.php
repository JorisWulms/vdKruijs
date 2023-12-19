<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_banner
								  SET layoutType = '".$_POST['layoutType']."',
								  title1_size='".$_POST['title1_size']."',
								  title1_color='".$_POST['title1_color']."',
								  title1_uppercase='".$_POST['title1_uppercase']."',
								  title1_background='".$_POST['title1_background']."',
								  title2_size='".$_POST['title2_size']."',
								  title2_color='".$_POST['title2_color']."',
								  title2_uppercase='".$_POST['title2_uppercase']."',
								  title2_background='".$_POST['title2_background']."',
								  buttonColor='".$_POST['buttonColor']."',
								  buttonBackgroundColor='".$_POST['buttonBackgroundColor']."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=settings_banner'); 
			}
		break;
	}	
}
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_banner");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Banner style instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_banner&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_banner&route=save" id="form">
		<table class="list">
			<thead>
				<tr>
					<td class="left" colspan="4" style="text-align:center;background:#ddd;color:#222;"><strong>General banner settings</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><strong>Kies een layout</strong></td>
					<td class="left"><strong>Kies button tekst kleur</strong></td>
					<td class="left"><strong>Kies button achtergrondkleur</strong></td>
					<td class="left"><strong>Actie</strong></td>
				</tr>
				<tr>
					<td class="left">
						<select name="layoutType">
							<option value="0" <?php if($resSettings['layoutType']==0){ echo 'selected="selected"'; } ?>>Geen banner</option>
							<option value="1" <?php if($resSettings['layoutType']==1){ echo 'selected="selected"'; } ?>>Statische banner binnen container</option>
							<option value="2" <?php if($resSettings['layoutType']==2){ echo 'selected="selected"'; } ?>>Slider banner binnen container</option>
							<option value="3" <?php if($resSettings['layoutType']==3){ echo 'selected="selected"'; } ?>>Statische banner op volledige breedte</option>
							<option value="4" <?php if($resSettings['layoutType']==4){ echo 'selected="selected"'; } ?>>Parallax banner op volledige breedte</option>
							<option value="5" <?php if($resSettings['layoutType']==5){ echo 'selected="selected"'; } ?>>Parallax banner binnen container</option>
							<option value="6" <?php if($resSettings['layoutType']==6){ echo 'selected="selected"'; } ?>>Custom banner layout</option>
							<option value="7" <?php if($resSettings['layoutType']==7){ echo 'selected="selected"'; } ?>>Custom banner layout per page</option>
						</select>
						
					</td>
					<td class="left">
						<input type="text" name="buttonColor" class="fullwidth colorPicker" placeholder="buttonColor" value="<?=$resSettings['buttonColor']?>" />
					</td>
					<td class="left">
						<input type="text" name="buttonBackgroundColor" class="fullwidth colorPicker" placeholder="buttonBackgroundColor" value="<?=$resSettings['buttonBackgroundColor']?>" />
					</td>
					<td class="left">
						<a onclick="$('#form').attr('action', 'index.php?action=settings_banner&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="list">
			<thead>
				<tr>
					<td class="left" colspan="5" style="text-align:center;background:#ddd;color:#222;"><strong>Vul hieronder de styles in voor de invulling van het hoofdkopje van de banner</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><strong>Lettergrootte</strong></td>
					<td class="left"><strong>Kleur</strong></td>
					<td class="left"><strong>Hoofdletters?</strong></td>
					<td class="left"><strong>Achtergrondkleur</strong></td>
					<td class="left"><strong>Actie</strong></td>
				</tr>
				<tr>
					<td class="left"><input type="text" name="title1_size" class="fullwidth" placeholder="title1_size" value="<?=$resSettings['title1_size']?>" /></td>
					<td class="left"><input type="text" name="title1_color" class="fullwidth colorPicker" placeholder="title1_color" value="<?=$resSettings['title1_color']?>" /></td>
					<td class="left"><input type="checkbox" name="title1_uppercase" class="fullwidth" placeholder="title1_uppercase" value="1" <?php if($resSettings['title1_uppercase']){ echo 'checked'; } ?>/></td>
					<td class="left"><input type="text" name="title1_background" class="fullwidth colorPicker" placeholder="title1_background" value="<?=$resSettings['title1_background']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_banner&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		<table class="list">
			<thead>
				<tr>
					<td class="left" colspan="5" style="text-align:center;background:#ddd;color:#222;"><strong>Vul hieronder de styles in voor de invulling van het subkopje van de banner</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><strong>Lettergrootte</strong></td>
					<td class="left"><strong>Kleur</strong></td>
					<td class="left"><strong>Hoofdletters?</strong></td>
					<td class="left"><strong>Achtergrondkleur</strong></td>
					<td class="left"><strong>Actie</strong></td>
				</tr>
				<tr>
					<td class="left"><input type="text" name="title2_size" class="fullwidth" placeholder="title2_size" value="<?=$resSettings['title2_size']?>" /></td>
					<td class="left"><input type="text" name="title2_color" class="fullwidth colorPicker" placeholder="title2_color" value="<?=$resSettings['title2_color']?>" /></td>
					<td class="left"><input type="checkbox" name="title2_uppercase" class="fullwidth" placeholder="title1_uppercase" value="1" <?php if($resSettings['title2_uppercase']==1){ echo 'checked'; } ?>/></td>
					<td class="left"><input type="text" name="title2_background" class="fullwidth colorPicker" placeholder="title2_background" value="<?=$resSettings['title2_background']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_banner&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>