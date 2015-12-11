<?php

	class bandController extends Controller {
		
		public $urlParams;
		public $model;
		public $album;
		
		
		// CREATE PAGE ON OPEN
		public function __construct() {
			parent::__construct();
			
			// GLOBAL CONNECTIONS
			global $conn;
			global $zepp;
			global $camel;
			
			
			//////////////////////////////////////////////////////
			// INSTANCE NAVIGATION BEFORE PAGE LOAD //
			//////////////////////////////////////////////////////
			$this->loadApp("controller/navigationController.php", array("nav", "navigationController"));
			
			// GET CURRENT URL
			$this->url = $this->url->trimURL();
			
			
			
			// DOES ALBUM EXIST
			if (isset($this->url[2])) {
				
				
				
				// ALBUM EXISTS
				if ($this->checkIfAlbumExists()) {
					
					
					// ALBUM REQUIRES
					require_once(BASEPATH . "model/albumModel.php");
					require_once(BASEPATH . "view/albumView.php");
					
					
					// LOAD ALBUM PAGE
					$this->albumModel = new albumModel($conn);
					
					
					// Load album data passing the band name and album name as parameters
					$this->albumModel->loadAlbumData($this->url[1], $this->url[2]);
					
					#print_r($this->albumModel->table["albums"]);
					// LOAD CORRECT ALBUM
					for ($i = 0; $i < count($this->albumModel->table["albums"]["album_name"]); $i++) {
					
						// If camel cased album name is equal to the URL album
						if ($camel->camelCase("create", $this->albumModel->table["albums"]["album_name"][$i]) == $this->url[2]) {
							
							// Save the iteration to remember album
							$this->iter = $i;
							
						}
					}
					
					// Band name
					$band = $this->albumModel->table["albums"]["band_name"][$this->iter];
					// Album name
					$album = $this->albumModel->table["albums"]["album_name"][$this->iter];
					
					// Load album Songs from band and album name
					$this->albumModel->loadAlbumSongs($band, $album);
					
					// Create album view passing it the album model and url as parameters
					$this->albumView = new albumView($this->albumModel, $this->url);
				
				
				
				// ALBUM DOESN'T EXIST, SEE IF BAND DOES
				} elseif ($this->doesBandExist()) {
					
					// LOAD BAND MODEL
					$this->model = new bandModel($conn);
					
					$this->model->selectBand($this->url);
					$this->model->selectAlbums($this->url);
					
					
					// CREATE BAND VIEW
					$this->createView($this->model, $this->url);

				
				
				
				// NO ALBUM, LOAD BAND HOMEPAGE	
				} else {
					
					require_once(BASEPATH . "templates/bandHomepage.php");
					
				}
				
				
				
			// DOES BAND EXIST	
			} elseif (isset($this->url[1])) {
				
				
				
				// BAND EXISTS
				if ($this->doesBandExist()) {
					
					
					
					// LOAD BAND MODEL
					$this->model = new bandModel($conn);
					
					$this->model->selectBand($this->url);
					$this->model->selectAlbums($this->url);
					
					
					// CREATE BAND VIEW
					$this->createView($this->model, $this->url);
					
					
					
				// NO BAND, LOAD BAND HOMEPAGE	
				} else {
					
					require_once(BASEPATH . "templates/bandHomepage.php");
					
				}
				
				
				
			// BAND HOMEPAGE	
			} elseif ($this->url[0]) {
				
				$this->model = new bandModel($conn);
				$this->model->listAllBands();
				
				$this->createView($this->model, $this->url);
				
				require_once(BASEPATH . "templates/bandHomepage.php");
				
			}
			
			
		}
		
		
		
		
		
		
		
		///////////////////////////////////////////////////////////////
		////////		CONTROLLER FUNCTIONS				/////////
		///////////////////////////////////////////////////////////////
		
		
		
		// LOAD THE VIEW MODULE FOR BAND PAGE
		private function createView($model, $url) {
			
			return $view = new bandView($model, $url);
			
		}
		
		
		
		// ALL APPS TO BE BROUGHT INTO BANDS PAGE
		private function loadFirstPartyApps() {
			
			// Load Navigation
			$this->loadApp("controller/navigationController.php", array("nav", "navigationController"));
			
		}
		
		
		
		/**
		*
		*	Check if album for band exists
		*
		*	Return boolean to load album page, if false continue to band page
		*
		*	@access	private
		*	@global		zepp	[zepp code class]
		*	@global		camel [camel case class]
		*	@return		boolean
		*
		*/
		private function checkIfAlbumExists() {
			
				global $camel;
				global $zepp;
				
				// UNDO CAMEL CASING
				$this->albumName = $camel->camelCase("break", $this->url[2]);
				$this->bandName = $camel->camelCase("break", $this->url[1]);
				
				// CONVERT TO ZEPP CODE FOR DATABASE
				$this->albumName = $zepp->zeppCode("string", "zepp", $this->albumName);
				$this->bandName = $zepp->zeppCode("string", "zepp", $this->bandName);
				
				// CREATE MODEL
				$model = new Model;
				
				// QUERY PARAMETERS
				$this->name = "albums";
				$this->cols = array("album_name", "band_name");
				$this->where = "`album_name` = '" . $this->albumName ."' AND `band_name` = '" . $this->bandName . "'";
				
				// QUERY
				$model->select($this->name, $this->cols, $this->where);
				
				// IF THERE IS A RETURN VALUE THAT IS VALID
				if (isset($model->table) &&!empty($model->table)) {
					
					return true;
				
				// NO ALBUM FOUND, RETURN FALSE AND LOAD BAND PAGE
				} else {
					
					return false;
					
				}
				
		}
		
		
		
		/**
		*
		*	Check if band name in URL exists
		*
		*	Return boolean to load band page, otherwise, load band homepage
		*
		*	@access	private
		*	@global		zepp	[zepp code class]
		*	@global		camel [camel case class]
		*	@return		boolean
		*
		*/
		private function doesBandExist() {
				
				// GLOBAL CALLS	//
				global $camel;
				global $zepp;
				
				// Break camel casing
				$this->bandName = $camel->camelCase("break", $this->url[1]);
				
				// Convert to zepp code
				$this->bandName = $zepp->zeppCode("string", "zepp", $this->bandName);
				
				// Create Model for testing
				$model = new Model;
				
				// Values to be tested
				$this->name = "bands";
				$this->cols = array("band_name");
				$this->where = "`band_name` = '" . $this->bandName . "'";
				
				// Query values
				$model->select($this->name, $this->cols, $this->where);
				
				// If band exists, return true and load info
				if (isset($model->table) &&!empty($model->table)) {
					
					return true;
					
				// Band does not exist, load band homepage
				} else {
					
					return false;
					
				}
		}
		
		
		
	}

?>