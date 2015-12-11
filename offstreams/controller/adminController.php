<?php

	class adminController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			// Call Global's
			global $url;
			
			// Make global's local
			$this->url = $this->url->trimURL();
			
			// Load Homepage if User is not logged in as admin
			if (!$this->isUserAdmin()) {
				
				require_once("controller/homeController.php");
				require_once("model/homeModel.php");
				require_once("view/homeView.php");
				
				return $subController = new homeController;
				
			}
			
			// Global Conn's
			global $conn;
			
			// LOAD NAVIGATION
			$this->loadNavigation();
			
			
			// Insert, edit, delete, etc.
			if (isset($this->url[1])) {
				
				
				// Modify each individual page
				if (isset($this->url[2])) {
					
					// Band, Album, User, Etc.
					return $this->loadModule($this->url[2] . ucfirst($this->url[1]));
					
					
				// Load module for default Insert, Edit, Delete, Etc.
				} else {
					
					echo $this->loadModule($this->url[1]);
					
				}
				
			
			
			// Default admin homepage
			} else {
				
				echo $this->loadDefaultAdminPage();
				
			}
			
		}
		
		
		
		private function loadModule($module = "edit") {
			
			// If module exists, load it, then return true
			if (method_exists($this, $module)) {
				
				return $this->{$module}();
			
			// Module doesn't exist
			} else {
				
				return $this->loadDefaultAdminPage();
				
			}
		}
		
		
		
		// Create Links for the admin page
		private function loadDefaultAdminPage() {
			
			$links = array("edit", "insert", "delete");
			
			foreach ($links as $link) {
				
				echo "<p><a href='" . BASE_URI . "admin/$link'>" . ucfirst($link) . "</a></p>";
				
			}
			
		}
		
		
		
		// Create links for the edit page
		private function edit() {
			
			$links = array("band", "album", "user");
			
			foreach ($links as $link) {
				
				echo "<p><a href='" . BASE_URI . "admin/edit/$link'>" . ucfirst($link) . "</a></p>";
				
			}
			
		}
		
		
		
		private function insert() {
			
			return "This is the insert page";
			
		}
		
		
		
		// Function to edit band page
		private function bandEdit() {
			
			global $conn;
			
			
			
			$this->model = new adminModel($conn);
			
			if (isset($_POST['bandName'])) {
				
				$this->model->queryBandName($this->url[3]);
				for ($i = 0; $i < count($this->model->table["bands"]); $i++) {
					
					$results[] = $this->model->table["bands"]["band_name"][$i];
					
				}
				
				echo json_encode($results);
				
			}
			
			
			
			$this->view = new adminView("editBand");
			
		}
		
		
	}

?>