<?php
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "save":
			$query = mysqli_query($res1 ,"UPDATE settings_style 
								  SET fontFamily1='".escape($_POST['fontFamily1'])."',
								  fontFamily2='".escape($_POST['fontFamily2'])."',
								  fontSize='".escape($_POST['fontSize'])."',
								  fontWeight='".escape($_POST['fontWeight'])."',
								  fontColor='".escape($_POST['fontColor'])."',
								  titleColor='".escape($_POST['titleColor'])."',
								  linkColor='".escape($_POST['linkColor'])."',
								  menuBackground='".escape($_POST['menuBackground'])."',
								  menuColor='".escape($_POST['menuColor'])."',
								  menuHoverColor='".escape($_POST['menuHoverColor'])."',
								  menuFullWidth='".$_POST['menuFullWidth']."',
								  menuItemPadding='".escape($_POST['menuItemPadding'])."',
								  menuBorders='".escape($_POST['menuBorders'])."',
								  menuCapitals='".escape($_POST['menuCapitals'])."',
								  centerLogo='".$_POST['centerLogo']."',
								  headerBorder='".$_POST['headerBorder']."',
								  headerBackground='".$_POST['headerBackground']."',
								  headerFixed='".$_POST['headerFixed']."',
								  siteWidth='".escape($_POST['siteWidth'])."',
								  siteBackground='".escape($_POST['siteBackground'])."',
								  siteLineheight='".escape($_POST['siteLineheight'])."',
								  h1size='".escape($_POST['h1size'])."',
								  h1weight='".escape($_POST['h1weight'])."',
								  h2size='".escape($_POST['h2size'])."',
								  h2weight='".escape($_POST['h2weight'])."',
								  h3size='".escape($_POST['h3size'])."',
								  h3weight='".escape($_POST['h3weight'])."',
								  textBlockBackground='".escape($_POST['textBlockBackground'])."',
								  textBlockColor='".escape($_POST['textBlockColor'])."',
								  footerBackground='".escape($_POST['footerBackground'])."',
								  footerColor='".escape($_POST['footerColor'])."',
								  footerBorder='".escape($_POST['footerBorder'])."'
								  WHERE id=1
								");

			if (count($query!=0)){
				$_SESSION['success'] = 'Instellingen succesvol bijgewerkt.';
				header('Location: index.php?action=settings_style'); 
			}
		break;
	}	
}

$getSettings = mysqli_query($res1 ,"SELECT * FROM settings_style");
$resSettings = mysqli_fetch_assoc($getSettings);

// ALL SELECTABLE FONTS
$defaultFonts = array('Arial','Calibri','Helvetica','Verdana','Georgia','Palatino','Times New Roman','Impact','Tahoma','Raleway','Lato','Open+Sans','Open+Sans+Condensed','Roboto','Roboto+Condensed','Roboto+Slab','Ubuntu','Arimo');
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Algemene style instellingen</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn"><span>Opslaan</span></a>
	</div>
