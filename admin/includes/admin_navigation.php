<?php
	function allNavs($id){
		global $res1;
		$allNavs = array();
		
		// New all navs
		$getAllNavs = mysqli_query($res1,"SELECT * FROM
										  navigation
										  WHERE navigationID = ".$id."
										  ORDER BY ordering");
		while($resAllNavs = mysqli_fetch_assoc($getAllNavs)){
			$allNavs[] = $resAllNavs;
		}
		
		return $allNavs;
	}
	
	if (isset($_GET['route'])){

		switch ($_GET['route']) {
			case "save":
				if (isset($_POST['ordering'])){
					foreach ($_POST['ordering'] as $id => $value){
						$query = mysqli_query($res1 ,"UPDATE navigation SET ordering='".$value."' WHERE id = ".$id);
					}
				}	
				
				if (count($query!=0)){
					$_SESSION['success'] = 'Sortering is met succes bijgewerkt.';
					header('Location: index.php?action=navigation'); 
				}
			break;
		}	
	}
?>
<div class="heading">
	<h1 style="background-image: url('images/category.png');">Navigatiebeheer</h1>
	<div class="buttons">
		<a onclick="$('#form').attr('action', 'index.php?action=navigation&route=save'); $('#form').submit();" class="green_btn"><span>Volgorde opslaan</span></a>
	</div>
</div>

<div class="content" id="newInputs">
	<form method="post" action="index.php?action=tree&route=save" id="form">
		<table class="list">
			<thead>
				<tr>
					<td class="left">Titel</td>
					<td class="left">Type</td>
					<td class="left">Volgorde</td>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td colspan="3" style="background:#efefef;font-weight:bold;padding: 10px 1%;width:98%;color:#444;margin:10px 0 0 0;"><b>Topnavigatie</b></td>
			</tr>
			<?php
			foreach(allNavs(4) as $key => $value){
				$type = '';
				if($value['sitetreeID']!=0){
					$type="Tekstpagina";
				}elseif($value['blogCatID']!=0){
					$type="Blog categorie";
				}else{
					$type="Link categorie";
				}
				echo '<tr>';
				echo '<td class="left">'.$value['title'].'</td>';
				echo '<td class="left">'.$type.'</td>';
				echo '<td class="left"><input type="text" name="ordering['.$value['id'].']" value='.$value['ordering'].' /></td>';
				echo '</tr>';
			}
			?>
			<tr>
				<td colspan="3" style="background:#efefef;font-weight:bold;padding: 10px 1%;width:98%;color:#444;margin:10px 0 0 0;"><b>Hoofdnavigatie</b></td>
			</tr>
			<?php
			foreach(allNavs(3) as $key => $value){
				$type = '';
				if($value['sitetreeID']!=0){
					$type="Tekstpagina";
				}elseif($value['blogCatID']!=0){
					$type="Blog categorie";
				}else{
					$type="Link categorie";
				}
				echo '<tr>';
				echo '<td class="left">'.$value['title'].'</td>';
				echo '<td class="left">'.$type.'</td>';
				echo '<td class="left"><input type="text" name="ordering['.$value['id'].']" value='.$value['ordering'].' /></td>';
				echo '</tr>';
			}
			?>
			<tr>
				<td colspan="3" style="background:#efefef;font-weight:bold;padding: 10px 1%;width:98%;color:#444;margin:10px 0 0 0;"><b>Footer</b></td>
			</tr>
			<?php
			foreach(allNavs(1) as $key => $value){
				$type = '';
				if($value['sitetreeID']!=0){
					$type="Tekstpagina";
				}elseif($value['blogCatID']!=0){
					$type="Blog categorie";
				}else{
					$type="Link categorie";
				}
				echo '<tr>';
				echo '<td class="left">'.$value['title'].'</td>';
				echo '<td class="left">'.$type.'</td>';
				echo '<td class="left"><input type="text" name="ordering['.$value['id'].']" value='.$value['ordering'].' /></td>';
				echo '</tr>';
			}
			?>
			</tbody>
		</table>
	</form>
</div>