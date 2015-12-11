<?php

	class loginView extends View {
		
		public $loginError;
		
		public function __construct($model, $url) {
			parent::__construct();
			
			// Allow local use of global variables
			$this->url = $url;
			$this->model = $model;
			
			
			
			// Possible Login Errors
			if (isset($this->model->loginErrors)) {
				$this->translateLoginErrors($this->model->loginErrors);
			// Prevent errors in template
			} else {
				$this->loginError = null;
			}
			
			// Load Login Page
			$template = BASEPATH . "templates/loginTemplate.php";
			$this->loadLoginTemplate($template);
			
			
		}
		
		
		
		public function loadLoginTemplate($template) {
			
			$this->render($template);
			
		}
		
		
		
		protected function translateLoginErrors($errors) {
			
			for ($i = 0; $i < count($errors); $i++) {
				
				if ($errors[$i]) {
					
					if ($errors[$i] == "blankField") {
						
						$this->loginError[] = "Fields are Blank";
						
					}
					if ($errors[$i] == "wrongInfo") {
						
						$this->loginError[] = "Username or Password is incorrect";
						
					}
					
				} else {
					
					$this->loginError = null;
					
				}
				
			}
			
			return $this->loginError;
			
		}
		
		
		protected function displayLoginErrors($errors) {
			
			if ($errors) {
				
				foreach ($errors as $error) {
					
					$errorBox = "<div class='errorBox'>$error</div>";
					echo $errorBox;
					
				}
				
			}
			
		}
		
		
	}

?>