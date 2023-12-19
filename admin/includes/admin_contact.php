<?php
$id = isset($_GET['id']);

if (isset($_POST['editcontact'])) {

    $query = mysqli_query($res1 ,"UPDATE contactform
								 SET parent='" . $_POST['parent'] . "',
								 type='" . $_POST['type'] . "',
								 placeholder='". escape($_POST['placeholder'])."',
								 title='". escape($_POST['title'])."'
								 WHERE id ='".$_POST['id']."'
								  ");
		
	foreach ($_POST['title'] as $id => $value){
		if(trim($value['title']) == ""){
			echo "You have to instert a title";
			die();
			if(!isset($_POST['type'])) {
				echo "you have to select a type for your input field";
				die();
			}
		}
		
	}

	if ($query == true) {
		$_SESSION['success'] = 'Het veld is met succes gewijzigd.';
		header('Location: index.php?action=contact'); 
	}
}

if (isset($_POST['addcontact'])) {
	
	$query = mysqli_query($res1 ,"INSERT INTO contactform 
												SET parent='" . $_POST['parent'] . "',
												type='" . $_POST['type'] . "',
												placeholder='". escape($_POST['placeholder'])."',
												visible='". $_POST['visible']."',
												title='". escape($_POST['title'])."'
												");
	
	$settings_contactid = mysqli_insert_id($res1);
	
	foreach ($_POST['title'] as $id => $value){
		if(trim($value['title']) == ""){
			echo "You have to instert a title";
			die();
			if(!isset($_POST['type'])) {
				echo "you have to select a type for your input field";
				die();
			}
		}
	}

	if ($query == true) {
  		$_SESSION['success'] = 'De pagina is met succes toegevoegd.';
		header('Location: index.php?action=contact'); 
	}
}



if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM contactform WHERE id='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De pagina is met succes verwijderd.';
					header('Location: index.php?action=contact'); 
				}
			}
		break;	
		
		case "save":
			if (isset($_POST['ordening'])){
				foreach ($_POST['ordening'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE contactform SET ordening='".$value."' WHERE id = ".$id);
				}
				
			}	
			
			if (isset($_POST['visible'])){
				foreach ($_POST['visible'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE contactform SET visible='".$value."' WHERE id = ".$id);
				}
			}	
			
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=contact'); 
			}
		break;
		
		case "saveTitle":
			if(isset($_POST['contactFormTitle'])){
				$query = mysqli_query($res1 ,"UPDATE settings_contact SET titel='".$_POST['contactFormTitle']."', bedanktpagina ='".$_POST['bedanktpagina']."'  WHERE id = 1");
			}
			
			if (count($query!=0)){
				$_SESSION['success'] = 'Settings zijn met succes bijgewerkt.';
				header('Location: index.php?action=contact'); 
			}
		break;
	}	
}

?>

<div class="buttonsScroll">
	<div style="float:right;">
		<a onclick="location = 'index.php?action=contact_add&clear=true'" class="green_btn"><span>Nieuw veld aanmaken</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=contact&route=save'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder selectie</span></a>
	</div>
