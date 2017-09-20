<?php

	// ----------------------
	// MyTreasure: Add author
	// ----------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_author() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('author_name', $_POST)) {
				
			$author_name = $_POST['author_name'];
			
			// Check if name already exists
			$check = $db->getQuery('select count(*) as c from authors where name = "'.$author_name.'";');

			// Check result
			if($check !== false) {
				if($check[0]['c'] == 0) {
					// Add new author
					$result = $db->setQuery('insert into authors (name) values ("'.$author_name.'");');
					
					if($result == false) {
						$ret = 'CantAddAuthor';
					}
					
					// -->
				}
				else {
					$ret = 'AuthorAlreadyExists';
				}
			}
			else {
				$ret = 'CantReadAuthors';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_author();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>