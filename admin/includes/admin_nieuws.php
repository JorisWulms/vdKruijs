<?php
$id = isset($_GET['id']);

if (isset($_POST['editnieuws'])) {

      $query = mysqli_query($res1 ,"UPDATE news 
									SET visible='".$_POST['visible']."',
										datum='".$_POST['datum']."',
										modified=NOW() 
										WHERE id='" . $_POST['id'] . "'");


		foreach ($_POST['description']	as $id => $value){

			if ($value['rewrite']!=""){
			  $rewrite = $value['rewrite'];
			}else{
			  $rewrite = encodeUrlParam($value['title']);
			}
			mysqli_query($res1 ,"UPDATE news_language SET title='".$value['title']."',rewrite='".$rewrite."',bigtext='".$value['bigtext']."',seotitle='".$value['seotitle']."',seodesc='".$value['seodesc']."',seokey='".$value['seokey']."' WHERE id='".$_POST['id']."' AND language_id='".$id."'");
		
		}
		
			if ($_FILES['image']['name']!="")
			{
				UploadImage(DIR_NEWSIMAGE,$_POST['id']);
				mysqli_query($res1 ,"UPDATE news SET foto_locatie='".$_FILES['image']['name']."' WHERE id='" . $_POST['id'] . "'");
			}

      if ($query == true) {
  		$_SESSION['success'] = 'Nieuwsbericht is succesvol gewijzigd.';
		header('Location: index.php?action=nieuws'); 
      }
}

if (isset($_POST['addnieuws'])) {


	$sql = "INSERT INTO news SET visible='".$_POST['visible']."',datum='".$_POST['datum']."'";
	$query = mysqli_query($res1 ,$sql);
	echo $sql;
	$nieuwsid = mysqli_insert_id($res1);


		foreach ($_POST['description']	as $id => $value){

			if ($value['rewrite']!=""){
			  $rewrite = $value['rewrite'];
			}else{
			  $rewrite = encodeUrlParam($value['title']);
			}
			
			mysqli_query($res1 ,"INSERT INTO news_language SET title='".$value['title']."',rewrite='".$rewrite."',bigtext='".$value['bigtext']."',seotitle='".$value['seotitle']."',seodesc='".$value['seodesc']."',seokey='".$value['seokey']."',id='".(int)$nieuwsid."', language_id='".(int)$id."'");
		
		}
			if ($_FILES['image']['name']!="")
				{
						UploadImage(DIR_NEWSIMAGE,$nieuwsid);
				}
      if ($query == true) {
  		$_SESSION['success'] = 'Nieuwsbericht is succesvol toegevoegd.';
		header('Location: index.php?action=nieuws'); 
      }
}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM news WHERE id='".$value."'");
					$query = mysqli_query($res1 ,"DELETE FROM news_language WHERE id='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De nieuws is met succes verwijderd.';
					header('Location: index.php?action=nieuws'); 
				}
			}
		break;	
		case "save":
			if (isset($_POST['ordering'])){
				foreach ($_POST['ordering'] as $id => $value){
				$query = mysqli_query($res1 ,"UPDATE news SET ordering='".$value."' WHERE id = ".$id);
				}
			}	
				
			if (count($query!=0)){
				$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
				header('Location: index.php?action=nieuws'); 
			}
		break;
	}	
}

$filter = '';

if (isset($_GET['filter_status'])){
	$filter .= " AND news.visible='".$_GET['filter_status']."'";
	$url.='&filter_status='.$_GET['filter_status'];
}
if (isset($_GET['filter_name'])){
	$filter .= " AND news_language.title LIKE '%".$_GET['filter_name']."%'";
	$url.='&filter_name='.$_GET['filter_name'];
}


$res = mysqli_query($res1 ,"SELECT * FROM news LEFT OUTER JOIN news_language ON news_language.id=news.id WHERE news_language.language_id=2 ".$filter." ORDER BY news.id ASC");

?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuws</h1>
	<div class="buttons">
		<?php if($_SESSION['user_status']==9){ ?>
			<div onclick="location = 'index.php?action=settings_nieuws&token=true'" class="gray_btn" style="float:left;">Nieuws instellingen</div>
		<?php } ?>
		<div onclick="location = 'index.php?action=nieuws_add&token=true'" class="green_btn">Nieuwsbericht toevoegen</div>
		<div onclick="$('#form').submit();" class="red_btn">Verwijder geselecteerde nieuwsberichten</div>
	</div>
</div>
<div class="backendNote">
	<span class="showMoreInfo">Click me for info</span>
	<div class="moreInfo" style="display:none;">
		<span class="title">Notes</span>
		<p>
			De nieuwsplugin dient ingesteld te worden via de settings pagina voordat deze goed functioneert. Vraag je contactpersoon deze voor je in te stellen als de nieuwsplugin nog niet juist werkt.
		</p>
	</div>
</div>
<div class="content" id="newInputs">
<form method="post" action="index.php?action=nieuws&route=delete" id="form">
<table class="list" id="overviewtbl">
	<thead>
		<tr>
			<td width="1" style="text-align: center;"><input type="checkbox" class="selectAll"/></td>
			<td class="left"><strong>Titel</strong></td>
			<td class="left"><strong>Seotitel</strong></td>
			<td class="left"><strong>Datum</strong></td>
			<td class="left"><strong>Zichtbaar</strong></td>
			<td class="right"><strong>Actie</strong></td>
		</tr>
	</thead>
	<tbody>	
		<?php 
		while ($siterow = mysqli_fetch_array($res)){
		?>
		<tr>
			<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $siterow['id']; ?>" /></td>
			<td class="left"><b><?=$siterow['title']?></b></td>
			<td class="left"><?=$siterow['seotitle']?></td>
			<td class="left"><?=$siterow['datum']?></td>
			<td class="left"><?=($siterow['visible']==0)? '<font color="red">Onzichtbaar</font>' : '<font color="green">Zichtbaar</font>'?></td>
			<td class="right"><div onclick="location = 'index.php?action=nieuws_edit&token=true&id=<?=$siterow['id']?>'"  class="gray_btn">Wijzig nieuwsbericht</div></td>
		</tr>
		<?php 
		}
		?>
	</tbody>	
	</table>
</form>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?action=news&clear=true';

	var filter_name = $('input[name=\'filter_name\']').attr('value');
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_navigatie = $('select[name=\'filter_navigatie\']').attr('value');
	if (filter_navigatie != '*') {
		url += '&filter_navigatie=' + encodeURIComponent(filter_navigatie);
	}

	var filter_status = $('select[name=\'filter_status\']').attr('value');
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	location = url;
}
//--></script>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script>
</div>