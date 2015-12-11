<?php

	class genreView extends View {
		
		public function __construct() {
			parent::__construct();
			
			// LOAD SONG PAGE
			$this->loadGenrePage();
			
		}
		
		
		
		private function loadGenrePage($template = BASEPATH . "templates/genreTemplate.php") {
			
			$this->render($template);
			
		}
		

	}

?>