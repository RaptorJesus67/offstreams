<?php

	class bandController {
		
		public function __construct() {
		
			//////////////////////
			//	CALL GLOBALS	//
			//////////////////////
			global $conn;
			global $url;
			
			$this->url = $url->trimURL();
			$this->model = new bandModel;
			$this->view = new bandView;
			
			
			/////////////////////////////////
			// AJAX CALL FOR WIDGETS
			//
			//
			//
			//
			if (file_get_contents('php://input')) {
				
				// Set contents to $_POST variable
				$_POST = json_decode(file_get_contents('php://input'), true);
				
				
				//////////////////////////////////
				// IF THE BAND'S WIDGET IS LOADED
				//
				if (isset($_POST['loadBandWidget'])) {
					
					// LOAD BAND INFO
					$this->model->loadBandInfo("ajax", $_POST['bandId']);
					
					// LOAD WIDGET
					$ajax = $this->loadBandPageWidget($_POST['loadBandWidget']);
					
					
					echo json_encode($ajax);
					exit;
				
				
				
				//////////////////////////////////
				// Band Info
				//
				} elseif (isset($_POST['bandData'])) {
					
					
					$this->model->loadBandInfo("ajax", $_POST['bandId']);
					
					$ajax = $this->loadBandPageWidget("Band");
					
					echo json_encode($ajax);
					exit;
					
				
				///////////////////////////////////	
				// THERE IS NO WIDGET SENT
				//
				} else {
					
					return null;
					
				}
				
			
			/////////////////////////////////
			// IF THE BAND PAGE
			//
			//
			//
			//
			} elseif (isset($this->url[1])) {
			
				$this->model->loadBandInfo("single", $this->url[1]);
				
				$this->view->__loadModel($this->model);
				$this->view->loadBandPage($this->model, $this->url);
				
				
			////////////////////////////////
			// THE BAND HOME PAGE
			//
			//
			//
			//
			} elseif (isset($this->url[0])) {
				
				// Load Band Info
				$this->model->loadBandInfo();
				
				// List All Bands
				/* Design a page that lists all bands (up to fifty in grid view)
					And Allow users to disect bands based on input */
				$this->view->listAllBands($this->model->table["bands"]);
				
				// Actually load the page
				$this->view->loadBandHomepage();
				
			}
			
			
		}
		
		
		
		/**
		*
		*	The function loads widget information from the model and
		*	then arranges the info into an array that is moved to
		*	the controller and then encoded in json and sent to Angular
		*
		*	Used in the controller
		*
		*	@access				private				[Used in the constructor]
		*	@param				array				[$_POST variable for SQL table]
		*	@global				$zepp				[Used to convert DB information to standard lexicon]
		*	@return				array				[Return array to be used as json]
		*/
		private function loadBandPageWidget($name) {
				
			global $zepp;	
			
			//////////////////////////////////
			// Album Widget
			//
			if ($name == "Albums") {
				// LOAD MODEL INFORMATION
				$this->model->loadBPWidgetInfo($name, $this->model->table["bands"], "DESC");
				
				// RETURN IF NULL
				isset($this->model->table["albums"]) ? "" : null;
				
				// Simplify the model info
				$album = $this->model->table["albums"];
				
				// JSON ARRAY SETUP
				$array = array();
				for ($i = 0; $i < count($album['album_id']); $i++) {
					
					$array[$i] = array("id"			=> $album["album_id"][$i],
									 "name"			=> $album["album_name"][$i],
									 "image"		=> $album["album_image"][$i],
									 "type"			=> $album["album_type"][$i],
									 "label"		=> $album["album_label"][$i],
									 "year"			=> $this->view->albumReleased($album["album_release"][$i], "Y"),
									 "release"		=> $album["album_release"][$i]
									 );
					
				}
				
				// ADD NUMBER OF ALBUMS TO ARRAY FOR ANGULAR
				return $array;
			
			
				
			/////////////////////////////////
			//	VIDEOS WIDGET
			//
			} elseif ($name == "Videos") {
				
				// Load Video Information from the model
				$this->model->loadBPWidgetInfo($name, $this->model->table["bands"], "DESC");
				
				// RETURN IF NULL
				isset($this->model->table["band-videos"]) ? "" : null;
				
				$video = $this->model->table["band-videos"];
				
				$array = array();
				for ($i = 0; $i < count($video['bvideo_id']); $i++) {
					
					
					
					// Convert band name to Symbol Form
					$band = $zepp->zeppCode("zepp", "symbol", $video["bvideo_band"][$i]);
					
					$array[$i] = array("id"			=> $video["bvideo_id"][$i],
									 "name"			=> $video["bvideo_name"][$i],
									 "band"			=> $band,
									 "album"		=> $video["bvideo_album"][$i],
									 "link"			=> $video["bvideo_youtube"][$i],
									 "bID"			=> $video["band_id"][$i],
									 "aID"			=> $video["album_id"][$i],
									 "thumbnail"	=> $video["bvideo_thumbnail"][$i],
									 "linkID"		=> $video["bvideo_yt-ID"][$i]
									 );
					
				}
				
				// ADD NUMBER OF VIDEOS TO ARRAY FOR ANGULAR
				return $array;
				
			
				
			/////////////////////////////////
			//	BAND INFO FOR ANGULAR
			//
			} elseif ($name == "Band") {
				
				// RETURN IF NULL
				isset($this->model->table["bands"]) ? "" : null;
				
				// Simplifiy
				$band = $this->model->table["bands"];
				
					
				// Convert band name to Symbol Form
				$band_name = $zepp->zeppCode("zepp", "symbol", $band["band_name"][0]);
				
				$array[] =   array("id"				=> $band["band_id"][0],
								   "name"			=> $band_name,
								   "city"			=> $band["band_city"][0],
								   "state"			=> $band["band_state"][0],
								   "country"		=> $band["band_country"][0]
								 );
					
			
				return $array;
			
			}
			
		}
		
		
	}

?>
