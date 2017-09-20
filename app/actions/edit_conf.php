<?php

	// ------------------------------
	// MyTreasure: Edit configuration
	// ------------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_conf() {
		global $db;
		
		//
		$ret  = '';
		
		//
		$records = array();
		
		if(array_key_exists('conf_title', $_POST)) $records['title'] = $_POST['conf_title'];
		if(array_key_exists('conf_owner', $_POST)) $records['owner'] = $_POST['conf_owner'];
		if(array_key_exists('conf_exlibris', $_POST)) $records['exlibris'] = $_POST['conf_exlibris'];
				
		foreach($records as $k => $v) {
			$numrecs = $db->getQuery('select count(*) as c from conf where name = "'.$k.'";');
			
			if($numrecs !== false) {
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					// Add record
					if(!$db->setQuery('insert into conf (name, value) values ("'.$k.'", "'.$v.'");')) {
						$ret = 'CantAddConf';
						break;
					}
				}
				else {					
					// Update record
					if(!$db->setQuery('update conf set value = "'.$v.'" where name = "'.$k.'";')) {
						$ret = 'CantUpdateConf';
						break;
					}
				}
			}
			else {
				$ret = 'CantReadConf';
				break;
			}
		}

		return $ret;
	}
	
	//
	$ret = edit_conf();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>