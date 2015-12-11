<?php

	class adminView extends View {
		
		public function __construct($type) {
			parent::__construct();
			
			// Call Global's
			global $camel;
			
			$this->type = $type;
			
			$this->loadWidget($this->type);
			
		}
		
		
		
		private function loadWidget($widget) {
			
			require_once(BASEPATH . "widgets/" . $widget . ".php");
			
		}
		
	}

?>