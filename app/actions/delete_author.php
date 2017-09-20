<?php

	// -------------------------
	// MyTreasure: Delete author
	// -------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_author() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('author_id', $_POST)) {
				
			$author_id = $_POST['author_id'];
			
			if(!$db->setQuery('delete from authors where id = "'.$author_id.'";')) {
				$ret = 'CantDeleteAuthor';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_author();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>