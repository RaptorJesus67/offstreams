<?php

	class loginView extends View {
		
		public function __construct() {
			parent::__construct();
			
		
			$this->loadLoginPage();
			
		}
		
		
		
		private function loadLoginPage() {
			
			$title = "Login - Offstreams";
			$template = "loginTemplate.php";
			
			$this->loadPage($title, $template);
			
		}
		
	}

?>
