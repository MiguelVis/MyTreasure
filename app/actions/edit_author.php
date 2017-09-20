<?php

	// -----------------------
	// MyTreasure: Edit author
	// -----------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_author() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('author_id', $_POST)
			&& array_key_exists('author_name', $_POST)) {
				
			$author_id = $_POST['author_id'];
			$author_name = $_POST['author_name'];
			
			$numrecs = $db->getQuery('select count(*) as c from authors where id != "'.$author_id.'" && name = "'.$author_name.'";');
			
			if($numrecs !== false) {
				
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					
					// Update record
					if(!$db->setQuery('update authors set name = "'.$author_name.'" where id = "'.$author_id.'";')) {
						$ret = 'CantUpdateAuthor';
					}
				}
				else {
					$ret = 'AuthorAlreadyExists';
				}
				
				// -->
			}
			else {
				$ret = 'CantReadAuthors';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = edit_author();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>