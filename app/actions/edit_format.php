<?php

	// -----------------------
	// MyTreasure: Edit format
	// -----------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_format() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('format_id', $_POST)
			&& array_key_exists('format_name', $_POST)) {
				
			$format_id = $_POST['format_id'];
			$format_name = $_POST['format_name'];
			
			$numrecs = $db->getQuery('select count(*) as c from formats where id != "'.$format_id.'" && name = "'.$format_name.'";');
			
			if($numrecs !== false) {
				
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					
					// Update record
					if(!$db->setQuery('update formats set name = "'.$format_name.'" where id = "'.$format_id.'";')) {
						$ret = 'CantUpdateFormat';
					}
				}
				else {
					$ret = 'FormatAlreadyExists';
				}
				
				// -->
			}
			else {
				$ret = 'CantReadFormats';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = edit_format();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>