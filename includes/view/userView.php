<?php

	class userView extends View {
		
		protected $createForm;
		
		
		/**
		*
		*	The view constructor for the user page
		*
		*	Loaded up in the user controller to establish
		*	base local variables
		*
		*	@access			public			[Used in the User Controller]
		*	@param			array			["$model"; the sql array values]
		*
		*/
		public function __construct($model, $url) {
			parent::__construct();
			
			// MODEL INFO
			$this->model = $model;
			
			// URL INFO
			$this->url = $url;
			
			// USER INFO
			$this->user = $this->model->table["users"];
			
			
		}
		
		
		
		public function loadUsersPage($pgTitle, $template = "userTemplate.php") {
			
			$title = $pgTitle . " - Offstreams";
			
			$this->loadPage($title, $template);
			
		}
		
		
		
		/**
		*
		*	The HTML <img> tag for the template
		*
		*	Used in the template page for the user info widget
		*
		*	@access			protected			[The user image for the template]
		*	@return			string				[Returns the HTML <img> or null]
		*
		*/
		protected function userImage() {
			
			if (isset($this->user["user_image"][0])) {
				
				$image = "<img src='" . BASE_URI . "images/users/" . $this->user["user_image"][0] . "' class='userProfilePicture' />";
				return $image;
				
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		protected function nameDisplay() {
			
			// If user image display exists
			if (isset($this->user["user_disName"][0])) {
				
				if ($this->user["user_disName"][0] == 1) {
					
					$info = $this->user["user_fName"][0] . " " . $this->user["user_lName"][0];
				
					return $info;
				
				// User Display Name is off	
				} else {
					
					return null;
					
				}
			
			// User image display was not loaded; return null	
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		
		protected function locationDisplay() {
			
			// If user image display exists
			if (isset($this->user["user_disLocation"][0])) {
				
				if ($this->user["user_disLocation"][0] == 1) {
					
					$in["city"] = $this->user["user_city"][0];
					$in["state"] = $this->user["user_state"][0];
					$country = ($this->user["user_country"][0] == "United States") ? null : $this->user["user_country"][0];
					
					// If Country is not Null
					if ($country != null) {
					
						$in["country"] = $country;
						
					}
					
					$location = implode(", ", $in);
					
					return $location;
				
				// User Display Name is off	
				} else {
					
					return null;
					
				}
			
			// User image display was not loaded; return null	
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		protected function editFormUser() {
			
			// SET UP FORM INFO
			// START <FORM>
			$action = BASE_URI . "user/" . $this->url[1] . "/change";
			
			// CREATE FORM
			$this->createForm = $this->createForm($action, "post", array("class" => "userEditProfileForm"));
			
			// FIRST NAME INPUT
			$this->inputFName = $this->createInput(array("type" 		=> "text",
														 "ng-model"		=> "profile.fName",
														 "name" 		=> "fName",
														 "class" 		=> "inputBox",
														 "id" 			=> "fName",
														 "placeholder"	=> "First Name"));
											  
			$this->inputLName = $this->createInput(array("type"			=> "text",
														 "name"			=> "lName",
														 "class"		=> "inputBox",
														 "id"			=> "lName",
														 "placeholder"	=> "Last Name"));
														 
			$this->inputCity  = $this->createInput(array("type"			=> "text",
														 "name"			=> "uCity",
														 "class"		=> "inputBox",
														 "id"			=> "uCity",
														 "placeholder"	=> "City"));
														 
			$this->inputState = $this->createSelect(array("class"		=> "selectBox",
														  "values"		=> $this->stateSelectList(),
														  ));
														  
			$this->inputCountry = $this->createSelect(array("class"		=> "selectBox",
														    "values"	=> $this->countrySelectList(),
														   ));
			
			
			
			
			// END </FORM>
			$this->endForm = $this->endForm();
			
		}
		
		
		
		
		protected function userInfoPanel() {
			
			$info = array("Name" => $this->nameDisplay(), 
						  "Location" => $this->locationDisplay(),
						  "Acc. Type" => ucfirst($this->user["user_access"][0]));
			
			$image = $this->user["user_image"][0];
			
			return $this->profileInfoWidget("standard", $info, $image);
			
		}
		
		
		
		protected function endUserInfoPanel() {
			
			return "</div>";
			
		}
		
	}

?>
