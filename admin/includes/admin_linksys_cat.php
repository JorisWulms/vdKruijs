<?php 
$id = (int)isset($_GET['id']);

if (isset($_POST['linksys_cat_edit']))
{
    $id = (int)$_POST['id'];
    
	if ($_POST['rewrite']!=""){
	  $rewrite = $_POST['rewrite'];
	}else{
	  $rewrite = encodeUrlParam($_POST['title']);
	}

	mysqli_query($res1,"UPDATE linksys_cat
					    SET title ='".escape($_POST['title'])."', 
					    rewrite ='".escape($rewrite)."',
					    description ='".escape($_POST['description'])."',
					    seotitle ='".escape($_POST['seotitle'])."',
					    seodesc ='".escape($_POST['seodesc'])."',
					    seokey ='".escape($_POST['seokey'])."',
					    volgorde ='".escape($_POST['volgorde'])."',
					    navigatie ='".escape($_POST['navigatie'])."'
						WHERE id = ".$id);
	
	// Start navigation save
	mysqli_query($res1 ,"UPDATE navigation 
						SET title='".realescape($_POST['title'])."',
						rewrite='".$rewrite."', 
						navigationID='".$_POST['navigatie']."' 
						WHERE linksysCatID='" . $_POST['id'] . "'");
	// End navigation save	
	
	if ($_FILES['image']['name']!="")
	{
		UploadImageLinksys(DIR_IMAGE,$_POST['id']);
		mysqli_query($res1 ,"UPDATE linksys_cat SET imagelocation='".$_FILES['image']['name']."' WHERE id='" . $_POST['id'] . "'");
	}
	
    $_SESSION['success'] = 'De categorie is met succes gewijzigd.';
    header('Location: index.php?action=linksys_cat');
}

if (isset($_POST['linksys_cat_add']))
{
	
	if ($_POST['rewrite']!=""){
	  $rewrite = $_POST['rewrite'];
	}else{
	  $rewrite = encodeUrlParam($_POST['title']);
	}
	mysqli_query($res1,"INSERT INTO linksys_cat
					    SET title ='".escape($_POST['title'])."', 
					    rewrite ='".escape($rewrite)."',
					    description ='".escape($_POST['description'])."',
					    seotitle ='".escape($_POST['seotitle'])."',
					    seodesc ='".escape($_POST['seodesc'])."',
					    seokey ='".escape($_POST['seokey'])."',
					    volgorde ='".escape($_POST['volgorde'])."',
					    navigatie ='".escape($_POST['navigatie'])."'
					   ");
	
	$catid = mysqli_insert_id($res1);			   
	// Save to the navigation table	
	mysqli_query($res1 ,"INSERT INTO navigation 
						SET title='".realescape($_POST['title'])."',
						rewrite='".$rewrite."', 
						navigationID='".$_POST['navigatie']."', 
						linksysCatID='" . $catid . "'");
						
	// End navigation save

	if ($_FILES['image']['name']!="")
	{	
		UploadImageLinksys(DIR_IMAGE,$catid);
		mysqli_query($res1 ,"UPDATE linksys_cat SET imagelocation='".$_FILES['image']['name']."' WHERE id='" . $catid . "'");
	}
    
    $_SESSION['success'] = 'De categorie is met succes toegevoegd.';
    header('Location: index.php?action=linksys_cat');
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
                    mysqli_query($res1, "DELETE FROM linksys_cat WHERE id='" . (int)$value . "'");
                    mysqli_query($res1, "DELETE FROM navigation WHERE linksysCatID='" . (int)$value . "'");
                    mysqli_query($res1, "UPDATE linksys_link SET category = 0 WHERE category='" . (int)$value . "'");
                }

                if (count($query != 0))
                {
                    $_SESSION['success'] = 'De categorie is met succes verwijderd.';
                    header('Location: index.php?action=linksys_cat');
                }
            }
            break;
			
			case "save":
			if (isset($_POST['volgorde'])){
				foreach ($_POST['volgorde'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE linksys_cat SET volgorde='".$value."' WHERE id = ".$id);
				}
			}	

			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=linksys_cat'); 
			}
		break;
    }
}

?>


<div class="heading">
	<h1 style="background-image: url('images/category.png');">Link categorie beheer</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=linksys_cat_add&clear=true'" class="green_btn"><span>Nieuwe categorie</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=linksys_cat&route=save'); $('#form').submit();" class="yellow_btn"><span>Opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a>
	</div>
</div>
<div class="content" id="newInputs">
	<form method="post" action="index.php?action=linksys_cat&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="360"><strong>Titel</strong></td>
					<td class="left" width="240"><strong>Rewrite</strong></td>
					<td class="left"><strong>Aantal links</strong></td>
					<td class="left"><strong>Volgorde</strong></td>
					<td class="left">Actie</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$res = mysqli_query($res1 ,"SELECT * FROM linksys_cat ORDER BY volgorde");
				if($res){
					while ($siterow = mysqli_fetch_assoc($res))
					{
						$getAllLinks = mysqli_query($res1 ,"SELECT category FROM linksys_link WHERE category = ".$siterow['id']."");
						$amtLinks = mysqli_num_rows($getAllLinks);
					?>
					<tr>
						<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $siterow['id']; ?>" /></td>
						<td class="left"><b><?=$siterow['title']?></b></td>
						<td class="left"><b><?=$siterow['rewrite']?></b></td>
						<td class="left"><?=$amtLinks?></td>
						<td class="left"><input type="text" name="volgorde[<?=$siterow['id']?>]" value="<?=$siterow['id']?>" size="5"></td>
						<td class="right"><a class="gray_btn" href='index.php?action=linksys_cat_edit&clear=true&id=<?=$siterow['id']?>'>Wijzig</a></td>
					</tr>
					<?php
					}
				}
				?>
			</tbody>
		</table>
	</form>
</div>