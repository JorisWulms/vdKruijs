<?php
	$q = "SELECT * FROM `affiliate_shops_cat` WHERE `Categorie` = '".(int)$_GET["id"]."';";
	$result = mysqli_query($res1 ,$q);
	$row = mysqli_fetch_assoc($result);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe categorie toevoegen</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=shop_cat&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content">
	<form method="post" action="index.php?action=shop_cat" id="form" enctype="multipart/form-data">
	<input type="hidden" name="shopcatedit" value="true">
		<div id="tab_general">
			<table class="form">
				<tr>
					<td width="20%">Naam:</td>
					<td><input type="text" name="naam" value="<?=$row["CATNaam"]?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td width="20%">Visable:</td>
					<td><select name='Visable'>
							<option value="1" <?=$row["Visable"] == true ? "SELECTED":"" ?>>Zichtbaar</option>
							<option value="0" <?=$row["Visable"] == false ? "SELECTED":"" ?>>On zichtbaar</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="height:300px;width:40%;" id="bigtext" name="Beschrijving"><?=$row["Cat_Beschrijving"]?></textarea></td>
				</tr>
				<tr>
					<td>SEO Titel:</td>
					<td><input type="text" name="seotitle" value="<?=$row["seotitle"]?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td valign="top">SEO Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="seodesc"><?=$row["seodesc"]?></textarea></td>
				</tr>
				<tr>
					<td>Hoeveel items moeten er getoont worden op de front page:</td>
					<td><input type="text" name="Items" value="<?=$row["Items"]?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td>Volgorde:</td>
					<td><input type="text" name="Order" value="<?=$row["Ordering"]?>" size="5"/></td>
				</tr>
				<input type="hidden" name="id" value="<?=$_GET["id"]?>" />
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

