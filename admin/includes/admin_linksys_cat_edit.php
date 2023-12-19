<?php
	$navigatie = array(
		'0' => 'Geen',
		'1' => 'Footer',
		'2' => 'Landingspage',
		'3' => 'Hoofdmenu'
	);

	$getInfo = mysqli_query($res1,"SELECT * FROM linksys_cat WHERE id = ".$_GET['id']);
	$resInfo = mysqli_fetch_assoc($getInfo);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Edit linkcategorie</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=linksys_cat&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=linksys_cat" id="form" enctype="multipart/form-data">
		<input type="hidden" name="linksys_cat_edit" value="true" />
		<input type="hidden" name="id" value="<?=$resInfo['id']?>" />
		<table class="form">
			<tr>
				<td>Titel:</td>
				<td><input type="text" name="title" value="<?=$resInfo['title']?>" /></td>
			</tr>        
			<tr>
				<td>Rewrite:</td>
				<td><input type="text" name="rewrite" value="<?=$resInfo['rewrite']?>" /></td>
			</tr>   
			<tr>
				<td>Omschrijving:</td>
				<td><textarea id="description" name="description"><?=$resInfo['description']?></textarea></td>
			</tr> 
			<tr>
				<td valign="top">Huidige afbeelding: <img src="<?=HTTP_IMAGE . $resInfo["imagelocation"]?>"><input type="hidden" name="image1" value="<?=$resInfo["imagelocation"]?>"></td><td><input type="file" name="image"> <small>Huidig afbeelding behouden, upload dan niks</small></td>
			</tr>
			<tr>
				<td>SEO titel:</td>
				<td><input type="text" name="seotitle" value="<?=$resInfo['seotitle']?>" /></td>
			</tr>   
			<tr>
				<td>SEO description:</td>
				<td><textarea name="seodesc"><?=$resInfo['seodesc']?></textarea></td>
			</tr>   
			<tr>
				<td>SEO keywords:</td>
				<td><input type="text" name="seokey" value="<?=$resInfo['seokey']?>" /></td>
			</tr>   
			<tr>
				<td>Volgorde:</td>
				<td><input type="text" name="volgorde" value="<?=$resInfo['volgorde']?>" /></td>
			</tr>  
			<tr>
				<td width="20%">Navigatie:</td>
				<td>
					<select name="navigatie"><?php 
					foreach ($navigatie as $id => $value){
						echo '<option value="'.$id.'"';
							if ($resInfo['navigatie']==$id){
							echo ' selected="selected"';
							}
						echo '>'.$value.'</option>';
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

