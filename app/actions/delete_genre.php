<?php

	// ------------------------
	// MyTreasure: Delete genre
	// ------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_genre() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('genre_id', $_POST)) {
				
			$genre_id = $_POST['genre_id'];
			
			if(!$db->setQuery('delete from genres where id = "'.$genre_id.'";')) {
				$ret = 'CantDeleteGenre';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_genre();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>