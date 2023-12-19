<?php
if (isset($_POST['addplugin'])) {
	$query = mysqli_query($res1 ,"INSERT INTO plugin 
								  SET naam='" . realescape($_POST['naam']) . "',
								  plugin='" . realescape($_POST['plugin']) . "'");
	
	$filename = DIR_SYSTEM.'includes/plugin_'.$_POST['plugin'].'.php';
	if (file_exists($filename)) {
		die("The file $filename already exists. Please choose another plugin name.");
	} else {
		fopen($filename, "w");
		fclose($filename);
	}
	
	if ($query == true) {
  		$_SESSION['success'] = 'De plugin is met succes toegevoegd.';
		header('Location: index.php?action=plugin'); 
	}
}

if (isset($_POST['editplugin'])) {
	
	$query = mysqli_query($res1 ,"UPDATE plugin 
								  SET naam='" . realescape($_POST['naam']) . "',
								  plugin='" . realescape($_POST['plugin']) . "'
								  WHERE id = '" . $_POST['id'] . "'");
	
	file_put_contents(DIR_SYSTEM.'includes/plugin_'.$_POST['plugin'].'.php',$_POST['pluginCode']);
	
	if ($query == true) {
  		$_SESSION['success'] = 'De plugin is met succes gewijzigd.';
		header('Location: index.php?action=plugin'); 
	}
}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					$getPluginToDelete = mysqli_query($res1,"SELECT * FROM plugin WHERE id='".$value."'");
					$resPluginToDelete = mysqli_fetch_assoc($getPluginToDelete);
					
					$filename = DIR_SYSTEM.'includes/plugin_'.$resPluginToDelete['plugin'].'.php';
					if (file_exists($filename)) {
						unlink($filename);
					}
					
					mysqli_query($res1 ,"DELETE FROM plugin WHERE id='".$value."'");
					
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De plugin is met succes verwijderd.';
					header('Location: index.php?action=plugin'); 
				}
			}
		break;	
	}	
}
	
$getplugins = mysqli_query($res1,"SELECT * FROM plugin");
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Plugins</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=plugin_add&clear=true'" class="green_btn"><span>Nieuwe plugin</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=plugin&route=delete'); $('#form').submit();" class="red_btn"><span>Verwijder</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=plugin&route=save" id="form" enctype="multipart/form-data">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="240"><strong>Naam</strong></td>
					<td class="left" width="240"><strong>Plugin</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php 
					while($resplugins = mysqli_fetch_assoc($getplugins)){
				?>
					<tr>
						<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $resplugins['id']; ?>" /></td>
						<td class="left" width="240"><strong><?=$resplugins['naam']?></strong></td>
						<td class="left" width="240"><?=$resplugins['plugin']?></td>
						<td class="left" width="240"><a class="gray_btn" href="index.php?action=plugin_edit&id=<?=$resplugins['id']?>">Wijzigen</a></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</form>
</div>