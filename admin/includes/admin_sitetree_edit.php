<?php
$navigatie = array(
	'0' => 'Geen',
	'1' => 'Footer',
	'2' => 'Landingspage',
	'3' => 'Hoofdmenu',
	'4' => 'Topmenu'
);

$res = mysqli_query($res1 ,"SELECT * from sitetree WHERE id=".$_GET['id']."");
$row = mysqli_fetch_object($res);

$tres = mysqli_query($res1 ,"SELECT * FROM sitetree_language WHERE id = '".$row->id."'");
while ($trow = mysqli_fetch_object($tres)){

	$description[$trow->language_id] = array(
				'title'             => $trow->title,
				'rewrite'    => $trow->rewrite,
				'introText' => $trow->introText,
				'bigtext' => $trow->bigtext,
				'seotitle' => $trow->seotitle,
				'seodesc' => $trow->seodesc,
				'seokey' => $trow->seokey,
				'lpintro' => $trow->lpintro
	);
}
 
if ($_SESSION['user_status']==9){
	$hiddenFields = '';
}else{
	$hiddenFields = 'style="display:none;"';
}

?>
	<div class="buttonsScroll">
		<div style="float:right;">
			<a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a>
			<a onclick="location = 'index.php?action=sitetree&clear=true'" class="gray_btn"><span>Annuleren</span></a>
		</div>
	</div>
	
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Wijzig pagina</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=sitetree&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content" id="newInputs">
<div id="tabs" class="htabs"><a tab="#tab_general">Algemeen</a><a tab="#tab_data">Gegevens</a></div>
<form method="post" action="index.php?action=sitetree" id="form" enctype="multipart/form-data">
<input type="hidden" name="edittree" value="true">
<input type="hidden" name="id" value="<?=$row->id?>">

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
					<td>
						<input type="text" name="description[<?=$language['languageID']?>][title]" value="<?=(!empty($description[$language['languageID']]['title'])) ? $description[$language['languageID']]['title'] : ''; ?>" style="width:40%;"/>
					</td>
				</tr>
				<tr>
					<td width="20%">HTML pagina: <small>(Deze wordt automatisch gegenereerd)</small></td>
					<td>
						<input type="text" name="description[<?=$language['languageID']?>][rewrite]" value="<?=(!empty($description[$language['languageID']]['rewrite'])) ? $description[$language['languageID']]['rewrite'] : ''; ?>" style="width:40%;" />
					</td>
				</tr>
				<tr>
					<td>Intro Text:</td>
					<td>
						<textarea cols="80" rows="15" style="height:300px;" id="introText[<?=$language['languageID']?>]" name="description[<?=$language['languageID']?>][introText]">
							<?=(!empty($description[$language['languageID']]['introText'])) ? $description[$language['languageID']]['introText'] : ''; ?>
						</textarea>
					</td>
				</tr>
				<tr>
					<td>Beschrijving:</td>
					<td>
						<textarea cols="80" rows="15" style="height:300px;" id="bigtext[<?=$language['languageID']?>]" name="description[<?=$language['languageID']?>][bigtext]">
							<?=(!empty($description[$language['languageID']]['bigtext'])) ? $description[$language['languageID']]['bigtext'] : ''; ?>
						</textarea>
					</td>
				</tr>
				<tr <?=$hiddenFields?>>
					<td>SEO Titel ( max 65 characters ) :</td>
					<td><input type="text" name="description[<?=$language['languageID']?>][seotitle]" value="<?=(!empty($description[$language['languageID']]['seotitle'])) ? $description[$language['languageID']]['seotitle'] : ''; ?>" style="width:40%;" maxlength="65" /></td>
				</tr>
				<tr <?=$hiddenFields?>>
					<td valign="top">SEO Beschrijving ( max 155 characters ) :</td>
					<td><textarea cols="80" rows="15" style="width:40%;height:150px;" id="seodesc" name="description[<?=$language['languageID']?>][seodesc]" class="mceNoEditor" maxlength="155"><?=(!empty($description[$language['languageID']]['seodesc'])) ? $description[$language['languageID']]['seodesc'] : ''; ?></textarea></td>
				</tr>
				<tr <?=$hiddenFields?>>
					<td>SEO Key:</td>
					<td><input type="text" name="description[<?=$language['languageID']?>][seokey]" value="<?=(!empty($description[$language['languageID']]['seokey'])) ? $description[$language['languageID']]['seokey'] : ''; ?>" style="width:40%;"/></td>
				</tr>

				<tr>
					<td>Extra veld</td>
					<td>
						<textarea name="description[<?=$language['languageID']?>][lpintro]" cols="80" rows="15" style="width:40%;height:150px;" id="lpintro[<?=$language['languageID']?>]">
							<?=(!empty($description[$language['languageID']]['lpintro'])) ? $description[$language['languageID']]['lpintro'] : ''; ?>
						</textarea>
					</td>
				</tr>

			</table>	
		</div>
		<?php }?>
	</div>
	<div id="tab_data">
	<table class="form">
		<tr>
			<td>Zichtbaar:</td>
			<td><select name="visible"><option value="1" <?=($row->visible=='1')? 'selected="selected"' : ''?>>Zichtbaar</option><option value="0" <?=($row->visible=='0')? 'selected="selected"' : ''?>>Onzichtbaar</option></select></td>
		</tr>	
		<tr>
			<td>Tekst inklappen d.m.v. "lees meer"?</td>
			<td><select name="leesmeer"><option value="1" <?=($row->leesmeer=='1')? 'selected="selected"' : ''?>>Ja</option><option <?=($row->leesmeer=='0')? 'selected="selected"' : ''?> value="0">Nee</option></select></td>
		</tr>
		<tr>
			<td>Na hoeveel regels tekst inklappen?</td>
			<td><input name="leesmeerAantal" type="number" min="0" value="<?=$row->leesmeerAantal?>" /></td>
		</tr>
		<tr>
			<td>Onder welke pagina?</td>
			<td><select name="parent"><option value="0">Geen</option>
			<?php 
			$res = mysqli_query($res1 ,"SELECT * FROM sitetree LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id WHERE sitetree.parent=0 ORDER BY sitetree.navigatie ASC");
			while($dirrow = mysqli_fetch_object($res)){
				echo "<option value='".$dirrow->id."'";
					if ($row->parent==$dirrow->id){
						echo ' selected="selected"';
					}
				echo ">".$dirrow->title."</option>";
			}
			?>
			</select></td>
		</tr>	
		<tr>
			<td>Navigatie:</td>
			<td><select name="navigatie"><?php 
			foreach ($navigatie as $id => $value){
				echo '<option value="'.$id.'"';
					if ($row->navigatie==$id){
					echo ' selected="selected"';
					}
				echo '>'.$value.'</option>';
			}
			?>
			</select></td>
		</tr>
		<tr>
			<td>Plugins:</td>
			<td><?php allPlugins($row->exttemp,''); ?></td>
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
</script>