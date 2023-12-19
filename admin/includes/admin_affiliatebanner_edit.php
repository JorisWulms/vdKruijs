<?php
     $res = mysqli_query($res1,"SELECT * FROM affiliate_banner WHERE bannerID=".$_GET['id']."");
     $row = mysqli_fetch_array($res);
     
     $locaties = array(
         '1'    => 'Geen locatie',
         '2'    => 'In header ( Let op, menu moet fullwidth zijn en logo niet centered )',
         '3'    => 'In banner ( enkel op banners zonder teksten er in )',
         '4'    => 'Onder banner ( tussen banner en tekst )',
         '5'    => 'Rechts langs tekst ( gewone tekst paginas )',
         '6'    => 'Boven footer ( Gecentreerd )',
         '7'    => 'In dropdownmenu ( indien aanwezig )',
         '8'    => 'In popup onderaan ( Let op, popup moet wel actief staan )',
         '9'    => 'In notice ( Let op, notice moet wel actief staan )'
    );     
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Wijzig banner</h1>
	<div class="buttons">
		<a onclick="$('#form').submit();" class="green_btn">Wijziging opslaan</a>
		<a onclick="location = 'index.php?action=affiliatebanner&clear=true'" class="gray_btn">Annuleren</a>
	</div>
</div>
<div class="content">
	<form method="post" action="index.php?action=affiliatebanner" id="form" enctype="multipart/form-data">
		<input type="hidden" name="editaffiliatebanner" value="true">
		<input type="hidden" name="bannerid" value="<?=$row['bannerID']?>">
		<table class="form">
			<tr>
				<td width="20%">URL:</td>
						<td><textarea name="url" cols="80" rows="5"/><?=$row['url']?></textarea></td>
			</tr>
			<tr>
				<td width="20%">Image:</td>
						<td><textarea name="image" cols="80" rows="5"/><?=$row['image']?></textarea></td>
			</tr>
			<tr>
				<td width="20%">Script: <i>Enkel voor affiliate banners die een < script >-tag hebben. Beide velden hierboven dan leeg laten</i></td>
						<td><textarea name="script" cols="80" rows="5"/><?=$row['script']?></textarea></td>
			</tr>
			<tr>
				<td width="20%">Kliks:</td>
						<td><input type="text" name="kliks" value="<?=$row['kliks']?>" /></td>
			</tr>        
			<tr>
				<td>Locatie:</td>
				<td>
					<div class="scrollbox">
					<?php
					$class = 'odd';
					foreach ($locaties AS $locatiekey => $locatievalue ){
						$class = ($class == 'even' ? 'odd' : 'even'); 
						$getres = mysqli_query($res1,"SELECT * FROM affiliate_banner_locatie WHERE bannerID='".$row['bannerID']."' AND locatie='".$locatiekey."'");
						$rowres = mysqli_fetch_assoc($getres);
						
						?>
						<div class="<?php echo $class; ?>">
							<label><input type="checkbox" name="locatie[]" value="<?=$locatiekey?>" <?=($rowres['locatie'])? 'checked="checked"' : ''?>> <?=$locatievalue?></label>
						</div>
						<?
					}
					?>
					</div>
				</td>
			</tr>	
		</table>
	</form>
</div>