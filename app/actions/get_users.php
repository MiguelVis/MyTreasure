<?php
  
	// ---------------------
	// MyTreasure: Get Users
	// ---------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	// $page
	// $page_length
	//
	function get_users($page, $page_length, $sort_by, $sort_order) {
		global $db;
		global $dashboard_error;
		
		//
		$ret = '';
		
		// Read total # of records
		$numrecs = $db->getQuery('select count(*) as c from users;');
		
		if($numrecs !== false)
		{
			// Get #
			$numrecs = $numrecs[0]['c'];
			
			// Set pagination
			$offset = ($page > 0 ? ' offset '.($page * $page_length).' ' : '');
			$limit  = ($page_length > 0 ? ' limit '.$page_length.' ' : '');
			
			// Read records
			$records = $db->getQuery('select u.*, r.name as role from users as u join roles as r on u.role_id = r.id '.
								'order by '.$sort_by.' '.$sort_order.$limit.$offset.';');

			// Check result
			if($records === false) {
				$ret = 'CantReadUsers';
			}
			
			// -->
		}
		else {
			$ret = 'CantReadUsers';
		}

		// -->
		
		if($ret != '') {
			$dashboard_error = $ret;
		}
		
		$ret = array(
			'total_recs' => ($ret == '' ? $numrecs : 0),
			'paged_recs' => ($ret == '' ? count($records) : 0),
			'recs' => ($ret == '' ? $records : array())
		);
		
		return $ret;
	}
?>