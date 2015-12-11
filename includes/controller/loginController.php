<?php

	class loginController {
		
		public function __construct() {
			
			//////////////////////////
			//		GLOBALS			//
			//////////////////////////
			global $url;
			global $conn;
			
			$this->conn = $conn;
			$this->url = $url->trimURL();
			
			// Load Model
			$this->model = new loginModel;
			
			
			// LOAD LOGIN INFO
			if (isset($_POST['login'])) {
			
				$this->checkIfLoginIsCorrect();
				
				// LOAD ONLY THE AJAX CODE
				return false;
				
			}
			
			
			
			// LOGIN PAGE
			
			$this->view = new loginView;
			
			
		}
		
		
		
		
		private function checkIfLoginIsCorrect() {
			
			global $clean;
			global $camel;
			
			// IF FORM WAS SUBMITTED CORRECTLY
			if (isset($_POST['login'])) {
				
				$user = $_POST['username'];
				$pass = $_POST['password'];
				
				
				// USERNAME EXISTS
				if ($this->model->doesUsernameExist($user)) {
				
					// GET THE PASSWORD HASHES
					$this->model->getPasswordHash($user);
					
					// Simplify array
					$user = $this->model->table["users"];
					$dbPass = $user["user_password"][0];
					$passHash = $user["user_passHash"][0];
					
					// Sha256 array
					$check = $clean->sha256($pass, "no", $passHash);
					
					// IF DATABASE PASS. IS EQUAL TO SHA256 HASHED PASSWORD
					if ($check == $dbPass) {
					
						// LOG THE USER IN
						$this->logUserIn($user);
						
						$page = $camel->camelCase("create", $user["username"][0]);
						
						header("Location: " . BASE_URI . "user/" . $page);
						
						return false;
						
					// PASSWORDS DO NOT MATCH
					} else {
						
						echo "Password is incorrect";
						return false;
						
					}
					
					
				// Username did not return	
				} else {
					
					echo "Username is incorrect";
					return false;
					
				}
				
			// FORM NOT SENT CORRECTLY, RETURN FALSE
			} else {
				
				"System is down, please try again later";
				return false;
				
			}
			
		}
		
		
		
		private function logUserIn($model) {
			
			$_SESSION['username'] = $model["username"][0];
			$_SESSION['access'] = $model["user_access"][0];
			$_SESSION['active'] = $model["user_active"][0];
			
			
		}
		
		
		
	}

?>
