<?php 
$BID = (int)isset($_GET['id']);

if (isset($_POST['blogedit'])) 
{

        mysqli_query($res1 ,"DELETE FROM blogs_language WHERE blogID='" . $_POST['id'] . "'");
        
            foreach ($_POST['description'] as $id => $value){
				if ($value['rewrite']!=""){
				  $rewrite = $value['rewrite'];
				}else{
				  $rewrite = encodeUrlParam($value['naam']);
				}
				
				mysqli_query($res1 ,"INSERT INTO blogs_language 
									 SET naam='".escape($value['naam'])."',
									 rewrite='".escape($rewrite)."',
									 beschrijving='".escape($value['bigtext'])."',
									 introText='".escape($value['introText'])."',
									 seotitle='".escape($value['seotitle'])."',
									 seodesc='".escape($value['seodesc'])."',
									 seokey='".escape($value['seokey'])."', 
									 extraItem='".escape($value['extraitem'])."', 
									 blogID='".$_POST['id']."', 
									 language_id='".$id."'"); 
				
				$query = mysqli_query($res1 ,"UPDATE blogs 
											  SET visable='".$_POST['visable']."',
											  catID='".$_POST['Categorie']."',
											  youtube='".$_POST['youtube']."',
											  plugin='".$_POST['plugin']."',
											  datum='".date("YmdHis",strtotime($_POST["tijd"]))."',
											  modified=NOW()
											  WHERE blogID='" . $_POST['id'] . "'");
            }        
        
			if ($_FILES['image']['name']!="")
			{
				UploadImage(DIR_IMAGE,$_POST['id']);
				mysqli_query($res1 ,"UPDATE blogs SET foto_locatie='".$_FILES['image']['name']."' WHERE blogID='" . $_POST['id'] . "'");
			}
			
			$_SESSION['success'] = 'De blog is met succes gewijzigd.';
                	header('Location: index.php?action=blog');
}

if (isset($_POST['blogadd'])) {
	$query = mysqli_query($res1 ,"INSERT INTO blogs 
								  SET visable='".$_POST['visable']."',
								  youtube='".$_POST['youtube']."',
								  plugin='".$_POST['plugin']."',
								  catID='".$_POST['Categorie']."',
								  datum='".date('YmdHis',strtotime($_POST["tijd"]))."'");
	$blogid = mysqli_insert_id($res1);

	if ($_FILES['image']['name']!="")
	{	
		UploadImage(DIR_IMAGE,$blogid);
		mysqli_query($res1 ,"UPDATE blogs SET foto_locatie='".$_FILES['image']['name']."' WHERE blogID='" . $blogid . "'");
	}
	
	foreach ($_POST['description'] as $id => $value){
		if ($value['rewrite']!=""){
		  $rewrite = $value['rewrite'];
		}else{
		  $rewrite = encodeUrlParam($value['naam']);
		}
		mysqli_query($res1 ,"INSERT INTO blogs_language 
							 SET naam='".escape($value['naam'])."',
							 rewrite='".escape($rewrite)."',
							 beschrijving='".escape($value['bigtext'])."',
							 introText='".escape($value['introText'])."',
							 seotitle='".escape($value['seotitle'])."',
							 seodesc='".escape($value['seodesc'])."',
							 seokey='".escape($value['seokey'])."', 
							 extraItem='".escape($value['extraitem'])."', 
							 blogID='".$blogid."', 
							 language_id='".$id."'");	

			
		$_SESSION['success'] = 'De blog is met succes toegevoegd.';
		header('Location: index.php?action=blog');
	}	
}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					$getFileName = mysqli_query($res1,"SELECT foto_locatie FROM blogs WHERE blogID='".(int)$value."'");
					$resFileName = mysqli_fetch_assoc($getFileName);
					$fileName = DIR_IMAGE . $resFileName['foto_locatie'];

					$delete = mysqli_query($res1 ,"DELETE FROM blogs WHERE blogID='".(int)$value."'");
					$query = mysqli_query($res1 ,"DELETE FROM blogs_language WHERE blogID='".(int)$value."'");
					
					if(!empty($resFileName) && $delete){
						if(file_exists($fileName)){
							unlink($fileName);
						}
					}
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De pagina is met succes verwijderd.';
					header('Location: index.php?action=blog'); 
				}
			}
		break;	
		case "save":
			if (isset($_POST['ordering'])){
				foreach ($_POST['ordering'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE blogs SET ordering='".$value."' WHERE blogID = ".$id);
				}
			}	
			if (isset($_POST['visable'])){
				foreach ($_POST['visable'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE blogs SET visable='".$value."' WHERE blogID = ".$id);
				}
			}				
			if (isset($_POST['category'])){

				foreach ($_POST['category'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE blogs SET catID='".$value."' WHERE blogID = ".$id);
				}
			}	
			
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=blog'); 
			}
		break;
	}	
}
		
?>



<div class="heading">
<h1 style="background-image: url('images/category.png');">blog item beheer</h1>
<div class="buttons">
	<a onclick="location = 'index.php?action=blog_add&clear=true'" class="green_btn"><span>Nieuw blog item</span></a>
	<a onclick="$('#form').attr('action', 'index.php?action=blog&route=save'); $('#form').submit();" class="yellow_btn"><span>Opslaan</span></a>
	<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a></div>
</div>
<div class="content">
<form method="post" action="index.php?action=blog&route=delete" id="form">
<table class="list">
	<thead>
		<tr>
			<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			<td class="left" width="360"><strong>Naam</strong></td>
            <td class="left" width="200"><strong>Categorie</strong></td>
			<td class="left" width="200"><strong>Beschrijving</strong></td>
			<td class="left" width="200"><strong>Zichtbaar</strong></td>
			<td class="left"><strong>Volgorde&nbsp;<input type="submit" name="sorteren" value="Opslaan" style="background:url(images/save.png) no-repeat top left;width:16px;height:16px;border:0;font-size:0;" title="Sorteer"></strong></td>
			<td class="left"></td>
		</tr>
	</thead>
		<tr>
			<td colspan="11" style="background:#c0c0c0;font-weight:bold;"><b>Blogs binnen categorie&euml;n</b></td>
		</tr>
		<tbody>
		<?php
			$res = mysqli_query($res1 ,"SELECT *, 
							  bcl.naam AS catnaam, 
							  bl.naam AS naam, 
							  bl.beschrijving AS beschrijving, 
							  b.ordering AS ordering, 
							  b.visable AS visable 
							  FROM blogs b, blogs_language bl, blog_cat bc, blog_cat_language bcl 
							  WHERE b.catID = bc.catID 
							  AND b.blogID = bl.blogID 
							  AND bcl.catID = bc.catID 
							  AND bcl.language_id='2' 
							  AND bl.language_id='2' 
							  ORDER BY b.catID, b.ordering ASC");
			while ($siterow = mysqli_fetch_array($res))
			{
		?>
			<tr>
				<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $siterow['blogID']; ?>" /></td>
				<td class="left"><b><?=$siterow['naam']?></b></td>
				<td class="left"><b>
					<select name="category[<?=$siterow['blogID']?>]">
						<?php 
							$getCatItems = mysqli_query($res1 ,"SELECT naam, catID
																			  FROM blog_cat_language ");
							while($resCatItems = mysqli_fetch_assoc($getCatItems)){
									if($resCatItems['catID']==$siterow['catID']){ $selected = " selected"; }else{ $selected=""; }
								 echo '<option'.$selected.' value="'.$resCatItems['catID'].'">'.$resCatItems['naam'].'</option>';
							}
						?>						
					</select>
				</b></td>
				<td class="left"><?=substr(strip_tags($siterow['beschrijving']),0,20)?></td>
				<td class="left">
					<select name="visable[<?=$siterow['blogID']?>]">
						<option value="0" <?=($siterow['visable']==0) ? 'selected' : ''?>>Onzichtbaar</option>
						<option value="1" <?=($siterow['visable']==0) ? '' : 'selected'?>>Zichtbaar</option>
					</select>
				</td>
				<td class="left"><input type="text" name="ordering[<?=$siterow['blogID']?>]" value="<?=$siterow['ordering']?>" size="5"></td>
				<td class="right"><a class="gray_btn" href='index.php?action=blog_edit&clear=true&id=<?=$siterow['blogID']?>'>Wijzig</a></td>
			</tr>
		<?php
			}
		?>
		<tr>
			<td colspan="11" style="background:#c0c0c0;font-weight:bold;"><b>Blogs zonder categorie</b></td>
		</tr>
		<tbody>
		<?php
			$res = mysqli_query( $res1, "SELECT * 
							  FROM blogs b
							  LEFT JOIN blogs_language ON b.blogID = blogs_language.blogID
							  WHERE b.catID = 0 
							  ORDER BY b.ordering ASC");
			while ($siterow = mysqli_fetch_assoc($res))
			{
		?>
			<tr>
				<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $siterow['blogID']; ?>" /></td>
				<td class="left"><b><?=$siterow['naam']?></b></td>
				<td class="left"><b>
					<select name="category[<?=$siterow['blogID']?>]">
						<option value="0" selected>Geen blog</option>
						<?php 
							$getCatItems = mysqli_query($res1, "SELECT naam, catID
																			  FROM blog_cat_language ");
							while($resCatItems = mysqli_fetch_assoc($getCatItems)){
									if($resCatItems['catID']==$siterow['catID']){ $selected = " selected"; }else{ $selected=""; }
								 echo '<option'.$selected.' value="'.$resCatItems['catID'].'">'.$resCatItems['naam'].'</option>';
							}
						?>						
					</select>
				</b></td>
				<td class="left"><?=substr(strip_tags($siterow['beschrijving']),0,20)?></td>
				<td class="left">
					<select name="visable[<?=$siterow['blogID']?>]">
						<option value="0" <?=($siterow['visable']==0) ? 'selected' : ''?>>Onzichtbaar</option>
						<option value="1" <?=($siterow['visable']==0) ? '' : 'selected'?>>Zichtbaar</option>
					</select>
				</td>
				<td class="left"><input type="text" name="ordering[<?=$siterow['blogID']?>]" value="<?=$siterow['ordering']?>" size="5"></td>
				<td class="right"><a class="gray_btn" href='index.php?action=blog_edit&clear=true&id=<?=$siterow['blogID']?>'>Wijzig</a></td>
			</tr>
		<?php
			}
		?>
	</table>
</form>
</div>
