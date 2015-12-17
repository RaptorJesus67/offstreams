<?php

	class registerView extends View {
	
		public function __construct() {
			parent::__construct();
		
			
		}
	
	
	
		public function loadRegisterPage() {
			
			$title = "Register - Offstreams";
			$template = "registerTemplate.php";
			
			$this->loadPage($title, $template);
			
		}
		
		
		
		public function registerMessage($message) {
			
			switch($message) {
			
				case "userExists":
					return array("class" => "errorMessage", 
								"text" => "Username Exists!");
					break;
					
				case "userDoesntExist":
					return array("class" => "cleanMessage", 
								"text" => "Username Available");
					break;
					
				default:
					return null;
					break;
				
			}
			
		}
		
		
	}

?>
