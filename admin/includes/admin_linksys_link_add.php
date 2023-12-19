<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe link</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=linksys_link&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=linksys_link" id="form" enctype="multipart/form-data">
		<input type="hidden" name="linksys_link_add" value="true" />
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
				<td>URL:</td>
				<td><input type="text" name="url" value="" /></td>
			</tr>
			<tr>
				<td>Lange omschrijving:</td>
				<td><textarea id="description" name="longdesc"></textarea></td>
			</tr>   
			<tr>
				<td>Korte omschrijving:</td>
				<td><textarea name="shortdesc"></textarea></td>
			</tr>   
			<tr>
				<td>Plaats:</td>
				<td><input type="text" name="place" value="" /></td>
			</tr>
			<tr>
				<td>Provincie:</td>
				<td><input type="text" name="province" value="" /></td>
			</tr>
			<tr>
				<td>Category:</td>
				<td>
					<select name="category">
						<option value="0">- </option>
						<?php
							$getCats = mysqli_query($res1,"SELECT id, title FROM linksys_cat");
							while($resCats = mysqli_fetch_assoc($getCats)){
								echo '<option value="'.$resCats['id'].'">'.$resCats['title'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Zoekwoorden:</td>
				<td><input type="text" name="searchwords" value="" /></td>
			</tr>  
			<tr>
				<td>Contact:</td>
				<td><input type="text" name="contact" value="" /></td>
			</tr>  
			<tr>
				<td>E-mail:</td>
				<td><input type="text" name="email" value="" /></td>
			</tr>  
			<tr>
				<td>Teruglink:</td>
				<td><input type="text" name="returnlink" value="" /></td>
			</tr>  
			<tr>
				<td>Eigen site:</td>
				<td><input type="checkbox" name="ownsite" /></td>
			</tr>  
			<tr>
				<td>Tip:</td>
				<td><input type="checkbox" name="tip" /></td>
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