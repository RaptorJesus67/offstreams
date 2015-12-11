<?php
	
	# A WIDGET CALLED ONLY BY AJAX CALL
	
	require_once("../includes/config/config.php");
	
	// Allow if Ajax call
	if (isset($_POST['searchTerm'])) {
		
		// Main Modules
		require_once(BASEPATH . "libs/Controller.php");
		require_once(BASEPATH . "libs/Model.php");
		require_once(BASEPATH . "libs/View.php");
		
		require_once(BASEPATH . "controller/searchController.php");
		require_once(BASEPATH . "model/searchModel.php");
		require_once(BASEPATH . "view/searchView.php");
		
		$controller = new searchController($_POST['searchTerm']);
		
	} else {
		
		require_once(BASEPATH . "index.php");
		
	}

?>