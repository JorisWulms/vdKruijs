<?php 
$id = (int)isset($_GET['id']);

if (isset($_POST['linksys_link_edit']))
{
    $id = (int)$_POST['id'];
    
	if ($_POST['rewrite']!=""){
	  $rewrite = $_POST['rewrite'];
	}else{
	  $rewrite = encodeUrlParam($_POST['title']);
	}

	mysqli_query($res1,"UPDATE linksys_link
					    SET title ='".escape($_POST['title'])."', 
					    rewrite ='".escape($rewrite)."',
					    url ='".escape($_POST['url'])."',
					    longdesc ='".escape($_POST['longdesc'])."',
					    shortdesc ='".escape($_POST['shortdesc'])."',
					    place ='".escape($_POST['place'])."',
					    province ='".escape($_POST['province'])."',
					    category ='".escape($_POST['category'])."',
					    searchwords ='".escape($_POST['searchwords'])."',
					    contact ='".escape($_POST['contact'])."',
					    email ='".escape($_POST['email'])."',
					    returnlink ='".escape($_POST['returnlink'])."',
					    ownsite ='".isset($_POST['ownsite'])."',
					    tip ='".isset($_POST['tip'])."'
						WHERE id = ".$id);
	
    $_SESSION['success'] = 'De categorie is met succes gewijzigd.';
    header('Location: index.php?action=linksys_link');
}

if (isset($_POST['linksys_link_add']))
{
	if ($_POST['rewrite']!=""){
		$rewrite = $_POST['rewrite'];
	}else{
		$rewrite = encodeUrlParam($_POST['title']);
	}
	mysqli_query($res1,"INSERT INTO linksys_link
					    SET title ='".escape($_POST['title'])."', 
					    rewrite ='".escape($rewrite)."',
					    url ='".escape($_POST['url'])."',
					    longdesc ='".escape($_POST['longdesc'])."',
					    shortdesc ='".escape($_POST['shortdesc'])."',
					    place ='".escape($_POST['place'])."',
					    province ='".escape($_POST['province'])."',
					    category ='".escape($_POST['category'])."',
					    searchwords ='".escape($_POST['searchwords'])."',
					    contact ='".escape($_POST['contact'])."',
					    email ='".escape($_POST['email'])."',
					    returnlink ='".escape($_POST['returnlink'])."',
					    ownsite ='".isset($_POST['ownsite'])."',
					    tip ='".isset($_POST['tip'])."'
					   ");
 
    
    $_SESSION['success'] = 'De categorie is met succes toegevoegd.';
    header('Location: index.php?action=linksys_link');
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
                    mysqli_query($res1, "DELETE FROM linksys_link WHERE id='" . (int)$value . "'");
                    mysqli_query($res1, "UPDATE linksys_link SET category = 0 WHERE category='" . (int)$value . "'");
                }

                if (count($query != 0))
                {
                    $_SESSION['success'] = 'De categorie is met succes verwijderd.';
                    header('Location: index.php?action=linksys_link');
                }
            }
            break;
			
			case "save":
			if (isset($_POST['volgorde'])){
				foreach ($_POST['volgorde'] as $id => $value){
					$query = mysqli_query($res1 ,"UPDATE linksys_link SET volgorde='".$value."' WHERE id = ".$id);
				}
			}	

			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=linksys_link'); 
			}
		break;
    }
}

?>


<div class="heading">
	<h1 style="background-image: url('images/category.png');">Links beheer</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=linksys_link_add&clear=true'" class="green_btn"><span>Nieuwe link</span></a>
		<a onclick="$('#form').attr('action', 'index.php?action=linksys_link&route=save'); $('#form').submit();" class="yellow_btn"><span>Opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a>
	</div>
</div>
<div class="content" id="newInputs">
	<form method="post" action="index.php?action=linksys_link&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left" width="360"><strong>Titel</strong></td>
					<td class="left" width="240"><strong>URL</strong></td>
					<td class="left"><strong>Categorie</strong></td>
					<td class="left"><strong>Contactpersoon</strong></td>
					<td class="left"><strong>Eigen site?</strong></td>
					<td class="left"><strong>Tip?</strong></td>
					<td class="left">Actie</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$res = mysqli_query($res1 ,"SELECT * FROM linksys_link");
				if($res){
					while ($siterow = mysqli_fetch_assoc($res))
					{
					$getCats = mysqli_query($res1,"SELECT id, title FROM linksys_cat WHERE id ='".$siterow['category']."'");
					$resCats = mysqli_fetch_assoc($getCats);
					?>
					<tr>
						<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $siterow['id']; ?>" /></td>
						<td class="left"><b><?=$siterow['title']?></b></td>
						<td class="left"><b><?=$siterow['url']?></b></td>
						<td class="left"><b><?=$resCats['title']?></b></td>
						<td class="left"><b><?=$siterow['contact']?></b></td>
						<td class="left"><b><?=$siterow['ownsite'] ? 'Ja' : 'Nee'?></b></td>
						<td class="left"><b><?=$siterow['tip'] ? 'Ja' : 'Nee'?></b></td>
						<td class="right"><a class="gray_btn" href='index.php?action=linksys_link_edit&clear=true&id=<?=$siterow['id']?>'>Wijzig</a></td>
					</tr>
					<?php
					}
				}
				?>
			</tbody>
		</table>
	</form>
</div>