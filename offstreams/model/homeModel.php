<?php

	class homeModel extends Model {
		
		public function __construct() {
			
			global $conn;
			
			parent::__construct($conn);
			
		}
		
	}

?>