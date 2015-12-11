<?php

	class userView extends View {
		
		public $imgSpecs;
		
		public function __construct($model, $url, $access, $action) {
			parent::__construct();
			
			global $image;
			
			// Call passed variables locally
			$this->model = $model;
			$this->url = $url;
			$this->access = $access;
			$this->action = $action;
			
			
			// Make model variable more user friendly
			$this->user = $this->model->table["users"];
			
			#echo $this->userImage();
			// Get image specs for centring image
			$this->imgSpecs = $image->centerImage($this->userImage(), 280, 280);
			
			
			// If visiting user page
			if (!empty($this->url[1])) {
				
				
				$template = BASEPATH . "templates/userTemplate.php";
				$this->loadUserPage($template);
				
			}
			
		}
		
		
		// LOAD USER PAGE
		protected function loadUserPage($template = null) {
			
			$this->render($template);
			
		}
		
		
		
		private function edit($template = BASEPATH . "templates/editUserFormTemplate.php") {
			
			$this->render($template);
			
		}
		
		
		
		// Clean way to insert other templates into page
		protected function loadActionTemplate() {
			
			if (isset($this->action)) {
				
				// If not false
				if ($this->action) {
					
					// Load method
					$this->{$this->action}();
				
				// Action is false
				} else {
					
					return false;
					
				}
			
			// Action has not been set
			} else {
				
				return false;
				
			}
			
		}
		
		
		
		/**
		*
		*	Creates the edit buttons for the user's page in the "user panel"
		*
		*	Used in the template for user page
		*
		*	@access		protected				[used in template]
		*	@param			string						[access variable provided in constructor]
		*	^@func			createEditButton()	[creates button for use based on parameters]
		*	^@echo			function					[echos "createEditButton()" to user]
		*	^@return		boolean					[returns false, if needed]
		*
		*/
		protected function userEditButtons($access) {
			
			// User is admin on self-page
			if ($access == "admin") {
				
				echo $this->createEditButton("Edit Page", "user/" . strtolower($_SESSION['username']) . "/edit");
				echo $this->createEditButton("Admin Panel", "admin");
				
			// User is an editor on self-page
			} elseif ($access == "editor") {
				
				echo $this->createEditButton("Edit Page", "user/" . strtolower($_SESSION['username']) . "/edit");
				echo $this->createEditButton("Editor Panel", "admin");
				
			// User is a member on self-page
			} elseif ($access == "member") {
				
				echo $this->createEditButton("Edit Page", "user/" . strtolower($_SESSION['username']) . "/edit");
				
			// User is a "visitor", display nothing
			} else {
				
				return false;
				
			}
			
		}
		
		
		
		/**
		*
		*	Creates the edit button for the users page in the "user panel"
		*
		*	Used in the "userEditButtons()" method within current class
		*
		*	@access		private		[used in "userEditButtons()" within class]
		*	@param			string			[Text to be displayed in the button]
		*	@return			string			[returns button HTML]
		*
		*/
		private function createEditButton($value, $redirect) {
			
			$button = "<a href='" . BASE_URI . "$redirect' class='editButtonLink'>
								<div class='editButtonContainer'>
									<button class='editButton'>
										$value
									</button>
							   </div>
							</a>";
						   
			return $button;
			
		}
		
		
		
		
		protected function editUserName() {
			
			// If user values exist
			if (isset($this->user)) {
				
				return "value='" . $this->user["user_name"][0] . "'";
			
			// You don gon fucked up			
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		
		
		// SOURCE FOR USER IMAGE
		protected function userImage() {
			
			$default = BASE_URI . "images/defaultPic.png";
			$userFile = "images/users/" . $this->user["user_image"][0];
			
			// USER HAS IMAGE OF VALUE
			if (!empty($this->user["user_image"][0])) {
				
				// If image in database is found in file registry
				if (file_exists(BASEPATH . $userFile)) {
					
					// return HTTP file link rather than system file link
					return BASE_URI . $userFile;
					
				// Prevent any possible database/file errors
				} else {
					
					return $default;
					
				}
				
			// RETURN STANDARD DEFAULT PIC
			} else {
				
				return $default;
				
			}
			
		}
		
		
		
		
		// STYLING FOR IMAGE
		protected function imgStyle() {
			
			$height = $this->imgSpecs["height"];
			$width = $this->imgSpecs["width"];
			$margin = $this->imgSpecs["margin"];
			
			$styles = "height: " . $height . "px; width: " . $width . "px; margin: " . $margin;
			return $styles;
			
		}
		
		
		
		// CREATE USER FIRST AND LAST NAME
		private function userFLName() {
			
			if (isset($this->user["user_name"])) {
				
				return $this->user['user_name'][0];
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		// DISPLAY USER LOCATION AS CITY, STATE, COUNTRY
		private function userLocation() {
			
			// Check if city exists
			if (isset($this->user["user_city"])) {
				
				$city = $this->user["user_city"][0];
				
			} else {
				
				$city = null;
				
			}
			
			// Check if state exists
			if (isset($this->user["user_state"])) {
				
				$state = $this->user["user_state"][0];
				
			} else {
				
				$state = null;
				
			}
			
			// Check if country exists
			if (isset($this->user["user_country"])) {
				
				$country = $this->user["user_country"][0];
				
			} else {
				
				$country = null;
				
			}
			
			$location = array($city, $state, $country);
			
			// Make sure each location has a value
			foreach ($location as $place) {
				
				// If user didn't enter value, skip it
				if (empty($place)) {
					
					continue;
					
				} else {
					
					$this->location[] = $place;
					
				}
				
			}
			
			
			// If user entered at least one part of their location
			if (!empty($this->location)) {
				
				$location = implode(", ", $this->location);
				return $location;
				
			} else {
				
				return null;
				
			}
			
			
		}
		
		
		
		// DISPLAY BIRTHDAY
		private function userBorn() {
			
			if (isset($this->user['user_birthday'])) {
				
				// Give function var for bday
				$bday = $this->user['user_birthday'][0];
				
				// User only inserted year
				if (strlen($bday) == 4) {
					
					return $bday;
					
				// User inserted month and year
				} elseif (strlen($bday) == 6) {
					
					// Process month and year
				
				// User inserted month, day, and year
				} elseif (strlen($bday) == 8) {
					
					$d = str_split($bday);
					// Month
					$date[] = $d[0] . $d[1];
					// Day
					$date[] = $d[2] . $d[3];
					// Year
					$date[] = $d[4] . $d[5] . $d[6] . $d[7];
					
					return implode("/", $date);
					
				// User didn't enter bday, or a crazy value was inserted somehow
				} else {
					
					return null;
					
				}
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		
		// DISPLAY USER'S GENDER
		private function userGender() {
			
			if (isset($this->user["user_gender"])) {
				
				return ucfirst($this->user["user_gender"][0]);
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		// MEMBER SINCE
		private function userCreated() {
			
			if (isset($this->user["user_created"])) {
				
				return date("M j, Y", $this->user["user_created"][0]);
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		
		// DISPLAY USER TYPE
		private function userType() {
			
			if (isset($this->user["user_access"])) {
				
				return ucfirst($this->user['user_access'][0]);
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		// DISPLAY USER BIO
		private function userBio() {
			
			if (isset($this->user["user_bio"])) {
				
				return $this->user["user_bio"][0];
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		// LIST OF INFO FOR THE USER
		protected function listUserInfo() {
			
			$infoArray = array($this->userFLName(), $this->userLocation(), $this->userBorn(), $this->userGender(),
										$this->userCreated(), $this->userType(), $this->userBio());
										
			$typeArray = array("Name:", "Location:", "Birthday:", "Gender:", "Member Since:", "Acc. Type", "Bio:");
			
			for ($i = 0; $i < count($infoArray); $i++) {
				
				echo $this->userInfoRow($typeArray[$i], $infoArray[$i], $i);
				
			}
			
		}
		
		
		
		// DISPLAY EACH ROW IN USER INFO
		protected function userInfoRow($type, $info, $iter) {
			
			// Create even and odd rows for coloring
			if ($iter % 2 == 0) {
				
				$class = "evenRow";
				
			} elseif ($iter % 2 == 1) {
				
				$class = "oddRow";
				
			}
			
			$row = 	"
						<p class='$class'>
							<span class='userInfoType left'>
								" . $type . "
							</span>
							<span class='userInfoData right'>
								" . $info . "
							</span>
						</p>
						";
						
			return $row;
			
		}
		
		
		
		/**
		*
		*	If the user has it already selected, make the gender appear as default
		*
		*	Used in the select box of user gender on "User Edit Page"
		*
		*	@access		protected			[use in template]
		*	@echo			string					[option "selected" value, or null]
		*
		*/
		protected function editUserGender() {
			
			if (isset($this->user["user_gender"])) {
				
				$gender = array("male", "female", "martian");
				
				// Loop through possible values
				foreach ($gender as $g) {
					
					// If the value is a match to user preference, return "selected"
					if ($g == $this->user["user_gender"][0]) {
						
						#echo "selected";
						
					// Value is not a match, echo null
					} else {
						
						continue;
						
					}
					
				}
				
				// None were a match, return null
				echo null;
				
			// Query didn't work, return null
			} else {
				
				echo null;
				
			}
			
		}
		
		
		
		protected function editFieldValue($field) {
			
			if (isset($this->user[$field])) {
				
				return "value='" . $this->user[$field][0] . "'";
				
			}
		}
		
		
		
	}

?>