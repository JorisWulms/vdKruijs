

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe categorie toevoegen</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=shop_cat&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content">
	<form method="post" action="index.php?action=shop_cat" id="form" enctype="multipart/form-data">
	<input type="hidden" name="shopcatadd" value="true">
		<div id="tab_general">
			<table class="form">
				<tr>
					<td width="20%">Naam:</td>
					<td><input type="text" name="naam" value="<?=isset($row["Naam"])?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td width="20%">Visable:</td>
					<td><select name='Visable'>
							<option value="1">Zichtbaar</option>
							<option value="0">On zichtbaar</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="height:300px;width:40%;" id="bigtext" name="Beschrijving"></textarea></td>
				</tr>
				<tr>
					<td>SEO Titel:</td>
					<td><input type="text" name="seotitle" value="" style="width:40%;"/></td>
				</tr>
				<tr>
					<td valign="top">SEO Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="seodesc"></textarea></td>
				</tr>
				<tr>
					<td>Hoeveel items moeten er getoont worden op de front page:</td>
					<td><input type="text" name="Items" value="" style="width:40%;"/></td>
				</tr>
				<tr>
					<td>Volgorde:</td>
					<td><input type="text" name="Order" value="" size="5"/></td>
				</tr>				
			</table>	
		</div>
	</form>
</div>

<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('bigtext',
					{
					filebrowserBrowseUrl : 'includes/filemanager.php',
					filebrowserImageBrowseUrl : 'includes/filemanager.php',
					filebrowserFlashBrowseUrl :'includes/filemanager.php',
					filebrowserUploadUrl  :'includes/filemanager.php',
					filebrowserImageUploadUrl : 'includes/filemanager.php',
					filebrowserFlashUploadUrl : 'includes/filemanager.php'
	 
	});
</script>