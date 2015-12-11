<?php

	class Controller {
		
		
		/**
		*
		*	The constructor to load the sub-controller and page
		*
		*	Used in the bootstrap to load the main page
		*	being accessed by the URL.
		*
		*	@access			public			[Used in the bootstrap for the main page]
		*	^@param			array			[The URL parameters presented by the URL]
		*	@global			$conn			[The main database connection]
		*	@global			$url			[The URL presented by the user]
		*
		*/
		public function __construct($urlParams = array()) {
			
			// Call Global Functions
			global $conn;
			global $url;


			// Allow sub-controllers to use the url variable

			$this->url = $url->trimURL();
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
		*	@access			public			[Used in this constructor]
		*	@param			string			[The URL presented in constructor]
		*	@load			.php			[Page Controller]
		*	@load			.php			[Page Model]
		*	@load			.php			[Page View]
		*	@return			class			[Load Controller for page]
		*
		*/
		protected function fileExists($url) {
			
			# Make parameter lower in case entered wrong in URL
			$directory = strtolower($url);
			$class = $directory . "Controller";
			$file = BASE_INCLUDE . "controller/" . $directory . "Controller.php";
			
			if (file_exists($file)) {
				
				require_once(BASE_INCLUDE . "controller/" . $directory . "Controller.php");
				require_once(BASE_INCLUDE . "model/" . $directory . "Model.php");
				require_once(BASE_INCLUDE . "view/" . $directory . "View.php");
				
				
				# Create instance of that class
				return $subController = new $class;
				
			} else {
				
				require_once(BASEPATH . "includes/controller/homeController.php");
				require_once(BASEPATH . "includes/model/homeModel.php");
				require_once(BASEPATH . "includes/view/homeView.php");
				
				return $subController = new homeController;
				
			}
		}
		
		
		
		/**
		*
		*	Check to make sure the user viewing page is admin
		*
		*	Used in the controller to block/grant access to admin
		*	sensitive information
		*
		*	@access			protected			[used in sub-controller]
		*	@param			array				[$_SESSION variable user set]
		*	@return			boolean				[Return true or false if admin]
		*
		*/
		
		protected function isUserAdmin($admin) {
			
			// IF the admin variable isset
			if (isset($admin)) {
				
				// If Admin is isset, return true
				if ($admin == "admin") {
					
					return true;
					
				// Admin variable isn't admin; return false
				} else {
					
					return false;
					
				}
			
			// Admin variable not set, return false
			} else {
				
				return false;
				
			}
		
		}
		
		
		
		protected function loggedInOnPage($session, $page, $user) {
			
			if (isset($session['username'], $page) && $user == $session['username']) {
			
				return true;
				
			} else {
			
				return false;
				
			}
			
		}
		
		
		
		
		
		
		
		
		
	}

?>
