<?php

	// -------------------------
	// MyTreasure: Delete format
	// -------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_format() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('format_id', $_POST)) {
				
			$format_id = $_POST['format_id'];
			
			if(!$db->setQuery('delete from formats where id = "'.$format_id.'";')) {
				$ret = 'CantDeleteFormat';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_format();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>