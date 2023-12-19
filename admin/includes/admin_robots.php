<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			file_put_contents(DIR_SYSTEM.'robots.txt',$_POST['robots']);
			
			$_SESSION['success'] = 'Robots succesvol bijgewerkt.';
			header('Location: index.php?action=robots'); 
		break;
	}	
}


$robots = file_get_contents(DIR_SYSTEM.'robots.txt');

?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Robots.txt</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=robots&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=robots&route=save" id="form">
		<table class="list">
			<thead>
				<tr>
					<td class="left" width="240" colspan="2"><strong>Robots.txt aanpassen</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><textarea rows="20" name="robots" style="width:100%;"><?=$robots?></textarea></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=robots&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>