<?php

	class loginModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
			
		}
		
		
		
		public function doesUsernameExist($username) {
			
			$table = "users";
			$cols = array("username");
			$where = "`username` = '" . $username . "'";
			
			return $this->select($table, $cols, $where);
			
		}
		
		
		
		public function getPasswordHash($username) {
			
			$table = "users";
			$cols = array("user_password", "user_passHash", "user_access", "user_active");
			$where = "`username` = '" . $username . "'";
			
			return $this->select($table, $cols, $where);
			
		}
		
	}

?>
