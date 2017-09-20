<?php

	// ----------------------------
	// MyTreasure: Delete publisher
	// ----------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_publisher() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('publisher_id', $_POST)) {
				
			$publisher_id = $_POST['publisher_id'];
			
			if(!$db->setQuery('delete from publishers where id = "'.$publisher_id.'";')) {
				$ret = 'CantDeletePublisher';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_publisher();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>