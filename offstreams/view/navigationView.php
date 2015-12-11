<?php

	class navigationView extends View {
		
		public function __construct($model) {
			parent::__construct();
			
			
			// Bring Model values locally
			$this->model = $model;
			
			// Shorten navigation info
			$this->nav = $this->model->table["navigation"];
			
			#echo "Navigation View";
			$template = BASEPATH . "templates/navigationTemplate.php";
			$this->loadNavTemplate($this->model, $template);
			
		}
		
		
		// LOAD THE NAVIGATION BAR HTML TEMPLATE
		private function loadNavTemplate($model, $template) {
			
			$this->render($template, $model);
			
		}
		
		
		// LOOPS THROUGH EACH NAVIGATION ITERATION
		protected function displayNavigation() {
			
			
			
			for($i = 0; $i < count($this->nav["nav_name"]); $i++) {
		
				echo "<a class='aWhite' href='" . BASE_URI . $this->nav["nav_url"][$i] . "'><li>" . $this->nav["nav_name"][$i] . "</li></a>";
				
			}
			
		}
		
		
	}

?>