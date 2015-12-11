<?php

	class searchModel extends Model {
		
		public function __construct($conn) {
			parent::__construct();
			
			
		}
		
		
		
		public function queryLiveSearch($term) {
			
			global $zepp;
			global $camel;
			
			$stringZepp = $zepp->zeppCode("string", "zepp", $term);
			$symZepp = $zepp->zeppCode("symbol", "zepp", $term);
			
			/* BAND SECTION */
			$this->bandTable = "bands";
			$this->bandCols = array("band_id", "band_name", "band_image");
			$this->bandWhere = " `band_name` LIKE '" . $stringZepp . "%' OR `band_name` LIKE '" . $symZepp . "%'";
			
			/* ALBUM SECTION */
			$this->albumTable = "albums";
			$this->albumCols = array("album_id", "album_name", "album_image");
			$this->albumWhere = " `album_name` LIKE '" . $stringZepp . "%' OR `album_name` LIKE '" . $symZepp . "%'";
			
			/* SONG SECTION */
			$this->songTable = "songs";
			$this->songCols = array("song_id", "song_name");
			$this->songWhere = " `song_name` LIKE '" . $stringZepp . "%' OR `song_name` LIKE '" . $symZepp . "%'";
			
			/* BAND QUERY */ 		$this->select($this->bandTable, $this->bandCols, $this->bandWhere, 3);
			/* ALBUM QUERY */		$this->select($this->albumTable, $this->albumCols, $this->albumWhere, 3);
			/* SONG QUERY */		$this->select($this->songTable, $this->songCols, $this->songWhere, 3);
			
			// EDITS
			for ($i = 0; $i < count($this->table["bands"]["band_name"]); $i++) {
				$bandName = $zepp->zeppCode("zepp", "string", $this->table["bands"]["band_name"][$i]);
				$bandSym = $zepp->zeppCode("zepp", "symbol", $this->table["bands"]["band_name"][$i]);
				$this->table["bands"]["band_url"][$i] = "band/" . $camel->camelCase("create", $bandName);
				$this->table["bands"]["band_name"][$i] = $bandSym;
			}
			
			
			
		}
		
	}

?>