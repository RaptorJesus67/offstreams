<?php

	class loginController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			
			// GLOBAL CONNECTIONS
			global $conn;
			global $zepp;
			global $camel;
			
			
			// LOAD NAVIGATION
			$this->loadNavigation();
			
			// Instantiate model
			$this->model = new loginModel($conn);
			
			
			// Grab the info for the current page inside of the band's directory
			// User submitted form
			if (isset($_POST['username'], $_POST['password'])) {
				$this->model->checkUser($_POST);
			}
			
			
			// Create View
			// Pass it only the table results
			$view = $this->createView($this->model, $_POST);
			
		}
		
		
		
		// LOAD THE VIEW MODULE FOR BAND PAGE
		private function createView($model, $url) {
			
			return $view = new loginView($model, $url);
			
		}
		
		
	}

?>