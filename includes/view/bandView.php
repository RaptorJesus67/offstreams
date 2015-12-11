<?php

	class bandView extends View {
		
		protected $band_name;
		
		public function __construct() {
			parent::__construct();
		
			$this->band_name = null;
		}
	
		
		
		// LOCALIZE MODEL INFO
		public function __loadModel($model) {
			
			$this->model = $model;
			$this->band = $this->model->table["bands"];
			
		}
		
		
		
		// LOAD BAND HOMEPAGE
		public function loadBandHomepage() {
			
			$title = "Bands - Offstreams";
			$temp = "bandHomepageTemplate.php";
			
			return $this->loadPage($title, $temp);
			
		}
		
		
		
		//////////////////////////////
		//	LOAD SINGLE BAND PAGE
		//
		//
		//
		//
		public function loadBandPage($model, $url) {
			
			global $zepp;
			
			$title = $zepp->zeppCode("zepp", "symbol", $model->table["bands"]["band_name"][0]);
			$temp = "bandTemplate.php";
			
			// SET BAND NAME
			$this->band_name = $title;
			
			
			return $this->loadPage($title . " - Offstreams", $temp);
			
		}
		
		
		
		
		public function listAllBands($bands) {
			
			global $zepp;
			global $camel;
			
			if (!empty($bands)) {
				
				foreach ($bands["band_name"] as $band) {
					
					$this->band[] = $zepp->zeppCode("zepp", "symbol", $band);
					$this->href[] = $camel->camelCase("create", $zepp->zeppCode("zepp", "string", $band));
					
				}
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		
		public function albumReleased($date, $regex) {
			
			return $this->convertNumToYear($date, $regex);
			
		}
		
		
	}

?>
