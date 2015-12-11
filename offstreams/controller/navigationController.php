<?php

	class navigationController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// IN CASE USER IS ACCESSING NAVIGATION DIRECTORY DIRECTLY
			if ($this->url->trimURL()[0] == "navigation") {
				header("Location: " . BASE_URI);
			}
			
			require_once(BASEPATH . "model/navigationModel.php");
			require_once(BASEPATH . "view/navigationView.php");
			
			$this->model = new navigationModel;
			
			$this->createNav();
			$this->view = new navigationView($this->model);
			#echo "Bands | Albums | Songs | Genres | Locations | Venues | About";
			
		}
		
		
		
		public function createNav() {
			
			$this->model->queryNav(); 
			
			
		}
		
	}

?>