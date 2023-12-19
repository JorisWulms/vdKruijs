<?php 
$BID = (int)isset($_GET['id']);

if (isset($_POST['shopedit'])) 
{
	$error = "";
	
	$BID = (int)$_POST['id'];
	$naam = realescape($_POST["naam"]);	
	$beschrijving = realescape($_POST["bigtext"]);
	$seokey = realescape($_POST["seokey"]);
	$seodesc = realescape(trim(strip_tags($_POST["seodesc"])));	
	$seotitle = realescape($_POST["seotitle"]);	
	$rewrite = realescape($_POST["rewrite"]);
	$Categorie = (int)$_POST["Categorie"];
	$visable = (int)$_POST["visable"];
	$tijd = realescape($_POST["Tijd"]);
	$affiliatelink = realescape($_POST["affiliatelink"]);
			
	//Rewrite controle
	if($rewrite == "")
	{
		$rewrite = $naam;
	}
	
	if($tijd == 0)
		$tijd = time();
	
	//Rewrite validatie
	$rewrite = encodeUrlParam($rewrite);
	
	echo $error;
	//update
	if( $error == "")
	{
		$q = "UPDATE  `affiliate_shops` SET 
			`Naam` =  '$naam',
			`Beschrijving` =  '$beschrijving',
			`Visable` =  '$visable',
			`Seokey` =  '$seokey',
			`Seodesc` =  '$seodesc',
			`Seotitle` =  '$seotitle',
			`Rewrite` =  '$rewrite' ,
			`Categorie` = '$Categorie',
			`Prijs` = '$tijd',
			`affiliatelink` = '$affiliatelink'
			WHERE `BID` = $BID;";

		if (mysqli_query($res1 ,$q) == true) 
		{
			if ($_FILES['image']['name']!="")
			{
				UploadImage(DIR_IMAGE,$BID);
			}
			
			$_SESSION['success'] = 'De pagina is met succes gewijzigd.';
		}
	}
	else
	{
		$_SESSION['success'] = $error;
	}
	
	header('Location: index.php?action=shop_products');
}

if (isset($_POST['shopadd'])) {
	
	$error = "";
	$naam = realescape($_POST["naam"]);	
	$beschrijving = realescape($_POST["bigtext"]);
	$seokey = realescape($_POST["seokey"]);
	$seodesc = realescape(trim(strip_tags($_POST["seodesc"])));	
	$seotitle = realescape($_POST["seotitle"]);	
	$rewrite = realescape($_POST["rewrite"]);
	$Categorie = (int)$_POST["Categorie"];
	$visable = (int)$_POST["Visable"];
	$tijd = realescape($_POST["Tijd"]);
	$affiliatelink = realescape($_POST["affiliatelink"]);
		
	//Duplicate namen
	$q = "SELECT * FROM `affiliate_shops` WHERE `naam` = '$naam'";
	$result = mysqli_query($res1 ,$q);
	if ( mysqli_num_rows($result) != 0 )
	{
		$error .= "Item bestaat al. ";
	}
    
	//Rewrite controle
	if($rewrite == "")
	{
		$rewrite = $naam;
	}
	
	//Rewrite validatie
	$rewrite = encodeUrlParam($rewrite);

	//add blog
	if( $error == "")
	{
		$q = "INSERT INTO `affiliate_shops` (
			`BID`,	`Naam`, `Beschrijving`, `visable`, `Seokey`, `Seodesc`, `Seotitle`, `Rewrite`, `Categorie`, `Prijs`, `affiliatelink`) 
			VALUES 
			(NULL, '$naam', '$beschrijving', '$visable', '$seokey', '$seodesc', '$seotitle', '$rewrite', '$Categorie', '$tijd', '$affiliatelink' );";

		$result = mysqli_query($res1 ,$q);
        $BID = mysqli_insert_id($res1);
                			
		if ($result) 
		{
			if ($_FILES['image']['name']!="")
			{
				UploadImage(DIR_IMAGE,$BID);
			}
			
			$_SESSION['success'] = 'De pagina is met succes gewijzigd.';
		}
	}
	else
	{
		$_SESSION['success'] = $error;
	}
		
	header('Location: index.php?action=shop_products');
}

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM affiliate_shops WHERE BID='".(int)$value."'");
					$query = mysqli_query($res1 ,"DELETE FROM affiliate_shops WHERE BID='".(int)$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De pagina is met succes verwijderd.';
					header('Location: index.php?action=shop_products'); 
				}
			}
		break;	
		
		case "save":
			if (isset($_POST['Itemordering'])){
				foreach ($_POST['Itemordering'] as $id => $value){
				$query = mysqli_query($res1 ,"UPDATE shops SET Itemordering='".$value."' WHERE BID = ".$id);
				}
			}	
				
			if (count($query!=0)){
				$_SESSION['success'] = 'De volgorde van de producten is bijgewerkt';
				header('Location: index.php?action=shop_products'); 
			}
		break;
	}	
}
?>

