<?php
if (isset($_POST['addmodule'])) {
	
	$query = mysqli_query($res1 ,"INSERT INTO module 
								  SET parent='" . realescape($_POST['parent']) . "',
								  title='" . realescape($_POST['title']) . "',
								  rewrite='" .realescape( $_POST['rewrite']) . "',
								  visible='" . $_POST['visible'] . "',
								  ordening='" . $_POST['ordening'] . "'");

	if ($query == true) {
  		$_SESSION['success'] = 'De module is met succes toegevoegd.';
		header('Location: index.php?action=module'); 
	}
}

if (isset($_POST['editmodule'])) {
	
	$query = mysqli_query($res1 ,"UPDATE module 
								  SET parent='" . realescape($_POST['parent']) . "',
								  title='" . realescape($_POST['title']) . "',
								  rewrite='" .realescape( $_POST['rewrite']) . "',
								  visible='" . $_POST['visible'] . "',
								  ordening='" . $_POST['ordening'] . "'
								  WHERE id = '" . $_POST['id'] . "'");

	if ($query == true) {
  		$_SESSION['success'] = 'De module is met succes gewijzigd.';
		header('Location: index.php?action=module'); 
	}
}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM module WHERE id='".$value."'");
					mysqli_query($res1 ,"DELETE FROM module_koppel WHERE moduleID='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De module is met succes verwijderd.';
					header('Location: index.php?action=module'); 
				}
			}
		break;	
		case "save":
			if (isset($_POST['ordening'])){
				foreach ($_POST['ordening'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE module SET ordening='".$value."' WHERE id = ".$id);
				}
			}	
			
			if (isset($_POST['visible'])){
				foreach ($_POST['visible'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE module SET visible='".$value."' WHERE id = ".$id);
				}
			}	
			
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=module'); 
			}
		break;
	}	
}
	
$getModules = mysqli_query($res1,"SELECT * FROM module WHERE parent = 0 ORDER BY ordening");
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Modules</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=module_add&clear=true'" class="green_btn"><span>Nieuwe module</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=module&route=save'); $('#form').submit();" class="yellow_btn"><span>Opslaan</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=module&route=delete'); $('#form').submit();" class="red_btn"><span>Verwijder</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=module&route=save" id="form" enctype="multipart/form-data">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="240"><strong>Naam</strong></td>
					<td class="left" width="240"><strong>Rewrite</strong></td>
					<td class="left" width="240"><strong>Status</strong></td>
					<td class="left" width="240"><strong>Volgorde</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php 
					while($resModules = mysqli_fetch_assoc($getModules)){
				?>
					<tr>
						<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $resModules['id']; ?>" /></td>
						<td class="left" width="240"><strong><?=$resModules['title']?></strong></td>
						<td class="left" width="240"><?=$resModules['rewrite']?></td>
						<td class="left">
							<select name="visible[<?=$resModules['id']?>]">
								<option value="0" <?=($resModules['visible']==0) ? 'selected' : ''?>>Inactief</option>
								<option value="1" <?=($resModules['visible']==0) ? '' : 'selected'?>>Actief</option>
							</select>
						</td>
						<td class="left"><input type="text" name="ordening[<?=$resModules['id']?>]" value="<?=$resModules['ordening']?>" size="5"></td>
						<td class="left" width="240"><a class="gray_btn" href="index.php?action=module_edit&id=<?=$resModules['id']?>">Wijzigen</a></td>
					</tr>
				<?php
						$getChildModules = mysqli_query($res1,"SELECT * FROM module WHERE parent = '".$resModules['id']."' ORDER BY ordening");
						while($resChildModules = mysqli_fetch_assoc($getChildModules)){
				?>
						<tr>
							<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $resChildModules['id']; ?>" /></td>
							<td class="left" width="240"><strong>---> <?=$resChildModules['title']?></strong></td>
							<td class="left" width="240"><?=$resChildModules['rewrite']?></td>
							<td class="left">
								<select name="visible[<?=$resChildModules['id']?>]">
									<option value="0" <?=($resChildModules['visible']==0) ? 'selected' : ''?>>Inactief</option>
									<option value="1" <?=($resChildModules['visible']==0) ? '' : 'selected'?>>Actief</option>
								</select>
							</td>
							<td class="left"><input type="text" name="ordening[<?=$resChildModules['id']?>]" value="<?=$resChildModules['ordening']?>" size="5"></td>
							<td class="left" width="240"><a class="gray_btn" href="index.php?action=module_edit&id=<?=$resChildModules['id']?>">Wijzigen</a></td>
						</tr>
				<?php		
						}
					}
				?>
			</tbody>
		</table>
	</form>
</div>