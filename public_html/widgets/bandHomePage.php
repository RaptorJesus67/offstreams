<?php
	
	// LOAD IN MAIN MODULES
	require_once("../../includes/config/config.php");
	require_once(BASEPATH . "includes/libs/model.php");
	
	
	
	// IF AJAX CALL, LOAD AJAX INFO
	if (isset($_POST['dataMine'])) {
		
		
		// Load Model
		$model = new Model;
		
		/////////////////////////////
		// QUERY
		//
		//
		// INFO FOR QUERY
		$name = "bands";
		$cols = array("band_name", "band_image", "band_city", "band_state",
					  "band_country");
		
		/////////////////////////////
		// LOAD ARRAY
		//
		//
		$arr = $model->select($name, $cols, null);
		
		// Semantics
		$array = array();
		$nav = $model->table["bands"];
		
		
		////////////////////////////
		// LOOP
		//
		// EACH DB ITERATION
		for ($i = 0; $i < count($nav["band_name"]); $i++) {
			
			// BAND NAME TO SYMBOL
			$bandName = $zepp->zeppCode("zepp", "symbol", $nav["band_name"][$i]);
			
			// BAND HREF
			$href = $camel->camelCase("create", $zepp->zeppCode("zepp", "string", $nav["band_name"][$i]));
			
			
			// CREATE LOCATION
			if ($nav["band_country"][$i] == "United States") {
			
				$loc = array($nav["band_city"][$i], $nav["band_state"][$i]);
				
			} else {
				
				$loc = array($nav["band_city"][$i], $nav["band_country"][$i]);
				
			}
			$location = implode(", ", $loc);
			
			
			///////////////////////////////
			//	IMAGE INFO
			//
			//
			//	GET THE IMG HEIGHT AND WIDTH
			list($width, $height) = getimagesize(BASE_URI . "images/bands/" . $nav["band_image"][$i]);
			
			if ($width > $height) {
				
				if ($height < 250) {
					
					$size = "height";
					
				} elseif ($height > 250) {
					
					$size = "width";
					
				}
				
			} else {
				
				$size = "height";
				
			}
			
			
			///////////////////////////////
			// SETUP ARRAY
			//
			//
			// ADD NEW ARRAY TO JSON
			$array[$i] = array("name" => $bandName,
							   "image" => $nav["band_image"][$i],
							   "location" => $location,
							   "href" => $href,
							   "size" => $size);
			
		}
		
		
		////////////////////////////
		// CHANGE CONTENT TYPE
		//
		//
		// HEADER JSON		   
		header("Content-Type: application/json");
		
		
		////////////////////////////
		// RETURN ARRAY TO ANGULAR
		//
		//
		// ECHO JSON DATA AND EXIT CODE
		echo json_encode($array);
		exit;
	
	
	// NOT JAX, RETURN TO HOME PAGE	
	} else {
	
		header("Location: " . BASE_URI);
		exit;
	
	}

?>

