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
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=blogcat&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=blogcat" id="form" enctype="multipart/form-data">
	<input type="hidden" name="blogcatadd" value="true">
		<div id="tab_general">
                    <table class="form">
                        <tr>
							<td>Volgorde:</td>
							<td><input type="text" name="order" value="" size="5" /></td>
                        </tr>                        
                        <tr>
							<td width="20%">Visable:</td>
							<td>
								<select name='visable'>
									<option value="1" selected="SELECTED">Zichtbaar</option>
									<option value="0">Onzichtbaar</option>
								</select>
							</td>
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
						<tr>
							<td>Tekst inklappen d.m.v. "lees meer"?</td>
							<td><select name="leesmeer"><option value="1">Ja</option><option value="0" selected="selected">Nee</option></select></td>
						</tr>
						<tr>
							<td>Na hoeveel regels tekst inklappen?</td>
							<td><input name="leesmeerAantal" type="number" value="5" /></td>
						</tr>
						<tr>
							<td>Afbeelding:</td><td><input type="file" name="image"></td>
						</tr>
                    </table>
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
                                            <td><input type="text" name="description[<?=$language['languageID']?>][naam]" value="" style="width:40%;"/></td>
                                    </tr>
                                    <tr>
                                            <td width="20%">Rewrite:</td>
                                            <td><input type="text" name="description[<?=$language['languageID']?>][rewrite]" value="" style="width:40%;"/></td>
                                    </tr>
                                    <tr>
                                            <td>introText:</td>
                                            <td><textarea cols="80" rows="15" style="height:300px;width:40%;" id="introText<?=$language['languageID']?>" name="description[<?=$language['languageID']?>][introText]"></textarea></td>
                                    </tr>
                                    <tr>
                                            <td>Beschrijving:</td>
                                            <td><textarea cols="80" rows="15" style="height:300px;width:40%;" id="bigtext<?=$language['languageID']?>" name="description[<?=$language['languageID']?>][bigtext]"></textarea></td>
                                    </tr>
									<tr>
										<td>ExtraItem:</td>
										<td><textarea cols="80" rows="15" style="height:100px;width:40%;" name="description[<?=$language['languageID']?>][extraitem]"></textarea></td>
									</tr> 
                                    <tr>
                                            <td>SEO Titel ( max 65 characters ) :</td>
                                            <td><input type="text" name="description[<?=$language['languageID']?>][seotitle]" value="" style="width:40%;" maxlength="65" /></td>
                                    </tr>
                                    <tr>
                                            <td valign="top">SEO Beschrijving ( max 155 characters ) :</td>
                                            <td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="description[<?=$language['languageID']?>][seodesc]" maxlength="155"></textarea></td>
                                    </tr>
                                    <tr>
                                            <td>SEO keywords:</td>
                                            <td><input type="text" name="description[<?=$language['languageID']?>][seokey]" value="" style="width:40%;"/></td>
                                    </tr>


                            </table>
                    </div>
                    <?php }?>
		</div>
	</form>
</div>

<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<?php 
foreach ($languages as $language){
?>
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
<script type="text/javascript">
$.tabs('#tabs a'); 
$.tabs('#languages a');
</script>

