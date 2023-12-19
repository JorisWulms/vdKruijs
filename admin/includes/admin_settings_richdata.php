<?php
include_once('../includes/settings.php');
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_richdata 
								  SET active='".(int)$_POST['active']."',
								  streetAddress='".realescape($_POST['streetAddress'])."',
								  addressLocality='".realescape($_POST['addressLocality'])."',
								  postalCode='".realescape($_POST['postalCode'])."',
								  addressCountry='".realescape($_POST['addressCountry'])."',
								  telephone='".realescape($_POST['telephone'])."',
								  contacturl='".realescape($_POST['contacturl'])."',
								  sameAs_facebook='".realescape($_POST['sameAs_facebook'])."',
								  sameAs_twitter='".realescape($_POST['sameAs_twitter'])."',
								  sameAs_google='".realescape($_POST['sameAs_google'])."',
								  alternateName='".realescape($_POST['alternateName'])."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=settings_richdata'); 
			}
		break;
	}	
}
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_richdata");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Richdata instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_richdata&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_richdata&route=save" id="form" enctype="multipart/form-data">
		<table class="list">
			<tbody>
				<tr>
					<td colspan="2" style="background:#efefef;font-weight:bold;padding: 10px 2%;width:96%;color:#444;margin:10px 0 0 0;"><b>Algemeen</b></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>URL</strong></td>
					<td class="left"><?=SITEURL?></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>logo</strong></td>
					<td class="left"><?=LOGO?></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Richdata actief?</strong></td>
					<td class="left">
						<select name="active">
							<option value="0" <?=($resSettings['active'] ? '' : 'selected="selected"')?>>Inactief</option>
							<option value="1" <?=($resSettings['active'] ? 'selected="selected"' : '')?>>Actief</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="background:#efefef;font-weight:bold;padding: 10px 2%;width:96%;color:#444;margin:10px 0 0 0;"><b>PostalAddress <small style="color:red;float:right;">( let op: deze velden dienen allemaal ingevuld te worden om address in rich data te krijgen! )</small> </b></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Straatnaam + huisnr <small style="float:right;">( Straatnaam 12 )</small></strong></td>
					<td class="left"><input type="text" name="streetAddress" class="fullwidth" placeholder="streetAddress" value="<?=$resSettings['streetAddress']?>" /></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Plaatsnaam <small style="float:right;">( Plaatsnaam )</small></strong></td>
					<td class="left"><input type="text" name="addressLocality" class="fullwidth" placeholder="addressLocality" value="<?=$resSettings['addressLocality']?>" /></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Postcode <small style="float:right;">( 1234AB )</small></strong></td>
					<td class="left"><input type="text" name="postalCode" class="fullwidth" placeholder="postalCode" value="<?=$resSettings['postalCode']?>" /></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Land  <small style="float:right;">( NL )</small></strong></td>
					<td class="left"><input type="text" name="addressCountry" class="fullwidth" placeholder="addressCountry" value="<?=$resSettings['addressCountry']?>" /></td>
				</tr>
				<tr>
					<td colspan="2" style="background:#efefef;font-weight:bold;padding: 10px 2%;width:96%;color:#444;margin:10px 0 0 0;"><b>ContactPoint</b></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Telefoon <small style="float:right;">( +31(0)123-456789 )</small></strong></td>
					<td class="left"><input type="text" name="telephone" class="fullwidth" placeholder="telephone" value="<?=$resSettings['telephone']?>" /></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>E-mailadres</strong></td>
					<td class="left"><?=SITEMAIL?></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Contactpagina <small style="float:right;">( http://www.sitenaam.nl/contact.html )</small></strong></td>
					<td class="left"><input type="text" name="contacturl" class="fullwidth" placeholder="contacturl" value="<?=$resSettings['contacturl']?>" /></td>
				</tr>
				<tr>
					<td colspan="2" style="background:#efefef;font-weight:bold;padding: 10px 2%;width:96%;color:#444;margin:10px 0 0 0;"><b>sameAs</b></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Facebook <small style="float:right;">( https://www.facebook.com/sitenaam )</small></strong></td>
					<td class="left"><input type="text" name="sameAs_facebook" class="fullwidth" placeholder="sameAs_facebook" value="<?=$resSettings['sameAs_facebook']?>" /></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Twitter <small style="float:right;">( https://twitter.com/sitenaam )</small></strong></td>
					<td class="left"><input type="text" name="sameAs_twitter" class="fullwidth" placeholder="sameAs_twitter" value="<?=$resSettings['sameAs_twitter']?>" /></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Google+ <small style="float:right;">(  https://plus.google.com/sitenaam/posts )</small></strong></td>
					<td class="left"><input type="text" name="sameAs_google" class="fullwidth" placeholder="sameAs_google" value="<?=$resSettings['sameAs_google']?>" /></td>
				</tr>
				<tr>
					<td colspan="2" style="background:#efefef;font-weight:bold;padding: 10px 2%;width:96%;color:#444;margin:10px 0 0 0;"><b>WebSite</b></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Websitenaam</strong></td>
					<td class="left"><?=SITENAAM?></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>Alternatieve websitenaam <small style="float:right;">(  SiteNaam.nl )</small></strong></td>
					<td class="left"><input type="text" name="alternateName" class="fullwidth" placeholder="alternateName" value="<?=$resSettings['alternateName']?>" /></td>
				</tr>
				<tr>
					<td class="left" width="240"><strong>WebsiteURL</strong></td>
					<td class="left"><?=SITEURL?></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>


