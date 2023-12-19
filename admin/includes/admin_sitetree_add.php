<?php
$navigatie = array(
	'0' => 'Geen',
	'1' => 'Footer',
	'2' => 'Landingspage',
	'3' => 'Hoofdmenu',
	'4' => 'Topmenu'
);
?>
<script type="text/javascript">
	function checkValues(){
		if($('#title').val()!="" && $('#rewrite_error').val()==0){
			$('#form').submit();
		}else{
			alert('Waarom voer je een verkeerde titel/rewrite in?');
		}
	}
</script>
<?php 
if ($_SESSION['user_status']==9){
	$hiddenFields = '';
}else{
	$hiddenFields = 'style="display:none;"';
}
?>
<div class="buttonsScroll">
	<div style="float:right;">
		<a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a>
		<a onclick="location = 'index.php?action=sitetree&clear=true'" class="gray_btn"><span>Annuleren</span></a>
	</div>
</div>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe pagina</h1>
	<div class="buttons">
		<a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a>
		<a onclick="location = 'index.php?action=sitetree&clear=true'" class="gray_btn"><span>Annuleren</span></a>
	</div>
</div>

<div class="content" id="newInputs">
<div id="tabs" class="htabs"><a tab="#tab_general">Algemeen</a><a tab="#tab_data">Gegevens</a></div>

<form method="post"  action="index.php?action=sitetree" id="form" enctype="multipart/form-data">
<input type="hidden" name="addtree" value="true" />
<input type="hidden" name="rewrite_error" id="rewrite_error" value="0" />
	<div id="tab_general">
		<div id="languages" class="htabs">
			<?php foreach ($languages as $language) { ?>
			<a tab="#language<?php echo $language['languageID']; ?>">
				<img src="images/flags/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?>
			</a>
			<?php } ?>
		</div>
		<?php foreach ($languages as $language) { ?>
		<div id="language<?php echo $language['languageID']; ?>">
		<table class="form">
			<tr>
				<td width="20%">Titel:</td>
				<td><input id="title" language_id="<?=$language['languageID']?>" class="titel" type="text" name="description[<?=$language['languageID']?>][title]" value="<?=isset($row) && $row->title?>" style="width:40%;"/></td>
			</tr>
			<tr>
				<td width="20%">HTML pagina: <small>(Deze wordt automatisch gegenereerd)</small></td>
				<td><input id="rewrite<?=$language['languageID']?>" type="text" language_id="<?=$language['languageID']?>" class="rewrite" name="description[<?=$language['languageID']?>][rewrite]" value="<?=isset($row) && $row->rewrite?>" style="width:40%;" /></td>
			</tr>
			<tr>
				<td>introText:</td>
				<td><textarea cols="80" rows="15" style="height:300px;" id="introText[<?=$language['languageID']?>]" name="description[<?=$language['languageID']?>][introText]"><?=isset($row) && $row->introText?></textarea></td>
			</tr>
			<tr>
				<td>Beschrijving:</td>
				<td><textarea cols="80" rows="15" style="height:300px;" id="bigtext[<?=$language['languageID']?>]" name="description[<?=$language['languageID']?>][bigtext]"><?=isset($row) && $row->bigtext?></textarea></td>
			</tr>
			
			<tr <?=$hiddenFields?>>
				<td>SEO Titel ( max 65 characters ) :</td>
				<td><input type="text" name="description[<?=$language['languageID']?>][seotitle]" value="<?=isset($row) && $row->seotitle?>" style="width:40%;"  maxlength="65" /></td>
			</tr>
			<tr <?=$hiddenFields?>>
				<td valign="top">SEO Beschrijving ( max 155 characters ) :</td>
				<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="description[<?=$language['languageID']?>][seodesc]" class="mceNoEditor" maxlength="155"><?=isset($row) && $row->seodesc?></textarea></td>
			</tr>
			<tr <?=$hiddenFields?>>
				<td>SEO Key:</td>
				<td><input type="text" name="description[<?=$language['languageID']?>][seokey]" value="<?=isset($row) && $row->seokey?>" style="width:40%;"/></td>
			</tr>
			
			<tr>
				<td>Extra veld:</td>
				<td><textarea name="description[<?=$language['languageID']?>][lpintro]" cols="80" rows="15" style="width:40%;height:150px;" id="lpintro[<?=$language['languageID']?>]"><?=isset($row) && $row->lpintro?></textarea></td>
			</tr>
		</table>	
		</div>
		<?php }?>
	</div>
	<div id="tab_data">
	<table class="form">
		<tr>
			<td>Zichtbaar:</td>
			<td><select name="visible"><option value="1" selected="selected">Zichtbaar</option><option value="0">Onzichtbaar</option></select></td>
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
			<td>Onder welke pagina?</td>
			<td><select name="parent"><option value="0">Geen</option>
			<?php 
			$res = mysqli_query($res1 ,"SELECT * FROM sitetree LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id WHERE sitetree.parent=0 AND sitetree_language.language_id=2 ORDER BY sitetree.navigatie ASC");
			while ($dirrow = mysqli_fetch_object($res)){
			echo "<option value='".$dirrow->id."'";
			if (isset($row) && $row->parent==$dirrow->id){
			echo " selected";
			}
			echo ">".$dirrow->title."</option>";
			}
			?>
			</select></td>
		</tr>	
		<tr>
			<td>Navigatie:</td>
			<td><select name="navigatie">      <?php 
			foreach ($navigatie as $id => $value){
			echo '<option value="'.$id.'"';
			if (isset($row) && $row->navigatie==$id){
			echo ' selected';
			}
			echo '>'.$value.'</option>';
			}
			?>
			</select></td>
		</tr>
		<tr>
			<td>Plugins:</td>
			<td><?php allPlugins('',''); ?></td>
		</tr>
	</table>	
	</div>
