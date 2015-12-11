<?php

	class albumModel extends Model {
		
		public function __construct($conn) {
			parent::__construct($conn);
			
			
		}
		
		
		
		public function loadAlbumsList($band = null) {
			
			global $camel;
			global $zepp;
			
			$this->name = "albums";
			$this->cols = array("album_image", "band_id", "album_name", "album_desc", 
										"album_type", "album_released", "album_label");
			$this->where = null;
			$this->secName = "bands";
			$this->key = "albums.band_id = bands.band_id";
			$this->bandZepp = $camel->camelCase("break", $band);
			$this->bandZepp = $zepp->zeppCode("string", "zepp", $this->bandZepp);
			
			// Album page, load all albums
			if (empty($band)) {
				
				// Just Chill
			
			// ACTUAL BAND PAGE
			} else {
				
				$this->where = " WHERE bands.band_name = '" . $this->bandZepp . "'";
				
			}
			
			$cols = "albums.";
			$cols .= implode(", albums.", $this->cols);
			$cols .= "";
			
			$this->rawSql = "SELECT " . $cols . ", bands.band_name FROM " . $this->name . " LEFT JOIN " . $this->secName . " ON " . $this->key .
									$this->where;
			
			$this->albums = $this->rawSelect($this->rawSql, $this->name);
			return $this->albums;
			
		}
		
		
		
		
		// LOAD ALL SONGS ON ALBUM
		public function loadAlbumSongs($band, $album) {
			
			$this->tableName = "songs";
			$this->cols = array("song_name", "song_uri");
			$this->where = "`band_name` = '" . $band . "' AND `album_name` = '" . $album . "'";
			
			return $this->select($this->tableName, $this->cols, $this->where);
			
		}
		
		
		
		// GRAB ALBUM DATA FOR ALBUM PAGE
		public function loadAlbumData($band, $album) {
			
			global $camel;
			global $zepp;
			
			// Un-camelCase
			$bandOrig = $camel->camelCase("break", $band);
			$albumOrig = $camel->camelCase("break", $album);
			
			// Create query values
			$bandZepp = $zepp->zeppCode("string", "zepp", $bandOrig);
			$albumZepp = $zepp->zeppCode("string", "zepp", $albumOrig);
			
			
			
			$this->tableName = "albums";
			$this->cols = array("album_image", "album_name", "band_name", "album_desc", 
									 "album_type", "album_released", "album_label", "album_amazon", "album_google", "album_itunes");
			
			$this->where = " `band_name` = '" . $bandZepp . "' OR `band_name` = '" . $bandOrig . "' 
									AND `album_name` = '" .$albumZepp . "' OR `album_name` = '" . $albumOrig . "'";
									
									
			 return $this->select($this->tableName, $this->cols, $this->where);
			
		}
		
	}

?>