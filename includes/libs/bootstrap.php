<?php
	
	# Determine which page to use
	class Bootstrap {
		
		public function __construct($conn) {
			
			// Call Global Variables
			global $url;
			global $conn;
			
			// Call Instance of Controller
			$controller = new Controller($url->trimURL());
			
		}
		
	}

?>
