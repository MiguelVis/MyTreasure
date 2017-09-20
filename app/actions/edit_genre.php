<?php

	// ----------------------
	// MyTreasure: Edit genre
	// ----------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_genre() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('genre_id', $_POST)
			&& array_key_exists('genre_name', $_POST)) {
				
			$genre_id = $_POST['genre_id'];
			$genre_name = $_POST['genre_name'];
			
			$numrecs = $db->getQuery('select count(*) as c from genres where id != "'.$genre_id.'" && name = "'.$genre_name.'";');
			
			if($numrecs !== false) {
				
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					
					// Update record
					if(!$db->setQuery('update genres set name = "'.$genre_name.'" where id = "'.$genre_id.'";')) {
						$ret = 'CantUpdateGenre';
					}
				}
				else {
					$ret = 'GenreAlreadyExists';
				}
				
				// -->
			}
			else {
				$ret = 'CantReadGenres';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = edit_genre();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>