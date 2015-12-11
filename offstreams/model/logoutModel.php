<?php

	class logoutModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			if (isset($_SESSION['username'])) {
				
				foreach ($_SESSION as $key => $value) {
					
					unset($_SESSION[$key]);
					session_regenerate_id(true);
					
				}
				
				
				header("Location: " . BASE_URI);
				exit;
				
			}
			
		}
		
	}

?>