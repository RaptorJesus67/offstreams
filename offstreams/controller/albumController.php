<?php

	class albumController extends Controller {
		
		// ALBUM NAVIGATION
		public function __construct() {
			parent::__construct();
			
			// CALL GLOBALS
			global $conn;
			
			
			// LOAD NAVIGATION
			$this->loadNavigation();
			
			
			// LOAD URL ARRAY
			$this->url = $this->url->trimURL();
			
			
			// INSTANTIATE MODEL
			$this->loadModule("model", $conn);
			
			
			// DOES THE PAGE NOT EXIST, DEFAULT TO NOTHING
			if (!isset($this->url[1])) {
				$this->url[1] = null;
			}
			
			// LOAD ALBUM LIST
			$this->albums = $this->model->loadAlbumsList($this->url[1]);
			
				
			// LOAD VIEW
			$this->loadModule("view", null, $this->model, $this->url);
			
			
		}
		
		
		
		// LOAD MODEL
		private function loadModule($type, $conn = null, $model = null, $url = null) {
			
			// IF THE FIRST PARAMETER ISSET (PROBABLY BAND PAGE), 
			// LOAD IN MODEL SINCE IT ISN'T PRELOADED
			if (isset($this->url[1])) {
				
				require_once($type . "/album" . ucfirst($type) . ".php");
				
			}
			
			// CREATE THE LOCAL INSTANCE OF MODEL
			switch ($type) {
				
				case "model":
					$this->model = new albumModel($conn);
					break;
				
				case "view":
					$this->model = new albumView($model, $url);
					break;
					
				default:
					return "Incorrect type given";
					break;
				
			}
			
			
		}
		
	}

?>