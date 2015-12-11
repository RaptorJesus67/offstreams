<?php

	class venueView extends View {
		
		protected $url;
		
		public function __construct($model, $url) {
			parent::__construct();
			
			$this->model = $model;
			$this->url = $url;
			
			// Venue values
			$this->venue = $this->model->table["venues"];
			$this->venueURL = $this->model->table["venues"]["venue_name"][0];
			
			// LOAD ASSOCIATIVE VENUE PAGE
			$this->loadVenuePage($this->url);
			
		}
		
		
		
		/**
		*
		*
		*
		*
		*/
		private function loadVenuePage($url = "venue") {
			
			// If venue isset
			if (isset($this->url[3])) {
				
				$template = BASEPATH  . "templates/venueTemplate.php";
				
			// On the city
			} elseif (isset($this->url[2])) {
				
				$template = BASEPATH . "templates/venueCity.php";
				
			// On the state/country
			} elseif (isset($this->url[1])) {
				
				$template = BASEPATH . "templates/venueState.php";
			
			// On main venue page, load venue
			} elseif(isset($this->url[0])) {
				
				$template = BASEPATH . "templates/venueHomePage.php";
				
			// Error, load main venue template
			} else {
				
				$template = BASEPATH . "templates/venueHomePage.php";
				
			}
			
			// render the correct template
			$this->render($template);
			
		}
		
		
		
		
		protected function listVenues() {
			
			// Global Camel Case
			global $camel;
			
			$urlName = $camel->camelCase("create", $this->venueURL);
			$urlCity = $camel->camelCase("create", $this->venue["venue_city"][0]);
			$urlState = $camel->camelCase("create", $this->venue["venue_state"][0]);
			
			$url = $urlState . "/" . $urlCity . "/" . $urlName;
			
			for ($i = 0; $i < count($this->venue["venue_id"]); $i++) {
				
				echo "<a href='" . BASE_URI . "venue/" . $url . "'>" . 
								$this->venue["venue_name"][$i] . " - " . $this->venue["venue_city"][$i] . ", " . $this->venue["venue_state"][$i] .
						"</a>";
				
			}
			
		}
		
		
		
		/**
		*
		* displays the band name in un-zepped form.
		*
		*	Used in the templates for venues
		*
		*	@access			protected			[used in templates]
		*	^@param			int						["iter", used to determine multiple possible iterations]
		*	@global				zepp					[Used for zepp conversion from database]
		*	@return				string					[Either returns edited value or null]
		*
		*/
		protected function venueName($iter = 0) {
			
			global $zepp;
			
			// If venue name exists
			if (isset($this->model->table["venues"]["venue_name"])) {
				
				$zeppName = $zepp->zeppCode("zepp", "symbol", $this->model->table["venues"]["venue_name"][$iter]);
				return $zeppName;
			
			// venue name is not set
			} else {
				
				return null;
				
			}
		}
		
		
		
		/**
		*
		*	Image for the main venue page
		*
		*	Used in individual template for venue page
		*
		* 	@access			protected			[used in template]
		*	^@param			int						["iter", used to keep interger of output]
		*	@global				image				[the image centering class]
		*	@return				string					[return either the image tag or null]
		*
		*/
		protected function venueMainImg($iter = 0) {
			
			global $image;
			
			if (isset($this->model->table["venues"]["venue_image"])) {
				
				// Image Source
				$img = BASE_URI . "images/venues/" . $this->model->table["venues"]["venue_image"][$iter];
				// Image centering
				$imgStyle = $image->centerImage($img, 300, 450);
				// Create style for centering
				$style = "width: " . $imgStyle["width"] . "px; height: " . $imgStyle["height"] . "px; margin: " . $imgStyle["margin"];
				
				// return image tag with info
				return "<img src='$img' style='$style' class='venueMainImage'/>";
				
			} else {
				
				return null;
				
			}
		}
		

	}

?>