<?php

	class locationController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// CALL GLOBALS
			global $conn;
			
			// LOCAL VAR FOR URL
			$this->url = $this->url->trimURL();
			
			// NAVIGATION
			$this->loadNavigation();
			
			// LOAD MODEL MODULE
			$this->model = new locationModel($conn);
			
			
			// DETERMINE WHICH TO QUERY
			$this->queryInfo();
			
			
			// LOAD VIEW
			$this->view = new locationView($this->model, $this->url);
			
			// City
			if (isset($this->url[2])) {
				
				// If city does not exist
				if ($this->view->doesCityExist() == false) {
					
					// If country/state does not exist
					if ($this->view->doesStateExist($this->url[1]) == false) {
						
						// Load default page
						$this->view->render(BASEPATH . "templates/locationTemplate.php");
					
					// State/Country does exist, city doesn't
					} else {
						
						$this->view->render(BASEPATH . "templates/locationCountry.php");
						
					}
					
				// City does exist
				} else {
					
					$this->view->render(BASEPATH . "templates/locationCity.php");
					
				}
				
				$this->view->render(BASEPATH . "templates/locationCity.php");
			
			// State/Country			
			} elseif (isset($this->url[1])) {
				
				$this->view->render(BASEPATH . "templates/locationCountry.php");
				
			// Main Page
			} else {
				
				$this->view->render(BASEPATH . "templates/locationTemplate.php");
				
			}
			
			
			
			
			
		}
		
		
		
		
		private function queryInfo() {
			
			if (isset($this->url[2])) {
				
				$this->model->pullCityInfo($this->url);
				
			} elseif (isset($this->url[1])) {
				
				$this->model->pullStateInfo($this->url);
				
			} else {
				
				$this->model->listAllLocations();
				
			}
			
		}
		
	}

?>