<?php

$res= mysqli_query($res1 ,"SELECT * from project WHERE id='".$_GET['id']."'");
$row = mysqli_fetch_object($res); 

?>
<div class="heading">
<h1 style="background-image: url('images/user.png');">Bewerk project</h1>
<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=project&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content" id="newInputs">
<form method="post" action="index.php?action=project" name="formulier" id="form">
<input type="hidden" name="editproject" value="true">
<input type="hidden" name="id" value="<?=$row->id?>">
<table class="form">
	<tr>
		<td>Naam:</td>
		<td><input type="text" name="naam" value="<?=$row->naam?>" maxlength="100" /></td>
	</tr>
	<tr>
		<td>HTML rewrite:</td>
		<td><input disabled type="text" name="rewrite" value="<?=$row->rewrite?>" /></td>
	</tr>  
	<tr>
		<td>Slogan:</td>
		<td><input type="text" name="slogan" value="<?=$row->slogan?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td>Beschrijving:</td>
		<td><textarea id="beschrijving" name="beschrijving" maxlength="255" cols="50"><?=$row->beschrijving?></textarea></td>
	</tr>
	<tr>
		<td>Korte beschrijving:</td>
		<td><textarea name="korteBeschrijving" maxlength="255" cols="50"><?=$row->korteBeschrijving?></textarea></td>
	</tr>
	<tr>
		<td>Moet dit project zichtbaar zijn?</td>
		<td><select name="visible"><option value="1" <?=($row->visible==1)? ' selected="selected"' : ''?>>Ja</option><option value="0" <?=($row->visible==0)? ' selected="selected"' : ''?>>Nee</option></select></td>
	</tr> 
</table>
</form>
</div>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('beschrijving',
					{
					filebrowserBrowseUrl : 'includes/filemanager.php',
					filebrowserImageBrowseUrl : 'includes/filemanager.php',
					filebrowserFlashBrowseUrl :'includes/filemanager.php',
					filebrowserUploadUrl  :'includes/filemanager.php',
					filebrowserImageUploadUrl : 'includes/filemanager.php',
					filebrowserFlashUploadUrl : 'includes/filemanager.php'
	 
	});	
</script>
