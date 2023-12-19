// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the menu
var menu = document.getElementById("menu");

// Get the offset position of the menu
var sticky = menu.offsetTop;

// Add the sticky class to the menu when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    menu.classList.add("sticky")
  } else {
    menu.classList.remove("sticky");
  }
} 

// Mobile menu

function mobileMenu(menuID) {
	menuDiv = menuID;
	
	$("#menuToggle").click(function(e) {
		$(menuDiv + ".mobile-menu > ul").slideToggle(checkUl);
	});
	
	$(".nav").click(function(e) {
		$(menuDiv + ".mobile-menu > ul").slideToggle(checkUl);
	});
	
	$(menuDiv + " > ul > li").click(function(e) {
		$(menuDiv + ".mobile-menu > ul > li.active").removeClass('active');
		$(this).addClass('active');
		var childUl = $(this).find('ul');
		$(menuDiv + ".mobile-menu > ul > li > ul").each(function() {
			if(!childUl.is($(this))) {
				$(this).hide();
			}
		});
		if(childUl.length > 0 && childUl.css('display') == 'none') {
			e.preventDefault();
			childUl.toggle();
		}
	});
	
	$(window).resize(toggleMobileMenu);
	 toggleMobileMenu();
}

function toggleMobileMenu() {
	$(menuDiv).removeClass('mobile-menu');
	$("#menuToggle").css("display", "none"); 
	$(menuDiv + " > .nav").css("display", "none");
	
	// Er wordt van uit gegaan dat menuDiv de ul is van het menu
	var outerHeight = $(menuDiv + " > ul").outerHeight(); 
	var outerHeightMenuItem = $(menuDiv + " > ul > li > a").outerHeight(); 
	if(outerHeight != outerHeightMenuItem && outerHeight != 0)
	{
		$(menuDiv).addClass('mobile-menu');
		$("#menuToggle").css("display", "block");
		$(menuDiv + "> .nav").css("display", "block");

		menuHeight = $(menuDiv).outerHeight();
	}
}



function checkUl(){
	var ulNav = $(menuDiv + ".mobile-menu > ul");
	
	if(ulNav.css("display") == "none"){
		ulNav.css("display","");
	}
}