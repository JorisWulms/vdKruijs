<?php
$getContactForm = mysqli_query($res1 ,"SELECT * FROM contactform WHERE id=".$_GET['id']."");
$resContactForm = mysqli_fetch_assoc($getContactForm);

$getParent = mysqli_query($res1 ,"SELECT * FROM contactform WHERE id = '".$resContactForm['parent']."'");
$resParent = mysqli_fetch_assoc($getParent);
?>
<div class="buttonsScroll">
	<div style="float:right;">
		<a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a>
		<a onclick="location = 'index.php?action=contact&clear=true'" class="gray_btn"><span>Annuleren</span></a>
	</div>
</div>
	
<div class="heading">
<h1 style="background-image: url('images/category.png');">Wijzig contact veld</h1>
<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=contact&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content" id="newInputs">
	<form method="post" action="index.php?action=contact" id="form" enctype="multipart/form-data">
		<input type="hidden" name="editcontact" value="true">
		<input type="hidden" name="id" value="<?=$resContactForm['id']?>">
		<table class="form">
			<tr>
				<td width="20%">Titel:</td>
				<td><input id="title" type="text" name="title" value="<?=$resContactForm['title']?>" style="width:40%;"/></td>
			</tr>

			<tr>
				<td width="20%">Type:</td>
				<td>
					<label class="fullLabel"><input type="radio" name="type" <?php if($resContactForm['type']=='text'){ echo 'checked="checked"'; } ?> value="text" /> Text <i>- Nodig voor alle gegevens-velden</i></label>
					<label class="fullLabel"><input type="radio" name="type" <?php if($resContactForm['type']=='textarea'){ echo 'checked="checked"'; } ?> value="textarea" /> Textarea <i>- Een veld voor bijvoorbeeld "opmerkingen".</i></label>
					<label class="fullLabel"><input type="radio" name="type" <?php if($resContactForm['type']=='checkbox'){ echo 'checked="checked"'; } ?> value="checkbox" /> Checkbox <i>- Een losstaande optie</i></label>
					<label class="fullLabel"><input type="radio" name="type" <?php if($resContactForm['type']=='select'){ echo 'checked="checked"'; } ?> value="select" /> Select <i>- Een lijst met opties</i></label>
					<label class="fullLabel"><input type="radio" name="type" <?php if($resContactForm['type']=='option'){ echo 'checked="checked"'; } ?> value="option" /> Option <i>- De opties voor een selectlijst</i></label>
					<label class="fullLabel"><input type="radio" name="type" <?php if($resContactForm['type']=='radio'){ echo 'checked="checked"'; } ?> value="radio" /> Radio <i>- Soort checkbox, maar dan is er maar &eacute;&eacute;n selectie mogelijk</i></label>
					<label class="fullLabel"><input type="radio" name="type" <?php if($resContactForm['type']=='submit'){ echo 'checked="checked"'; } ?> value="submit" /> Submitknop <i>- Deze is verplicht als je een formulier wilt versturen</i></label>
				</td>
			</tr>
			<tr>
				<td>Placeholder</td>
				<td><input id="placeholder" type="text" name="placeholder" value="<?=$resContactForm['placeholder']?>" style="width:40%;"/></td>
			</tr>
			<tr>
				<td>Moet dit veld zichtbaar zijn?</td>
				<td>
					<select name="visible">
						<option value="0" <?php if($resContactForm['visible']=='0'){ echo 'selected'; } ?>>Onzichtbaar</option>
						<option value="1" <?php if($resContactForm['visible']=='1'){ echo 'selected'; } ?>>Zichtbaar</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Groep (indien het een select of radio is! anders negeren)</td>
				<td>
					<select name="parent">
					<option value="0">-</option>
						<?php 
							$i=0;
								  $res = mysqli_query($res1 ,"SELECT id, title FROM contactform WHERE type = 'select' OR type = 'radio' AND parent=0 ORDER BY id ASC");
								  while ($siterow = mysqli_fetch_assoc($res)){
							$i++;
						?>
							<option value="<?=$siterow['id']?>" <?php if($resParent['id'] == $siterow['id']){ echo 'selected="selected"'; } ?>><?=$siterow['title']?></option>
						<?php }?>
				
					</select>
				</td>
			</tr>
		</table>	
	</form>
</div>