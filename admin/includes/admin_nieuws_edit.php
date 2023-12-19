<?php 
$res = mysqli_query($res1 ,"SELECT * from news WHERE id=".$_GET['id']."");
$row = mysqli_fetch_object($res);


$tres = mysqli_query($res1 ,"SELECT * FROM news_language WHERE id = '".$row->id."'");
while ($trow = mysqli_fetch_object($tres)){

	$description[$trow->language_id] = array(
				'title'             => $trow->title,
				'rewrite'    => $trow->rewrite,
				'bigtext' => $trow->bigtext,
				'seotitle' => $trow->seotitle,
				'seodesc' => $trow->seodesc,
				'seokey' => $trow->seokey
	);
}


?>
<div class="heading">
<h1 style="background-image: url('images/category.png');">Wijzig nieuws</h1>
<div class="buttons"><div onclick="$('#form').submit();" class="green_btn">Opslaan</div><div onclick="location = 'index.php?action=nieuws&clear=true';" class="gray_btn">Annuleren</div></div>
</div>
<div class="content" id="newInputs">
<div id="tabs" class="htabs"><a tab="#tab_general">Algemeen</a><a tab="#tab_data">Gegevens</a></div>
<form method="post" action="index.php?action=nieuws" id="form" enctype="multipart/form-data">
<input type="hidden" name="editnieuws" value="true">
<input type="hidden" name="id" value="<?=$row->id?>">

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
				<td><input type="text" name="description[<?=$language['languageID']?>][title]" value="<?=($description[$language['languageID']]['title']!="") ? $description[$language['languageID']]['title'] : ''; ?>" style="width:40%;"/></td>
			</tr>
			<tr>
				<td width="20%">HTML pagina: <small>(Vul niks in als je wil automatisch laten kiezen)</small></td>
				<td><input type="text" name="description[<?=$language['languageID']?>][rewrite]" value="<?=($description[$language['languageID']]['rewrite']!="") ? $description[$language['languageID']]['rewrite'] : ''; ?>" style="width:40%;" /></td>
			</tr>
			<tr>
				<td>Beschrijving:</td>
				<td><textarea cols="80" rows="15" style="height:300px;" id="bigtext<?=$language['languageID']?>" name="description[<?=$language['languageID']?>][bigtext]"><?=($description[$language['languageID']]['bigtext']!="") ? $description[$language['languageID']]['bigtext'] : ''; ?></textarea></td>
			</tr>
			<?php if ($_SESSION['user_status']==9){?>
			<tr>
				<td>SEO Titel:</td>
				<td><input type="text" name="description[<?=$language['languageID']?>][seotitle]" value="<?=($description[$language['languageID']]['seotitle']!="") ? $description[$language['languageID']]['seotitle'] : ''; ?>" style="width:40%;"/></td>
			</tr>
			<tr>
				<td valign="top">SEO Beschrijving:</td>
				<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="description[<?=$language['languageID']?>][seodesc]" class="mceNoEditor"><?=($description[$language['languageID']]['seodesc']!="") ? $description[$language['languageID']]['seodesc'] : ''; ?></textarea></td>
			</tr>
			<tr>
				<td>SEO Key:</td>
				<td><input type="text" name="description[<?=$language['languageID']?>][seokey]" value="<?=($description[$language['languageID']]['seokey']!="") ? $description[$language['languageID']]['seokey'] : ''; ?>" style="width:40%;"/></td>
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
			<td><select name="visible"><option value="1" <?=($row->visible=='1')? 'selected="selected"' : ''?>>Actief</option><option value="0" <?=($row->visible=='0')? 'selected="selected"' : ''?>>Inactief</option></select></td>
		</tr>
		<tr>
			<td>Datum:<br/><span class="help">yyyy-mm-dd</span></td>
			<td><input type="text" name="datum" value="<?=$row->datum?>"></td>
		</tr>	
		<tr>
			<td valign="top">Huidig afbeelding: <img src="<?=HTTP_NEWSIMAGE . $row->foto_locatie?>"><input type="hidden" name="image1" value="<?=$row->foto_locatie?>"></td><td><input type="file" name="image"> <small>Huidig afbeelding behouden, upload dan niks</small></td>
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