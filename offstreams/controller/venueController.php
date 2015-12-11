<?php

	class venueController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// CALL GLOBALS
			global $conn;
			
			// LOCAL VAR FOR URL
			$this->url = $this->url->trimURL();
			
			
			// NAVIGATION
			$this->loadNavigation();
			
			$this->model = new venueModel($conn);
			// Call all values from venue table
			$this->model->listAllVenues();
			
			$this->view = new venueView($this->model, $this->url);
			
			
			
		}
		
	}

?>