<?php

	class locationModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
		}
		
		
		
		public function listAllLocations() {
			
			$this->name = "locations";
			$this->cols = array("loc_id", "loc_city", "loc_state", "loc_country", "loc_image");
			$this->where = null;
			
			return $this->select($this->name, $this->cols, $this->where);
			
		}
		
		
		
		public function listNumberOfBands() {
			
			$this->name = "bands";
			$this->cols = array("band_id", "band_city", "band_state", "band_country");
			$this->where = null;
			
			return $this->select($this->name, $this->cols, $this->where);
			
		}
		
		
		
		public function pullCityInfo($url) {
			
			global $camel;
			global $zepp;
			
			$city = $camel->camelCase("break", $url[2]);
			$city = $zepp->zeppCode("string", "zepp", $city);
			
			$state = $camel->camelCase("break", $url[1]);
			$state = $zepp->zeppCode("string", "zepp", $state);
			
			$this->name = "locations";
			$this->cols = array("loc_id", "loc_city", "loc_state", "loc_country", "loc_image");
			$this->where = "`loc_city` = '$city' AND `loc_state` = '$state' OR `loc_country` = '$state'";
			
			return $this->select($this->name, $this->cols, $this->where);
			
		}
		
		
		
		public function pullStateInfo($url) {
			
			global $camel;
			global $zepp;
			
			$state = $camel->camelCase("break", $url[1]);
			$state = $zepp->zeppCode("string", "zepp", $state);
			
			$this->name = "locations";
			$this->cols = array("loc_id", "loc_city", "loc_state", "loc_country");
			$this->where = "`loc_state` = '$state' OR `loc_country` = '$state'";
			
			return $this->select($this->name, $this->cols, $this->where);
			
		}
		
	}
	
	
	
	
	
	
	
	
	

?>