<?php

	class registerView extends View {
		
		public $post;
		public $regError;
		
		public function __construct($model) {
			parent::__construct();
			
			// Make included parameters locally available
			$this->model = $model;
			
			
			// Possible Registration Errors
			if (isset($this->model->regErrors)) {
				
				// Translate error code into readable message
				$this->translateRegErrors($this->model->regErrors);
				
			// Prevent errors in template
			} else {
				
				$this->regError = null;
				
			}
			
			
			// Check if post variables exist and allow them in the template error free
			$this->retainInfo();
			
			
			$template = BASEPATH . "templates/registerTemplate.php";
			$this->loadRegisterTemplate($template);
			
			
		}
		
		
		private function loadRegisterTemplate($template) {
			
			$this->render($template);
			
		}
		
		
		
		// Display previously entered information on page reload if piece of info is not permitted
		private function retainInfo() {
			
			if (isset($_POST['emailAddress'], $_POST['username'])) {
				$postArray = array("username" => $_POST["username"], "emailAddress" => $_POST["emailAddress"]);
				
				foreach ($postArray as $key => $val) {
					
					$this->post[$key] = $val;
					
					// If there is info in the post
					if (!empty($this->post[$key])) {
						
						$this->post[$key];
						
					} else {
						
						$this->post[$key] = null;
						
					}
				}
			} else {
				
				$postArray = array("username" => null, "emailAddress" => null);
				foreach ($postArray as $key => $val) {
					
					$this->post[$key] = $val;
					
				}
				
			}
			
			return $this->post;
			
		}

		
		
		// TRANSLATE REGISTRATION ERRORS TO DISPLAY THEM TO THE SCREEN
		protected function translateRegErrors($errors) {
			
			$errorArray = array("emptyFields" => "All Fields Need To Be Entered",
										"usedCode" => "Haha! Nice try, but no code allowed... you sneaky bastard",
										"notAlphanumeric" => "Username Must Contain Only Letters Or Numbers",
										"wrongLen" => "Username Has To Be Between 6 And 20 Characters Long",
										"usernameTaken" => "Username Has Already Been Taken",
										"emailRegistered" => "An Account With This Email Already Exists",
										"passNotAllowed" => "Password Needs To Be Between 8 And 32 Characters <br/> And Contain An Uppercase Letter, A Lowercase Letter, And A Number",
										"passwordUsernameEmail" => "Password Cannot Equal Username Or Email",
										"passMatch" => "Passwords Do Not Match",
										"connection" => "We Are Currently Unable To Process Your Info At This Time");
			
			for ($i = 0; $i < count($errors); $i++) {
				
				// Check if error exists
				if ($errors[$i]) {
					
					foreach ($errorArray as $type => $message) {
						
						// If error matches one of the types, set the message to an array
						if ($errors[$i] == $type) {
						
							$this->regError[] = $message;
							
						// Error doesn't match the type
						} else {
							
							continue;
							
						}
						
					}
					
					
				// There are no errors present	
				} else {
					
					$this->regError = null;
					
				}
				
			}
			
			return $this->regError;
			
		}
		
		
		
		protected function displayRegErrors($errors) {
			
			
			if ($errors) {
				
				foreach ($errors as $error) {
					
					$errorBox = "<div class='errorBox'>$error</div>";
					echo $errorBox;
					
				}
				
			}
			
		}
			
		
		
	}

?>