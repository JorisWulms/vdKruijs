<script type="text/javascript">
	function checkValues(){
		if($('#title').val()!=""){
			$('#form').submit();
		}else{
			alert('Waarom vergeet je een naam in te vullen?');
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
	<h1 style="background-image: url('images/category.png');">Nieuwe Plugin</h1>
	<div class="buttons"><a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=plugin&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content" id="newInputs">
	<form method="post"  action="index.php?action=plugin" id="form" enctype="multipart/form-data">
		<input type="hidden" name="addplugin" value="true">
		<table class="form">
			<tr>
				<td width="20%">Naam:</td>
				<td><input type="text" name="naam" id="title" value="" placeholder="Naam van plugin" style="width:40%;" /></td>
			</tr>
			<tr>
				<td width="20%">Plugin:</td>
				<td><input type="text" name="plugin" value="" placeholder="Bestandsnaam van plugin" style="width:40%;" /></td>
			</tr>	
	</form>
</div>