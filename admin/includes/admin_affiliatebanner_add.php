<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe banner</h1>
	<div class="buttons">
		<a onclick="$('#form').submit();" class="green_btn">Banner toevoegen</span></a>
		<a onclick="location = 'index.php?action=affiliatebanner&clear=true'" class="gray_btn">Annuleren</a>
	</div>
</div>
<div class="content">
	<form method="post" action="index.php?action=affiliatebanner" id="form" enctype="multipart/form-data">
		<input type="hidden" name="addaffiliatebanner" value="true">
		<table class="form">
			<tr>
				<td width="20%">URL:</td>
				<td><textarea name="url" cols="80" rows="5"/></textarea></td>
			</tr>
			<tr>
				<td width="20%">Image:</td>
				<td><textarea name="image" cols="80" rows="5"/></textarea></td>
			</tr>
			<tr>
				<td width="20%">Script: <i>Enkel voor affiliate banners die een < script >-tag hebben. Beide velden hierboven dan leeg laten</i></td>
						<td><textarea name="script" cols="80" rows="5"/></textarea></td>
			</tr>
			<tr>
				<td width="20%">Kliks:</td>
				<td><input disabled="disabled" type="text" name="kliks" value="0" /></td>
			</tr>        
			<tr>
				<td>Locatie:</td>
				<td>
				<div class="scrollbox">
					<div class="even">
						<label><input type="checkbox" name="locatie[]" value="1"> Geen locatie</label>
					</div>    
					<div class="odd">
						<label><input type="checkbox" name="locatie[]" value="2"> In header ( Let op, menu moet fullwidth zijn en logo niet centered )</label>
					</div>  
					<div class="even">
						<label><input type="checkbox" name="locatie[]" value="3"> In banner ( enkel op banners zonder teksten er in )</label>
					</div> 
					<div class="odd">
						<label><input type="checkbox" name="locatie[]" value="4"> Onder banner ( tussen banner en tekst )</label>
					</div>  
					<div class="even">
						<label><input type="checkbox" name="locatie[]" value="5"> Rechts langs tekst ( gewone tekst pagina's )</label>
					</div> 
					<div class="odd">
						<label><input type="checkbox" name="locatie[]" value="6"> Boven footer ( Gecentreerd )</label>
					</div>  
					<div class="even">
						<label><input type="checkbox" name="locatie[]" value="7"> In dropdownmenu ( indien aanwezig )</label>
					</div> 
					<div class="odd">
						<label><input type="checkbox" name="locatie[]" value="8"> In popup onderaan ( Let op, popup moet wel actief staan )</label>
					</div>  
					<div class="even">
						<label><input type="checkbox" name="locatie[]" value="9"> In notice ( Let op, notice moet wel actief staan )</label>
					</div> 
				</div>    
				</td>
			</tr>	
		</table>
	</form>
</div>