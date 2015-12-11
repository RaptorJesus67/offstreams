<?php

	class userModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
		}
		
		
		public function getUserInfo($url) {
			
			$this->name = "users";
			
			$this->cols = array("username", "user_name", "user_city", "user_state", "user_country",
										"user_birthday", "user_gender", "user_image", "user_bio", "user_created", "user_access");
										
			$this->where = " `username` = '" . $url . "'";
			
			$this->select($this->name, $this->cols, $this->where);
			
		}
		
	}

?>