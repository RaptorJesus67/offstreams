<?php

	class venueModel extends Model {
		
		public function __construct() {
			parent::__construct();
			
			
		}
		
		
		
		/**
		*
		*	List all venues stored in the database
		*
		*	Called in controller, used in venue template on the main venue page
		*
		*	@access			public				[called in controller]
		*	@var					$this->name		[table name]
		*	@var					$this->cols			[Array; columns that are called]
		*	@var					$this->where		[where statement for sql]
		*	@return				mixed					[table array that is passed into view as "$this->model->table[$tableName]"]
		*
		*/
		public function listAllVenues() {
			
			$this->name = "venues";
			$this->cols = array("venue_id", "venue_name", "venue_address", "venue_state", "venue_city", "venue_image");
			$this->where = null;
			
			return $this->select($this->name, $this->cols, $this->where);
			
		}
		
	}

?>