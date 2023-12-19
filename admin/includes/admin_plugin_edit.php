<?php
$getplugin = mysqli_query($res1 ,"SELECT * FROM plugin WHERE id=".$_GET['id']."");
$resplugin = mysqli_fetch_assoc($getplugin);

$pluginCode = file_get_contents(DIR_SYSTEM.'includes/plugin_'.$resplugin['plugin'].'.php');
?>
<script type="text/javascript">
	function checkValues(){
		if($('#title').val()!=""){
			$('#form').submit();
		}else{
			alert('Waarom vergeet je een titel in te vullen?');
		}
	}
</script>
<div class="buttonsScroll">
	<div style="float:right;">
		<a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a>
		<a onclick="location = 'index.php?action=plugin&clear=true'" class="gray_btn"><span>Annuleren</span></a>
	</div>
</div>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Plugin aanpassen</h1>
	<div class="buttons"><a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=plugin&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content" id="newInputs">
	<form method="post"  action="index.php?action=plugin" id="form" enctype="multipart/form-data">
		<input type="hidden" name="editplugin" value="true">
		<input type="hidden" name="id" value="<?=$resplugin['id']?>">
		<table class="form">
			<tr>
				<td width="20%">Titel:</td>
				<td><input type="text" name="naam" id="title" value="<?=$resplugin['naam']?>" placeholder="Naam van plugin" style="width:40%;" /></td>
			</tr>
			<tr>
				<td width="20%">Plugin:</td>
				<td><input type="text" name="plugin" value="<?=$resplugin['plugin']?>" placeholder="Bestandsnaam van plugin" style="width:40%;" /></td>
			</tr>
			<tr>
				<td width="20%">Code (enkel aanraken als je weet wat je doet!):</td>
				<td>
					<textarea rows="20" name="pluginCode" id="pluginCode" style="width:100%;"><?=htmlentities($pluginCode)?></textarea>
				</td>
			</tr>
	</form>
</div>
<script src="js/codemirror.js"></script>
<script>
  var editor = CodeMirror.fromTextArea(document.getElementById('pluginCode'), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true
  });
</script>