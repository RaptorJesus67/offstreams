<?php

	class bandView extends View {
		
		public $link;
		
		// LOAD TEMPLATE ON LOAD
		public function __construct($modelResults, $url, $albums = array()) {
			parent::__construct();
			
			global $image;
			
			// Set Local model
			$this->model = $modelResults;
			$this->url = $url;
			
			// ACTUAL BAND PAGE
			if (!empty($url[1])) {
				
				// Convert complex band table results, to simple variable
				$this->band = $this->model->table["bands"];
				
				
				// Does the band exist? Prevents the user from accessing an unknown "band page"
				if ($this->doesBandExist() == false) {
					
					$this->loadMainPage();
					
					return false;
					
				}
				
				
				// Album Info
				if (!empty($this->model->table["albums"])) {
					$this->album = $this->model->table["albums"];
				}
				
				
				// IMAGE LOCATION
				$this->imageSrc = BASE_URI . "images/bands/" . $this->model->table["bands"]["band_image"][0];
				// IMAGE SPECS
				$this->imgSpecs = $image->centerImage($this->imageSrc, 250, 400);
				$this->imageSpecs = $this->imgStyle();
				
				
				// Load Template for band if the band actually exists
				$template = BASEPATH . "templates/bandPage.php";
				$this->loadMainPage($template);
				
				
			// MAIN BAND PAGE
			} else {
				
				
				
				$this->loadMainPage();
				
			}
		}
		
		
		
		// STYLING FOR IMAGE
		protected function imgStyle() {
			
			$height = $this->imgSpecs["height"];
			$width = $this->imgSpecs["width"];
			$margin = $this->imgSpecs["margin"];
			
			$styles = "height: " . $height . "px; width: " . $width . "px; margin: " . $margin;
			return $styles;
			
		}
		
		
		
		// FUNCTION TO LOAD FILE VIA MAIN VIEW CONFIG
		// DEFAULT LOAD MAIN BAND PAGE
		public function loadMainPage($template = BASEPATH . "templates/bandHomepage.php") {
			
			$this->render($template);
			
		}
		
		
		
		private function doesBandExist() {
			
			// If the Page Title Exists (there was a successful query), then return true
			if ($this->bandPageTitle()) {
				
				return true;
				
			// The page technically doesn't exist, return false so the band page doesn't open
			} else {
				
				return false;
				
			}
		}
		
		
		
		// ZEPP BAND NAME
		public function bandPageTitle() {
			
			global $zepp;
			
			// Serialize band name through Zepp Code
			return $zepp->zeppCode("zepp", "symbol", $this->model->table["bands"]["band_name"][0]);
			
		}
		
		
		
		// GET BAND IMAGE FROM IMAGES
		public function getBandImage() {
			
			$this->bandImage = $this->model->table["bands"]["band_image"][0];
			
			if (empty($this->bandImage)) {
				
				$this->bandImage = "defaultPic.png";
				
			} else {
				
				$this->bandImage = "bands/" . $this->bandImage;
				
			}
			
			$location = BASE_URI . "images/" . $this->bandImage;
			return $location;
			
		}
		
		
		
		
		// SET UP BAND'S BIO
		public function bandBio() {
			
			// If results exist
			if (isset($this->band)) {
				
				return $this->band["band_bio"][0];
				
			}
			
		}
		
		
		
		// SET UP LINKS
		// CALL FUNCTION BEFOREHAND TO ACCESS LINK VARIABLE WITH TEXT AND HREF
		public function listThirdPartyLinks() {
			
			$links = array("google" => "Google Play", "itunes" => "iTunes", "amazon" => "Amazon", "merchLink" => "Merch");
			
			foreach ($links as $key => $link) {
				
				$this->link["text"][] = $link;
				$this->link["href"][] = $this->model->table["bands"]["band_" . $key][0];
				
			}
		}
		
		
		
		
		// LIST BAND INFORMATION
		public function displayBandInformation() {
			
			// SET UP VALUES
			$city = $this->model->table["bands"]["band_city"][0];
			$state = $this->model->table["bands"]["band_state"][0];
			$country = $this->model->table["bands"]["band_country"][0];
			$start = $this->model->table["bands"]["band_formed"][0];
			$ended = $this->model->table["bands"]["band_disbanded"][0];
			
			
			// Create array for type and it's value
			$infoType = array("Location", "Years Active");
			$infoData = array($this->location($city, $state, $country), $this->yearsActive($start, $ended));
			
			// Loop though each type
			for ($i = 0; $i < count($infoData); $i++) {
				
				
				// IF THE INFO IS EMPTY, DON'T DISPLAY IT
				if ($infoData[$i] == null) {
					
					continue;
				
				// CREATE ROW FOR DATA				
				} else {
					
					echo "<div class='bandInfoRow'>
								<div class='bandInfoLeftCol'>
									<strong>$infoType[$i]</strong>
								</div>
								<div class='bandInfoRightCol'>
									<p>$infoData[$i]</p>
								</div>
							</div>";
					
				}
				
			}
			
		}
		
		
		
		
		// LIST THRID PARTY MUSIC LINKS
		public function listThirdPartyMusic() {
			
			// If band info exists
			if (isset($this->band)) {
				
				// Get three music links
				$links = array($this->band["band_google"][0], 
									$this->band["band_amazon"][0],
									$this->band["band_itunes"][0]);
				$names = array("Google Play", "Amazon", "iTunes");
				$images = array("googlePlay.png","amazon.png", "itunes.png");
				
				// Loop through each to see if they exist
				for ($i = 0; $i < count($links); $i++) {
					
					// No value for the link, show unavailable
					if (empty($links[$i])) {
						
						echo "
								<li>
									<p>Not Available on <em>$names[$i]</em></p>
								</li>
								";
						
					// Link has value, show image with link to page
					} else {
						
						echo "
								<li>
									<a href='$links[$i]' target='_blank'>
										<img src='" . BASE_URI . "images/$images[$i]' class='thirdPartyMusicButtons' />
									</a>
								</li>
								";
						
					}
					
				}
				
			}
			
		}
		
		
		
		/////////////////////////////////////////
		//			ALBUMS						////
		/////////////////////////////////////////
		
		// DISPLAY ALBUMS TO BAND PAGE
		public function listAlbums() {
			
			if (isset($this->model->table["albums"])) {
				
				$this->albums = $this->model->table["albums"];
				
				// Loop Through each album
				for ($c = 0; $c < count($this->albums["album_name"]); $c++) {
					
					echo "<div class='albumBox'>";
					
					// Album Title
					echo $this->indvAlbumTitle($this->albums["album_released"][$c], $this->albums["album_name"][$c]);
					// Album Info Body
					echo $this->albumAccordionBody($c);
					
					echo "</div>";
					
				}
				
			}
			
		}
		
		
		
		
		// TITLE FOR EACH ALBUM (ACCORDION)
		private function indvAlbumTitle($year, $name) {
			
			$title = "
						<div class='albumAccordionTitle'>
							<h2>" . $this->birthstamp($year, "Y") . " - " . $name . "</h2>
						</div>
						";
			return $title;
			
		}
		
		
		
		
		// BODY FOR EACH ALBUM ACCORDION
		private function albumAccordionBody($iter) {
			
			// Albums exist
			if (isset($this->albums)) {
				
				$structure = 
						"
						<div class='albumAccordionBody'>
							<div class='albumAccordionImageContainer'>
								<img src='" . BASE_URI . "images/albums/" . $this->albums["album_image"][$iter] . "' class='albumAccordionImage' />
							</div>
							<div class='albumAccordionMiddle'>
								<table>
									" . $this->albumMiddleInfo($iter) . "
								</table>
							</div>
							<div class='albumAccordionRight'>
							
							</div>
						</div>
						";
						
				return $structure;
				
			}
			
		}
		
		
		
		
		// CENTER ALBUM COLUMN ON ALBUM ACCORDION BODY
		private function albumMiddleInfo($iter) {
			
			$typeArray = array("Released", "Label", "Type", "Genres");
			$valArray = array($this->birthstamp($this->albums["album_released"][$iter], "M j, Y"), $this->albums["album_label"][$iter],
										$this->styleAlbumType($this->albums["album_type"][$iter]), "No Music to Display");
			
			$structure = null;
			for ($c = 0; $c < count($typeArray); $c++) {
				
				$structure .= "
							<tr>
								<td>
									<strong>$typeArray[$c]</strong>
								</td>
								<td>
									<p>$valArray[$c]</p>
								</td>
							</tr>
							";
				
			}
			
			return $structure;
			
		}
		
		
		// LIST ALL BANDS FOR THE HOMEPAGE
		public function listAllBands() {
			
			global $camel;
			global $zepp;
			
			$this->allBands = $this->model->table["bands"]["band_name"];
			
			foreach ($this->allBands as $band) {
				
				$bandName = $zepp->zeppCode("zepp", "symbol", $band);
				$bandLink = $zepp->zeppCode("zepp", "string", $band);
				$bandLink = $camel->camelCase("create", $bandLink);
				
				echo "<a href='" . BASE_URI . "band/" . $bandLink . "'>" . $bandName . "</a><br/>";
				
			}
			
		}
		
		
	}

?>