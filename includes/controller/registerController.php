<?php

	class registerController {
	
		public function __construct() {
			
			//////////////////////
			//		GLOBALS		//
			//////////////////////
			global $url;
			
			$this->url = $url->trimURL();
			$this->model = new registerModel;
			
			
			/////////////////////////////
			//	AJAX CALL
			//
			// Form Submitted
			if (isset($_POST['regData'])) {
				
				echo "AJAX CALL";
				exit;
			
			/////////////////////////////
			//	AJAX CALL
			//
			//	Does Post variable equal certain input box
			} else if (isset($_POST['username'])) {
				
				echo json_encode($this->usernameCheck($_POST['username']));
				exit;
				
			/////////////////////////////
			//	LOAD PAGE
			//
			//	Load Page normally
			} else {
			
			
				$this->view = new registerView;
				$this->view->loadRegisterPage();
				
			}
		
		}
		
		
		
		private function usernameCheck($post) {
			
			$view = new registerView;
			
			// Username exists
			if ($this->model->doesUsernameExist($post)) {
			
				return $view->registerMessage("userExists");
				
			} else if (!empty($post)) {
				
				return $view->registerMessage("userDoesntExist");
				
			} else {
			
				return null;
				
			}
			
		}
		
		
		
	
	}

?>
