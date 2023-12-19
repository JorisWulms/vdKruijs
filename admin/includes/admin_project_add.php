
<div class="heading">
<h1 style="background-image: url('images/user.png');">Nieuw project</h1>
<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=project&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content" id="newInputs">
<form method="post" action="index.php?action=project" name="formulier" id="form">
<input type="hidden" name="addproject" value="true">
<table class="form">
	<tr>
		<td>Naam:</td>
		<td><input type="text" name="naam" value="" maxlength="100" /></td>
	</tr>
	<tr>
		<td>HTML rewrite:</td>
		<td><input type="text" name="rewrite" value="" /></td>
	</tr>  
	<tr>
		<td>Slogan:</td>
		<td><input type="text" name="slogan" value="" maxlength="255" /></td>
	</tr>
	<tr>
		<td>Beschrijving:</td>
		<td><textarea id="beschrijving" name="beschrijving" maxlength="255" cols="50"></textarea></td>
	</tr>
	<tr>
		<td>Korte beschrijving:</td>
		<td><textarea name="korteBeschrijving" maxlength="255" cols="50"></textarea></td>
	</tr>
	<tr>
		<td>Moet dit project zichtbaar zijn?</td>
		<td><select name="visible"><option value="1">Ja</option><option value="0" selected="selected">Nee</option></select></td>
	</tr>      
</table>
</form>
</div>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('beschrijving',
					{
					filebrowserBrowseUrl : 'includes/filemanager.php',
					filebrowserImageBrowseUrl : 'includes/filemanager.php',
					filebrowserFlashBrowseUrl :'includes/filemanager.php',
					filebrowserUploadUrl  :'includes/filemanager.php',
					filebrowserImageUploadUrl : 'includes/filemanager.php',
					filebrowserFlashUploadUrl : 'includes/filemanager.php'
	 
	});	
</script>