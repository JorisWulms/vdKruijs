$(function() {
	// Fill in the logoID, menuID, meniItem path, drop-down path respectively.
	calculateMenu('#logo','.containerNav','.containerNav > li > a','.containerNav li ul');
	calculateMenuDropdown('.fullNav','.fullNav li ul');
	
	//Initialize mobile menu, use the ID of the element around the UL
	mobileMenu('#navigation');
	
	// Calculate the amout of margin-top for the element below the header.
	// Note: this must be initialized below the calculateMenu function. 
	// Fill in the headerID and ID for the element below the header
	calculateTop('#header.headerFixed','#banner');
	
	// Initialize the banner slider.
	$('#bannerSlider').bxSlider({
		pager: false,
		auto: true
	});
	
	function readMore(){
		var rewrite = $('input[name="maxLines"]').val();
		var data = 'r='+rewrite;
		
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "includes/ajax_maxLines.php", //Relative or absolute path to response.php file
			data: data,
			success: function (data) {
				// Initialize readmore function on all items with the textTruncate class.
				$(".textTruncate").mtruncate({
					maxLines: data,
					expandText: '<span class="readMore">> Lees meer</span>',
					collapseText: '<span class="readMore">< Lees minder</span>'
				});	
			}
		});
	}
	
	readMore();
	
	calculateBlogImage('.blogsContainer.fullPage .blogOverviewBlog','.blogOverviewImage')
	
});

// Functions that need to either be recalculated or initialized on resizing of window.
$(window).resize(function() {
	calculateTop('#header.headerFixed','#banner');
});