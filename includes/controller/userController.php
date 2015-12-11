<?php

	class userController extends Controller {
		
		public function __construct() {
			parent::__construct();
			
			//////////////////////////
			//		GLOBALS			//
			//////////////////////////
			global $url;
			global $conn;
			
			$this->conn = $conn;
			$this->url = $url->trimURL();
			
			// LOAD MODEL
			$this->model = new userModel;
			
			// LOAD USER INFO
			if (isset($this->url[1])) {
				
				////////////////////////////
				//	IF THE USER DOESN'T EXIST,
				//	LOAD THE HOMEPAGE
				//
				//
				//
				if (!$this->model->loadBasicUserInfo($this->url[1])) {
					
					$this->fileExists(null);
					return false;
					
				}
				
			}
			
			
			//////////////////////////
			//	AJAX CALL ANGULAR SELECT
			//
			//
			//	PULL USER PROFILE INFO
			if (isset($_POST['selectUserInfo'])) {
				
				echo json_encode($this->profileInfoAJAX($this->model->table["users"]));
				#echo "AJAX CALL";
			
			
			
			//////////////////////////
			//	AJAX CALL jQUERY UPDATE
			//
			//
			//	PULL USER PROFILE INFO
			} elseif (isset($_POST['update'])) {
				
				#echo json_encode($this->profileInfoAJAX($this->model->table["users"]));
				$data = $_POST['update'];
				
				#print_r($data);
				
				if ($this->model->ajaxUpdateProfile($data, $_SESSION['username'])) {
				
					echo "Updated";
					
				} else {
					
					echo "Didn't Update";
					
				}/**/
				
				
			//////////////////////////
			//	LOAD PAGE NORMALLY
			//
			//
			//	PULL USER PROFILE INFO	
			} else {
				
				
				// LOAD VIEW
				$this->view = new userView($this->model, $this->url);
				
				
				
				//////////////////////////
				// LOAD THE USER PAGE
				//
				//
				//	NORMAL PAGE
				$this->view->loadUsersPage($this->model->table["users"]["username"][0]);
				
				
				
			
			}
			
			
			
		} // END CONSTRUCTOR
		
		
		
		
		private function profileInfoAJAX($data) {
			
			// USE SESSION INFO TO ALLOW VARIABLES
			$session = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
			
			// CURRENT PAGE
			$page = (isset($this->url[1])) ? $this->url[1] : "";
			
			// URL INFO
			$url = (isset($this->url[2])) ? $this->url[2] : "";
			
			$day = null;
			$month = null;
			$year = null;
			
			// BDAY
			if (isset($data["user_bDay"][0]) && (strlen($data["user_bDay"][0]) == 8)) {
				
				$bday = $data["user_bDay"][0];
				
				$day = substr($bday, 0, 2);
				$month = substr($bday, 2, 2);
				$year = substr($bday, 4, 4);
				
				$b = array($day, $month, $year);
				$s = implode("/", $b);
				
			}
			
			
			// ARRAY THAT IS JSON_ENCODED AND
			// SENT TO ANGULAR
			$ajax = array("fName"		=> $data["user_fName"][0],
						  "lName"		=> $data["user_lName"][0],
						  "city"		=> $data["user_city"][0],
						  "state"		=> $data["user_state"][0],
						  "country"		=> $data["user_country"][0],
						  "accType"		=> $data["user_access"][0],
						  "session"		=> $session,
						  "page"		=> $page,
						  "directive"	=> $url,
						  "month"		=> $day,
						  "day"			=> $month,
						  "year"		=> $year,
						  "birthday"	=> date("M j, Y", strtotime($s)),
						  "gender"		=> $data["user_gender"][0]
						  );
						  
			return $ajax;
			
		}
		
		
		
		
	}

?>
