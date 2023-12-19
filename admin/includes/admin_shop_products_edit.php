<?php
	$q = "SELECT * FROM `affiliate_shops` WHERE `BID` = '".(int)$_GET["id"]."';";
	$result = mysqli_query($res1 ,$q);
	$row = mysqli_fetch_assoc($result);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Product wijzigen</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn">Wijziging opslaan</a><a onclick="location = 'index.php?action=shop_products&clear=true'" class="gray_btn">Annuleren</a></div>
</div>

<div class="content">
	<form method="post" action="index.php?action=shop_products" id="form" enctype="multipart/form-data">
	<input type="hidden" name="shopedit" value="true">
		<div id="tab_general">
			<table class="form">
				<tr>
					<td width="20%">Naam:</td>
					<td><input type="text" name="naam" value="<?=$row["Naam"]?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td>Prijs:</td>
					<td><input type="text" name="Tijd" value="<?=$row["Prijs"]?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td width="20%">Categorie:</td>
					<td><?php echo ShopCatItems("Categorie",$row["Categorie"]); ?></td>
				</tr>
				<tr>
					<td width="20%">HTML pagina: <small>(Deze wordt automatisch gegenereerd)</small></td>
					<td><input type="text" name="rewrite" value="<?=$row["Rewrite"]?>" style="width:40%;" /></td>
				</tr>
				<tr>
					<td>Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="height:300px;width:40%;" id="bigtext" name="bigtext"><?=$row["Beschrijving"]?></textarea></td>
				</tr>
				<tr>
					<td>Affiliatelink:</td>
					<td><input type="text" name="affiliatelink" value="<?=$row["affiliatelink"]?>" style="width:40%;"></input></td>
				</tr>
				<tr>
					<td>SEO Titel:</td>
					<td><input type="text" name="seotitle" value="<?=$row["Seotitle"]?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td valign="top">SEO Beschrijving:</td>
					<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="seodesc"><?=$row["Seodesc"]?></textarea></td>
				</tr>
				<tr>
					<td>SEO Key:</td>
					<td><input type="text" name="seokey" value="<?=$row["Seokey"]?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td>Visable</td>
					<td>
					<select name='visable'>
						<option value="1" <?=$row["Visable"] == true ?  "SELECTED":"" ?>>Zichtbaar</option>
						<option value="0" <?=$row["Visable"] == false ? "SELECTED":"" ?>>On zichtbaar</option>
					</select>
					</td>
				</tr>
				<tr>
					<td valign="top">Huidige afbeelding: <img src="<?=HTTP_IMAGE . $row["Foto_Locatie"]?>"><input type="hidden" name="image1" value="<?=$row["Foto_Locatie"]?>"></td><td><input type="file" name="image"> <small>Huidig afbeelding behouden, upload dan niks</small></td>
				</tr>
			</table>	
		</div>
		<input type="hidden" name="id" value="<?= $_GET["id"]?>" />
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
