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
		<a onclick="location = 'index.php?action=module&clear=true'" class="gray_btn"><span>Annuleren</span></a>
	</div>
</div>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe module</h1>
	<div class="buttons"><a onclick="checkValues()" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=module&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content" id="newInputs">
	<form method="post"  action="index.php?action=module" id="form" enctype="multipart/form-data">
		<input type="hidden" name="addmodule" value="true">
		<table class="form">
			<tr>
				<td width="20%">Titel:</td>
				<td><input type="text" name="title" id="title" value="" placeholder="Naam van module" style="width:40%;" /></td>
			</tr>
			<tr>
				<td width="20%">Rewrite:</td>
				<td><input type="text" name="rewrite" value="" placeholder="Rewrite naam van module" style="width:40%;" /></td>
			</tr>
			<tr>
				<td>Onder welke module?</td>
				<td><select name="parent"><option value="0">Geen</option>
				<?php 
				$res = mysqli_query($res1 ,"SELECT * FROM module WHERE parent=0 ORDER BY title ASC");
				while ($dirrow = mysqli_fetch_assoc($res)){
					echo "<option value='".$dirrow['id']."'";
					if (isset($row) && $row['parent']==$dirrow['id']){
						echo " selected";
					}
					echo ">".$dirrow['title']."</option>";
				}
				?>
				</select></td>
			</tr>
			<tr>
				<td>Status:</td>
				<td><select name="visible"><option value="1" selected="selected">Actief</option><option value="0">Inactief</option></select></td>
			</tr>	
			<tr>
				<td>Volgorde:</td>
				<td><input type="text" name="ordening" value="" placeholder="Op welke plek in het menu moet de module komen?" /><td>
			</tr>	
	</form>
</div>