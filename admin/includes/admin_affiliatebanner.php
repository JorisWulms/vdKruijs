<?php
if (isset($_POST['addaffiliatebanner'])){

	$query = mysqli_query($res1,"INSERT INTO affiliate_banner SET url='".$_POST['url']."',image='".$_POST['image']."',script='".$_POST['script']."',kliks='".$_POST['kliks']."'");
	$bannerid = mysqli_insert_id($res1);
	
	if (isset($_POST['locatie'])){
		foreach ($_POST['locatie'] as $key => $value) {
			mysqli_query($res1,"INSERT INTO affiliate_banner_locatie SET locatie='".$value."', bannerID='".(int)$bannerid."' ");
		}
	}
		
	if ($query == true) {
		$_SESSION['success'] = 'De banner is succesvol toegevoegd.';
		header('Location: index.php?action=affiliatebanner'); 
	}
	
}

if (isset($_POST['editaffiliatebanner'])){
	$query = mysqli_query($res1,"UPDATE affiliate_banner SET url='".$_POST['url']."',image='".$_POST['image']."',script='".$_POST['script']."',kliks='".$_POST['kliks']."' WHERE bannerID='".$_POST['bannerid']."'");

	if($_POST['locatie']!="")
	{ 
		mysqli_query($res1,"DELETE FROM affiliate_banner_locatie WHERE bannerID='".$_POST['bannerid']."'"); 
		foreach ($_POST['locatie'] as $bannerid) 
		{ 
			mysqli_query($res1,"INSERT INTO affiliate_banner_locatie SET bannerID='".(int)$_POST['bannerid']."',locatie='".$bannerid."'"); 
		} 
	}


	if ($query == true) {
		$_SESSION['success'] = 'De banner is succesvol gewijzigd.';
		header('Location: index.php?action=affiliatebanner'); 
	}

}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					$query = mysqli_query($res1,"DELETE FROM affiliate_banner WHERE bannerID='".$value."'");
					$query2 = mysqli_query($res1,"DELETE FROM affiliate_banner_locatie WHERE bannerID='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De banner is succesvol verwijderd.';
					header('Location: index.php?action=affiliatebanner'); 
				}
			}
		break;	
	}	
}
?>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Affiliate banners</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=affiliatebanner_add&clear=true'" class="green_btn"><span>Nieuwe banner</span></a>
		<a onclick="$('#form').submit();" class="red_btn"><span>Verwijder banner selectie</span></a>
	</div>
</div>

<div class="content banner">
	<form method="post" action="index.php?action=affiliatebanner&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td>ID</td>
					<td>URL</td>
					<td>Afbeelding ( complete < img > tag mee plaatsen )</td>
					<td>Locatie</td>
					<td>Kliks</td>
					<td>Wijzig</td>
				</tr>
			</thead>
			<tbody>
			<?php
			$resBanner = mysqli_query($res1,"SELECT *, affiliate_banner.bannerID AS bannerID FROM affiliate_banner LEFT OUTER JOIN affiliate_banner_locatie ON affiliate_banner.bannerID=affiliate_banner_locatie.bannerID GROUP BY affiliate_banner.bannerID");
			while ($rowBanner = mysqli_fetch_assoc($resBanner)){
			?>
				<tr>
					<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $rowBanner['bannerID']; ?>" /></td>
					<td><?=$rowBanner['bannerID']; ?></td>
					<td><?=$rowBanner['url']; ?></td>
					<td><?=$rowBanner['image']; ?><!--<br/><?=str_replace(array("<img",">"),array("< img"," >"),$rowBanner['image']);?>--></td>
					<td>
						<?php 
						$resLocatie = mysqli_query($res1,"SELECT * FROM affiliate_banner_locatie WHERE bannerID='".$rowBanner['bannerID']."'");
						$amtLocatie = mysqli_num_rows($resLocatie);

						while ($rowLocatie = mysqli_fetch_assoc($resLocatie)){
							if($rowLocatie['locatie']==1){
								$locatie="Geen locatie";
							}elseif($rowLocatie['locatie']==2){
								$locatie="In header ( Let op, menu moet fullwidth zijn en logo niet centered )";
							}elseif($rowLocatie['locatie']==3){
								$locatie="In banner ( enkel op banners zonder teksten er in )";
							}elseif($rowLocatie['locatie']==4){
								$locatie="Onder banner ( tussen banner en tekst )";
							}elseif($rowLocatie['locatie']==5){
								$locatie="Rechts langs tekst ( gewone tekst pagina's )";
							}elseif($rowLocatie['locatie']==6){
								$locatie="Boven footer ( Gecentreerd )";
							}elseif($rowLocatie['locatie']==7){
								$locatie="In dropdownmenu ( indien aanwezig )";
							}elseif($rowLocatie['locatie']==8){
								$locatie="In popup onderaan ( Let op, popup moet wel actief staan )";
							}elseif($rowLocatie['locatie']==9){
								$locatie="In notice ( Let op, notice moet wel actief staan )";
							}else{
								$locatie="Something went wrong...";
							}
							echo $locatie;
							if($amtLocatie > 1){
								echo ',<br/>';
							}
						} ?>
					</td>
					<td><?=$rowBanner['kliks']; ?></td>
					<td><a href="index.php?action=affiliatebanner_edit&id=<?=$rowBanner['bannerID']?>" class="gray_btn">Wijzig</a></td>
				</tr>
			<?php
			}
			?>
		</table>
	</form>
</div>