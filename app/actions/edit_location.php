<?php

	// -------------------------
	// MyTreasure: Edit location
	// -------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_location() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('location_id', $_POST)
			&& array_key_exists('location_name', $_POST)) {
				
			$location_id = $_POST['location_id'];
			$location_name = $_POST['location_name'];
			
			$numrecs = $db->getQuery('select count(*) as c from locations where id != "'.$location_id.'" && name = "'.$location_name.'";');
			
			if($numrecs !== false) {
				
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					
					// Update record
					if(!$db->setQuery('update locations set name = "'.$location_name.'" where id = "'.$location_id.'";')) {
						$ret = 'CantUpdateLocation';
					}
				}
				else {
					$ret = 'LocationAlreadyExists';
				}
				
				// -->
			}
			else {
				$ret = 'CantReadLocations';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = edit_location();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>