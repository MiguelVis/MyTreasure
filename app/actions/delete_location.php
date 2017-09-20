<?php

	// ---------------------------
	// MyTreasure: Delete location
	// ---------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_location() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('location_id', $_POST)) {
				
			$location_id = $_POST['location_id'];
			
			if(!$db->setQuery('delete from locations where id = "'.$location_id.'";')) {
				$ret = 'CantDeleteLocation';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_location();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>