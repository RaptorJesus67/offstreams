<?php

	class userModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
		}
		
		
		
		public function loadBasicUserInfo($username) {
			
			$table = "users";
			$cols = array("username", "user_fName", "user_lName", "user_city",
							"user_state", "user_country", "user_disLocation",
							"user_disName", "user_access", "user_image",
							"user_bDay", "user_gender");
			$where = "`username` = '" . $username . "'";
			
			return $this->select($table, $cols, $where);
			
		}
		
		
		
		public function ajaxUpdateProfile($ajax, $username) {
		
			$name = "users";
			$cols = array("user_fName", "user_lName", "user_city", "user_state",
						  "user_country", "user_bDay");
			
			$vals = array($ajax["fName"], $ajax["lName"], $ajax["city"], $ajax["state"],
						  $ajax["country"], $ajax["birthday"]);
			
			$where = "`username` = '" . $username . "'";
			
			return $this->update($name, $cols, $vals, $where);
			
		}
		
		
	}

?>
