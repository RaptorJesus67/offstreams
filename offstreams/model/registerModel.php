<?php

	class registerModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
		}
		
		
		// MAIN FUNCTION FOR TESTING
		public function checkUserRegistration() {
			
			// Call global functions
			global $clean;
			
			
			// Reset errors on each load of page
			$this->regErrors = null;
			
			// CHECK ALL FIELDS ARE FILLED TO PREVENT HTML MANIPULATION
			if ($this->allFieldsFilled() == false) {
				
				$this->regErrors[] = "emptyFields";
				
				return false;
				
			} else {
				
				// Set local variables from post variables since they already are set
				$this->username = $_POST['username'];
				$this->email = $_POST['emailAddress'];
				$this->password = $_POST['password'];
				$this->confirm = $_POST['confirmPass'];
				
			}
			
			
			// CHECKS IF USERNAME IS ALLOWED
			if ($this->isUsernameAllowed() == false) {
				
				return false;
				
			}
			
			
			// QUERY USERNAME AND SEE IF IT EXISTS ALREADY
			if ($this->doesUsernameExist($this->username)) {
				
				$this->regErrors[] = "usernameTaken";
				
				return false;
				
			}
			
			
			// QUERY EMAIL AND SEE IF IT EXISTS ALREADY
			if ($this->doesEmailExist($this->email)) {
				
				$this->regErrors[] = "emailRegistered";
				
				return false;
				
			}
			
			
			// CHECK IF PASSWORD FITS CRITERIA
			if ($this->isPasswordAllowed($this->password) == false) {
				
				$this->regErrors[] = "passNotAllowed";
				
				return false;
				
			}
			
			
			// CHECK IF BOTH PASSWORDS ENTERED MATCH
			if ($this->password == $this->confirm) {
				
				#echo "Both passwords are allowed and equal the glorious requirements";
				
			} else {
				
				$this->regErrors[] = "passMatch";
				
				return false;
				
			}
			
			
			// GET ELEMENTS READY FOR INSERTION
			$this->userHash = $clean->randString(32);
			$this->userCookie = $clean->randString(32);
			$this->userActiveHash = $clean->randString(32);
			$this->userAccess = "member";
			$this->userActive = "unactive";
			$this->userCreated = time();
			$this->password = $clean->sha256($this->password, "no", $this->userHash);
			
			$values = array($this->username, $this->password, $this->email, $this->userCreated, $this->userHash,
									$this->userActive, $this->userAccess, $this->userCookie, $this->userActiveHash);
			
			
			// Upload User information into the database
			// If it returns true, send user back to homepage
			if ($this->registerUser($values)) {
				
				header("Location: " . BASE_URI);
				exit;
				
			} else {
				
				$this->regErrors[] = "connection";
				
				return false;
				
			}
			
			
		}
		
		
		
		// CHECKS IF THE USER FILLED IN ALL FIELDS
		private function allFieldsFilled() {
			
			// Return true if all fields are filled in
			if (isset($_POST['username'], $_POST['emailAddress'], $_POST['password'], $_POST['confirmPass'])) {
				
				// All fields have a value
				if (!empty($_POST['username']) && !empty($_POST['emailAddress']) && !empty($_POST['password']) && !empty($_POST['confirmPass'])) {
				
					return true;
				
				// User did not fill in all fields
				} else {
					
					return false;
					
				}
			
			// User has not submitted form
			} else {
				
				return false;
				
			}
		}
		
		
		
		// CHECK IF USERNAME FITS CRITERIA TO BE ALLOWED ACCESS
		private function isUsernameAllowed() {
			
			global $purifier;
			
			// If username exists
			if (isset($this->username)) {
				
				// Prevent code as a username
				$this->username = $purifier->purify($this->username);
				
				// Use regex to prevent anything that is not alphanumeric
				if (ctype_alnum($this->username)) {
					
					// Check if username is at least 6 characters and no more than 20
					if (strlen($this->username) >= 6 && strlen($this->username) <= 20) {
						
						return true;
					
					// Username is too short or too long
					} else {
						
						$this->regErrors[] = "wrongLen";
						
						return false;
						
					}
					
				// Name contains something that is not alphanumeric
				} else {
					
					$this->regErrors[] = "notAlphanumeric";
					
					return false;
					
				}
			
			// Return false as security measure
			} else {
				
				return false;
				
			}
			
		}
		
		
		
		// CHECK IF USERNAME ALREADY EXISTS BY QUERYING IT
		private function doesUsernameExist($username) {
			
			$this->name = "users";
			$this->cols = array("username");
			$this->where = " LOWER(`username`) = '" . strtolower($username) . "'";
			
			$this->userAvailable = $this->select($this->name, $this->cols, $this->where);
			
			// If Username exists, return true; else return false
			return $this->userAvailable;
			
		}
		
		
		
		// CHECK IF EMAIL IS ALREADY REGISTERED BY QUERYING IT
		private function doesEmailExist($email) {
			
			$this->name = "users";
			$this->cols = array("user_email");
			$this->where = " LOWER(`user_email`) = '" . strtolower($email) . "'";
			
			$this->emailAvailable = $this->select($this->name, $this->cols, $this->where);
			
			// If Username exists, return true; else return false
			return $this->emailAvailable;
			
		}
		
		
		
		// CHECK IF PASSWORD FITS ALL CRITERIA NEEDED
		private function isPasswordAllowed($password) {
			
			// If password is less than 8 or larger than 32 characters, return false
			if (strlen($password) >= 8 && strlen($password) <= 32) {
				
				// Password contains at least two characters (Case insensitive)	
				if (preg_match("/[A-Z]{2}/i", $password)) {
					
					// Password doesn't contain at least one uppercase or one lowercase
					if ($password == strtolower($password) || $password == strtoupper($password)) {
						
						return false;
						
					// Password contains at least one uppercase and one lowercase character
					} else {
						
						// Password contains at least one number
						if (preg_match("/[0-9]{1}/", $password)) {
							
							// CHECK TO SEE IF IT IS EQUAL TO USERNAME OR PASSWORD
							if (strtolower($password) == strtolower($this->username) || strtolower($password) == strtolower($this->email)) {
								
								$this->regErrors[] = "passwordUsernameEmail";
								
								return false;
							
							// IT'S GLORIOUS! USER PASSWORD HAS PASSED ALL OF THE CHALLENGES TO GET THROUGH
							} else {
								
								return true;
								
							}
							
						// Password has no numbers
						} else {
							
							return false;
							
						}
					}
					
				// Password doesn't contain at least two characters
				} else {
					
					return false;
					
				}
			
			// Password too big or too small			
			} else {
				
				return false;
				
			}
		}
		
		
		
		// INSERT USER DATA INTO THE DATABASE
		private function registerUser($values = array()) {
			
			$this->name = "users";
			$this->cols = array("username", "user_password", "user_email", "user_created", "user_hash", 
										"user_active", "user_access", "user_cookie", "user_activeHash");
			$this->vals = $values;
			$this->where = null;
			
			return $this->insert($this->name, $this->cols, $this->vals, $this->where);
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}

?>