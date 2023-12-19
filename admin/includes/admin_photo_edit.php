<?php
$res= mysqli_query($res1 ,"SELECT * from galerij WHERE id=".$_GET['id']."");
$row = mysqli_fetch_object($res);

$pRes = mysqli_query($res1 ,"SELECT * FROM project");
$pResCurrent = mysqli_query($res1 ,"SELECT projectid FROM project_galerij WHERE project_galerij.galerijid = '".$_GET['id']."'");
$pRowCurrent = mysqli_fetch_assoc($pResCurrent);
?>
<div class="left"></div>
<div class="right"></div>
<div class="heading">
<h1 style="background-image: url('images/user.png');">Wijzig foto</h1>
<div class="buttons"><a onclick="$('#form').submit();" class="button"><span>Opslaan</span></a><a onclick="location = 'index.php?action=photo&clear=true'" class="button"><span>Annuleren</span></a></div>
</div>
<div class="content">
<form method="post" enctype="multipart/form-data" action="index.php?action=photo&clear=true" name="formulier" id="form">
<input type="hidden" name="editfoto" value="true">
<input type="hidden" name="id" value="<?=$row->id?>">
<table class="form">
	<tr>
		<td>Foto:</td>
		<td><img src="<?=("../images/gallery/".$row->url)?>" /></td>
	</tr>
	<tr>
		<td>Categorie:</td>
		<td>
		<select name="project">
		<?php
		while($pRow = mysqli_fetch_assoc($pRes)){
			echo("<option value=\"".$pRow["id"]."\"".($pRowCurrent['projectid'] == $pRow["id"] ? " selected" : "").">".$pRow["naam"]."</option>");
		} ?>
		</select>
		</td>
	</tr>
</table>
</form>
</div>
