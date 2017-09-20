<?php
  
	// -----------------------
	// MyTreasure: Get Authors
	// -----------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	// $page
	// $page_length
	//
	function get_authors($page, $page_length) {
		global $db;
		global $dashboard_error;
		
		//
		$ret = '';
		
		// Read total # of records
		$numrecs = $db->getQuery('select count(*) as c from authors;');
		
		if($numrecs !== false)
		{
			// Get #
			$numrecs = $numrecs[0]['c'];
			
			// Set pagination
			$offset = ($page > 0 ? ' offset '.($page * $page_length).' ' : '');
			$limit  = ($page_length > 0 ? ' limit '.$page_length.' ' : '');
			
			// Read records
			$records = $db->getQuery('select * from authors order by name'.$limit.$offset.';');

			// Check result
			if($records === false) {
				$ret = 'CantReadAuthors';
			}
			
			// -->
		}
		else {
			$ret = 'CantReadAuthors';
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