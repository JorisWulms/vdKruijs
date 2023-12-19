<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_blogs 
								  SET layoutTypeRandom='".escape($_POST['layoutTypeRandom'])."',
								  layoutTypeCategory='".escape($_POST['layoutTypeCategory'])."',
								  layoutTypeBlog='".escape($_POST['layoutTypeBlog'])."',
								  randomAmt='".escape($_POST['randomAmt'])."',
								  randomMainColor='".escape($_POST['randomMainColor'])."',
								  randomSubColor='".escape($_POST['randomSubColor'])."',
								  randomTxtColor='".escape($_POST['randomTxtColor'])."',
								  randomTxtAmt='".escape($_POST['randomTxtAmt'])."',
								  randomTitleSize='".escape($_POST['randomTitleSize'])."',
								  randomTitleColor='".escape($_POST['randomTitleColor'])."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=settings_blogs'); 
			}
		break;
	}	
}
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_blogs");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Blog instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_blogs&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_blogs&route=save" id="form">
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="4">Selecteer de gewenste layouts</td></tr>
				<tr>
					<td class="left" width="240"><strong>layoutTypeRandom ( aantal per rij )</strong></td>
					<td class="left" width="240"><strong>layoutTypeCategory</strong></td>
					<td class="left" width="240"><strong>layoutTypeBlog</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left">
						<select name="layoutTypeRandom" style="width:100%;">
							<option value="1" <?php if($resSettings['layoutTypeRandom']==1){ echo 'selected="selected"'; } ?>>Fancy hover blocks (3)</option>
							<option value="2" <?php if($resSettings['layoutTypeRandom']==2){ echo 'selected="selected"'; } ?>>Image text button (3)</option>
							<option value="3" <?php if($resSettings['layoutTypeRandom']==3){ echo 'selected="selected"'; } ?>>Columns (&infin;)</option>
							<option value="4" <?php if($resSettings['layoutTypeRandom']==4){ echo 'selected="selected"'; } ?>>Fancy hover blocks V2 (3)</option>
							<option value="5" <?php if($resSettings['layoutTypeRandom']==5){ echo 'selected="selected"'; } ?>>Half om half en een hele ( 2 - 1 )</option>
							<option value="6" <?php if($resSettings['layoutTypeRandom']==6){ echo 'selected="selected"'; } ?>>Custom random layout</option>
							<option value="7" <?php if($resSettings['layoutTypeRandom']==7){ echo 'selected="selected"'; } ?>>Small blocks (5)</option>
							<option value="8" <?php if($resSettings['layoutTypeRandom']==8){ echo 'selected="selected"'; } ?>>FullWidth row (4)</option>
						</select>
					</td>
					<td class="left">
						<select name="layoutTypeCategory" style="width:100%;">
							<option value="1" <?php if($resSettings['layoutTypeCategory']==1){ echo 'selected="selected"'; } ?>>Full category text - Full all blogs</option>
							<option value="2" <?php if($resSettings['layoutTypeCategory']==2){ echo 'selected="selected"'; } ?>>Half text - Half blogs</option>
							<option value="3" <?php if($resSettings['layoutTypeCategory']==3){ echo 'selected="selected"'; } ?>>2/3 Text - 1/3 blogs</option>
							<option value="4" <?php if($resSettings['layoutTypeCategory']==4){ echo 'selected="selected"'; } ?>>2/3 Text - 1/3 blogs - No image</option>
							<option value="5" <?php if($resSettings['layoutTypeCategory']==5){ echo 'selected="selected"'; } ?>>2/3 Text - 1/3 blogs - No Text</option>
							<option value="6" <?php if($resSettings['layoutTypeCategory']==6){ echo 'selected="selected"'; } ?>>TicketLeft text right</option>
							<option value="7" <?php if($resSettings['layoutTypeCategory']==7){ echo 'selected="selected"'; } ?>>Custom category layout</option>
						</select>
					</td>
					<td class="left">
						<select name="layoutTypeBlog" style="width:100%;">
							<option value="1" <?php if($resSettings['layoutTypeBlog']==1){ echo 'selected="selected"'; } ?>>Full blog text - Back button</option>
							<option value="2" <?php if($resSettings['layoutTypeBlog']==2){ echo 'selected="selected"'; } ?>>2/3tekst 1/3 random Blogs zelfde cat</option>
							<option value="3" <?php if($resSettings['layoutTypeBlog']==3){ echo 'selected="selected"'; } ?>>Custom blogpage layout</option>
						</select>
					</td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_blogs&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="8">Random blog settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>randomAmt</strong></td>
					<td class="left" width="240"><strong>randomMainColor</strong></td>
					<td class="left" width="240"><strong>randomSubColor</strong></td>
					<td class="left" width="240"><strong>randomTxtColor</strong></td>
					<td class="left" width="240"><strong>randomTxtAmt</strong></td>
					<td class="left" width="240"><strong>randomTitleSize</strong></td>
					<td class="left" width="240"><strong>randomTitleColor</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="randomAmt" class="fullwidth" placeholder="randomAmt" value="<?=$resSettings['randomAmt']?>" /></td>
					<td class="left"><input type="text" name="randomMainColor" class="fullwidth colorPicker" placeholder="randomMainColor" value="<?=$resSettings['randomMainColor']?>" /></td>
					<td class="left"><input type="text" name="randomSubColor" class="fullwidth colorPicker" placeholder="randomSubColor" value="<?=$resSettings['randomSubColor']?>" /></td>
					<td class="left"><input type="text" name="randomTxtColor" class="fullwidth colorPicker" placeholder="randomTxtColor" value="<?=$resSettings['randomTxtColor']?>" /></td>
					<td class="left"><input type="text" name="randomTxtAmt" class="fullwidth" placeholder="randomTxtAmt" value="<?=$resSettings['randomTxtAmt']?>" /></td>
					<td class="left"><input type="text" name="randomTitleSize" class="fullwidth" placeholder="randomTitleSize" value="<?=$resSettings['randomTitleSize']?>" /></td>
					<td class="left"><input type="text" name="randomTitleColor" class="fullwidth colorPicker" placeholder="randomTitleColor" value="<?=$resSettings['randomTitleColor']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_blogs&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>

	</form>
</div>