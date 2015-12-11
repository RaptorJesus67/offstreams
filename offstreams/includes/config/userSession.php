<?php

	class userSession {
		
		public function __construct() {
			
			if (isset($_SESSION)) {
				
				// DO SESSION PROCESSING
				
			} else {
				
				return false;
				
			}
			
		}
	
		
	}

?>