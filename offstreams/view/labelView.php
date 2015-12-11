<?php

	class labelView extends View {
		
		public function __construct() {
			parent::__construct();
			
			// LOAD SONG PAGE
			$this->loadLabelPage();
			
		}
		
		
		
		private function loadLabelPage($template = BASEPATH . "templates/labelTemplate.php") {
			
			$this->render($template);
			
		}
		

	}

?>