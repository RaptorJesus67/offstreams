<?php

	class registerController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			global $conn;
			
			// LOAD NAVIGATION
			$this->loadNavigation();
			
			$this->model = new registerModel($conn);
			
			
			// If user submitted registration form
			if (isset($_POST['username'], $_POST['emailAddress'], $_POST['password'], $_POST['confirmPass'])) {
				$this->model->checkUserRegistration();
			}
			
			$this->view = new registerView($this->model);
			
			
		}
		
		
		
	}

?>