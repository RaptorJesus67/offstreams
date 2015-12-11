$(document).ready(function(){
	
	
	
	/////////////////////////////////////////////////////////
	////					FUNCTIONS							////
	/////////////////////////////////////////////////////////
	
	
	// UPPERCASE FIRST LETTER
	function ucfirst(string) {
		return string.charAt(0).toUpperCase() + string.slice(1);
	}
	
	
	
	// CAMEL CASE WORD
	function camelCase(type, input) {
		
		switch (type) {
			
			case "create":
				var camelType = 1;
				break;
			
			case "break":
				var camelType = 2;
				break;
				
			default:
				var camelType = false;
				break;
			
		}
		
		// Declare camel null for use later
		var camel = "";
		
		// If we are creating camelCasing
		if (camelType == 1) {
			
			var string = input.toLowerCase();
			
			var stringArray = string.split(" ");
			
			// Loop through each string element
			for (var i = 0; i < stringArray.length; i++) {
				
				// skip the first value
				if (i == 0) {
					
					camel += stringArray[i];
					
				} else {
					
					camel += ucfirst(stringArray[i]);
					
				}
			}
			
			return camel;
			
		} else if (camelType == 2) {
			
			var camel = input.split(/(?=[A-Z])/);
			
			//return camel;
			
			var cam = "";
			for (var i = 0; i < camel.length; i++) {
				cam += camel[i].toLowerCase() + " ";
			}
			
			return cam;
			
		}
	}
	
	
	
	var camel = camelCase("break", "zergIsReal");
	console.log(camel);
	
	function rtrim(str, charlist) {
	// CREDITS LEFT OUT OF RESPECT
	//	discuss at: http://phpjs.org/functions/rtrim/
	// 	original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	//  input by: Erkekjetter
	//  input by: rem
	// 	improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// 	bugfixed by: Onno Marsman
	// 	bugfixed by: Brett Zamir (http://brett-zamir.me)
	//  example 1: rtrim('    Kevin van Zonneveld    ');
	//  returns 1: '    Kevin van Zonneveld'

	  charlist = !charlist ? ' \\s\u00A0' : (charlist + '')
		.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\\$1');
	  var re = new RegExp('[' + charlist + ']+$', 'g');
	  return (str + '')
		.replace(re, '');
	}
	
	
	
	var base_uri = "http://localhost/offstreams/";
	
	$("#editBandName").bind("input", function(){
		var searchTerm = $(this).val();
		//console.log(searchTerm);
		
		$.ajax({
			url: base_uri + "widgets/queryBandName.php",
			type: 'POST',
			data: {bandName: searchTerm},
			success: function(value) {
				
				// There are values in database
				if (value != null) {
					
					var band = JSON.parse(value);
					
					// Each array iteration
					$.each(band, function(index, data) {
						
						// band[index].type
						// type: name, id
						console.log(band[index].name);
						
					});
					
				// No database values
				} else {
					
					
					
				}
			}
		});
	});
	
	
	
	///////////////////////////////////////////////////////////////
	////																   ////
	////						SEARCH BAR						   ////
	////																   ////
	///////////////////////////////////////////////////////////////
	
	$("#searchbar").bind("input", function() {
		
		var searchTerm = $(this).val();
		//console.log(searchTerm);
		
		$.ajax({
			url: base_uri + "widgets/searchBarWidget.php",
			type: "POST",
			data: {searchTerm: searchTerm},	// {PHP_POST_VAR, USER_INPUT_VIA_JQUERY}
			success: function(data) {
				
				// If query returns true information
				if (data != null && searchTerm) {
					
					// console.log(data);
					
					// Refresh the search results
					$(".liveSearchResults").remove();
					
					var camelURL = camelCase("create", searchTerm);
					$(".searchbarForm").attr("action", base_uri + "search/" + camelURL);
					$("#centerHeaderElement").append("<div class='liveSearchResults'></div>");
					
					table = JSON.parse(data);
					// console.log(table);
					
					// If the results don't exist
					if (table == null) {
						
						return false;
						
					}
					
					$.each(table, function(index, data) {
						
						str = index.substring(0, index.length - 1);
						var id = str + "_id";
						var name = str + "_name";
						var url = str + "_url";
						//console.log(table[index][name]);
						
						if (table[index][name] == null) {
							
							return false;
							
						}
						
						var sectionName = index;
						$(".liveSearchResults").append("<ul class='" + index + "Ul'><li>" + index.toUpperCase() + "</li></ul>");
						
						for (var i = 0; i < table[index][name].length; i++) {
							 // console.log(table[index][url]);
							
							$("." + index + "Ul").append("<a href='" + base_uri + table[index][name][i] + "'><li>" + table[index][name][i] + "</li></a>");
							
						}
						
						
					});
					
				// Value doesn't exist, show no values error
				} else {
					
					$(".liveSearchResults").remove();
					
				}
				
			}
		});
		
	});
	
});