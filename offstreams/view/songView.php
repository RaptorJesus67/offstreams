<?php

	class songView extends View {
		
		public function __construct() {
			parent::__construct();
			
			// LOAD SONG PAGE
			$this->loadSongPage();
			
		}
		
		
		
		private function loadSongPage($template = BASEPATH . "templates/songTemplate.php") {
			
			$this->render($template);
			
		}
		

	}

?>