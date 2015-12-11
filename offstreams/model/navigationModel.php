<?php

	class navigationModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
		}
		
		
		// PULL ALL NAVIGATION VALUES
		public function queryNav() {
			
			global $camel;
			global $zepp;
			
			
			// TABLE NAME
			$this->tableName = "navigation";
			
			// COLUMNS TO PULL
			$this->cols = array("nav_name", "nav_url");
			
			$this->select($this->tableName, $this->cols);
			
		}
		
	}

?>