<div class="buttonsScroll">
	<div style="float:right;">
		<a onclick="location = 'index.php?action=shop_products_add&clear=true'" class="green_btn">Nieuw product toevoegen</a>
		<a onclick="$('#form').attr('action', 'index.php?action=shop_products&route=save'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn">Verwijder selectie</a>
	</div>
</div>

<div class="heading">
	<h1 style="background-image: url('images/category.png');">Alle producten</h1>
	<div class="buttons">
		<a onclick="location = 'index.php?action=shop_products_add&clear=true'" class="green_btn">Nieuw product toevoegen</a>
		<a onclick="$('#form').attr('action', 'index.php?action=shop_products&route=save'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
		<a onclick="$('#form').submit();" class="red_btn">Verwijder selectie</a>
	</div>
</div>
<div class="content">
	<form method="post" action="index.php?action=shop_products&route=delete" id="form">
		<table class="list">
			<thead>
				<tr>
					<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left"><strong>Naam</strong></td>
					<td class="left"><strong>Categorie</strong></td>
					<td class="left"><strong>Beschrijving</strong></td>
					<td class="left"><strong>Affiliatelink</strong></td>
					<td class="left"><strong>Volgorde</strong></td>
					<td class="left"><strong>Kliks</strong></td>
					<td class="left"></td>
				</tr>
			</thead>
			<tbody>
			<?php 
			$i=0;
			$res = mysqli_query($res1 ,"SELECT * FROM affiliate_shops as shop, affiliate_shops_cat as cat WHERE shop.Categorie = cat.Categorie ORDER BY shop.Categorie, shop.Itemordering");
			
			$prevValue = NULL;
			
			while ($siterow = mysqli_fetch_array($res))
			{
				$curValue=$siterow['CATNaam'];
			
				if($curValue!=$prevValue){ ?>
					<tr>
						<td style="text-align: center;padding: 10px 0;" bgcolor="#fff" colspan="8">&nbsp;</td>
					</tr>
					<tr>
						<td style="text-align: center;padding: 10px 0;" bgcolor="#ddd" colspan="8"><span style="font-size: 16px;padding:5px 0;text-transform:uppercase;font-weight:bold;color:#000;"><?=$siterow['CATNaam']?></span></td>
					</tr>
			<?php 	}
			
			$i++;
			?>
			<tr>
				<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $siterow['BID']; ?>" /></td>
				<td class="left"><b><?=$siterow['Naam']?></b></td>
				<td class="left"><b><?=$siterow['CATNaam']?></b></td>
				<td class="left"><?=substr(strip_tags($siterow['Beschrijving']),0,20)?>...</td>
				<td class="left"><?=$siterow['affiliatelink']?></td>
				<td class="left"><input type="text" name="Itemordering[<?=$siterow['BID']?>]" value="<?=$siterow['Itemordering']?>" size="5"></td>
				<td class="left"><?=$siterow['kliks']?></td>
				<td class="right"><a href='index.php?action=shop_products_edit&clear=true&id=<?=$siterow['BID']?>' class="gray_btn">Wijzig product</a></td>
			</tr>
			<?php 
				$prevValue=$curValue;
			}
			?>
		</table>
	</form>
</div>
