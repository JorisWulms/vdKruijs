<script type="text/javascript">
	function checkValues(){
		if($('#naam').val()!=""){
			$('#form').submit();
		}else{
			alert('Waarom vergeet je een titel in te vullen?');
		}
	}
</script>


<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe blog item toevoegen</h1>
	<div class="buttons"><a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=blog&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=blog" id="form" enctype="multipart/form-data">
	<input type="hidden" name="blogadd" value="true">
		<div id="tab_general">
			<table class="form">
				<tr>
					<td>Datum (d-m-y h:m):</td>
					<td><input type="text" name="tijd" value="<?=date("d-m-Y H:i")?>" style="width:40%;"/></td>
				</tr>
				<tr>
					<td>Youtube link:</td>
					<td><input type="text" name="youtube" value="" style="width:40%;"/></td>
				</tr>
				<tr>
					<td width="20%">Categorie:</td>
					<td><?php echo BlogCatItems("Categorie",0); ?></td>
				</tr>
				<tr>
					<td>Visable</td>
					<td>
						<select name='visable'>
							<option value="1">Zichtbaar</option>
							<option value="0">Onzichtbaar</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Plugin</td>
					<td>
						<?php allPlugins('',''); ?>
					</td>
				</tr>
				<tr>
					<td>Afbeelding:</td><td><input type="file" name="image"></td>
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
					<td><input type="text" id="naam" name="description[<?=$language['languageID']?>][naam]" value="" style="width:40%;"/></td>
				</tr>
				<tr>
					<td width="20%">HTML pagina: <small>(Deze wordt automatisch gegenereerd)</small></td>
					<td><input type="text" name="description[<?=$language['languageID']?>][rewrite]" value="" style="width:40%;" /></td>
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
					<td><input type="text" name="description[<?=$language['languageID']?>][seotitle]" value="" style="width:40%;" maxlength="65"/></td>
				</tr>
				<tr>
					<td valign="top">SEO Beschrijving ( max 155 characters ) :</td>
					<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="description[<?=$language['languageID']?>][seodesc]" maxlength="155"></textarea></td>
				</tr>
				<tr>
					<td>SEO Key:</td>
					<td><input type="text" name="description[<?=$language['languageID']?>][seokey]" value="" style="width:40%;"/></td>
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