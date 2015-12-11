<?php

	class View {
		
		public function __construct() {
			
			
			
		}
		
		
		
		public function render($template) {
			
			// Grab template
			require_once($template);
			
		}
		
		
		
		// STYLE ALBUM TYPE
		protected function styleAlbumType($type) {
			
			switch ($type) {
				
				case "ep":
					return "E.P.";
					break;
				
				case "album":
					return "Album";
					break;
					
				case "single":
					return "Single";
					break;
					
				default:
					return null;
					break;
				
			}
			
		}
		
		
		
		
		// CONVERT BIRTHSTAMP
		protected function birthstamp($data, $regex = "m/d/Y") {
			
			if (strlen($data) == 4) {
					
					return $data;
					
				// User inserted month and year
				} elseif (strlen($data) == 6) {
					
					// Process month and year
				
				// User inserted month, day, and year
				} elseif (strlen($data) == 8) {
					
					$d = str_split($data);
					// Month
					$date[] = $d[0] . $d[1];
					// Day
					$date[] = $d[2] . $d[3];
					// Year
					$date[] = $d[4] . $d[5] . $d[6] . $d[7];
					
					$value = implode("/", $date);
					$date = date($regex, strtotime($value));
					
					return $date;
					
				// User didn't enter data, or a crazy value was inserted somehow
				} else {
					
					return null;
					
				}
			
			$date = date($regex, $data);
			return $date;
			
		}
		
		
		
		/**
		*
		*	Return the Location in "standard format"
		*
		*	Format is follows: implode(", ", array($city, $state, $country))
		*
		*	@access		protected
		*	@param			string				[City]
		*	@param			string				[State]
		*	@param			string				[Country]
		*	@return			mixed				[Either string or null]
		*
		*/
		protected function location($city, $state, $country) {
			
			// Put variables in array to check for null
			$locArray = array($city, $state, $country);
			
			// Loop through array of variables
			foreach ($locArray as $loc) {
				
				// If element is empty or equal to the U.S., toss it out.
				if ($loc == null || $loc == "U.S.") {
					
					continue;
					
				// If element is valid, add it to new array for implode
				} else {
					
					$locationArray[] = $loc;
					
				}
			}
			
			// Implode and then return array
			$location = implode(", ", $locationArray);
			return $location;
			
		}
		
		
		
		// STYLE YEARS ACTIVE
		protected function yearsActive($start, $ended) {
			
			if ($start == null) {
				
				$start = "Unknown";
				
			}
			
			if ($ended == null) {
				
				$ended = "Unknown";
				
			}
			
			$yearsActive = $start . " - " . $ended;
			return $yearsActive;
			
		}
		
		
		
		
		// MAKE IMAGE CENTER WORK
		protected function imageCenter($image, $maxHeight, $maxWidth) {
			
			global $image;
			
			return $image->centerImage($image, $maxHeight, $maxWidth);
			
		}
		
	}

?>