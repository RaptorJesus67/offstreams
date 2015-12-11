<?php

	class labelController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// CALL GLOBALS
			global $conn;
			
			// LOCAL VAR FOR URL
			$this->url = $this->url->trimURL();
			
			// NAVIGATION
			$this->loadNavigation();
			
			$this->model = new labelModel($conn);
			
			$this->view = new labelView($this->url);
			
			
			
		}
		
	}

?>