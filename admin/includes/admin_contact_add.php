<script type="text/javascript">
	function checkValues(){
		if($('#title').val()!=""){
			$('#form').submit();
		}else{
			alert('Vul a.u.b. een titel in.');
		}
	}
</script>
	<div class="buttonsScroll">
		<div style="float:right;">
			<a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a>
			<a onclick="location = 'index.php?action=contact&clear=true'" class="gray_btn"><span>Annuleren</span></a>
		</div>
	</div>
	<div class="heading">
		<h1 style="background-image: url('images/category.png');">Contact veld</h1>
		<div class="buttons"><a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=contact&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
	</div>
	<div class="content" id="newInputs">
	<div id="tabs" class="htabs"><a tab="#tab_general">Algemeen</a></div>

	<form method="post"  action="index.php?action=contact" id="form" enctype="multipart/form-data">
	<input type="hidden" name="addcontact" value="true">
		<div id="tab_general">
			<div id="language">
			<table class="form">
				<tr>
					<td width="20%">Titel:</td>
					<td><input id="title" type="text" name="title" value="" style="width:40%;" placeholder="Naam van het veld" /></td>
				</tr>
				
				<tr>
					<td width="20%">Type:</td>
					<td>
						<label class="fullLabel"><input type="radio" name="type" value="text" /> Text <i>- Nodig voor alle gegevens-velden</i></label>
						<label class="fullLabel"><input type="radio" name="type" value="textarea" /> Textarea <i>- Een veld voor bijvoorbeeld "opmerkingen".</i></label>
						<label class="fullLabel"><input type="radio" name="type" value="checkbox" /> Checkbox <i>- Een losstaande optie</i></label>
						<label class="fullLabel"><input type="radio" name="type" value="select" /> Select <i>- Een lijst met opties</i></label>
						<label class="fullLabel"><input type="radio" name="type" value="option" /> Option <i>- De opties voor een selectlijst</i></label>
						<label class="fullLabel"><input type="radio" name="type" value="radio" /> Radio <i>- Soort checkbox, maar dan is er maar &eacute;&eacute;n selectie mogelijk</i></label>
						<label class="fullLabel"><input type="radio" name="type" value="submit" /> Submitknop <i>- Deze is verplicht als je een formulier wilt versturen</i></label>
					</td>
				</tr>
				<tr>
					<td>Placeholder</td>
					<td><input id="placeholder" type="text" name="placeholder" value="" style="width:40%;" placeholder="Standaard tekst in het veld" /></td>
				</tr>
				<tr>
					<td>Moet dit veld zichtbaar zijn?</td>
					<td>
						<select name="visible">
							<option value="0">Onzichtbaar</option>
							<option value="1" selected>Zichtbaar</option>
						</select>
					</td>
				</tr>	
				<tr>
					<td>Groep (indien het een select of radio is, anders kun je dit negeren)</td>
					<td>
						<select name="parent">
							<option value="0">-</option>
							<?php
								$res = mysqli_query($res1 ,"SELECT id, title, type FROM contactform WHERE type = 'select' OR type = 'radio' AND parent=0 ORDER BY type, id ASC");
								while ($siterow = mysqli_fetch_array($res)){
							?>
									<option value="<?=$siterow['id']?>"><?=$siterow['type']?> - <?=$siterow['title']?></option>
							<?php } ?>
						</select>
					</td>
				</tr>		
			</table>	
			</div>
		</div>
	</form>
</div>