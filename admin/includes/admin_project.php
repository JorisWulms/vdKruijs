<?php
if (isset($_POST['editproject'])) {
    $projectid = $_POST['id'];
    
    if ($_POST['rewrite']!=""){
      $rewrite = $_POST['rewrite'];
    }else{
      $rewrite = encodeUrlParam($_POST['naam']);
    }     

    mysqli_query($res1 ,"UPDATE project 
				 SET naam = '".escape($_POST['naam'])."', 
				 rewrite='".escape($rewrite)."', 
				 beschrijving = '".escape($_POST['beschrijving'])."',
				 korteBeschrijving = '".escape($_POST['korteBeschrijving'])."',
				 slogan = '".escape($_POST['slogan'])."',
				 visible='".$_POST['visible']."' 
				 WHERE id = '".$projectid."'");
}
  
if (isset($_POST['addproject'])) {
      
        if ($_POST['rewrite']!=""){
          $rewrite = $_POST['rewrite'];
        }else{
          $rewrite = encodeUrlParam($_POST['naam']);
        }
        
        mysqli_query($res1 ,"INSERT INTO project 
					 SET naam='".escape($_POST['naam'])."',
					 rewrite='".escape($rewrite)."', 
					 beschrijving='".escape($_POST["beschrijving"])."',
					 korteBeschrijving = '".escape($_POST['korteBeschrijving'])."',
					 slogan = '".escape($_POST['slogan'])."',
					 visible='".$_POST['visible']."'");
					 
		$category_id = mysqli_insert_id($res1);		 
}
        
if (isset($_GET['route'])){
	switch ($_GET['route']) {
		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					$query = mysqli_query($res1 ,"DELETE FROM project_galerij WHERE projectid='".$value."'");
					$query = mysqli_query($res1 ,"DELETE FROM project WHERE id='".$value."'");
				}
				if (count($query) > 0){
					$_SESSION['success'] = 'Project met succes verwijderd.';
					header('Location: index.php?action=project');
				}
			}
		break;
		case "order":
			foreach($_POST['order'] as $key => $value){
				if(is_numeric($value)){
					$query = "UPDATE project SET ordering = '".$value."' WHERE id='".$key."'";
					mysqli_query($res1 ,$query);
				}
			}
			foreach($_POST['visible'] as $key => $value){
				if(is_numeric($value)){
					$query = "UPDATE project SET visible = '".$value."' WHERE id='".$key."'";
					mysqli_query($res1 ,$query);
				}
			}
			$_SESSION['success'] = 'Volgorde en categorie&euml;n zijn opgeslagen.';
			header('Location: index.php?action=project');
		break;
	}	
}

$showRecords = 20;

if(isset($_GET['pag'])) {

  $pagina = $_GET['pag'];
  $_SESSION['pag']=$pagina;

   if ($_SESSION['pag']==1){
   $start = 0;
   }else{
   $start = $_SESSION['pag'] * $showRecords - $showRecords;
   }
} else {

  $pagina = 1;
  $start = 0;

}


$tResult = mysqli_query($res1 ,"SELECT * FROM project");

if($tResult && mysqli_num_rows($tResult) > 0) {
  $pages = ceil(mysqli_num_rows($tResult) / $showRecords);
} else {
  $pages = 0;
}

$limit="LIMIT ".$start.",".$showRecords."";
$res = mysqli_query($res1 ,"SELECT count(*) AS total FROM project");
$qtotaal = mysqli_fetch_array($res);
$totaal = $qtotaal['total'];

$url = 'index.php?action=project&clear=true';

$res = mysqli_query($res1 ,"SELECT * FROM project ORDER BY ordering ".$limit);
if(isset($uploadErr)){
	echo("<script type=\"text/javascript\">alert('".$errMsg."');</script>");
} 

$projectCategory = array();
?>
<div class="heading">
<h1 style="background-image: url('images/category.png');">Projecten</h1>
<div class="buttons">
	<a onclick="location = 'index.php?action=project_add&clear=true'" class="green_btn"><span>Nieuw project</span></a>
	<input type="submit" value="Volgorde en categori&euml;en opslaan" onClick="setOrderSubmit();" class="yellow_btn" />
	<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a>
</div>
</div>
<div class="content">
<form method="post" action="index.php?action=project&route=delete" id="form">
<table class="list">
	<thead>
		<tr>
			<td width="1" style="text-align: center;"><input type="checkbox" onclick= "$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			<td class="left"><b>Titel</b></td>
			<td class="left"><b>Slogan</b></td>
			<td class="left"><b>Volgorde</b></td>
			<td class="left"><b>Is het project zichtbaar?</b></td>                        
			<td class="left"><b>Afbeeldingen</b></td>
			<td class="right">Actie</td>
		</tr>
	</thead>
	<tbody>
	<?php
	while ($row = mysqli_fetch_object($res)){
		$qResult = mysqli_query($res1 ,"SELECT COUNT(*) AS cnt FROM galerij g INNER JOIN project_galerij pg ON g.id = pg.galerijid WHERE pg.projectid = '".$row->id."'");
		$cnt = mysqli_num_rows($qResult);
	?>
		<tr>
			<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $row->id; ?>" /></td>
			<td valign="top" class="left"><?=$row->naam?></td>
			<td valign="top" class="left"><?=$row->slogan?></td>
			<td valign="top" class="left"><input type="text" value="<?=$row->ordering?>" name="order[<?=$row->id?>]" size="4"></td>
			<td valign="top" class="left">			
				<select name="visible[<?=$row->id?>]">
					<option value="0" <?=($row->visible==0)? ' selected="selected"' : ''?>>Nee</option>
					<option value="1" <?=($row->visible==1)? ' selected="selected"' : ''?>>Ja</option>
				</select>
			</td>
			<td valign="top" class="left"><?=$cnt?></td>
			<td width="10%" class="right"><a class="gray_btn" href="index.php?action=project_edit&id=<?=$row->id?>">Wijzigen</a></td>
		</tr>
	<?php 
	unset($projectCategory);
	
	} ?>
	</tbody>
</table>
</form>
<script type="text/javascript">
function setOrderSubmit()
{
	var form = document.getElementById('form');
	form.action = 'index.php?action=project&route=order';
	form.submit();
}
</script>
