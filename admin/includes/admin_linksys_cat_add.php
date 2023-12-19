<?php
$navigatie = array(
	'0' => 'Geen',
	'1' => 'Footer',
	'2' => 'Landingspage',
	'3' => 'Hoofdmenu'
);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe categorie</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=linksys_cat&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=linksys_cat" id="form" enctype="multipart/form-data">
		<input type="hidden" name="linksys_cat_add" value="true" />
		<table class="form">
			<tr>
				<td>Titel:</td>
				<td><input type="text" name="title" value="" /></td>
			</tr>        
			<tr>
				<td>Rewrite:</td>
				<td><input type="text" name="rewrite" value="" /></td>
			</tr>   
			<tr>
				<td>Omschrijving:</td>
				<td><textarea id="description" name="description"></textarea></td>
			</tr>   
			<tr>
				<td>Afbeelding:</td><td><input type="file" name="image"></td>
			</tr>
			<tr>
				<td>SEO titel:</td>
				<td><input type="text" name="seotitle" value="" /></td>
			</tr>   
			<tr>
				<td>SEO description:</td>
				<td><textarea name="seodesc"></textarea></td>
			</tr>   
			<tr>
				<td>SEO keywords:</td>
				<td><input type="text" name="seokey" value="" /></td>
			</tr>   
			<tr>
				<td>Volgorde:</td>
				<td><input type="text" name="volgorde" value="" /></td>
			</tr>  
			<tr>
				<td width="20%">Navigatie:</td>
				<td>
					<select name="navigatie">      
					<?php 
					foreach ($navigatie as $id => $value){
						echo '<option value="'.$id.'">'.$value.'</option>';
					}
					?>
					</select>
				</td>
			</tr>
		</table>
	</form>
</div>

<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('description',
	{
		filebrowserBrowseUrl : 'includes/filemanager.php',
		filebrowserImageBrowseUrl : 'includes/filemanager.php',
		filebrowserFlashBrowseUrl :'includes/filemanager.php',
		filebrowserUploadUrl  :'includes/filemanager.php',
		filebrowserImageUploadUrl : 'includes/filemanager.php',
		filebrowserFlashUploadUrl : 'includes/filemanager.php'
	});
</script>

