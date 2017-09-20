<?php

	// ---------------------
	// MyTreasure: Add genre
	// ---------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_genre() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('genre_name', $_POST)) {
				
			$genre_name = $_POST['genre_name'];
			
			// Check if record already exists
			$check = $db->getQuery('select count(*) as c from genres where name = "'.$genre_name.'";');

			// Check result
			if($check !== false) {
				if($check[0]['c'] == 0) {
					// Add new record
					$result = $db->setQuery('insert into genres (name) values ("'.$genre_name.'");');
					
					if($result == false) {
						$ret = 'CantAddGenre';
					}
					
					// -->
				}
				else {
					$ret = 'GenreAlreadyExists';
				}
			}
			else {
				$ret = 'CantReadGenres';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_genre();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>