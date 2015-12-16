

///////////////////////////////////////
//////////	FUNCTIONS		///////////
///////////////////////////////////////
	
	// IMPLODE()
	function implode(glue, pieces) {
		//  discuss at: http://phpjs.org/functions/implode/
		// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// improved by: Waldo Malqui Silva
		// improved by: Itsacon (http://www.itsacon.net/)
		// bugfixed by: Brett Zamir (http://brett-zamir.me)
		//   example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']);
		//   returns 1: 'Kevin van Zonneveld'
		//   example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
		//   returns 2: 'Kevin van Zonneveld'

		var i = '',
		retVal = '',
		tGlue = '';
		
		if (arguments.length === 1) {
			pieces = glue;
			glue = '';
		}
		
		if (typeof pieces === 'object') {
			
			if (Object.prototype.toString.call(pieces) === '[object Array]') {
				return pieces.join(glue);
			}
			
			for (i in pieces) {
				retVal += tGlue + pieces[i];
				tGlue = glue;
			}
			
			return retVal;
			
		}
		
		return pieces;
		
	}


///////////////////////////////////////
//////////	END FUNCTIONS	  /////////
///////////////////////////////////////






// CHANGE PASSWORD TO READABLE
$(document).on("click", "#showPasswordCheckbox, #showPassword", function(){
	
	var pass = ".loginWrapper input[name=password]";
	var element = $(pass).attr("type");
	
	if (element == "password") {
		
		$(pass).removeAttr("type");
		$("#showPasswordCheckbox").attr("checked");
		$(pass).attr("type", "text");
		
	} else if (element == "text") {
		
		$(pass).removeAttr("type");
		$(pass).attr("checked", false);
		$(pass).attr("type", "password");
		
	}
	
});




///////////////////////////////////
//	BAND PAGE DROP DOWN INFO
//
//
//
$(document).on("click", ".bandPageDropDown", function() {
	
	var rotate = $(this).css("-webkit-transform", "rotate(180deg)");
	$(this).addClass("bandPageDropDownClicked");
	$(this).removeClass("bandPageDropDown");
	$(".bandPageInfoBottom").slideDown("slow", function(){
		$(".bandPageInfoBottom > *").fadeIn("slow", function() {
			// Animation Complete
		});
	});
	
});
$(document).on("click", ".bandPageDropDownClicked", function() {
	
	
	// Band Info/Donate Widget
	$(".bandPageInfoBottom > *").fadeOut("slow", function() {
		// Window Disappeared
		
		// Spin the button
		var rotate = $(".bandPageDropDownClicked").css("-webkit-transform", "rotate(0deg)");
		$(".bandPageDropDownClicked").addClass("bandPageDropDown");
		$(".bandPageDropDownClicked").removeClass("bandPageDropDownClicked");
		
	});
	$(".bandPageInfoBottom").delay(600).slideUp("slow", function() {
		// Slided Up
		// Waited .6 seconds for info to fade out. Prevents weird
		// CSS "display" glitches.
	});
	
});





$(document).on('click', ".tab", function() {

	$('.tab').removeClass('active');
	$(this).addClass('active');
	
});




///////////////////////////////////
//	BAND PAGE VIDEO CLICK
//
//
//
$(document).on("click", ".videoWidgetContainer", function() {
	
	// ACTUAL POPUP
	$(".youtubePopup").bPopup({
		follow: [false, false]
	});
	
	
	// GET WIDTH OF POPUP
	var popupWidth = $(".youtubePopup").width();
	var winWidth = $(window).width();
	
	
	// ALWAYS IN CENTER
	$(".youtubePopup").css("margin-left", (winWidth - popupWidth) / 2);
	$(".youtubePopup").css("top", "25%");
	$(".youtubePopup").css("left", "0");
	
	
	$(window).resize(function(){
	   $(".youtubePopup").css("margin-left", ($(window).width() - popupWidth) / 2);
	   console.log($(window).width());
	});
	
});










// EDIT IMAGE STYLE
$(window).load(function() {
  
	var image = $(".bandLinkImg");
	var contain = $(".bandLinkContainer");
	
	var iWidth = image.width();			// IMAGE WIDTH
	var iHeight = image.height();		// IMAGE HEIGHT
	
	var cWidth = contain.width();		// CONTAINER WIDTH
	var cHeight = contain.height();		// CONTAINER HEIGHT
	
	// IF imageWidth is > containerWidth AND imageHeight > containerHeight
	if (iWidth >= cWidth && iHeight >= cHeight) {
		
		if (iWidth > iHeight) {
			
			console.log(cWidth + "x" + cHeight);
			console.log(iWidth + "x" + iHeight);
			image.css("width", "100%");
			
		}
		
	} else if (iWidth >= cWidth && iHeight <= cHeight) {
		
		if (iWidth >= cWidth) {
			
			image.css("height", "100%");
			
		} else if (iHeight >= cHeight) {
			
			image.css("width", "100%");
			
		}
		
	}
	
	
});




//////////////////////////////////
//		YOUTUBE ICON HOVER		//
//////////////////////////////////
$(".videoYoutubeIcon").on("mouseenter", function() {
	
	console.log("Test");
	
});










/////////////////////////////////////////
////////	DOCUMENT			/////////
/////////////////////////////////////////
$(document).ready(function() {
	
	$(".userEditProfileForm select, .userEditProfileForm input").bind("change keyup paste", function() {
		
		var city = $("#uCity").val();
		var state = $("#uStateSelect option:selected").text();
		var country = $("#uCountrySelect option:selected").text();
		
		if (country == "United States") {
		
			locArray = [city, state];
			$("#uStateSelect").css("display", "block");
			$("#uStateHidden").css("display", "none");
			
		} else {
			
			locArray = [city, country];
			$("#uStateSelect").css("display", "none");
			$("#uStateHidden").css("display", "block");
			
		}
		
		var location = implode(", ", locArray);
		
		$('#userProfileLocation').text(location);
		
		
	});
	
	
	$(".videoWidgetContainer > .videoYoutubeIcon").bind("mouseenter", function() {
	
		console.log("Test");
		
	});
	
	
	
	
	
	
});




