<?php

	class cleanInput {
		
		
		// Sanitize Input
		function sanitize($input) {
			global $conn;
			$search = array(
				'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
				'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
			);

			$preg = preg_replace($search, '', $input);
			$output = mysqli_real_escape_string($conn, $preg);
			
			return $output;
		}
		
		
		
		// Random String
		function randString($length = 32) {
			$characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$characterLen = strlen($characters);
			$randomString = "";
			for ($i = 0; $i < $length; $i++){
				$randomString .= $characters[rand(0, $characterLen - 1)];
			}
			return $randomString;
		}
		
		
		// PRINT_R IN STYLE!
		function arrayView($input) {
			echo "<pre>";
			print_r($input);
			echo "</pre>";
		}
		
		
		
		public function sha256($input, $rand = "no", $hash = null) {
			
			if ($rand == "yes") {
				$this->hash = $this->randString(32);
				return hash("sha256", $this->hash . $input);
			} elseif ($rand == "no" && $hash != null) {
				return hash("sha256", $hash . $input);
			}
			
			
			
		}
		
		
		function numToMonth($input) {
			$month = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May",
									"06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sept", "10" => "Oct", "11" => "Nov", "12" => "Dec");
			foreach ($month as $mon => $abbr){
				if ($input != $mon) {
					continue;
				} else {
					return $abbr;
				}
			}
		}
		
		function monthToNum($input) {
			$month = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May",
									"06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sept", "10" => "Oct", "11" => "Nov", "12" => "Dec");
			foreach ($month as $mon => $abbr){
				if ($input != $abbr) {
					continue;
				} else {
					return $mon;
				}
			}
		}
		
		
	}

?>