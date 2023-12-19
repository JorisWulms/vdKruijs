<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_general 
								  SET websitename='".$_POST['websitename']."',
								  websiteurl='".$_POST['websiteurl']."',
								  emailaddress='".$_POST['emailaddress']."',
								  bccaddress='".$_POST['bccaddress']."',
								  sitemap='".$_POST['sitemap']."',
								  blogpath='".$_POST['blogpath']."',
								  linksyspath='".$_POST['linksyspath']."',
								  additionalTagHeader='".escape($_POST['additionalTagHeader'])."',
								  additionalTagBody='".escape($_POST['additionalTagBody'])."',
								  xmlFeed='".escape($_POST['xmlFeed'])."',
								  notFound='".escape($_POST['notFound'])."'
								  WHERE id=1
								");
			
			if($_POST['xmlFeed']!=""){
				include_once('import.php');
			}
			
			if ($_FILES['image']['name']!="")
			{
				UploadLogo(DIR_USERFILES);
				mysqli_query($res1 ,"UPDATE settings_general 
								  SET logo='".$_FILES['image']['name']."'
								  WHERE id=1
								");
			}

			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=settings_general'); 
			}
		break;
	}	
}
$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_general");
$resSettings = mysqli_fetch_assoc($getSettings);
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Algemene instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_general&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_general&route=save" id="form" enctype="multipart/form-data">
		<table class="list">
			<thead>
				<tr>
					<td class="left" width="240"><strong>Website naam</strong></td>
					<td class="left" width="240"><strong>Website URL</strong></td>
					<td class="left" width="240"><strong>E-mailadres</strong></td>
					<td class="left" width="240"><strong>BCC adres</strong></td>
					<td class="left" width="240"><strong>Sitemap</strong></td>
					<td class="left" width="240"><strong>Blogpad</strong></td>
					<td class="left" width="240"><strong>Linksyspad</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="websitename" class="fullwidth" placeholder="Website naam" value="<?=$resSettings['websitename']?>" /></td>
					<td class="left"><input type="text" name="websiteurl" class="fullwidth" placeholder="Website URL" value="<?=$resSettings['websiteurl']?>" /></td>
					<td class="left"><input type="text" name="emailaddress" class="fullwidth" placeholder="E-mailadres" value="<?=$resSettings['emailaddress']?>" /></td>
					<td class="left"><input type="text" name="bccaddress" class="fullwidth" placeholder="BCC adres" value="<?=$resSettings['bccaddress']?>" /></td>
					<td class="left"><input type="checkbox" name="sitemap" class="fullwidth" value="1" <?php if($resSettings['sitemap']){ echo "checked"; }?> /></td>
					<td class="left"><input type="text" name="blogpath" class="fullwidth" placeholder="blogpath" value="<?=$resSettings['blogpath']?>" /></td>
					<td class="left"><input type="text" name="linksyspath" class="fullwidth" placeholder="linksyspath" value="<?=$resSettings['linksyspath']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_general&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<!-- logo upload-->
		<span>Logo:</span>
		<span>
			Huidige logo: <img src="<?=HTTP_USERFILES . $resSettings["logo"]?>">
			<br/><input type="file" name="image" />
		</span>
		
		<table class="list" style="margin:30px 0 0 0;">
			<thead>
				<tr>
					<td class="left" width="240"><strong>Extra regels binnen de HEAD-tags</strong></td>
					<td class="left" width="240"><strong>Extra regels voor de /BODY-tag</strong></td>
					<td class="left" width="240"><strong>XML feed link</strong></td>
					<td class="left" width="240"><strong>Page not found</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><textarea name="additionalTagHeader" class="fullwidth" placeholder="Code voor binnen de <head></head> tags"><?=$resSettings['additionalTagHeader']?></textarea></td>
					<td class="left"><textarea name="additionalTagBody" class="fullwidth" placeholder="Code voor de </body> tag"><?=$resSettings['additionalTagBody']?></textarea></td>
					<td class="left"><input type="text" name="xmlFeed" class="fullwidth" placeholder="Werkt nog niet 100%" value="<?=$resSettings['xmlFeed']?>" /></td>
					<td class="left">
						<select name="notFound" style="width:100%;">
							<option value="1" <?=($resSettings['notFound']==1) ? 'selected' : ''?>>301 redirect naar homepage</option>
							<option value="2" <?=($resSettings['notFound']==2) ? 'selected' : ''?>>404 pagina</option>
						</select>
					</td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_general&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>


