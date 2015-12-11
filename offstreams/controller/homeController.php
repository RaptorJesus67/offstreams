<?php

	class homeController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			global $conn;
			
			
			#print_r($_SESSION);
			
			//////////////////////////////////////////////////////
			// INSTANCE NAVIGATION BEFORE PAGE LOAD //
			//////////////////////////////////////////////////////
			require_once("navigationController.php");
			$nav = new navigationController;
			
			
			$model = new homeModel($conn);
			$view = new homeView;
			
			echo "Home Page";
			
			
		}
		
	}

?>