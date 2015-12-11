(function() {
	
	//////////////////////////////////////
	//	FUNCTIONS FOR JS BY PHP.JS		//
	//////////////////////////////////////
	
	// UCFIRST()
	function ucfirst(str) {
		//  discuss at: http://phpjs.org/functions/ucfirst/
		// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// bugfixed by: Onno Marsman
		// improved by: Brett Zamir (http://brett-zamir.me)
		//   example 1: ucfirst('kevin van zonneveld');
		//   returns 1: 'Kevin van zonneveld'

		str += '';
		var f = str.charAt(0)
		.toUpperCase();
		return f + str.substr(1);
	}
	
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
	
	
	// ISSET()
	function isset() {
		//  discuss at: http://phpjs.org/functions/isset/
		// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// improved by: FremyCompany
		// improved by: Onno Marsman
		// improved by: Rafał Kukawski
		//   example 1: isset( undefined, true);
		//   returns 1: false
		//   example 2: isset( 'Kevin van Zonneveld' );
		//   returns 2: true

		var a = arguments,
			l = a.length,
			i = 0,
			undef;

		if (l === 0) {
			throw new Error('Empty isset');
		}

		while (i !== l) {
			if (a[i] === undef || a[i] === null) {
				return false;
			}
			i++;
		}
		return true;
	}

	
	
	
	
	
	
	
	
	
	
	//////////////////////////////////////
	//////////////////////////////////////
	/////////	 ANGULAR CODE	  ////////
	//////////////////////////////////////
	//////////////////////////////////////
	
	
	var base_uri = "http://localhost/";
	
	// OFFSTREAMS INTIATION
	var app = angular.module('ostrApp', []);
	
	
	
	
	
	// NAVIGATION CONTROLLER
	app.controller('Navigation', ['$http', '$scope', function($http, $scope) {
		
		
		// AJAX CALL
		$http({
			
			method: 'POST',
			url: base_uri + "widgets/navigation.php",
			data: "dataMine",
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
		
		// ON SUCCESS
		}).success(function(data){
			
			// Set the scope to the data being returned
			$scope.names = data;
			console.log($scope.names);
			
		});
		
	}]);
	
	
	
	
	
	
	// BAND HOMEPAGE
	app.controller('bandHomePage', ['$http', '$scope', function($http, $scope) {
		
		$http({
			
			method: 'POST',
			url: base_uri + "widgets/bandHomePage.php",
			data: "dataMine",
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			
		// ON SUCCESS
		}).success(function(data) {
			
			// Set the scope to the data in return
			$scope.bands = data;
			console.log($scope.band);
			
		});
		
	}]);
	
	
	
	
	
	
	
	// USER EDITING PAGE
	app.controller('userProfile', ['$http', '$scope', function($http, $scope) {
		
		var locArray;
		
		$http({
			
			method: 'POST',
			url: document.URL,
			data: "selectUserInfo",
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			
		}).success(function(data) {
			
			$scope.profile = data;
			$scope.profile.accType = ucfirst($scope.profile.accType);
			
			// IF ON EDIT PAGE
			if ($scope.profile.page.toLowerCase() == $scope.profile.session.toLowerCase()) {
				
				$scope.showEditButton = true;
				
				// IF USER IS LOGGED IN AND ON THEIR OWN PAGE
				if ($scope.profile.directive == "edit") {
				
					$scope.showEdit = true;
					
				}
				
			}
			
			///////////////////////////////////
			// LOCATION
			//
			//
			
			// Show the states if the country is the U.S.
			if ($scope.profile.country == "United States") {
				
				locArray = [$scope.profile.city, $scope.profile.state];
				$("#uStateSelect").css("display", "block");
				$("#uStateHidden").css("display", "none");
				
			// Remove the states if any other country is selected
			} else {
				
				locArray = [$scope.profile.city, $scope.profile.country];
				$("#uStateSelect").css("display", "none");
				$("#uStateHidden").css("display", "block");
				
			}
			
			// IMPLODE LOCATION AND SEPERATE WITH COMMA
			$scope.location = implode(", ", locArray);
			
			// Show the edit button
			console.log($scope.profile);
			
		});
		
		
		$scope.updateProfile = function() {
			
			var update = {
						'fName': $scope.profile.fName
						};
			
			
			console.log(update);
			
		};
		
	}]);
	
	
	
	
	
	
	
	
	
	////////////////////////////////////////
	// THE CONTROLLER FOR THE BAND PAGE
	//
	//
	//
	app.controller('bandPage', ['$http', '$scope', function($http, $scope) {
		
		// Initiate the widget as albums
		$scope.widget = "Albums";
		$scope.Albums = false;
		$scope.Singles = false;
		$scope.Videos = false;
		$scope.bandId = $(".bandIdHidden").val();
		
		
		
		
		///////////////////////////
		//	AJAX CALL FOR BANDS
		//
		$http({
			
			url: base_uri + "band",
			method: 'POST',
			data: {"bandData": true,
				   "bandId": $scope.bandId},
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			
		}).success(function(data) {
			
			$scope.bands = data;
			
		});
		
		// LOAD BAND LOCATION
		$scope.location = function() {
			
			var loc;
			
			
			if ($scope.bands[0].country == "United States") {
				
				loc = [$scope.bands[0].city, $scope.bands[0].state];
			
			} else {
				
				loc = [$scope.bands[0].city, $scope.bands[0].country];
				
			}
			
			
			var location = implode(", ", loc);
			
			return location;
			
		};
		
		
		
		
		///////////////////////////
		// AJAX CALL FOR ALBUMS
		//
		$scope.call = $http({
			
			method: 'POST',
			url: base_uri + "band",
			data: {"loadBandWidget": $scope.widget, 
				   "bandId": $scope.bandId},
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			
		}).success(function(data) {
			
			$scope.albums = data;
			console.log(data);
			
			
			// NUMBER OF ALBUMS
			$scope.albumNumber = data.length;
			console.log($scope.albumNumber);
			
		});
		
		
		//////////////////////////////////////////
		// LOAD INFO ON CLICK OF DIFFERENT TAB
		//
		$scope.loadBandWidget = function(widget, id) {
		
			$scope.bandId = id;
			$scope.widget = widget;
			$scope.band.link = undefined;
			
			if ($scope.Albums == false || $scope.Singles == false || $scope.Videos == false) {
				$http({
					
					method: 'POST',
					url: base_uri + "band",
					data: {"loadBandWidget": $scope.widget, 
						   "bandId": $scope.bandId},
					headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
					
				}).success(function(data) {
					
					$scope.band = data;
					console.log(data);
					
					if (widget == "Albums") {
						$scope.Albums = true;
					} else if (widget == "Singles") {	
						$scope.Singles = true;
					} else if (widget == "Videos") {
						$scope.Videos = true;
					}
					
				});
			}
			
		}
		
		
		// CHANGE STYLING FOR ALBUM TYPE
		$scope.albumType = function(type) {
			
			switch(type) {
				
				case "album":
					return "Album";
					break;
					
				case "ep":
					return "E.P.";
					break;
					
				default:
					return "";
					break;
				
			}
			
		}
		
		
		// ALBUM IMAGE
		$scope.albumImage = function(image) {
		
			return base_uri + "images/albums/" + image;
			
		}
		
		
		
	}]);
	
	
	
	
	
	
})();
