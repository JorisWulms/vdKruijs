// Script to make sure the content is below the sticky header
function calculateTop(header, mainContent){
	var headerHeight = $(header).outerHeight();
	$(mainContent).css('margin-top', headerHeight);
}