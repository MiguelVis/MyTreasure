<?php
  
	// ----------------------------
	// MyTreasure: Get # of authors
	// ----------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.	

	function get_num_authors() {
		global $db;
		
		// Read total # of records
		$r = $db->getQuery('select count(*) as c from authors;');
		
		// Return value
		return ($r !== false ? $r[0]['c'] : tr('NotAvailable'));
	}
?>