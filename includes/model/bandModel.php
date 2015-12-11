<?php

	class bandModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
			
		}
		
		
		
		public function loadBandInfo($type = "all", $url = null) {
			
			global $camel;
			global $zepp;
			
			// IF BAND IS INCLUDED
			if (!empty($url)) {
				
				// Break the Camel Case
				$band = $camel->camelCase("break", $url);
				// Zepp Translate from string to symbol
				$band = $zepp->zeppCode("string", "zepp", $band);
				
			}
			
			$name = "bands";
			$cols = array("band_id", "band_name", "band_image", "band_city",
						  "band_state", "band_country");
			
			// TYPE FOR THE INFO
			if ($type == "single") {
				
				$where = "`band_name` = '" . $band . "'";
			
			} elseif ($type == "ajax") {
			
				$where = "`band_id` = '" . $band . "'";
				
			} else {
				
				$where = null;
				
			}
			
			
			return $this->select($name, $cols, $where);
			
		}
		
		
		
		public function loadAllBands() {
			
			$band = "bands";
			$cols = array("band_name");
			
		}
		
		
		
		
		public function loadBPWidgetInfo($name, $model, $order = "DESC") {
			///////////////
			// GLOBALS	 //
			///////////////
			global $zepp;
			
			$this->model = $model;
			
			// DON'T BOTHER IF THE BAND NAME DOESN'T EXIST
			if (!isset($this->model["band_name"][0])) {
				
				return false;
				
			}
			
			// SETUP NAMES
			$bandName = $zepp->zeppCode("symbol", "zepp", $this->model["band_name"][0]);
			$bandId = $this->model["band_id"][0];
		
			
			// CHOOSE WHICH WIDGET TO LOAD
			switch($name) {
				
				// ALBUMS WIDGET
				case "Albums":
					$table = "albums";
					$cols = array("album_id", "album_name", "album_image", "album_type", 
								  "album_label", "album_release");
					$where = "`band_id` = '" . $bandId . "' AND `band_name` = '" . $bandName . "'";
					$order = array("album_time", "DESC");
					break;
					
				case "Videos":
					$table = "band-videos";
					$cols = array("bvideo_id", "bvideo_name", "bvideo_album", "bvideo_band",
								  "bvideo_youtube", "band_id", "album_id",
								  "bvideo_thumbnail", "bvideo_yt-ID");
					$where = "`bvideo_band` = '" . $bandName . "' AND `band_id` = '" . $bandId . "'";
					$order = array("album_id", $order);
					break;
					
				// RETURN FALSE
				default:
					return false;
					break;
				
			}
			
			
			// RETURN MODEL DB INFO
			return $this->select($table, $cols, $where, null, $order);
			
			
		}
		
		
	}

?>
