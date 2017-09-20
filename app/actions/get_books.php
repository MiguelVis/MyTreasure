<?php
  
	// ---------------------
	// MyTreasure: Get books
	// ---------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	require_once(dirname(__FILE__) . '/../libs/read_books.php');
	
	function get_books($page, $page_length, $sort_by, $sort_order, $filters = null) {
		global $dashboard_error;
		
		// Set pagination
		$offset = ($page > 0 ? $page * $page_length : 0);
		$limit  = $page_length;
					
		// Read records
		$ret = read_books($offset, $limit, $sort_by, $sort_order, $filters);
		
		// Check result
		if($ret['error'] != '') {
			$dashboard_error = $ret;
		}
					
		// Return result
		return $ret;
	}
?>