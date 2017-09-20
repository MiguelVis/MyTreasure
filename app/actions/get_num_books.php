<?php
  
	// --------------------------
	// MyTreasure: Get # of books
	// --------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	

	function get_num_books() {
		global $db;
		
		// Read total # of records
		$r = $db->getQuery('select count(*) as c from books;');
		
		// Return value
		return ($r !== false ? $r[0]['c'] : tr('NotAvailable'));
	}
?>