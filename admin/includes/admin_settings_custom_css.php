<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			file_put_contents(DIR_SYSTEM.'css/customStyle.css',stripslashes($_POST['customCSS']));
			
			$_SESSION['success'] = 'Custom CSS succesvol bijgewerkt.';
			header('Location: index.php?action=settings_custom_css'); 
		break;
	}	
}


$customCSS = file_get_contents(DIR_SYSTEM.'css/customStyle.css');

?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Custom CSS</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_custom_css&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_custom_css&route=save" id="form">
		<table class="list">
			<thead>
				<tr>
					<td class="left" width="240" colspan="2"><strong>Custom CSS aanpassen - Alleen als je weet wat je doet</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><textarea rows="20" name="customCSS" style="width:100%;"><?=$customCSS?></textarea></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_custom_css&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>