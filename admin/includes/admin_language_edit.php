<?php 
     $res = mysqli_query($res1 ,"SELECT * from text_languages WHERE id=".$_GET['id']."");
     $row = mysqli_fetch_array($res);
?>
<div class="heading">
	<h1 style="background-image: url('images/language.png');">Wijzig taal</h1>
	<div class="buttons">
		<a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a>
		<a onclick="location = 'index.php?action=language&clear=true'" class="gray_btn"><span>Annuleren</span></a>
	</div>
</div>
<div class="content" id="newInputs">
	<form method="post" action="index.php?action=language" id="form" enctype="multipart/form-data">
		<input type="hidden" name="taalid" value="<?=$row['id']?>">
		<input type="hidden" name="edittaal" value="true">
		<table class="form">
			<tr>
				<td width="20%">Code:</td>
				<td><input type="text" name="code" value="<?=$row['text_langcode']?>" /></td>
			</tr>
			<tr>
				<td width="20%">Taal:</td>
				<td><input type="text" name="taal" value="<?=$row['text_language']?>" /></td>
			</tr>
			<tr>
				<td>Actief:</td>
				<td><select name="visible"><option value="0" <?=($row['visible']==0)? 'selected="selected"' : ''?>>Inactief</option><option value="1" <?=($row['visible']==1)? 'selected="selected"' : ''?>>Actief</option></select></td>
			</tr>	
		</table>
	</form>
</div>