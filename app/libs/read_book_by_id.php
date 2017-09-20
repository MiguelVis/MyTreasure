<?php
  
	// ---------------------------
	// MyTreasure: Read book by id
	// ---------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function read_book_by_id($book_id) {
		global $db;
		
		//
		$ret = '';
		
		// Build query
		$sql = 'select b.*, '.
			'a.name as author, a2.name as author2, p.name as publisher, g.name as genre, f.name as format, l.name as language, o.name as location '.
			'from books as b '.
			'join authors as a on b.author_id = a.id '.
			'join authors as a2 on b.author2_id = a2.id '.
			'join publishers as p on b.publisher_id = p.id '.
			'join genres as g on b.genre_id = g.id '.
			'join formats as f on b.format_id = f.id '.
			'join languages as l on b.language_id = l.id '.
			'join locations as o on b.location_id = o.id '.
			'where b.id = '.$book_id.';';

		// Read data
		$recs = $db->getQuery($sql);
		
		// Check result
		if($recs === false) {
			$ret = 'CantReadBooks';
		}

		$ret = array(
			'recs' => ($ret == '' ? $recs : array()),
			'error' => $ret
		);
	
		return $ret;
	}
?>