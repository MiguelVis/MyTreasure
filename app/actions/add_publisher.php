<?php

	// -------------------------
	// MyTreasure: Add publisher
	// -------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_publisher() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('publisher_name', $_POST)) {
				
			$publisher_name = $_POST['publisher_name'];
			
			// Check if record already exists
			$check = $db->getQuery('select count(*) as c from publishers where name = "'.$publisher_name.'";');

			// Check result
			if($check !== false) {
				if($check[0]['c'] == 0) {
					// Add new record
					$result = $db->setQuery('insert into publishers (name) values ("'.$publisher_name.'");');
					
					if($result == false) {
						$ret = 'CantAddPublisher';
					}
					
					// -->
				}
				else {
					$ret = 'PublisherAlreadyExists';
				}
			}
			else {
				$ret = 'CantReadPublishers';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_publisher();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>