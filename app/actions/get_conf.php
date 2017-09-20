<?php
  
	// -----------------------------
	// MyTreasure: Get Configuration
	// -----------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function get_conf() {
		global $db;
		global $dashboard_error;
		
		//
		$ret = '';
		
		// Default configuration
		$conf = array(
			'title' => '',
			'owner' => '',
			'exlibris' => 0
		);
		
		foreach($conf as $k => $v) {
			// Check if record exists
			$numrecs = $db->getQuery('select count(*) as c from conf where name = "'.$k.'";');
			
			if($numrecs !== false) {
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs > 0) {
					// Read record
					$record = $db->getQuery('select value from conf where name = "'.$k.'" limit 1;');

					// Check result
					if($record !== false) {
						$conf[$k] = $record[0]['value'];
					}
					else {
						$ret = 'CantReadConf';
					}
				}
			}
			else {
				$ret = 'CantReadConf';
			}
		}
					
		if($ret != '') {
			$dashboard_error = $ret;
		}
		
		return $conf;
	}
?>