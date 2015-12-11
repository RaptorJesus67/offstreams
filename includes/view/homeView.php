<?php

	class homeView extends View {

		public function __construct() {
			parent::__construct();
			
			$this->loadHomePage();
			
		}
		
		private function loadHomePage() {
			
			$title = "Offstreams - Discover Your Next Favorite Band";
			
			$this->loadPage($title);
			
		}
		
	}

?>
