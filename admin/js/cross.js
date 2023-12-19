function loadnext(divout,divin){$("." + divout).hide();$("." + divin).fadeIn("slow");}

needToConfirm = false;
window.onbeforeunload = askConfirm;

function askConfirm(){
	if (needToConfirm){
		return "U heeft uw werk nog niet opgeslagen.";
	}
}

function calculate(value,prod,hash){
	 $.ajax({
	   type: "get",
	   url: "includes/calc.php",
	   data: "value="+value+"&prod="+prod+"&hash="+hash+"&recal=true",
	   success: function(data) {
		   if(data=="yes")
		   {
		   recalculate(hash);
		  // $("#volgende").show();
		   }
		   if(data=="no")
		   {
		   alert('De bestelhoeveelheid is te weinig.');
		   $("#volgende").hide();
		   }
	   }
	});
}

function recalculate(hash){
	$.ajax({
		type: "get",
		url: "includes/calc.php",
		data: "hash="+hash+"&totaal=true",
		success: function(data) {
		$("#totaalofferte").html(data);
		}
	});
}


function hideshow(el,act)
{
	if(act) $('#'+el).css('visibility','visible');
	else $('#'+el).css('visibility','hidden');
}

function error(act,txt)
{
	hideshow('errormsg',act);
	if(txt) $('#errormsg').html(txt);
}

function submitForm(formObj, formMode) {
	if (!formObj)
			return false;

	if (formObj.tagName != "FORM") {
			if (!formObj.form)
					return false;
			formObj = formObj.form;
	}
	if (formObj.mode)
			formObj.mode.value = formMode;

	formObj.submit();
}

function popup_image_selection (type, id, imgid) {
    return window.open("includes/image_selection.php?type="+type+"&id="+id+"&imgid="+imgid,"selectimage","width=500,height=350,toolbar=no,status=no,scrollbars=yes,resizable=no,menubar=no,location=no,direction=no");
}

function expandSubMenu(){
	$('#menu > ul > li > a').on('click', function(e){
		if($(this).parent("li").children('ul').length){
			e.preventDefault();
			$(this).parent("li").children('ul').slideToggle();
		}
	});
}

function dashboardTabs(){
	$('.dashboardTabs a').on('click touchStart',function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		
		$('.dashboardTabs a').removeClass('active');
		$(this).addClass('active');
		
		$('.board').removeClass('active');
		$('.dashboard_'+id).addClass('active');
	});
	
}

$(function(){
	// Kopieer linkbuilding tr
	$('#copyButton').click(function(){
		var itemToCopy = $('.copyMe').get();
		if(itemToCopy.length == 0) 
			return;
			
		var copyItem = $(itemToCopy[0]);
		var copyClone = copyItem.clone();
		var cloneInput = copyClone.find("input").get();
		for( var index in cloneInput) {
			$(cloneInput[index]).val("");
		}
		
		copyItem.parent().append(copyClone);
		bindEvents();
	});
	
	// Verwijder linkbuilding tr
	function bindEvents(){
		$('.deleteCopy').click(function(){
			$(this).closest('.copyMe').remove();
		});
	}
	bindEvents();
	
	$('#menu > ul > li').each(function(){
		if($(this).children('ul').length){
			$(this).addClass('dropdown');
		}	
	});
	expandSubMenu();
	dashboardTabs();
	
	$('li.active').closest('ul').css('display','block');
	
	// Kopieer linkbuilding tr
	$('.showMoreInfo').click(function(){
		$('.moreInfo').toggle();
	});
});