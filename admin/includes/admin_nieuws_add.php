
<div class="heading">
<h1 style="background-image: url('images/category.png');">Nieuw nieuws</h1>
<div class="buttons"><div onclick="$('#form').submit();" class="green_btn">Opslaan</div><div onclick="location = 'index.php?action=nieuws&clear=true';" class="gray_btn">Annuleren</strong></div></div>
</div>
<div class="content" id="newInputs">
<div id="tabs" class="htabs"><a tab="#tab_general">Algemeen</a><a tab="#tab_data">Gegevens</a></div>
<form method="post" action="index.php?action=nieuws" id="form" enctype="multipart/form-data">
<input type="hidden" name="addnieuws" value="true">
	<div id="tab_general">
		<div id="languages" class="htabs">
		<?php foreach ($languages as $language) { ?>
		<a tab="#language<?php echo $language['languageID']; ?>"><img src="images/flags/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
		<?php } ?>
		</div>
		<?php foreach ($languages as $language) { ?>
		<div id="language<?php echo $language['languageID']; ?>">
		<table class="form">
			<tr>
				<td width="20%">Titel:</td>
				<td><input type="text" name="description[<?=$language['languageID']?>][title]" value="<?=isset($row) && $row->title?>" style="width:40%;"/></td>
			</tr>
			<tr>
				<td width="20%">HTML pagina: <small>(Vul niks in als je wil automatisch laten kiezen)</small></td>
				<td><input type="text" name="description[<?=$language['languageID']?>][rewrite]" value="<?=isset($row) && $row->rewrite?>" style="width:40%;" /></td>
			</tr>
			<tr>
				<td>Beschrijving:</td>
				<td><textarea cols="80" rows="15" style="height:300px;" id="bigtext<?=$language['languageID']?>" name="description[<?=$language['languageID']?>][bigtext]"><?=isset($row) && $row->bigtext?></textarea></td>
			</tr>
			<?php if ($_SESSION['user_status']==9){?>
			<tr>
				<td>SEO Titel:</td>
				<td><input type="text" name="description[<?=$language['languageID']?>][seotitle]" value="<?=isset($row) && $row->seotitle?>" style="width:40%;"/></td>
			</tr>
			<tr>
				<td valign="top">SEO Beschrijving:</td>
				<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="description[<?=$language['languageID']?>][seodesc]" class="mceNoEditor"><?=isset($row) && $row->seodesc?></textarea></td>
			</tr>
			<tr>
				<td>SEO Key:</td>
				<td><input type="text" name="description[<?=$language['languageID']?>][seokey]" value="<?=isset($row) && $row->seokey?>" style="width:40%;"/></td>
			</tr>
			<?php }?>
		</table>	
		</div>
		<?php }?>
	</div>
	<div id="tab_data">
	<table class="form">
		<tr>
			<td>Status:</td>
			<td><select name="visible"><option value="1" selected="selected">Actief</option><option value="0">Inactief</option></select></td>
		</tr>	
		<tr>
			<td>Datum:<br/><span class="help">yyyy-mm-dd</span></td>
			<td><input type="text" name="datum" value=""></td>
		</tr>	
		<tr>
			<td>Afbeelding:</td><td><input type="file" name="image"></td>
		</tr>
	</table>	
	</div>
</form>
</div>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('bigtext<?=$language['languageID']; ?>',
				{
                filebrowserBrowseUrl : 'includes/filemanager.php',
                filebrowserImageBrowseUrl : 'includes/filemanager.php',
                filebrowserFlashBrowseUrl :'includes/filemanager.php',
				filebrowserUploadUrl  :'includes/filemanager.php',
				filebrowserImageUploadUrl : 'includes/filemanager.php',
				filebrowserFlashUploadUrl : 'includes/filemanager.php'
 
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
$.tabs('#tabs a'); 
$.tabs('#languages a');
//--></script>