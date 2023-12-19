<!--- NAVIGATIE --->
<div id="nav">
<?php
	$resDiffs = mysqli_query($res1 ,"SELECT Categorie, CATNaam FROM affiliate_shops_cat ORDER BY Ordering ASC");
	if($resDiffs){
		while($rowDiffs = mysqli_fetch_assoc($resDiffs))
		{
			?>
			<a class="green_button cat" href="#" id="<?php echo $rowDiffs['Categorie'];?>link">Naar <?php echo $rowDiffs['CATNaam'];?></a>
			<?php 
		}
	}
?>
</div>

<script type="text/javascript">
    function goToByScroll(id){
        id = id.replace("link", "");

        $('html,body').animate({
            scrollTop: $("#"+id).offset().top-40},'slow'
		);
    }

    $("#nav > a").click(function(e) { 
        e.preventDefault(); 
        goToByScroll($(this).attr("id"));           
    });
		
</script>

<!--- CATEGORIEËN EN PRODUCTEN --->
<?php 
	$resCats = mysqli_query($res1 ,"SELECT * FROM affiliate_shops_cat ORDER BY Ordering ASC");	
	
	if($resCats){
		while($rowCats = mysqli_fetch_assoc($resCats))
		{
			echo '
				<div id="'.$rowCats['Categorie'].'" class="shopCategorie">
					<h3>'.$rowCats['CATNaam'].'</h3>
			';
				
				$resProds = mysqli_query($res1 ,"SELECT * FROM affiliate_shops WHERE Categorie='".$rowCats['Categorie']."' ORDER BY Itemordering ASC");
				$count=1;
				
				while($rowProds = mysqli_fetch_assoc($resProds))
				{
					if($count % 3 == 0){
						$last = 'last';
					}else{
						$last = '';
					}
				?>
					<a href="<?php echo SHOP_PATH.'/'.$rowProds["Rewrite"]; ?>.html" class="shopProduct <?php echo $last; ?>">
						<span><?php echo $rowProds["Naam"]; ?></span>
						<span class="imgcont"><img src="images/shop/<?php echo $rowProds["Foto_Locatie"]; ?>" /></span>
						<p>
							Vanaf &euro; <?php echo $rowProds["Prijs"]; ?>
						</p>
					</a>
				<?php 
					$count++;
				}
			
			echo '<a href="#top" id="toTop">^ Terug naar boven ^</a>';
			echo '</div>';
		}
	}
?>
<script type="text/javascript">
	$("a[href='#top']").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});
</script>