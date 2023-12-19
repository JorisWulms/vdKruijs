<?php 
$id = (int)isset($_GET['id']);

if (isset($_POST['shopcatedit']))
{
    $id = (int)$_POST['id'];

    $error = "";
    $naam = realescape($_POST["naam"]);
    $visable = (int)$_POST["Visable"];
    $items = realescape($_POST["Items"]);
	$Order = realescape($_POST["Order"]);
	$beschrijving = realescape($_POST["Beschrijving"]);
	
    //Rewrite controle
    if ($rewrite == "")
    {
        $rewrite = $naam;
    }
	
    //Rewrite validatie
    $rewrite = encodeUrlParam($rewrite);

    //update
    if ($error == "")
    {
        $q = "UPDATE  `affiliate_shops_cat` SET 
			`CATNaam` =  '$naam',
			`Visable` =  '$visable',
			`Items` =  '$items',
			`Ordering` =  '$Order',
			`seotitle` =  '$seotitle',
			`seodesc` =  '$seodesc',
			`Cat_Beschrijving` = '$beschrijving'
			WHERE `Categorie` = $id";

        if (mysqli_query($res1 ,$q) == true)
        {
            $_SESSION['success'] = 'De pagina is met succes gewijzigd.';
        }
    }
    else
    {
        $_SESSION['success'] = $error;
    }
	
    header('Location: index.php?action=shop_cat');
}

if (isset($_POST['shopcatadd']))
{

    $error = "";
    $naam = realescape($_POST["naam"]);
	$rewrite = $naam;
    $visable = (int)$_POST["Visable"];
    $items = realescape($_POST["Items"]);
	$Order = realescape($_POST["Order"]);
	$beschrijving = realescape($_POST["Beschrijving"]);
	$seotitle = realescape($_POST["seotitle"]);
	$seodesc = realescape($_POST["seodesc"]);

    //Duplicate namen
    $q = "SELECT * FROM `affiliate_shops_cat` WHERE `CATNAAM` = '$naam'";
    $result = mysqli_query($res1 ,$q);

    if (mysqli_num_rows($result) != 0)
    {
        $error .= "Item bestaat al. ";
    }

    //Rewrite validatie
    $rewrite = encodeUrlParam($rewrite);

    //add blogcat
    if ($error == "")
    {
        $q = "INSERT INTO `affiliate_shops_cat` 
		(`Categorie`,`CATNaam`, `Visable`, `Items`, `Ordering`, `Cat_Beschrijving`, `seotitle`, `seodesc`, `Rewrite`) 
		VALUES 
		(NULL,'$naam', '$visable', '$items', '$Order', '$beschrijving', '$seotitle', '$seodesc', '$rewrite');";

        if (mysqli_query($res1 ,$q) == true)
        {
            $_SESSION['success'] = 'De pagina is met succes gewijzigd.';
        }
    }
    else
    {
        $_SESSION['success'] = $error;
    }

    header('Location: index.php?action=shop_cat');
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
                    mysqli_query($res1 ,"DELETE FROM  affiliate_shops_cat WHERE Categorie='" . (int)$value . "'");
                    $query = mysqli_query($res1 ,"DELETE FROM  affiliate_shops_cat WHERE Categorie='" . (int)$value .
                        "'");
                }

                if (count($query != 0))
                {
                    $_SESSION['success'] = 'De pagina is met succes verwijderd.';
                    header('Location: index.php?action=shop_cat');
                }
            }
            break;
			
		case "save":
			if (isset($_POST['Ordering'])){
				foreach ($_POST['Ordering'] as $id => $value){
				$query = mysqli_query($res1 ,"UPDATE affiliate_shops_cat SET Ordering='".$value."' WHERE Categorie = ".$id);
				}
			}	
				
			if (count($query!=0)){
				$_SESSION['success'] = 'De categorievolgorde is bijgewerkt.';
				header('Location: index.php?action=shop_cat'); 
			}
		break;
    }
}

?>
<div class="heading">
<h1 style="background-image: url('images/category.png');">Overzicht productcategorie&euml;n</h1>
<div class="buttons">
	<a onclick="location = 'index.php?action=shop_cat_add&clear=true'" class="green_btn">Nieuwe categorie</a>
	<a onclick="$('#form').attr('action', 'index.php?action=shop_cat&route=save'); $('#form').submit();" class="yellow_btn"><span>Volgorde opslaan</span></a>
	<a onclick="$('#form').submit();" class="red_btn">Verwijder selectie</a>
</div>
</div>
<div class="content">
<form method="post" action="index.php?action=shop_cat&route=delete" id="form">
<table class="list">
	<thead>
		<tr>
			<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			<td class="left"><strong>Naam</strong></td>
			<td class="left"><strong>Zichtbaar</strong></td>
			<td class="left"><strong>Aantal producten</strong></td>
			<td class="left"><strong>Volgorde</strong></td>
			<td class="left"></td>
		</tr>
	</thead>
		<tbody>
		<?php 

$i = 0;
$res = mysqli_query($res1 ,"SELECT * FROM  affiliate_shops_cat ORDER BY Ordering");
while ($siterow = mysqli_fetch_array($res))
{
    $i++;

?>
		<tr>
			<td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php

    echo $siterow['Categorie'];

?>" /></td>
			<td class="left"><b><?=

    $siterow['CATNaam']

?></b></td>
			<td class="left">
				<?=$siterow['Visable'] == 1 ? "Zichtbaar" : "Niet zichtbaar"?>
			</td>
			
			<td class="left">
				<?php
				
				$resProds = mysqli_query($res1 ,"SELECT * FROM  affiliate_shops_cat WHERE Categorie = '".$siterow['Categorie']."'");
				$amtItems = mysqli_num_rows($resProds);
				?>
			</td>
			
			<td class="left">
				<input type="text" name="Ordering[<?=$siterow['Categorie']?>]" value="<?=$siterow['Ordering']?>" size="5">
			</td>
			
			<td class="right">
				<a href='index.php?action=shop_cat_edit&clear=true&id=<?=$siterow['Categorie']?>' class="gray_btn">Wijzig</a>
			</td>
		</tr>
		<?php 

}

?>
	</table>
</form>
</div>