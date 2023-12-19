<?php 

$id = (int)isset($_GET['id']);

if (isset($_POST['blogcatedit']))
{
    $id = (int)$_POST['id'];
    $query = mysqli_query($res1 ,"UPDATE blog_cat 
								  SET visable='".$_POST['visable']."',
								  ordering='".$_POST['order']."',
								  leesmeer='".$_POST['leesmeer']."',
								  leesmeerAantal='".$_POST['leesmeerAantal']."', 
								  navigatie='".$_POST['navigatie']."' 
								  WHERE catID='" . $_POST['id'] . "'");
		
	// Save to the navigation table	
	if ($_POST['description']['2']['rewrite']!=""){
		$rewrite = $_POST['description']['2']['rewrite'];
	}else{
		$rewrite = encodeUrlParam($_POST['description']['2']['naam']);
	}
	mysqli_query($res1 ,"UPDATE navigation 
						SET title='".realescape($_POST['description']['2']['naam'])."',
						rewrite='".$rewrite."', 
						navigationID='".$_POST['navigatie']."' 
						WHERE blogCatID='" . $_POST['id'] . "'");
	// End navigation save
	
    mysqli_query($res1 ,"DELETE FROM blog_cat_language WHERE catID='".$_POST['id']."'");
	foreach ($_POST['description']	as $id => $value){
		if ($value['rewrite']!=""){
			$rewrite = $value['rewrite'];
		}else{
			$rewrite = encodeUrlParam($value['naam']);
		}
		mysqli_query($res1 ,"INSERT INTO blog_cat_language 
							 SET naam='".realescape($value['naam'])."',
							 rewrite='".realescape($rewrite)."',
							 introText='".realescape($value['introText'])."',
							 beschrijving='".realescape($value['bigtext'])."',
							 extraItem='".realescape($value['extraitem'])."',
							 seotitle='".realescape($value['seotitle'])."',
							 seodesc='".realescape($value['seodesc'])."',
							 seokey='".realescape($value['seokey'])."', 
							 catID='".$_POST['id']."',
							 language_id='".$id."'");
	}    
	
	if ($_FILES['image']['name']!="")
	{
		UploadImage(DIR_IMAGE,$_POST['id']);
		mysqli_query($res1 ,"UPDATE blog_cat SET foto_locatie='".$_FILES['image']['name']."' WHERE catID='" . $_POST['id'] . "'");
	}
	
    $_SESSION['success'] = 'De categorie is met succes gewijzigd.';
    header('Location: index.php?action=blogcat');
}

if (isset($_POST['blogcatadd']))
{
	
    $query = mysqli_query($res1 ,"INSERT INTO blog_cat 
								  SET visable='".$_POST['visable']."',
								  ordering='".$_POST['order']."',
								  navigatie='".$_POST['navigatie']."', 
								  leesmeer='".$_POST['leesmeer']."',
								  leesmeerAantal='".$_POST['leesmeerAantal']."'");
    $catid = mysqli_insert_id($res1);
	
	if ($_FILES['image']['name']!="")
	{	
		UploadImage(DIR_IMAGE,$catid);
		mysqli_query($res1 ,"UPDATE blog_cat SET foto_locatie='".$_FILES['image']['name']."' WHERE catID='" . $catid . "'");
	}
	
	// Save to the navigation table	
	if ($_POST['description']['2']['rewrite']!=""){
		$rewrite = $_POST['description']['2']['rewrite'];
	}else{
		$rewrite = encodeUrlParam($_POST['description']['2']['naam']);
	}
	mysqli_query($res1 ,"INSERT INTO navigation 
						SET title='".realescape($_POST['description']['2']['naam'])."',
						rewrite='".$rewrite."', 
						navigationID='".$_POST['navigatie']."', 
						blogCatID='" . $catid . "'");
	// End navigation save

	foreach ($_POST['description']	as $id => $value){
		if ($value['naam']!=""){
			if ($value['rewrite']!=""){
				$rewrite = $value['rewrite'];
			}else{
				$rewrite = encodeUrlParam($value['naam']);
			}

			mysqli_query($res1 ,"INSERT INTO blog_cat_language 
								 SET naam='".realescape($value['naam'])."',
								 rewrite='".realescape($rewrite)."',
								 introText='".realescape($value['introText'])."',
								 beschrijving='".realescape($value['bigtext'])."',
								 extraItem='".realescape($value['extraitem'])."',
								 seotitle='".realescape($value['seotitle'])."',
								 seodesc='".realescape($value['seodesc'])."',
								 seokey='".realescape($value['seokey'])."', 
								 catID='".$catid."',
								 language_id='".$id."'");
		}
	}   
    
    $_SESSION['success'] = 'De categorie is met succes toegevoegd.';
    header('Location: index.php?action=blogcat');
}

if (isset($_GET['route']))
{

    switch ($_GET['route'])
    {

        case "delete":
            if (isset($_POST['selected']))
            {
                foreach ($_POST['selected'] as $key => $value)
                {
                     mysqli_query($res1, "DELETE FROM blog_cat WHERE catID='" . (int)$value . "'");
                     mysqli_query($res1, "DELETE FROM navigation WHERE blogCatID='" . (int)$value . "'");
                     mysqli_query($res1, "UPDATE blogs SET catID = 0 WHERE catID='" . (int)$value . "'");
                    $query =  mysqli_query($res1, "DELETE FROM  blog_cat_language WHERE catID='" . (int)$value . "'");
                }

                if (count($query != 0))
                {
                    $_SESSION['success'] = 'De pagina is met succes verwijderd.';
                    header('Location: index.php?action=blogcat');
                }
            }
            break;
			
			case "save":
			if (isset($_POST['ordering'])){
				foreach ($_POST['ordering'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE blog_cat SET ordering='".$value."' WHERE catID = ".$id);
				}
			}	
			if (isset($_POST['visable'])){
				foreach ($_POST['visable'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE blog_cat SET visable='".$value."' WHERE catID = ".$id);
				}
			}	
			if (isset($_POST['navigation'])){
				foreach ($_POST['navigation'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE navigation SET navigationID='".$value."' WHERE blogCatID = ".$id);
					$query = mysqli_query($res1 ,"UPDATE blog_cat SET navigatie='".$value."' WHERE catID = ".$id);
				}
			}	
			
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=blogcat'); 
			}
		break;
    }
}

$navigatie = array(
	'0' => 'Geen',
	'3' => 'Hoofdmenu',
	'2' => 'Landingspage',
	'1' => 'Footer'
);
?>


<div class="heading">
	<h1 style="background-image: url('images/category.png');">Blog categorie beheer</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=blogcat_add&clear=true'" class="green_btn"><span>Nieuwe categorie</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=blogcat&route=save'); $('#form').submit();" class="yellow_btn"><span>Opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a>
	</div>
</div>
<div class="content" id="newInputs">
	<form method="post" action="index.php?action=blogcat&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="360"><strong>Naam</strong></td>
					<td class="left" width="240"><strong>Zichtbaar</strong></td>
					<td class="left" width="240"><strong>Navigatie</strong></td>
					<td class="left"><strong>Aantal blogs</strong></td>
					<td class="left"><strong>Volgorde</strong></td>
					<td class="left"></td>
				</tr>
			</thead>
			<tbody>
			<?php
			$res = mysqli_query($res1 ,"SELECT * FROM  blog_cat bc, blog_cat_language bcl WHERE bcl.catID = bc.catID AND bcl.language_id='2' ORDER BY `ordering`");
			while ($siterow = mysqli_fetch_array($res))
			{
				$getAllBlogs = mysqli_query($res1 ,"SELECT blogID FROM blogs WHERE catID = ".$siterow['catID']."");
				$amtBlogs = mysqli_num_rows($getAllBlogs);
	?>
			<tr>
				<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $siterow['catID']; ?>" /></td>
				<td class="left"><b><?=$siterow['naam']?></b></td>
				<td class="left">
					<select style="width:100%;" name="visable[<?=$siterow['catID']?>]">
						<option value="0" <?=($siterow['visable']==0) ? 'selected' : ''?>>Onzichtbaar</option>
						<option value="1" <?=($siterow['visable']==0) ? '' : 'selected'?>>Zichtbaar</option>
					</select>
				</td>
				<td class="left">						
					<select style="width:100%;" name="navigation[<?=$siterow['catID']?>]">
					<?php 
					foreach ($navigatie as $id => $value){
						echo '<option value="'.$id.'"';
							if ($siterow['navigatie']==$id){
							echo ' selected="selected"';
							}
						echo '>'.$value.'</option>';
					}
					?>
					</select>
				</td>
				<td class="left"><?=$amtBlogs?></td>
				<td class="left"><input type="text" name="ordering[<?=$siterow['catID']?>]" value="<?=$siterow['ordering']?>" size="5"></td>
				<td class="right"><a class="gray_btn" href='index.php?action=blogcat_edit&clear=true&id=<?=$siterow['catID']?>'>Wijzig</a></td>
			</tr>
			<?php
	}
	?>
		</table>
	</form>
</div>