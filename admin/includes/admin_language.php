<?php 
if (isset($_POST['addtaal'])){

	$query = mysqli_query($res1 ,"INSERT INTO text_languages SET text_langcode='".$_POST['code']."',text_language='".$_POST['taal']."',visible='".$_POST['visible']."'");

	$language_id = mysqli_insert_id($res1);
	
	include ('checklanguage.php');
	
	if ($query == true){
		$_SESSION['success'] = 'De taal is met succes toegevoegd';
		header('Location: index.php?action=language'); 
	}

}

if (isset($_POST['edittaal'])){
	
	$language_id = $_POST['taalid'];

	$query = mysqli_query($res1 ,"UPDATE text_languages SET text_langcode='".$_POST['code']."',text_language='".$_POST['taal']."',visible='".$_POST['visible']."' WHERE id='".$language_id."'");

	include ('checklanguage.php');
	
	if ($query == true){
		$_SESSION['success'] = 'De taal is met succes gewijzigd';
		header('Location: index.php?action=language'); 
	}


}

$url = 'index.php?action=language';

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM text_languages WHERE id='".$value."'");
					mysqli_query($res1 ,"DELETE FROM text_language WHERE id='".$value."'");
					$query = mysqli_query($res1 ,"DELETE FROM text_display WHERE id='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De Taal is met succes verwijderd.';
					header('Location: '.$url); 
				}
			}
		break;	
		case "save":
			if (isset($_POST['order_by'])){
				foreach ($_POST['order_by'] AS $id => $value){
				$query = mysqli_query($res1 ,"UPDATE categorie SET orderby='".$value."' WHERE catID='".$id."'");
				}
			}			
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: '.$url); 
			}
		break;
	}	
}
?>
<div class="heading">
	<h1 style="background-image: url('images/language.png');">Talen</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=language_add&clear=true'" class="green_btn"><span>Nieuwe taal</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a>
	</div>
</div>
<div class="content" id="newInputs">
	<form method="post" action="index.php?action=language&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="20%">Code</td>
					<td class="left">Taal</td>
					<td class="left">Actief</td>
					<td class="right">Actie</td>
				</tr>
			</thead>
			<tbody>	
			<?php 
				$res = mysqli_query($res1 ,"SELECT * FROM text_languages");
				while ($row = mysqli_fetch_object($res)){
			?>
				<tr>
					<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $row->id; ?>" /></td>
					<td class="left"><b><?=$row->text_langcode?></b></td>
					<td class="left"><?=$row->text_language?></td>
					<td class="left"><?=($row->visible==1)? '<font color="green">Actief</font>' : '<font color="red">Inactief</font>'?></td>
					<td class="right">[ <a href="index.php?action=language_edit&clear=true&id=<?=$row->id?>">Wijzigen</a> ]</td>
				</tr>
			<?php 
			  }
			?>
			</tbody>
		</table>
	</form>
</div>