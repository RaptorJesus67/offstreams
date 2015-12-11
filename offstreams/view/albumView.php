<?php

	class albumView extends View {
		
		public function __construct($modelResults, $url) {
			parent::__construct();
			
			global $camel;
			
			// MAKE VARIABLES LOCAL
			$this->model = $modelResults;
			$this->url = $url;
			
			
			
			// IF BOTH BAND AND ALBUM ARE IN THE URL, LOAD PAGE
			if (isset($this->url[1], $this->url[2])) {
				
				$this->album = $this->model->table["albums"];
				
				if (isset($this->model->table["songs"])) {
					
					$this->songs = $this->model->table["songs"];
					
				}
				
				
				for ($i = 0; $i < count($this->album["album_name"]); $i++) {
					
					if ($camel->camelCase("create", $this->album["album_name"][$i]) == $this->url[2]) {
						
						$this->iter = $i;
						
					}
				}
				#$this->songs = $this->model->table["songs"];
				
				$template = BASEPATH . "templates/albumTemplate.php";
				$this->loadAlbumPage($template);
				echo $this->displayAlbumSongs();
			
			
			
			// ALBUM HOMEPAGE
			} else {
				
				$this->loadAlbumPage();
				
			}
			
			
			
		}
		
		
		
		
		// LOAD ALBUM PAGE; LOAD HOMEPAGE BY DEFAULT
		protected function loadAlbumPage($template = BASEPATH . "templates/albumHomeTemplate.php") {
			
			$this->render($template);
			
		}
		
		
		
		// DISPLAY ALBUMS TO PAGE
		public function listAlbums($model) {
			
			global $zepp;
			global $camel;
			
			$this->model = $model;
			$this->album = $this->model->table["albums"];
			
			for ($c = 0; $c < count($this->model->table["albums"]["album_name"]); $c++) {
				
				# C++, HA! Programming joke... get it? No? Go fuck yourself Janet.
				
				
				// CONVERT FROM ZEPP-STRING (DATABASE TO URL)
				$bandZepp = $zepp->zeppCode("zepp", "string", $this->album["band_name"][$c]);
				$albumZepp = $zepp->zeppCode("zepp", "string", $this->album["album_name"][$c]);
				
				
				// CREATE CAMEL CASE FOR VALUES
				$bandLink = $camel->camelCase("create", $bandZepp);
				$albumLink = $camel->camelCase("create", $albumZepp);
				
				
				// CONVERT FROM ZEPP-SYMBOL (DATABASE TO PAGE)
				$bandName = $zepp->zeppCode("zepp", "symbol", $this->album["band_name"][$c]);
				$albumName = $zepp->zeppCode("zepp", "symbol", $this->album["album_name"][$c]);
				
				
				// Make the link
				$this->link = "<p><a href='" . BASE_URI . "band/" . $bandLink . "/" . $albumLink . "'>" . 
										$albumName . " - " . $bandName . "</a></p>";
									
				echo $this->link;
			
				
			}
		}
		
		
		
		
		// MAIN ALBUM WIDGET FOR THE BAND PAGE
		public function loadAlbumWidget($albums) {
			
			global $zepp;
			
			foreach ($albums as $key => $val) {
				$this->album[$key] = $val[0];
			}
			
			for ($i = 0; $i < count($albums["album_name"]); $i++) {
			
				// Header for each album
				echo $this->loadAlbumWidgetHeader($this->album["album_name"], $this->album["album_type"]);
			
			}
			
		}
		
		
		
		// CREATE EACH HEADER FOR THE ALBUM
		private function loadAlbumWidgetHeader($name, $type) {
			
			$header = "<div class='albumWidgetHeader'>";
			$header .= "<h2 class='albumWidgetHeaderText'>";
			$header .= $name;
			$header .= " - ";
			$header .= $this->styleAlbumType($type);
			$header .= "</h2>";
			$header .= "</div>";
			
			return $header;
			
		}
		
		
		
		
		// ALBUM PAGE TITLE
		protected function albumTitle() {
			
			if (isset($this->album["album_name"])) {
				
				return $this->album["album_name"][$this->iter];
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		// SRC FOR ALBUM IMAGE
		protected function albumImageSrc() {
			
			if (isset($this->album["album_image"])) {
				
				$src = "albums/" . $this->album["album_image"][$this->iter];
				
			} else {
				
				$src = "defaultPic.png";
				
			}
			
			return BASE_URI . "images/" . $src;
			
		}
		
		
		
		// STYLING FOR ALBUM IMAGE
		protected function albumImageStyle() {
			
			if (isset($this->album["album_image"])) {
				
				$style= "height: 230px; width: 230px;";
				
			} else {
				
				$style = null;
				
			}
			
			return $style;
			
		}
		
		
		
		// MERCH BUTTONS FOR ALBUM
		protected function albumMerchButtons() {
			
			$merchImages = array("googlePlay.png", "amazon.png", "itunes.png");
			$merchLinks = array($this->album["album_google"][$this->iter], $this->album["album_amazon"][$this->iter], $this->album["album_itunes"][$this->iter]);
			$merchValues = array("Google Play", "Amazon", "iTunes");
			
			for ($i = 0; $i < count($merchLinks); $i++) {
				
				// BAND DOESN'T SELL MUSIC ON ONE OF THE PLATFORMS
				if (empty($merchLinks[$i])) {
					
					// MAKE VALUES DIFFERENT
					
					$button = "
									<div class='merchButton'>
										<p>N/A</p>
									</div>
								  ";
					
					echo $button;
					
				} else {
					
					$button = "
									<div class='merchButton'>
										<a href='$merchLinks[$i]'>
											<img src='" . BASE_URI . "images/$merchImages[$i]' style='height: 40px' title='$merchValues[$i]'/>
										</a>
									</div>
								  ";
								  
					echo $button;
					
				}
				
			}
			
			
		}
		
		
		
		
		// CREATE SECTION FOR ALBUM INFO
		protected function albumInfo() {
			
			$this->albumType = $this->album["album_type"][$this->iter];
			$this->bstamp = $this->birthstamp($this->album["album_released"][$this->iter], "M. j, Y");
			
			$values = array($this->bstamp, $this->styleAlbumType($this->albumType), $this->album["album_label"][$this->iter]);
			foreach ($values as $stuff) {
				
				echo $stuff . "<br>";
				
			}
			
		}
		
		
		
		// LOOP THROUGH SONGS
		protected function displayAlbumSongs() {
			
			if (isset($this->songs)) {
				
				$song = null;
				for ($i = 0; $i < count($this->songs["song_name"]); $i++) {
					
					$song .= "
								<iframe src='https://embed.spotify.com/?uri=" . $this->songs["song_uri"][$i] . "' 
									width='600' height='80' frameborder='0' allowtransparency='true'></iframe><br/>
								";
								
					
				}
				
				return $song;
				
			}
			
		}
		
		
		
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>