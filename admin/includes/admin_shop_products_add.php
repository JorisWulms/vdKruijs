<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe product toevoegen</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn">Product toevoegen</a><a onclick="location = 'index.php?action=shop_products&clear=true'" class="gray_btn">Annuleren</a></div>
</div>

<div class="content">
	<form method="post" action="index.php?action=shop_products" id="form" enctype="multipart/form-data">
	<input type="hidden" name="shopadd" value="true">
		<div id="tab_general">
			<table class="form">
				<tr>
					<td width="20%">Naam:</td>
					<td><input type="text" name="naam" value="" style="width:40%;"/></td>
				</tr>
				<tr>
					<td>Prijs:</td>
					<td><input type="text" name="Tijd" value="" style="width:40%;"/></td>
				</tr>
				<tr>
					<td width="20%">Categorie:</td>
					<td><?php echo ShopCatItems("Categorie",0); ?></td>
				</tr>
				<tr>
					<td width="20%">HTML pagina: <small>(Deze wordt automatisch gegenereerd)</small></td>
					<td><input type="text" name="rewrite" value="" style="width:40%;" /></td>
				</tr>
				<tr>
					<td>Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="height:300px;width:40%;" id="bigtext" name="bigtext"></textarea></td>
				</tr>
				<tr>
					<td>Affiliatelink:</td>
					<td><input type="text" name="affiliatelink" value="" style="width:40%;"></input></td>
				</tr> 
				<tr>
					<td>SEO Titel:</td>
					<td><input type="text" name="seotitle" value="" style="width:40%;"></input></td>
				</tr>
				<tr>
					<td valign="top">SEO Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="seodesc"></textarea></td>
				</tr>
				<tr>
					<td>SEO Key:</td>
					<td><input type="text" name="seokey" value="" style="width:40%;"/></td>
				</tr>
				<tr>
					<td>Visable</td>
					<td>
					<select name='Visable'>
						<option value="1">Zichtbaar</option>
						<option value="0">On zichtbaar</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Afbeelding:</td><td><input type="file" name="image"></td>
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