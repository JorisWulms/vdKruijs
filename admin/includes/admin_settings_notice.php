<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_notice 
								  SET noticeText='".escape($_POST['noticeText'])."',
								  buttonText='".escape($_POST['buttonText'])."',
								  colorScheme='".escape($_POST['colorScheme'])."',
								  noticeTextColor='".escape($_POST['noticeTextColor'])."',
								  plugin='".escape($_POST['plugin'])."',
								  active='".$_POST['active']."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Notice succesvol bijgewerkt.';
				header('Location: index.php?action=settings_notice'); 
			}
		break;
	}	
}
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_notice");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Notice instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_notice&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_notice&route=save" id="form">
		<table class="list">
			<thead>
				<tr>
					<td class="left" width="240"><strong>Notice text</strong></td>
					<td class="left" width="240"><strong>Open button text</strong></td>
					<td class="left" width="240"><strong>Kleur van notice</strong></td>
					<td class="left" width="240"><strong>Text kleur</strong></td>
					<td class="left" width="240"><strong>Plugin</strong></td>
					<td class="left" width="240"><strong>Status</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left">
						<textarea name="noticeText" placeholder="Tekst voor in de notice" class="fullwidth"><?=$resSettings['noticeText']?></textarea>
					</td>
					<td class="left">
						<input type="text" name="buttonText" placeholder="Tekst voor op 'open-knop'" class="fullwidth" value="<?=$resSettings['buttonText']?>" />
					</td>
					<td class="left">
						<input type="text" name="colorScheme" class="colorPicker fullwidth" value="<?=$resSettings['colorScheme']?>" />
					</td>
					<td class="left">
						<input type="text" name="noticeTextColor" class="colorPicker fullwidth" value="<?=$resSettings['noticeTextColor']?>" />
					</td>
					<td>
						<?php allPlugins($resSettings['plugin'],' style="width:100%;"'); ?>
					</td>
					<td>
						<select name="active" style="width:100%;">
							<option value="0" <?php if($resSettings['active']==0){ echo 'selected="selected"'; } ?>>Inactief</option>
							<option value="1" <?php if($resSettings['active']==1){ echo 'selected="selected"'; } ?>>Actief</option>
						</select>
					</td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_notice&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>