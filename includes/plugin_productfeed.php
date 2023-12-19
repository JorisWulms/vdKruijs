<?php
echo '<div id="allProducts">';
echo '<div id="results" class="productsContainer" style="float:left;width:100%;"></div>';
echo '</div>';
echo '<script type="text/javascript">
		$(document).ready(function() {
			$("#results" ).load( "includes/ajax_fetch_pages.php" ); //load initial records
		   
			//executes code below when user click on pagination links
			$("#results").on( "click", ".pagination a", function (e){
				e.preventDefault();
				$(".productBlock").fadeOut();
				var page = $(this).attr("data-page"); //get page number from link
				$("#results").load("includes/ajax_fetch_pages.php",{"page":page},function(){
					$(".productBlock").fadeIn();
				});
				$("html, body").animate({
					scrollTop: $("#allProducts").offset().top
				}, 500);
			});
		});
	</script>';