<?php
	
	// LOAD IN MAIN MODULES
	require_once("../../includes/config/config.php");
	require_once(BASEPATH . "includes/libs/model.php");
	
	// IF AJAX CALL, LOAD AJAX INFO
	if (isset($_POST['dataMine'])) {
		
		// Load Model
		$model = new Model;
		
		// INFO FOR QUERY
		$name = "navigation";
		$cols = array("nav_name", "nav_href");
		
		// LOAD ARRAY FROM MYSQL
		$arr = $model->select($name, $cols, null);
		
		// Semantics
		$array = array();
		$nav = $model->table["navigation"];
		
		// LOOP THROUGH EACH DB ITERATION
		for ($i = 0; $i < count($nav["nav_name"]); $i++) {
			
			// ADD NEW ARRAY TO JSON
			$array[$i] = array("name" => $nav["nav_name"][$i],
							  "href" => $nav["nav_href"][$i]);
			
		}
		
		// HEADER JSON		   
		header("Content-Type: application/json");
		
		// ECHO JSON DATA AND EXIT CODE
		echo json_encode($array);
		exit;
	
	// NOT JAX, RETURN TO HOME PAGE	
	} else {
	
		header("Location: " . BASE_URI);
		exit;
	
	}

?>
