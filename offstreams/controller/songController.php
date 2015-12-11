<?php

	class songController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// CALL GLOBALS
			global $conn;
			
			// LOCAL VAR FOR URL
			$this->url = $this->url->trimURL();
			
			// NAVIGATION
			$this->loadNavigation();
			
			$this->model = new songModel($conn);
			
			$this->view = new songView($this->url);
			
			
			
		}
		
	}

?>