</form>
</div>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php 
foreach ($languages as $language){
?>
	CKEDITOR.replace('bigtext[<?=$language['languageID']?>]',
					{
					filebrowserBrowseUrl : 'includes/filemanager.php',
					filebrowserImageBrowseUrl : 'includes/filemanager.php',
					filebrowserFlashBrowseUrl :'includes/filemanager.php',
					filebrowserUploadUrl  :'includes/filemanager.php',
					filebrowserImageUploadUrl : 'includes/filemanager.php',
					filebrowserFlashUploadUrl : 'includes/filemanager.php'
	 
	});
	CKEDITOR.replace('introText[<?=$language['languageID']?>]',
					{
					filebrowserBrowseUrl : 'includes/filemanager.php',
					filebrowserImageBrowseUrl : 'includes/filemanager.php',
					filebrowserFlashBrowseUrl :'includes/filemanager.php',
					filebrowserUploadUrl  :'includes/filemanager.php',
					filebrowserImageUploadUrl : 'includes/filemanager.php',
					filebrowserFlashUploadUrl : 'includes/filemanager.php'
	 
	});
<?php 
} 
?>
//--></script>
<script type="text/javascript">
$.tabs('#tabs a'); 
$.tabs('#languages a');

function generateRewrite(val, lang, replaceRewrite) {

$('#rewrite' + lang).removeClass('error');
$('.rewrite_error').remove();
$('#rewrite_error').val(0);
$.ajax({
type: "POST",
dataType: "json",
url: "includes/ajax_checkrewrite.php", //Relative or absolute path to response.php file
data: "title=" + val + "&lang=" + lang,
success: function (data) {
var rewr = $('#rewrite' + lang);

if (replaceRewrite === true) {
rewr.val(data.rewrite);
}

if (data.check === true) {
rewr.addClass('error');
$('#rewrite_error').val(1);
rewr.after('<div class="rewrite_error">Deze rewrite wordt al voor iets anders gebruikt.</div>');
}
}
});

}

$(document).ready(function(){
	$('.titel').bind('keyup', function() {
		var val = $(this).val();
		var lang = $(this).attr('language_id');
		generateRewrite(val, lang, true);
	});

	$('.rewrite').bind('keyup', function() {
		var val = $(this).val();
		var lang = $(this).attr('language_id');
		generateRewrite(val, lang, false);
	});
});
</script>