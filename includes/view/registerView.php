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
		
		
		
	}

?>
