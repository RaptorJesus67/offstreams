<?php

	class bandModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
		}
		
		
		
		// SELECT BAND INFO FOR THEIR PAGE
		// USES MAIN MODEL FOR ACTUAL QUERY, THIS SETS UP THE BAND INFO
		public function selectBand($urlParams) {
			
			global $camel;
			global $zepp;
			
			// CREATE WHERE
			$bandName = $camel->camelCase("break", $urlParams);
			$bandName = $zepp->zeppCode("string", "zepp", $bandName);
			$this->whereStatement = "`band_name` = '$bandName'";
			
			// TABLE NAME
			$this->tableName = "bands";
			
			// COLUMNS TO PULL
			$this->cols = array("band_name", "band_image", "band_city", "band_state", "band_country", "band_bio",
										"band_formed", "band_disbanded", "band_google", "band_itunes", "band_amazon", "band_merchLink");
			
			
			return $this->select($this->tableName, $this->cols, $this->whereStatement);
			
		}
		
		
		
		// LIST ALL BANDS
		public function listAllBands() {
			
			global $conn;
			
			$this->name = "bands";
			$this->cols = array("band_name");
			$this->where = null;
			
			$rows = $this->select($this->name, $this->cols, $this->where);
			
			// Return band names
			return $this->table["bands"]["band_name"];
			
			
		}
		
		
		
		// LIST BAND ALBUMS
		public function selectAlbums($urlParams) {
			
			global $camel;
			global $zepp;
			
			// CREATE WHERE
			$bandName = $camel->camelCase("break", $urlParams);
			$bandZepp = $zepp->zeppCode("string", "zepp", $bandName);
			$this->whereStatement = "`band_name` = '$bandZepp' OR `band_name` = '$bandName' 
												ORDER BY `album_released` DESC";
			
			// TABLE NAME
			$this->tableName = "albums";
			
			// COLUMNS TO PULL
			$this->cols = array("album_name", "album_image", "album_released", "album_label", "album_type");
			
			
			return $this->select($this->tableName, $this->cols, $this->whereStatement);
			
		}
		
		
		
		
	}

?>