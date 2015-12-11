<?php

	class logoutController {
		
		public function __construct() {
			
			$this->unsetSession();
			
		}
		
		
		
		private function unsetSession() {
			
			foreach ($_SESSION as $iter => $sess) {
			
				unset($_SESSION[$iter]);
				
			}
			
			
			header("Location: " . BASE_URI);
			exit;
			
		}
		
		
	}

?>
