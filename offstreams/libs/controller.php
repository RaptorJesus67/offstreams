<?php

	class Controller {
		
		
		
		public function __construct($urlParams = array()) {
			
			// Call Global Functions
			global $conn;
			global $url;
			
			// Allow sub-controllers to use the url variable
			$this->url = $url;
			$this->urlParams = $urlParams;
			
			
			// If there is a parameter in the URL
			if (!empty($urlParams)) {
				
				# Check if File exists
				$this->fileExists($urlParams[0]);
				
			}
		}
		
		
		
		/**
		*
		*	Check if the page controller, model, and view exist
		*
		*	Called in constructor for the main controller
		*
		*	@load		.php		[Page Controller]
		*	@load		.php		[Page Model]
		*	@load		.php		[Page View]
		*	@return		class		[Load Controller for page]
		*
		*/
		public function fileExists($url) {
			
			# Make parameter lower in case entered wrong in URL
			$directory = strtolower($url);
			$class = $directory . "Controller";
			$file = "controller/" . $directory . "Controller.php";
			
			if (file_exists($file)) {
					
					require_once("controller/" . $directory . "Controller.php");
					require_once("model/" . $directory . "Model.php");
					require_once("view/" . $directory . "View.php");
					
					
					# Create instance of that class
					return $subController = new $class;
					
				
				# Homepage
				} else {
					
					require_once("controller/homeController.php");
					require_once("model/homeModel.php");
					require_once("view/homeView.php");
					
					return $subController = new homeController;
					
				}
			
		}
		
		
		
		/**
		*
		*	Loads the navigation for the page
		*
		*	Used in the page controller before template is loaded
		*
		*	@access	protected						
		*	@load		.php								[Navigation Main Controller]
		*	@example 	$this->loadNavigation() 	[Inside page controller]
		*
		*/
		protected function loadNavigation() {
			
			//////////////////////////////////////////////////////
			// INSTANCE NAVIGATION BEFORE PAGE LOAD //
			//////////////////////////////////////////////////////
			require_once(BASEPATH . "controller/navigationController.php");
			$nav = new navigationController;
			
		}
		
		
		
		
		// LOAD ALL APPS
		public function loadApp($location, $app = array()) {
			
			// DON'T LOAD UNDEFINED APPS
			if ($app == array()) {
				
				return false;
				
			}
			
			// LOAD ONLY IF ARRAY HAS TWO VALUES
			if (count($app) != 2) {
				
				return false;
				
			}
			
			require_once(BASEPATH . $location);
			$this->app[$app[0]] = new $app[1];
			
		}
		
		
		
		/**
		*
		*	Determine if the user is logged in
		*
		*	Tested as a boolean value in if statement to restrict access
		*
		*	@access	protected
		*	@return		boolean
		*
		*/
		protected function userIsLoggedIn() {
			
			// CHECK IF BOTH USERNAME AND HASH EXIST
			if (isset($_SESSION['username'], $_SESSION['user_hash'], $_SESSION['user_access'])) {
				
				// User is logged in
				return true;
			
			// User has no session variables, they are not logged in
			} else {
				
				return false;
				
			}
			
		}
		
		
		
		protected function isUserAdmin() {
			
			// Check if user is logged in
			if ($this->userIsLoggedIn()) {
				
				// Is user admin
				if ($_SESSION['user_access'] == "admin") {
					
					return true;
					
				// User is not admin
				} else {
					
					return false;
					
				}
				
			// User is not logged in
			} else {
				
				return false;
				
			}
			
		}
		
		
		
		/**
		*
		*	Check whether the user is logged in and on their page
		*
		*	Meant to be used in local page's controller
		*
		*	@access		protected	[used in the sub-controller]
		*	@param			string 		[url parameter of the user page]
		*	@return			boolean		[used to allow/prevent access]
		*
		*/
		protected function userLoggedInOnPage($url) {
			
			// User is logged in
			if ($this->userIsLoggedIn()) {
				
				// User is on their page and they are logged in
				if (strtolower($url) == strtolower($_SESSION['username'])) {
					
					return true;
					
				// User is logged in, but not on their page
				} else {
					
					return false;
					
				}
			
			// User is not logged in, prevent further access
			} else {
				
				return false;
				
			}
			
		}
		
		
		
		/**
		*
		*	Check whether the user is logged in, admin, and on their page
		*
		*	Meant to be used in local page's controller
		*
		*	@access		protected	[used in the sub-controller]
		*	@param			string 		[url parameter of the user page]
		*	@return			boolean		[used to allow/prevent access]
		*
		*/
		protected function adminLoggedInOnPage($url) {
			
			// User is logged in
			if ($this->userIsLoggedIn()) {
				
				// User is on their page and they are logged in
				if (strtolower($url) == strtolower($_SESSION['username'])) {
					
					if ($_SESSION['user_access'] == "admin") {
						
						return true;
						
					// User is not admin
					} else {
						
						return false;
						
					}
				
				// User is logged in, but not on their page
				} else {
					
					return false;
					
				}
				
			// User is not logged in
			} else {
				
				return false;
				
			}
		}
		
		
		
		/**
		*
		*	Check whether the user is logged in, editor, and on their page
		*
		*	Meant to be used in local page's controller
		*
		*	@access		protected	[used in the sub-controller]
		*	@param			string 		[url parameter of the user page]
		*	@return			boolean		[used to allow/prevent access]
		*
		*/
		protected function editorLoggedInOnPage($url) {
			
			// User is logged in
			if ($this->userIsLoggedIn()) {
				
				// User is on their page and they are logged in
				if (strtolower($url) == strtolower($_SESSION['username'])) {
					
					if ($_SESSION['user_access'] == "editor") {
						
						return true;
						
					// User is not editor
					} else {
						
						return false;
						
					}
				
				// User is logged in, but not on their page
				} else {
					
					return false;
					
				}
				
			// User is not logged in
			} else {
				
				return false;
				
			}
		}
		
		
		
		
	}

?>