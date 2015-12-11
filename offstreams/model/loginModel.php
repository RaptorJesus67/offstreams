<?php

	class loginModel extends Model {
		
		private $loginValues = array();
		
		public function __construct() {
			parent::__construct();
			
			
		}
		
		
		// MAIN LOGIN FUNCTION
		// CHECKS THE USER'S INFORMATION TO ALLOW LOGIN
		public function checkUser() {
			
			global $clean;
			
			
			// USER DIDN'T FILL IN BOTH FIELDS
			if ($this->bothFieldsFilled() == false) {
				
				// Create Error to send back
				$this->loginErrors[] = "blankFields";
				
				// Kill Function
				return false;
			}
			
			
			// LOOP THROUGH LOGIN VALUES
			foreach ($_POST as $key => $post) {
				
				// sanitize each login value
				$this->loginValues[$key] = $clean->sanitize($post);
				
			}
			
			// Check if username exists
			$this->queryUsername($this->loginValues);
			
			
			// If Username was a Match in the Database
			if ($this->validateUserExists){
				
				// Make simple array for validation
				$this->loginInfo = array("username" => $this->loginValues["username"],
												  "password" => $this->loginValues["password"],
												  "hash" => $this->table["users"]["user_hash"][0]);
				
				
				// Validate the Password now
				$this->validatePassword($this->loginInfo);
				
				// USER LOGGED IN CORRECTLY
				if ($this->userValidated && isset($this->table["users"]["user_access"])) {
					
					// Create Sessions
					$this->createUserSession($this->table["users"]);
					
					// User logged in, reset the session id
					session_regenerate_id(true);
					
					// Redirect User to their page
					header("Location: " . BASE_URI . "user/" . strtolower($_SESSION['username']));
					exit;
					
					
				// USER TYPED IN WRONG PASSWORD
				} else {
					
					$this->loginErrors[] = "wrongInfo";
					
					return false;
				}
				
			
			// USERNAME WAS NOT A MATCH
			} else {
				
				$this->loginErrors[] = "wrongInfo";
				
				return false;
			}
			
			
		}
		
		
		
		// QUERY THE USERNAME, RETURN THE HASH IF IT IS VALID
		private function queryUsername($loginVals) {
			
			
			$this->tableName = "users";
			$this->cols = array("user_hash");
			$this->where = " LOWER(`username`) = '" . strtolower($loginVals["username"]) . "'";
			
			return $this->validateUserExists = $this->select($this->tableName, $this->cols, $this->where);
			
		}
		
		
		
		// IF USERNAME EXISTS, CHECK HASHED PASSWORD AND USERNAME FOR EQUAL MATCHES
		// IN THE DATABASE
		private function validatePassword($loginVals) {

			global $clean;
			
			$this->name = "users";
			$this->cols = array("username", "user_id", "user_active", "user_access", "user_cookie");
			$this->where = " LOWER(`username`) = '" . strtolower($loginVals["username"]) . "' AND `user_password` = '" . 
									$clean->sha256($loginVals["password"], "no", $loginVals["hash"]) . "'";
									
			return $this->userValidated = $this->select($this->name, $this->cols, $this->where);
			
		}
		
		
		
		private function createUserSession($sessionVar) {
			
			// Loop through each column to give it a session variable
			foreach ($sessionVar as $sessKey => $sessValArray) {
				
				// Session variable is given a key equivalent to the column name and a value equal to the db value
				$_SESSION[$sessKey] = $sessValArray[0];
				
			}
			
			// End the method
			return false;
			
		}
		
		
		
		// USED AS A DOUBLE CHECKER FOR HTML MANIPULATION PREVENTION
		private function bothFieldsFilled() {
			
			// IF either username or password fields are filled; user needs both filled
			if (empty($_POST['username']) || empty($_POST['password'])) {
				
				return false;
				
			// user has both fields filled in, let them continue to next step
			} elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
				
				return true;
				
			
			// Prevent any possible errors from slipping through
			} else {
				
				return false;
				
			}
		}
		
	}

?>