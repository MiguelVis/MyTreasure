<?php

	// --------------------------
	// MyTreasure: Edit publisher
	// --------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_publisher() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('publisher_id', $_POST)
			&& array_key_exists('publisher_name', $_POST)) {
				
			$publisher_id = $_POST['publisher_id'];
			$publisher_name = $_POST['publisher_name'];
			
			$numrecs = $db->getQuery('select count(*) as c from publishers where id != "'.$publisher_id.'" && name = "'.$publisher_name.'";');
			
			if($numrecs !== false) {
				
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					
					// Update record
					if(!$db->setQuery('update publishers set name = "'.$publisher_name.'" where id = "'.$publisher_id.'";')) {
						$ret = 'CantUpdatePublisher';
					}
				}
				else {
					$ret = 'PublisherAlreadyExists';
				}
				
				// -->
			}
			else {
				$ret = 'CantReadPublishers';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = edit_publisher();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>