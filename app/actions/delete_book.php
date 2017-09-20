<?php

	// -----------------------
	// MyTreasure: Delete book
	// -----------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_book() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('book_id', $_POST)) {
				
			$book_id = $_POST['book_id'];
			
			if(!$db->setQuery('delete from books where id = "'.$book_id.'";')) {
				$ret = 'CantDeleteBook';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_book();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>