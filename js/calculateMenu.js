// This script is for the correct paddings on the a-elements in #navigation
function calculateMenu(logo,navDiv,navItem,dropdownBlock){
	var fullHeight =  $(logo).outerHeight();
	var navItemHeight = $(navItem).outerHeight();
	var correctHeight = fullHeight - navItemHeight;
	var displayHeight = correctHeight / 2;

	$(navItem).css('padding-top', displayHeight);
	$(navItem).css('padding-bottom', displayHeight);
	
	var newNavHeight = $(navDiv).outerHeight();
	
	// Place dropdown menu beneath mainmenu
	$(dropdownBlock).css('top',newNavHeight);
}

// This script is for the correct placing of the dropdown for full width navigations
function calculateMenuDropdown(navDiv,dropdownBlock){
	var newNavHeight = $(navDiv).outerHeight();
	// Place dropdown menu beneath mainmenu
	$(dropdownBlock).css('top',newNavHeight);
}