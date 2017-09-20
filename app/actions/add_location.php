<?php

	// ------------------------
	// MyTreasure: Add location
	// ------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_location() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('location_name', $_POST)) {
				
			$location_name = $_POST['location_name'];
			
			// Check if record already exists
			$check = $db->getQuery('select count(*) as c from locations where name = "'.$location_name.'";');

			// Check result
			if($check !== false) {
				if($check[0]['c'] == 0) {
					// Add new record
					$result = $db->setQuery('insert into locations (name) values ("'.$location_name.'");');
					
					if($result == false) {
						$ret = 'CantAddLocation';
					}
					
					// -->
				}
				else {
					$ret = 'LocationAlreadyExists';
				}
			}
			else {
				$ret = 'CantReadLocations';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_location();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>