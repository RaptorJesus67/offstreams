<?php

	class userController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// GLOBAL VARIABLES
			global $conn;
			
			
			//////////////////////////////////////////////////////
			// INSTANCE NAVIGATION BEFORE PAGE LOAD //
			//////////////////////////////////////////////////////
			require_once("navigationController.php");
			$nav = new navigationController;
			
			
			// CALL UPON MODEL
			$this->model = new userModel($conn);
			
			
			// Call the URL VALUES from MainController
			$this->url = $this->url->trimURL();
			
			
			// Query the user if the username is set in the url
			if (isset($this->url[1])) {
				
				$this->model->getUserInfo($this->url[1]);
				
			}
			
			
			// DETERMINE USER ACCESS TO A MEMBER PAGE
			// return "$this->access"
			$this->grantUserAccess($this->url[1]);
			
			
			// If Action is set, load function in view
			if (isset($this->url[2])) {
				
				$this->userAction = $this->url[2];
				
			} else {
				
				$this->userAction = false;
				
			}
			
			// RENDER THE PAGE AFTER MODEL CALLS
			$view = new userView($this->model, $this->url, $this->access, $this->userAction);
			
			
		}
		
		
		
		/**
		*
		*	Used in constructor to set variable
		*
		*	To be sent to View to grant access
		*
		*	@access		private		[use is only in this class]
		*	@param			string			[user "page" set in URL]
		*	@return			string			["$this->access"; used in view to control access]
		*
		*/
		private function grantUserAccess($url) {
			
			// Admin on self-page
			if ($this->adminLoggedInOnPage($url)) {
				
				return $this->access = "admin";
				
			// Editor on self-page
			} elseif ($this->editorLoggedInOnPage($url)) {
				
				return $this->access = "editor";
			
			// Member on self-page
			} elseif ($this->userLoggedInOnPage($url)) {
				
				return $this->access = "member";
			
			// User on user-page without any edit abilities
			} else {
				
				return $this->access = "visitor";
				
			}
			
		}
		
	}

?>