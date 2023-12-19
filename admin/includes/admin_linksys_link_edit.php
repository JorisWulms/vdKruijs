<?php
	$getInfo = mysqli_query($res1,"SELECT * FROM linksys_link WHERE id = ".$_GET['id']);
	$resInfo = mysqli_fetch_assoc($getInfo);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe link</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=linksys_link&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=linksys_link" id="form" enctype="multipart/form-data">
		<input type="hidden" name="linksys_link_edit" value="true" />
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
				<td>URL:</td>
				<td><input type="text" name="url" value="<?=$resInfo['url']?>" /></td>
			</tr>
			<tr>
				<td>Lange omschrijving:</td>
				<td><textarea id="description" name="longdesc"><?=$resInfo['longdesc']?></textarea></td>
			</tr>   
			<tr>
				<td>Korte omschrijving:</td>
				<td><textarea name="shortdesc"><?=$resInfo['shortdesc']?></textarea></td>
			</tr>   
			<tr>
				<td>Plaats:</td>
				<td><input type="text" name="place" value="<?=$resInfo['place']?>" /></td>
			</tr>
			<tr>
				<td>Provincie:</td>
				<td><input type="text" name="province" value="<?=$resInfo['province']?>" /></td>
			</tr>
			<tr>
				<td>Category:</td>
				<td>
					<select name="category">
						<option value="0" <?=!$resInfo['category'] ? 'checked' : ''?>>- </option>
						<?php
							$getCats = mysqli_query($res1,"SELECT id, title FROM linksys_cat");
							while($resCats = mysqli_fetch_assoc($getCats)){
								echo '<option value="'.$resCats['id'].'" '.($resInfo['category'] == $resCats['id'] ? 'selected="selected"' : '').'>'.$resCats['title'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Zoekwoorden:</td>
				<td><input type="text" name="searchwords" value="<?=$resInfo['searchwords']?>" /></td>
			</tr>  
			<tr>
				<td>Contact:</td>
				<td><input type="text" name="contact" value="<?=$resInfo['contact']?>" /></td>
			</tr>  
			<tr>
				<td>E-mail:</td>
				<td><input type="text" name="email" value="<?=$resInfo['email']?>" /></td>
			</tr>  
			<tr>
				<td>Teruglink:</td>
				<td><input type="text" name="returnlink" value="<?=$resInfo['returnlink']?>" /></td>
			</tr>  
			<tr>
				<td>Eigen site:</td>
				<td><input type="checkbox" name="ownsite" <?=$resInfo['ownsite'] ? 'checked' : ''?> /></td>
			</tr>  
			<tr>
				<td>Tip:</td>
				<td><input type="checkbox" name="tip" <?=$resInfo['tip'] ? 'checked' : ''?> /></td>
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