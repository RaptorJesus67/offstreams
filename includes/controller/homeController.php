<?php

	class homeController extends Controller {

		public function __construct() {
			
			global $conn;
			
			$this->model = new homeModel($conn);
			$this->view = new homeView;
			
			
		}
		
	}

?>
