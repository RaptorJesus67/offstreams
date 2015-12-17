<?php

	class registerController {
	
		public function __construct() {
			
			//////////////////////
			//		GLOBALS		//
			//////////////////////
			global $url;
			
			$this->url = $url->trimURL();
			$this->model = new registerModel;
			
			
			if (isset($_POST['regData'])) {
				
				echo "AJAX CALL";
				
			} else {
			
			
				$this->view = new registerView;
				$this->view->loadRegisterPage();
				
			}
		
		}
	
	}

?>
