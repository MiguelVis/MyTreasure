<?php

	// --------------------
	// MyTreasure: Add book
	// --------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_book() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('book_title', $_POST)
			&& array_key_exists('book_author_id', $_POST)
			&& array_key_exists('book_author2_id', $_POST)
			&& array_key_exists('book_publisher_id', $_POST)
			&& array_key_exists('book_genre_id', $_POST)
			&& array_key_exists('book_format_id', $_POST)
			&& array_key_exists('book_language_id', $_POST)
			&& array_key_exists('book_location_id', $_POST)
			&& array_key_exists('book_location_ex', $_POST)
			&& array_key_exists('book_isbn', $_POST)
			&& array_key_exists('book_summary', $_POST)
		) {
				
			$book_title = $_POST['book_title'];
			$book_author_id = $_POST['book_author_id'];
			$book_author2_id = $_POST['book_author2_id'];
			$book_publisher_id = $_POST['book_publisher_id'];
			$book_genre_id = $_POST['book_genre_id'];
			$book_format_id = $_POST['book_format_id'];
			$book_language_id = $_POST['book_language_id'];
			$book_location_id = $_POST['book_location_id'];
			$book_location_ex = $_POST['book_location_ex'];
			$book_isbn = $_POST['book_isbn'];
			$book_summary = $_POST['book_summary'];
			
			// Add new record
			$result = $db->setQuery('insert into books '.
				'(title, author_id, author2_id, publisher_id, genre_id, format_id, language_id, location_id, location_ex, isbn, summary) '.
				'values '.
				'("'.$book_title.'", "'.$book_author_id.'", "'.$book_author2_id.'", "'.$book_publisher_id.
				'", "'.$book_genre_id.'", "'.$book_format_id.'", "'.$book_language_id.'", "'.$book_location_id.
				'", "'.$book_location_ex.'", "'.$book_isbn.'", "'.$book_summary.'");');
					
			if($result == false) {
				$ret = 'CantAddBook';
			}
			
			// -->
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_book();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>