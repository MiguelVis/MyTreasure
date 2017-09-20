<?php
  
	// --------------------------
	// MyTreasure: Get # of users
	// --------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	

	function get_num_users() {
		global $db;
		
		// Read total # of records
		$r = $db->getQuery('select count(*) as c from users;');
		
		// Return value
		return ($r !== false ? $r[0]['c'] : tr('NotAvailable'));
	}
?>