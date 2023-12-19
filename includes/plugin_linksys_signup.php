<?php
$succes = false;
if (isset($_POST['submitLink']) && 
	!empty($_POST['title']) && 
	!empty($_POST['url']) && 
	!empty($_POST['longdesc']) && 
	!empty($_POST['shortdesc']) && 
	!empty($_POST['place']) && 
	!empty($_POST['province']) && 
	!empty($_POST['category']) && 
	!empty($_POST['contact']) && 
	!empty($_POST['email']) && 
	!empty($_POST['returnlink']) && 
	$_POST["check"] == 1)
{
	$rewrite = encodeUrlParam($_POST['url']);

	mysqli_query($res1,"INSERT INTO linksys_link
					    SET title ='".realescape($_POST['title'])."', 
					    rewrite ='".realescape($rewrite)."',
					    url ='".realescape($_POST['url'])."',
					    longdesc ='".realescape($_POST['longdesc'])."',
					    shortdesc ='".realescape($_POST['shortdesc'])."',
					    place ='".realescape($_POST['place'])."',
					    province ='".realescape($_POST['province'])."',
					    category ='".realescape($_POST['category'])."',
					    searchwords ='".realescape($_POST['searchwords'])."',
					    contact ='".realescape($_POST['contact'])."',
					    email ='".realescape($_POST['email'])."',
					    returnlink ='".realescape($_POST['returnlink'])."',
					    ownsite ='0',
					    tip ='0'
					   ");
					   
	// Send mail
	$mail = new mosPHPMailer();
	$plaintext = '  
		<table width="100%" border="0" cellpadding="0" cellspacing="2">
			<tbody>
				<tr>
				  <td colspan="2">Er is een linkaanvraag ingediend op '.SITENAAM.'</td>
				</tr>
				<tr>
				  <td colspan="2">Ga naar de backend en bekijk of de link follow mag worden of niet.</td>
				</tr>
			</tbody>
		</table>';
		
	$sitenaam=SITENAAM;
	$sitemail=SITEMAIL;
	$subject="Linkaanvraag ".SITENAAM;
	$mail->From = $sitemail;
	$mail->FromName = $sitenaam;
	$mail->Body = $plaintext;
	$mail->Subject = $subject;
	$mail->IsHTML(true);
	$mail->AddAddress($sitemail, $sitenaam);
	$mail->AddBCC(SITEMAILBCC, $sitenaam);
	$query=$mail->Send();
	$mail->ClearAddresses();
	
	$succes = true;
}
if($succes==false){
?>
<form method="post" action="" id="form" enctype="multipart/form-data">
	<div class="fancyInputs">
		<span><input type="text" name="title" value="<?=(!empty($_POST['title']) ? $_POST['title'] : '')?>" placeholder="Vul hier uw titel in..." /></span>
		<span><input type="text" name="url" value="<?=(!empty($_POST['url']) ? $_POST['url'] : '')?>" placeholder="Vul hier uw URL in..." /></span>
		<span><textarea id="description" name="longdesc" placeholder="Vul hier uw lange omschrijving in..."><?=(!empty($_POST['longdesc']) ? $_POST['longdesc'] : '')?></textarea></span>
		<span><textarea name="shortdesc" placeholder="Vul hier uw korte omschrijving in..."><?=(!empty($_POST['shortdesc']) ? $_POST['shortdesc'] : '')?></textarea></span>
		<span><input type="text" name="place" value="<?=(!empty($_POST['place']) ? $_POST['place'] : '')?>" placeholder="Vul hier uw plaatsnaam in..." /></span>
		<span><input type="text" name="province" value="<?=(!empty($_POST['province']) ? $_POST['province'] : '')?>" placeholder="Vul hier uw provincie in..." /></span>
		<span>
			<select name="category">
				<option value="0">Selecteer een categorie</option>
				<?php
					$getCats = mysqli_query($res1,"SELECT id, title FROM linksys_cat");
					while($resCats = mysqli_fetch_assoc($getCats)){
						echo '<option value="'.$resCats['id'].'">'.$resCats['title'].'</option>';
					}
				?>
			</select>
		</span>
		<span><input type="text" name="searchwords" value="<?=(!empty($_POST['searchwords']) ? $_POST['searchwords'] : '')?>" placeholder="Vul hier uw zoekwoorden in..." /></span>
		<span><input type="text" name="contact" value="<?=(!empty($_POST['contact']) ? $_POST['contact'] : '')?>" placeholder="Vul hier de naam van uw contactpersoon in..." /></span>
		<span><input type="text" name="email" value="<?=(!empty($_POST['email']) ? $_POST['email'] : '')?>" placeholder="Vul hier uw e-mailadres in..." /></span>
		<span><input type="text" name="returnlink" value="<?=(!empty($_POST['returnlink']) ? $_POST['returnlink'] : '')?>" placeholder="Vul hier uw teruglink in..." /></span>
		<span><input type="submit" name="submitLink" value="Verstuur linkaanvraag" /></span>
		<input name="check" id="check" value="0" type="hidden">
		<script type="text/javascript">
		   document.getElementById("check").value = 1;					
		</script>
	</div>
</form>
<?php
}else{
	echo '<h2>Uw linkaanvraag is succesvol verstuurd</h2>';
	echo '<p>Bedankt voor uw aanvraag. Indien u een link terug heeft geplaatst, zal uw website opgenomen worden.</p>';
}
?>