<?php

	class adminModel extends Model {
		
		public function __construct($conn) {
			parent::__construct($conn);
			
			
			
		}
		
		
		
		// QUERY BANDS BASED ON ADMIN INPUT
		public function queryBandName($input = null) {
			
			$this->name = "bands";
			$this->cols = array("band_name", "band_id");
			$this->where = "`band_name` = '" . $input . "'";
			
			return $this->select($this->name, $this->cols, $this->where);
			
		}
		
	}

?>