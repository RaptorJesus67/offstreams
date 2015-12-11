<?php

	class genreController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// CALL GLOBALS
			global $conn;
			
			// LOCAL VAR FOR URL
			$this->url = $this->url->trimURL();
			
			// NAVIGATION
			$this->loadNavigation();
			
			$this->model = new genreModel($conn);
			
			$this->view = new genreView($this->url);
			
			
			
		}
		
	}

?>