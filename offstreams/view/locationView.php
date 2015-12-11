<?php

	class locationView extends View {
		
		public function __construct($model, $url) {
			parent::__construct();
			
			// Initiate calls
			$this->model = $model;
			$this->url = $url;
			$this->city = $this->model->table["locations"];
			
			
		}
		
		
		
		
		
		protected function displayAllCities() {
			
			global $camel;
			
			if (isset($this->city["loc_city"])) {
				
				for ($i = 0; $i < count($this->city["loc_city"]); $i++) {
					
					$country = $camel->camelCase("create", $this->city["loc_country"][$i]);
					$state = $camel->camelCase("create", $this->city["loc_state"][$i]);
					$city = $camel->camelCase("create", $this->city["loc_city"][$i]);
					
					if (!empty($state)) {
						
						$country = $state;
						
					}
					
					echo "<a href='" . BASE_URI . "location/" . $country . "/" . $city . "' class='locationHref'>
								<div class='locationCityContainer'>
									<p class='locationName'>" . $this->city["loc_city"][$i] . "</p>
									<p class='bandList'></p>
									<p class='venueList'></p>
									" . $this->cityImage(300, 450, $i) . "
									<img src='" . BASE_URI . "images/Div Shadow.png' class='divShadow' />
								</div>
							</a>";
							
				}
				
			} else {
				
				return false;
				
			}
		}
		
		
		
		/**
		*
		*	Checks if city exsts
		*
		*	Used to determine if city exists t prevent blank pages
		*
		*/
		public function doesCityExist() {
			
			// If the Page Title Exists (there was a successful query), then return true
			if ($this->cityPageTitle()) {
				
				return true;
				
			// The page technically doesn't exist, return false so the band page doesn't open
			} else {
				
				return false;
				
			}
		}
		
		
		
		public function doesStateExist($url) {
			
			if ($this->statePageTitle($url)) {
				
				return true;
				
			} else {
				
				return false;
				
			}
		}
		
		
		
		// ZEPP CITY NAME
		public function cityPageTitle() {
			
			global $zepp;
			
			// Serialize band name through Zepp Code
			return $zepp->zeppCode("zepp", "symbol", $this->model->table["locations"]["loc_city"][0]);
			
		}
		
		
		// ZEPP STATE NAME
		public function statePageTitle($state) {
			
			global $camel;
			
			$state = $camel->camelCase("break", $state);
			echo $state;
			print_r($this->model->table);
			
			if ($state == strtolower($this->city["loc_state"][0])) {
				
				return true;
				
			} elseif ($state == strtolower($this->city["loc_country"][0])) {
				
				return true;
				
			} else {
				
				return false;
				
			}
		}
		
		
		
		
		protected function cityImage($height = 300, $width = 0, $iter = 0) {
			
			global $image;
			
			if (isset($this->city["loc_image"]) && !empty($this->city["loc_image"])) {
				
				// Image Source
				$src = BASE_URI . "images/locations/" . $this->city["loc_image"][$iter];
				// Image styling
				$style = $image->centerImage($src, $height, $width);
				$styleArray = "width: " . $style["width"] . "px; height: " . $style["height"] . "px; margin: " . $style["margin"] . ";";
				
				$img = "<img src='$src' style='$styleArray' class='cityImage'/>";
				return $img;
				
			} else {
				
				return null;
				
			}
		}
		

	}

?>