<?php

	// ----------------------
	// MyTreasure: Add format
	// ----------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_format() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('format_name', $_POST)) {
				
			$format_name = $_POST['format_name'];
			
			// Check if record already exists
			$check = $db->getQuery('select count(*) as c from formats where name = "'.$format_name.'";');

			// Check result
			if($check !== false) {
				if($check[0]['c'] == 0) {
					// Add new record
					$result = $db->setQuery('insert into formats (name) values ("'.$format_name.'");');
					
					if($result == false) {
						$ret = 'CantAddFormat';
					}
					
					// -->
				}
				else {
					$ret = 'FormatAlreadyExists';
				}
			}
			else {
				$ret = 'CantReadFormats';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_format();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>