</div>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Contactbeheer</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=contact_add&clear=true'" class="green_btn"><span>Nieuw veld aanmaken</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=contact&route=save'); $('#form').submit();" class="yellow_btn"><span>Opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder selectie</span></a>
	</div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=contact&route=delete" id="form">
	<?php
		$getContactSettings = mysqli_query($res1 ,"SELECT * FROM settings_contact");
		$resContactSettings = mysqli_fetch_assoc($getContactSettings);
	?>
		<table class="list">
			<thead>
				<tr>
					<td class="left" width="360"><strong>Titel boven formulier</strong></td>
					<td class="left" width="360"><strong>Bedanktpagina - <i>Pagina waar men naar toeverwezen wordt wanneer het formulier verzonden is</i></strong></td>
					<td class="right"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="contactFormTitle" value="<?=$resContactSettings['titel']?>" placeholder="Titel voor boven contactformulier" class="fullwidth" /></td>
					<td class="left">
						<select name="bedanktpagina" class="fullwidth">	
							<option value="">-</option>
							<?php
								$getPages = mysqli_query($res1, "SELECT * FROM sitetree_language ORDER BY id");
								while($resPages = mysqli_fetch_assoc($getPages)){
									if($resPages['rewrite'] == $resContactSettings['bedanktpagina']){
										$selected = ' selected="selected"';
									}else{
										$selected = '';
									}
									echo '<option value="'.$resPages['rewrite'].'"'.$selected.'>'.$resPages['title'].'</option>';
								}
							?>
						</select>
					
					</td>
					<td class="right"><a class="green_btn" onclick="$('#form').attr('action', 'index.php?action=contact&route=saveTitle'); $('#form').submit();">Opslaan</a></td>
				</tr>
			</tbody>
		</table>
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="360"><strong>Titel</strong></td>
					<td class="left"><strong>Volgorde&nbsp;<input type="submit" name="sorteren" value="Opslaan" style="background:url(images/save.png) no-repeat top left;width:16px;height:16px;border:0;font-size:0;" title="Sorteer"></strong></td>
					<td class="left"><strong>Zichtbaar</strong></td>
					<td class="left"><strong>Type</strong></td>
					<td class="left"><strong>Placeholder</strong></td>
					
					<td class="right"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
			<?php
			$getFields = mysqli_query($res1 ,"SELECT * 
											  FROM contactform 
											  WHERE parent = 0
											  ORDER BY ordening");								  
			while ($resFields = mysqli_fetch_array($getFields)){
			?>
				<tr>
					<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $resFields['id']; ?>" /></td>
					<td class="left"><b><?=$resFields['title']?></b></td>
					<td class="left">
					<input type="text" id="ordening" name="ordening[<?=$resFields['id']?>]" value="<?=$resFields['ordening']?>" placeholder ="<?=$resFields['ordening']?>" size="5"/>
					<td class="left">
						<select name="visible[<?=$resFields['id']?>]">	
							<option value="1" <?=($resFields['visible']==0) ? '' : 'selected'?>>Zichtbaar</option>
							<option value="0" <?=($resFields['visible']==0) ? 'selected' : ''?>>Onzichtbaar</option>
						</select>
					</td>
					<td class="left"><?=$resFields['type']?></td>
					<td class="left"><?=$resFields['placeholder']?></td>
					<td class="right"><a class="gray_btn" href='index.php?action=contact_edit&clear=true&id=<?=$resFields['id']?>'>Wijzig</a></td>
				</tr>
				<?php
				$getChilds = mysqli_query($res1 ,"SELECT * 
												  FROM contactform 
												  WHERE parent = ".$resFields['id']."
												  ORDER BY ordening");								  
				while ($resChilds = mysqli_fetch_array($getChilds)){
				?>
					<tr>
						<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $resChilds['id']; ?>" /></td>
						<td class="left"><b>---> <?=$resChilds['title']?></b></td>
						<td class="left">
						<input type="text" id="ordening" name="ordening[<?=$resChilds['id']?>]" value="<?=$resChilds['ordening']?>" placeholder ="<?=$resChilds['ordening']?>" size="5"/>
						<td class="left">
							<select name="visible[<?=$resChilds['id']?>]">	
								<option value="1" <?=($resChilds['visible']==0) ? '' : 'selected'?>>Zichtbaar</option>
								<option value="0" <?=($resChilds['visible']==0) ? 'selected' : ''?>>Onzichtbaar</option>
							</select>
						</td>
						<td class="left"><?=$resChilds['type']?></td>
						<td class="left"><?=$resChilds['placeholder']?></td>
						<td class="right"><a class="gray_btn" href='index.php?action=contact_edit&clear=true&id=<?=$resChilds['id']?>'>Wijzig</a></td>
					</tr>
				<?php
					
				}
			}
			?>
			</tbody>
		</table>
	</form>
</div>