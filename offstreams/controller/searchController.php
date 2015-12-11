<?php

	class searchController extends Controller {
		
		public function __construct($liveTerm = null) {
			parent::__construct();
			
			global $conn;
			global $camel;
			
			$this->url = $this->url->trimURL();
			
			// IF ON SEARCH PAGE
			if (isset($this->url[1], $this->url[0]) && $this->url[0] == "search") {
				
				// LOAD NAVIGATION
				$this->loadNavigation();
				echo $camel->camelCase("break", $this->url[1]);
				
			// DYNAMIC JQUERY SEARCH
			} else {
			
				$this->model = new searchModel($conn);
				$this->model->queryLiveSearch($liveTerm);
				
				// Return json encode
				echo json_encode($this->model->table);
			
			}
			
		}
		
	}

?>