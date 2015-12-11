<?php

	class aboutView extends View {
		
		public function __construct() {
			parent::__construct();
			
			// LOAD SONG PAGE
			$this->loadAboutPage();
			
		}
		
		
		
		private function loadAboutPage($template = BASEPATH . "templates/aboutTemplate.php") {
			
			$this->render($template);
			
		}
		

	}

?>