</div>
<div id="newInputs" class="content">
	<form method="post" action="index.php?action=settings_style&route=save" id="form">
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="8">Text settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>Main font-family</strong></td>
					<td class="left" width="240"><strong>Sub font-family</strong></td>
					<td class="left" width="240"><strong>Font size</strong></td>
					<td class="left" width="240"><strong>Font weight</strong></td>
					<td class="left" width="240"><strong>Main font-color</strong></td>
					<td class="left" width="240"><strong>Title color</strong></td>
					<td class="left" width="240"><strong>Link color</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left">
						<select name="fontFamily1" style="width:100%;">
							<?php 
								foreach($defaultFonts as $value){
									$resSettings['fontFamily1']== $value ? $selected = 'selected="selected"' : $selected = '';
									echo '<option value="'.$value.'" '.$selected.' style="font-family:'.$value.';">'.str_replace('+',' ',$value).'</option>';
								} 
							?>
						</select>
					</td>
					<td class="left">
						<select name="fontFamily2" style="width:100%;">
							<option value="" <?php if($resSettings['fontFamily2']==''){ echo 'selected="selected"'; } ?> >-</option>
							<?php 
								foreach($defaultFonts as $value){
									$resSettings['fontFamily2']== $value ? $selected = 'selected="selected"' : $selected = '';
									echo '<option value="'.$value.'" '.$selected.' style="font-family:'.$value.';">'.str_replace('+',' ',$value).'</option>';
								} 
							?>
						</select>
					</td>
					<td class="left"><input type="text" name="fontSize" class="fullwidth" placeholder="fontSize" value="<?=$resSettings['fontSize']?>" /></td>
					<td class="left">
						<select name="fontWeight" style="width:100%;">
							<option value="light" <?php if($resSettings['fontWeight']=='light'){ echo 'selected="selected"'; } ?> >Light</option>
							<option value="normal" <?php if($resSettings['fontWeight']=='normal'){ echo 'selected="selected"'; } ?> >Normal</option>
							<option value="bold" <?php if($resSettings['fontWeight']=='bold'){ echo 'selected="selected"'; } ?> >Bold</option>
						</select>
					</td>
					<td class="left"><input type="text" name="fontColor" class="fullwidth colorPicker" placeholder="Main font-color" value="<?=$resSettings['fontColor']?>" /></td>
					<td class="left"><input type="text" name="titleColor" class="fullwidth colorPicker" placeholder="Title color" value="<?=$resSettings['titleColor']?>" /></td>
					<td class="left"><input type="text" name="linkColor" class="fullwidth colorPicker" placeholder="Link color" value="<?=$resSettings['linkColor']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn" style="float:right;"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="5">Header settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>Header background</strong></td>
					<td class="left" width="240"><strong>Header bottom border</strong></td>
					<td class="left" width="240"><strong>Center logo</strong></td>
					<td class="left" width="240"><strong>Fixed</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="headerBackground" class="fullwidth colorPicker" placeholder="Achtergrondkleur header" value="<?=$resSettings['headerBackground']?>" /></td>
					<td class="left"><input type="text" name="headerBorder" class="fullwidth colorPicker" placeholder="Border van 1px onderaan" value="<?=$resSettings['headerBorder']?>" /></td>
					<td class="left"><input type="checkbox" name="centerLogo" class="fullwidth" value="1" <?=$resSettings['centerLogo'] ? 'checked' : '' ?>/></td>
					<td class="left"><input type="checkbox" name="headerFixed" class="fullwidth" value="1" <?=$resSettings['headerFixed'] ? 'checked' : '' ?>/></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn" style="float:right;"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="10">Menu settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>Menu background</strong></td>
					<td class="left" width="240"><strong>Menu color</strong></td>
					<td class="left" width="240"><strong>Menu hover color</strong></td>
					<td class="left" width="240"><strong>Menu padding</strong> <i>- only for fullwidth menu</i></td>
					<td class="left" width="240"><strong>Menu borders</strong></td>
					<td class="left" width="240"><strong>Menu fullwidth</strong></td>
					<td class="left" width="240"><strong>Menu hoofdletters</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="menuBackground" class="fullwidth colorPicker" placeholder="menuBackground" value="<?=$resSettings['menuBackground']?>" /></td>
					<td class="left"><input type="text" name="menuColor" class="fullwidth colorPicker" placeholder="menuColor" value="<?=$resSettings['menuColor']?>" /></td>
					<td class="left"><input type="text" name="menuHoverColor" class="fullwidth colorPicker" placeholder="menuHoverColor" value="<?=$resSettings['menuHoverColor']?>" /></td>
					<td class="left"><input type="text" name="menuItemPadding" class="fullwidth" placeholder="menuItemPadding" value="<?=$resSettings['menuItemPadding']?>" /></td>
					<td class="left"><input type="text" name="menuBorders" class="fullwidth colorPicker" placeholder="Borders rondom menuItems" value="<?=$resSettings['menuBorders']?>" /></td>
					<td class="left"><input type="checkbox" name="menuFullWidth" class="fullwidth" value="1" <?=$resSettings['menuFullWidth'] ? 'checked' : '' ?>/></td>
					<td class="left"><input type="checkbox" name="menuCapitals" class="fullwidth" value="1" <?=$resSettings['menuCapitals'] ? 'checked' : '' ?>/></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn" style="float:right;"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="4">Container settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>siteWidth</strong></td>
					<td class="left" width="240"><strong>siteBackground</strong></td>
					<td class="left" width="240"><strong>siteLineheight</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="siteWidth" class="fullwidth" placeholder="siteWidth" value="<?=$resSettings['siteWidth']?>" /></td>
					<td class="left"><input type="text" name="siteBackground" class="fullwidth colorPicker" placeholder="siteBackground" value="<?=$resSettings['siteBackground']?>" /></td>
					<td class="left"><input type="text" name="siteLineheight" class="fullwidth" placeholder="siteLineheight" value="<?=$resSettings['siteLineheight']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn" style="float:right;"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="7">Font heading settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>h1size</strong></td>
					<td class="left" width="240"><strong>h1weight</strong></td>
					<td class="left" width="240"><strong>h2size</strong></td>
					<td class="left" width="240"><strong>h2weight</strong></td>
					<td class="left" width="240"><strong>h3size</strong></td>
					<td class="left" width="240"><strong>h3weight</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="h1size" class="fullwidth" placeholder="h1size" value="<?=$resSettings['h1size']?>" /></td>
					<td class="left"><input type="text" name="h1weight" class="fullwidth" placeholder="h1weight" value="<?=$resSettings['h1weight']?>" /></td>
					<td class="left"><input type="text" name="h2size" class="fullwidth" placeholder="h2size" value="<?=$resSettings['h2size']?>" /></td>
					<td class="left"><input type="text" name="h2weight" class="fullwidth" placeholder="h2weight" value="<?=$resSettings['h2weight']?>" /></td>
					<td class="left"><input type="text" name="h3size" class="fullwidth" placeholder="h3size" value="<?=$resSettings['h3size']?>" /></td>
					<td class="left"><input type="text" name="h3weight" class="fullwidth" placeholder="h3weight" value="<?=$resSettings['h3weight']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn" style="float:right;"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="3">Text block settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>Background</strong></td>
					<td class="left" width="240"><strong>Tekst kleur</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="textBlockBackground" class="fullwidth colorPicker" placeholder="textBlockBackground" value="<?=$resSettings['textBlockBackground']?>" /></td>
					<td class="left"><input type="text" name="textBlockColor" class="fullwidth colorPicker" placeholder="textBlockColor, laat leeg voor default" value="<?=$resSettings['textBlockColor']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn" style="float:right;"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
		
		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="4">Footer settings</td></tr>
				<tr>
					<td class="left" width="240"><strong>Background</strong></td>
					<td class="left" width="240"><strong>Tekst kleur</strong></td>
					<td class="left" width="240"><strong>Top border kleur</strong></td>
					<td class="left" width="240"><strong>Actie</strong></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left"><input type="text" name="footerBackground" class="fullwidth colorPicker" placeholder="footerBackground" value="<?=$resSettings['footerBackground']?>" /></td>
					<td class="left"><input type="text" name="footerColor" class="fullwidth colorPicker" placeholder="footerColor, laat leeg voor default" value="<?=$resSettings['footerColor']?>" /></td>
					<td class="left"><input type="text" name="footerBorder" class="fullwidth colorPicker" placeholder="Footer van 1px bovenaan" value="<?=$resSettings['footerBorder']?>" /></td>
					<td class="left"><a onclick="$('#form').attr('action', 'index.php?action=settings_style&route=save'); $('#form').submit();" class="green_btn" style="float:right;"><span>Opslaan</span></a></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>