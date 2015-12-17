<?php

	class registerModel extends Model {
	
		public function __construct() {
			parent::__construct();
			
		
		}
	
	
	
		public function doesUsernameExist($user) {
		
			$table = "users";
			$cols = array("username");
			$where = "`username` = '" . $user . "'";
			
			return $this->select($table, $cols, $where);
			
		}
	
	}

?>
