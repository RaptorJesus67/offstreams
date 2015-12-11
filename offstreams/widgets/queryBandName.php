<?php

	require_once("../includes/config/config.php");
	require_once(BASEPATH . "libs/model.php");
	
	if (isset($_POST['bandName'])) {

		$model = new Model($conn);
		
		$zeppBand = $zepp->zeppCode("string", "zepp", $_POST['bandName']);
		$symBand = $zepp->zeppCode("symbol", "zepp", $_POST['bandName']);
		
		$name = "bands";
		$cols = array("band_name", "band_id");
		$where = " `band_name` LIKE '" . $zeppBand . "%' OR `band_name` LIKE '" . $symBand . "%' LIMIT 5";
		$model->select($name, $cols, $where);
		
		$name = null;
		for ($i = 0; $i < count($model->table["bands"]["band_name"]); $i++) {
			
			$name[$i]["name"] = $zepp->zeppCode("zepp", "symbol", $model->table["bands"]["band_name"][$i]);
			$name[$i]["id"] = $model->table["bands"]["band_id"][$i];
			
		}
		
		echo json_encode($name);
		
	}

?>