<?php
require_once("imageclass.php");
$id = isset($_GET['id']);

if (isset($_POST['edittree'])) {

	$query = mysqli_query($res1 ,"UPDATE sitetree 
								  SET parent='" . $_POST['parent'] . "',
								  exttemp='" . $_POST['plugin'] . "',
								  navigatie='".$_POST['navigatie']."',
								  visible='".$_POST['visible']."',
								  leesmeer='".$_POST['leesmeer']."',
								  leesmeerAantal='".$_POST['leesmeerAantal']."' 
								  WHERE id='" . $_POST['id'] . "'");

	foreach ($_POST['description']	as $id => $value){
		mysqli_query($res1, "DELETE FROM sitetree_language
							 WHERE id='".$_POST['id']."' 
							 AND language_id='".$id."'");
		
		if ($value['rewrite']!=""){
			$rewrite = encodeUrlParam($value['rewrite']);
		}else{
			$rewrite = encodeUrlParam($value['title']);
		}
		mysqli_query($res1 ,"INSERT INTO sitetree_language
							 SET title='".escape($value['title'])."',
							 rewrite='".escape($rewrite)."',
							 introText='".escape($value['introText'])."',
							 bigtext='".escape($value['bigtext'])."',
							 seotitle='".escape($value['seotitle'])."',
							 seodesc='".escape($value['seodesc'])."',
							 seokey='".escape($value['seokey'])."',
							 lpintro='".escape($value['lpintro'])."',
							 id='".$_POST['id']."',
							 language_id='".$id."'");
	}

	// Save to the navigation table	
	if ($_POST['description']['2']['rewrite']!=""){
		$rewrite = encodeUrlParam($_POST['description']['2']['rewrite']);
	}else{
		$rewrite = encodeUrlParam($_POST['description']['2']['title']);
	}
	mysqli_query($res1 ,"UPDATE navigation 
						SET title='".realescape($_POST['description']['2']['title'])."',
						rewrite='".$rewrite."', 
						navigationID='".$_POST['navigatie']."' 
						WHERE sitetreeID='" . $_POST['id'] . "'");
	// End navigation save
		
	if ($query == true) {
		$_SESSION['success'] = 'De pagina is met succes gewijzigd.';
		header('Location: index.php?action=sitetree'); 
	}
}

if (isset($_POST['addtree'])) {
	
	$query = mysqli_query($res1 ,"INSERT INTO sitetree 
								  SET parent='" . $_POST['parent'] . "',
								  exttemp='" . $_POST['plugin'] . "',
								  navigatie='". $_POST['navigatie']."',
								  visible='". $_POST['visible']."',
								  leesmeer='". $_POST['leesmeer']."',
								  leesmeerAantal='". $_POST['leesmeerAantal']."'");
	$treeid = mysqli_insert_id($res1);
	
	foreach ($_POST['description']	as $id => $value){
		if ($value['rewrite']!=""){
			$rewrite=encodeUrlParam($value['rewrite']);
		}else{
			$rewrite=encodeUrlParam($value['title']);
		}
		
		mysqli_query($res1 ,"INSERT INTO sitetree_language 
							 SET title='".escape($value['title'])."',
							 rewrite='".escape($rewrite)."',
							 introText='".escape($value['introText'])."',
							 bigtext='".escape($value['bigtext'])."',
							 seotitle='".escape($value['seotitle'])."',
							 seodesc='".escape($value['seodesc'])."',
							 seokey='".escape($value['seokey'])."',
							 lpintro='".escape($value['lpintro'])."',
							 id='".(int)$treeid."', 
							 language_id='".(int)$id."'");
	}
	
	// Save to the navigation table	
	if ($_POST['description']['2']['rewrite']!=""){
		$rewrite = encodeUrlParam($_POST['description']['2']['rewrite']);
	}else{
		$rewrite = encodeUrlParam($_POST['description']['2']['title']);
	}
	mysqli_query($res1 ,"INSERT INTO navigation 
						SET title='".realescape($_POST['description']['2']['title'])."',
						rewrite='".$rewrite."', 
						navigationID='".$_POST['navigatie']."',
						sitetreeID='" . (int)$treeid . "'");
	// End navigation save
	
	if ($query == true) {
  		$_SESSION['success'] = 'De pagina is met succes toegevoegd.';
		header('Location: index.php?action=sitetree'); 
	}
}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM sitetree WHERE id='".$value."'");
					mysqli_query($res1 ,"DELETE FROM navigation WHERE sitetreeID='".$value."'");
					$query = mysqli_query($res1 ,"DELETE FROM sitetree_language WHERE id='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De pagina is met succes verwijderd.';
					header('Location: index.php?action=sitetree'); 
				}
			}
		break;	
		case "save":
			if (isset($_POST['ordering'])){
				foreach ($_POST['ordering'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE sitetree SET ordering='".$value."' WHERE id = ".$id);
				}
			}	
			
			if (isset($_POST['visible'])){
				foreach ($_POST['visible'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE sitetree SET visible='".$value."' WHERE id = ".$id);
				}
			}	
			
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=sitetree'); 
			}
		break;
	}	
}

$navigatie = array(
	'0' => 'Geen',
	'1' => 'Footer',
	'2' => 'Landingspage',
	'3' => 'Hoofdmenu',
	'4' => 'Topmenu'
);

?>

<div class="buttonsScroll">
	<div style="float:right;">
		<a onclick="location = 'index.php?action=sitetree_add&clear=true'" class="green_btn"><span>Nieuwe pagina aanmaken</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=sitetree&route=save'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder selectie</span></a>
	</div>
</div>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Paginabeheer</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=sitetree_add&clear=true'" class="green_btn"><span>Nieuwe pagina aanmaken</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=sitetree&route=save'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder selectie</span></a>
	</div>
</div>

<div class="content">
	<div class="backendNote">
		<span class="showMoreInfo">Click me for info</span>
		<div class="moreInfo" style="display:none;">
			<span class="title">Landingspages</span>
			<p>
				Een landingspage kan op 2 manieren aangemaakt worden.<br/><br/>
				<b>1. Een los staande landingspage.</b><br/>
				Dit is een losstaande pagina die nergens onder hangt. Deze heeft enkel de navigatie "landingspage". Deze worden zichtbaar op pagina's waar geen specifieke landingspages onder hangen.
				<br/><br/>
				<b>2. Een landingspage welke onder een andere pagina valt.</b><br/>
				Deze pagina dien je "onder een bestaande pagina te hangen". Wanneer men dan op de bestaande pagina komt, dan zal op deze pagina een link zichtbaar zijn naar de landingspage. Geef de landingspage wel de navigatie "landingspage".
			</p>
			<span class="title">Notes</span>
			<p>
				<b>1. Let op: </b><br/>
				Als een pagina op "onzichtbaar" staat, dan wordt deze niet ge&iuml;dexeert en is deze niet te bereiken.
			</p>
		</div>
	</div>
	<form method="post" action="index.php?action=sitetree&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="360"><strong>Titel</strong></td>
					<td class="left notMobile" width="240"><strong>Seotitel</strong></td>
					<td class="left"><strong>Navigatie</strong></td>
					<td class="left"><strong>Zichtbaar</strong></td>
					<td class="left"><strong>Volgorde</strong></td>

					<td class="left"><strong>SEO link</strong></td>
					<td class="left notMobile"><strong>Plugin</strong></td>
					<td class="right"><strong>Actie</strong></td>
				</tr>
			</thead>
			<?php
				foreach($navigatie as $key => $id){
					$getNavItems = mysqli_query($res1 ,"SELECT *, sitetree.id AS id 
														FROM sitetree 
														LEFT OUTER JOIN sitetree_language 
														ON sitetree_language.id=sitetree.id 
														LEFT JOIN navigation 
														ON navigation.sitetreeID = sitetree.id
														WHERE sitetree.parent=0 
														AND sitetree_language.language_id=2 
														AND sitetree.navigatie=".$key."
														ORDER BY navigation.ordering ASC");
					echo '<tr>
							 <td colspan="10" style="background:#efefef;font-weight:bold;padding: 10px 2%;width:96%;color:#444;margin:10px 0 0 0;"><b>'.$id.'</b></td>
						  </tr>';
					while($resNavItems = mysqli_fetch_assoc($getNavItems)){
						$getCorrectPlugin = mysqli_query($res1, "SELECT * FROM plugin WHERE id = '".$resNavItems['exttemp']."'");
						$resCorrectPlugin = mysqli_fetch_assoc($getCorrectPlugin);
						// Main items
						echo '<tr>
								<td style="text-align: center;"><input type="checkbox" name="selected[]" value="'.$resNavItems['id'].'" /></td>
								<td class="left"><b>'.$resNavItems['title'].'</b></td>
								<td class="left notMobile">'.$resNavItems['seotitle'].'</td>
								<td class="left">
									<select name="navigatie['.$resNavItems['id'].']">';
										foreach ($navigatie as $id => $value){
											echo '<option value="'.$id.'"';
												if ($resNavItems['navigatie']==$id){
												echo ' selected="selected"';
												}
											echo '>'.$value.'</option>';
										}
								echo '</select>
								</td>
								<td class="left">
									<select name="visible['.$resNavItems['id'].']">
										<option value="0" '.($resNavItems['visible']==0 ? 'selected' : '').'>Onzichtbaar</option>
										<option value="1" '.($resNavItems['visible']==0 ? '' : 'selected').'>Zichtbaar</option>
									</select>
								</td>
								<td class="left">&nbsp;</td>
								<td class="left">'.$resNavItems['rewrite'].'</td>
								<td class="left notMobile">'.$resCorrectPlugin['naam'].'</td>
								<td class="right"><a class="gray_btn" href="index.php?action=sitetree_edit&clear=true&id='.$resNavItems['id'].'">Wijzig</a></td>
							</tr>';
						
						// Child items
						$getChildNav = mysqli_query($res1 ,"SELECT * 
															FROM sitetree 
															LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id 
															WHERE sitetree.parent=".$resNavItems['id']." 
															AND sitetree_language.language_id=2 
															ORDER BY sitetree.id ASC");
						
						if($getChildNav){
							while($resChildNav = mysqli_fetch_assoc($getChildNav)){
								$getCorrectPlugin = mysqli_query($res1, "SELECT * FROM plugin WHERE id = '".$resChildNav['exttemp']."'");
								$resCorrectPlugin = mysqli_fetch_assoc($getCorrectPlugin);
								echo '<tr>
										<td style="text-align: center;"><input type="checkbox" name="selected[]" value="'.$resChildNav['id'].'" /></td>
										<td class="left"><b style="padding-left:10px;">---> '.$resChildNav['title'].'</b></td>
										<td class="left notMobile">'.$resChildNav['seotitle'].'</td>
										<td class="left">
											<select name="navigatie['.$resChildNav['id'].']">';
												foreach ($navigatie as $id => $value){
													echo '<option value="'.$id.'"';
														if ($resChildNav['navigatie']==$id){
														echo ' selected="selected"';
														}
													echo '>'.$value.'</option>';
												}
										echo '</select>
										</td>
										<td class="left">
											<select name="visible['.$resChildNav['id'].']">
												<option value="0" '.($resChildNav['visible']==0 ? 'selected' : '').'>Onzichtbaar</option>
												<option value="1" '.($resChildNav['visible']==0 ? '' : 'selected').'>Zichtbaar</option>
											</select>
										</td>
										<td class="left"><input type="text" name="ordering['.$resChildNav['id'].']" value="'.$resChildNav['ordering'].'"></td>
										<td class="left">'.$resChildNav['rewrite'].'</td>
										<td class="left notMobile">'.$resCorrectPlugin['naam'].'</td>
										<td class="right"><a class="gray_btn" href="index.php?action=sitetree_edit&clear=true&id='.$resChildNav['id'].'">Wijzig</a></td>
									</tr>';
									
								// Sub child items
								$getSubChildNav = mysqli_query($res1 ,"SELECT * 
																	FROM sitetree 
																	LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id 
																	WHERE sitetree.parent=".$resChildNav['id']." 
																	AND sitetree_language.language_id=2 
																	ORDER BY sitetree.id ASC");
								if($getSubChildNav){
									while($resSubChildNav = mysqli_fetch_assoc($getSubChildNav)){
										$getCorrectPlugin = mysqli_query($res1, "SELECT * FROM plugin WHERE id = '".$resSubChildNav['exttemp']."'");
										$resCorrectPlugin = mysqli_fetch_assoc($getCorrectPlugin);
										echo '<tr>
												<td style="text-align: center;"><input type="checkbox" name="selected[]" value="'.$resSubChildNav['id'].'" /></td>
												<td class="left"><b style="padding-left:30px;">---> '.$resSubChildNav['title'].'</b></td>
												<td class="left notMobile">'.$resSubChildNav['seotitle'].'</td>
												<td class="left">
													<select name="navigatie['.$resSubChildNav['id'].']">';
														foreach ($navigatie as $id => $value){
															echo '<option value="'.$id.'"';
																if ($resSubChildNav['navigatie']==$id){
																echo ' selected="selected"';
																}
															echo '>'.$value.'</option>';
														}
												echo '</select>
												</td>
												<td class="left">
													<select name="visible['.$resSubChildNav['id'].']">
														<option value="0" '.($resSubChildNav['visible']==0 ? 'selected' : '').'>Onzichtbaar</option>
														<option value="1" '.($resSubChildNav['visible']==0 ? '' : 'selected').'>Zichtbaar</option>
													</select>
												</td>
												<td class="left"><input type="text" name="ordering['.$resSubChildNav['id'].']" value="'.$resSubChildNav['ordering'].'"></td>
												<td class="left">'.$resSubChildNav['rewrite'].'</td>
												<td class="left notMobile">'.$resCorrectPlugin['naam'].'</td>
												<td class="right"><a class="gray_btn" href="index.php?action=sitetree_edit&clear=true&id='.$resSubChildNav['id'].'">Wijzig</a></td>
											</tr>';
									}
								}
							}
						}
					}
				}
			?>
		</table>
	</form>
</div>