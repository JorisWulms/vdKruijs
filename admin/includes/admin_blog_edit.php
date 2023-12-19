<?php
$result = mysqli_query($res1 ,"SELECT * FROM blogs WHERE blogID = '".$_GET["id"]."'");
$row = mysqli_fetch_assoc($result);


$tres = mysqli_query($res1 ,"SELECT * FROM blogs_language WHERE blogID = '".$row['blogID']."'");

while ($trow = mysqli_fetch_object($tres)){
	$description[$trow->language_id] = array(
				'naam' => $trow->naam,
				'rewrite' => $trow->rewrite,
				'bigtext' => $trow->beschrijving,
				'introText' => $trow->introText,
				'seotitle' => $trow->seotitle,
				'seodesc' => $trow->seodesc,
				'seokey' => $trow->seokey,
				'extraitem' => $trow->extraItem
	);
}

?>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Wijzig blog item</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=blog&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=blog" id="form" enctype="multipart/form-data">
	<input type="hidden" name="blogedit" value="true">
	<input type="hidden" name="id" value="<?=$row['blogID']?>">
		<div id="tab_general">
                    <table class="form">
                        <tr>
                                <td>Datum (d-m-y h:m):</td>
                                <td><input type="text" name="tijd" value="<?=date("d-m-Y H:i",strtotime($row["datum"]))?>" style="width:40%;"/></td>
                        </tr>
                        <tr>
                                <td>Youtube link:</td>
                                <td><input type='text' name='youtube' value='<?=$row["youtube"]?>' style='width:40%;'/></td>
                        </tr>
                        <tr>
                                <td width="20%">Categorie:</td>
                                <td><?php echo BlogCatItems("Categorie",$row['catID']); ?></td>
                        </tr>
                        <tr>
                                <td>Zichtbaarheid</td>
                                <td>
                                <select name='visable'>
                                        <option value="1" <?=$row["visable"] == true ?  "SELECTED":"" ?>>Zichtbaar</option>
                                        <option value="0" <?=$row["visable"] == false ?  "SELECTED":"" ?>>Onzichtbaar</option>
                                </select>
                                </td>
                        </tr>
					<tr>
						<td>Plugin</td>
						<td>
							<?php allPlugins($row['plugin']); ?>
						</td>
					</tr>
				<tr>
					<td valign="top">Huidig afbeelding: <img src="<?=HTTP_IMAGE . $row["foto_locatie"]?>"><input type="hidden" name="image1" value="<?=$row["foto_locatie"]?>"></td><td><input type="file" name="image"> <small>Huidig afbeelding behouden, upload dan niks</small></td>
				</tr>
                        
                    </table>
                    <br/>
                    <div id="languages" class="htabs">
                    <?php foreach ($languages as $language) { ?>
                    <a tab="#language<?php echo $language['languageID']; ?>"><img src="images/flags/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                    <?php } ?>
                    </div>
                    <?php foreach ($languages as $language) { ?>
                    <div id="language<?php echo $language['languageID']; ?>">
                    
			<table class="form">
				<tr>
					<td width="20%">Naam:</td>
					<td><input type="text" name="description[<?=$language['languageID']?>][naam]" value="<?= $description[$language['languageID']]['naam']!="" ?$description[$language['languageID']]['naam'] : ''; ?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td width="20%">HTML pagina: <small>(Deze wordt automatisch gegenereerd)</small></td>
					<td><input type="text" name="description[<?=$language['languageID']?>][rewrite]" value="<?=$description[$language['languageID']]['rewrite']!="" ?$description[$language['languageID']]['rewrite'] : ''; ?>" style="width:40%;" /></td>
				</tr>
				<tr>
					<td>introText:</td>
					<td>
						<textarea cols="80" rows="15" style="height:300px;width:40%;" id="introText<?=$language['languageID']?>" name="description[<?=$language['languageID']?>][introText]">
							<?=$description[$language['languageID']]['introText'] != "" ? $description[$language['languageID']]['introText'] : '';?>
						</textarea>
					</td>
				</tr>
				<tr>
					<td>Beschrijving:</td>
					<td>
						<textarea cols="80" rows="15" style="height:300px;width:40%;" id="bigtext<?=$language['languageID']?>" name="description[<?=$language['languageID']?>][bigtext]">
							<?=$description[$language['languageID']]['bigtext'] != "" ? $description[$language['languageID']]['bigtext'] : '';?>
						</textarea>
					</td>
				</tr>
				<tr>
					<td>ExtraItem:</td>
					<td><textarea cols="80" rows="15" style="height:100px;width:40%;" name="description[<?=$language['languageID']?>][extraitem]"><?=$description[$language['languageID']]['extraitem']!="" ?$description[$language['languageID']]['extraitem'] : ''; ?></textarea></td>
				</tr> 
				<tr>
					<td>SEO Titel( max 65 characters ) :</td>
					<td><input type="text" name="description[<?=$language['languageID']?>][seotitle]" value="<?=$description[$language['languageID']]['seotitle']!="" ? $description[$language['languageID']]['seotitle'] : ''; ?>" style="width:40%;" maxlength="65" /></td>
				</tr>
				<tr>
					<td valign="top">SEO Beschrijving ( max 155 characters ) :</td>
					<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="description[<?=$language['languageID']?>][seodesc]" maxlength="155"><?=$description[$language['languageID']]['seodesc']!="" ? $description[$language['languageID']]['seodesc'] : ''; ?></textarea></td>
				</tr>
				<tr>
					<td>SEO Key:</td>
					<td><input type="text" name="description[<?=$language['languageID']?>][seokey]" value="<?=$description[$language['languageID']]['seokey']!="" ?$description[$language['languageID']]['seokey'] : ''; ?>" style="width:40%;"/></td>
				</tr>
			</table>
                    </div>
                    <?php }?>
		</div>
	</form>
</div>

<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<?php foreach ($languages as $language) { ?>
<script type="text/javascript">
	CKEDITOR.replace('bigtext<?=$language['languageID']?>',
					{
					filebrowserBrowseUrl : 'includes/filemanager.php',
					filebrowserImageBrowseUrl : 'includes/filemanager.php',
					filebrowserFlashBrowseUrl :'includes/filemanager.php',
					filebrowserUploadUrl  :'includes/filemanager.php',
					filebrowserImageUploadUrl : 'includes/filemanager.php',
					filebrowserFlashUploadUrl : 'includes/filemanager.php'
	 
	});
	CKEDITOR.replace('introText<?=$language['languageID']?>',
					{
					filebrowserBrowseUrl : 'includes/filemanager.php',
					filebrowserImageBrowseUrl : 'includes/filemanager.php',
					filebrowserFlashBrowseUrl :'includes/filemanager.php',
					filebrowserUploadUrl  :'includes/filemanager.php',
					filebrowserImageUploadUrl : 'includes/filemanager.php',
					filebrowserFlashUploadUrl : 'includes/filemanager.php'
	 
	});
</script>
<?php }?>
<script type="text/javascript"><!--
$.tabs('#tabs a'); 
$.tabs('#languages a');
//--></script>