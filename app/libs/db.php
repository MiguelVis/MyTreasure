<?php

	// ----------
	// MyTreasure
	// ----------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.


	class DataBase {
		private static $connection;
		private static $instance;
		
		private $queryRows = 0;
		
		private function __construct() {
			global $CF;
			
			try {
				self::$connection = new mysqli(
					$CF['db_server'],
					$CF['db_user'],
					$CF['db_password'],
					$CF['db_name']
				);
				
				if(self::$connection->connect_errno) {
					throw new Exception('Could not connect to database.');
				}
			}
			catch(Exception $ex) {
				self::$connection = null;
			}
		}
		
		public function __destruct() {
			if(self::$connection !== null) {
				self::$connection->close();
			}
		}
		
		public static function getConnection() {
			if(self::$instance === null) {
				self::$instance = new DataBase();
			}
							
			return (self::$connection !== null ? self::$instance : null);
		}
		
		public function getQuery($query) {
						
			if(self::$connection !== null) {
				$result = self::$connection->query($query);
				
				if($result !== false) {
					$data = array();
					
					while(($row = $result->fetch_assoc()) !== null) {
						$data[] = $row;
					}
					
					$this->queryRows = self::$connection->affected_rows;
					
					$result->free();
					
					// Success
					return $data;
				}
			}
			
			// Error
			$this->queryRows = -1;
						
			return false;
		}
		
		public function getNumRows() {
			return $this->queryRows;
		}
		
		public function setQuery($query) {
			
			if(self::$connection !== null) {
				$result = self::$connection->query($query);
				
				if($result !== false) {
					$this->queryRows = self::$connection->affected_rows;
	
					// Success
					return true;
				}
			}
			
			// Error
			$this->queryRows = -1;
						
			return false;
		}
		
	}
	
?>