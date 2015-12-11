<?php

	class Model extends cleanInput {
		
		public $table;
		private $data;
		public $query;
		
		public function __construct() {
			
			////////////////////////////////
			//		CALL GLOBALS			//
			////////////////////////////////
			global $clean;
			global $conn;
			
			
			////////////////////////////////
			//	MAKE LOCAL VARS		//
			////////////////////////////////
			$this->clean = $clean;
			$this->conn = $conn;
			
		}
		
		
		
		// SELECT VALUES FROM DATABASE FOR BROWSER
		// CLEAN INPUT ON PULL
		public function select($tableName, $columns, $where = null, $limit = null) {
			
			global $purifier;
			
			// Make columns SQL friendly
			$cols = "`";
			$cols .= implode("`, `", $columns);
			$cols .= "`";
			
			$table = "`" . $tableName . "`";
			
			if (!empty($where)) {
				
				$where = " WHERE " . $where;
				
			}
			
			// Check limit
			if (!empty($limit)) {
				
				$limit = " LIMIT $limit";
				
			}
			
			// SQL CODE
			$sql = "SELECT " . $cols . " FROM " . $table . $where . $limit;
			
			#echo $sql;
			
			$query = $this->conn->query($sql);
			
			// Store the value in a variable called table with an array of that table's name followed by it's values
			// EX: $model->table["bands"]["band_name"]
			//
			// Accessible by the individual page/directory's controller's
			
			while($row = $query->fetch_assoc()){
				
				// Store values as $model->table["tableName"]["columnName"]["index (usually 0)"]
				foreach ($row as $key => $val) {
					$this->data[$tableName][$key][] = $row[$key];
				}
			
			}
			
			
			// Loop through results to clean them
			// Foreach loops through each column
			// Make sure the table isn't empty (i.e. login returns an error)
			if (!empty($this->data[$tableName])) {
				foreach ($this->data[$tableName] as $key => $tableArray) {
					
					// For loop goes through each value in a certain row
					for ($i = 0; $i < count($tableArray); $i++) {
						// Convert from data variable to table after HTML PURIFIER
						$this->table[$tableName][$key][$i] = $purifier->purify($tableArray[$i]);
					}
					
				}
			}
			
			
			// Declare the array after loop has finished for use in view
			$this->table;
			
			if (!empty($this->table)) {
				return true;
			}
			
		}
		
		
		
		// PUBLIC FUNCTION INSERT INTO DATABASE
		public function insert($tableName, $columns, $values = array(), $where = null) {
			
			$cols = "(`";
			$cols .= implode("`, `", $columns);
			$cols .= "`)";
			
			$table = "`" . $tableName . "`";
			
			$val = "('";
			$val .= implode("', '", $values);
			$val .= "')";
			
			
			$sql = "INSERT INTO " . $table . " " . $cols . " VALUES " . $val;
			
			
			// If It queries correctly, upload info and return true
			if ($this->conn->query($sql)) {
				
				return true;
				
			// There was an error; return false
			} else {
				
				echo "WTF";
				
				return false;
				
			}
			
		}
		
		
		
		// ALLOW QUERY OF RAW SELECT STATEMENTS
		public function rawSelect($statement, $tableName) {
			
			global $purifier;
			
			$sql = $statement;
			
			$query = $this->conn->query($sql) or die($this->conn->error);
			
			
			// Store the value in a variable called table with an array of that table's name followed by it's values
			// EX: $model->table["bands"]["band_name"]
			//
			// Accessible by the individual page/directory's controller's
			
			while($row = $query->fetch_assoc()){
				
				// Store values as $model->table["tableName"]["columnName"]["index (usually 0)"]
				foreach ($row as $key => $val) {
					$this->data[$tableName][$key][] = $row[$key];
				}
				
			
			}
			
			
			// Loop through results to clean them
			// Foreach loops through each column
			// Make sure the table isn't empty (i.e. login returns an error)
			if (!empty($this->data[$tableName])) {
				foreach ($this->data[$tableName] as $key => $tableArray) {
					
					// For loop goes through each value in a certain row
					for ($i = 0; $i < count($tableArray); $i++) {
						// Convert from data variable to table after HTML PURIFIER
						$this->table[$tableName][$key][$i] = $purifier->purify($tableArray[$i]);
					}
					
				}
			}
			
			
			// Declare the array after loop has finished for use in view
			$this->table;
			
			if (!empty($this->table)) {
				return true;
			}
			
		}
		
		
		
		/**
		*
		*	Allow Join Table Select statements
		*
		*	Used in the sub-Model
		*
		*	@access		protected			[used in sub-model]
		*	@param			array					[$tables]
		*	@param			array					[$columns]
		*	^@param		string					[$where]
		*
		*/
		protected function joinSelect($tables, $columns, $where = null) {
			
			
			
		}
		
		
		
		
		
	}

?>