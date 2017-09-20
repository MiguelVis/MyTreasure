<?php

	// ----------
	// MyTreasure
	// ----------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	// Build an array with book filters based on $_POST parameters
	function get_book_filters() {

		$filters = array(
			'filter_title' => isset($_POST['filter_title']) ? $_POST['filter_title'] : '',
			'filter_author_id' => isset($_POST['filter_author_id']) ? $_POST['filter_author_id'] : '',
			'filter_author2_id' => isset($_POST['filter_author2_id']) ? $_POST['filter_author2_id'] : '',
			'filter_genre_id' => isset($_POST['filter_genre_id']) ? $_POST['filter_genre_id'] : '',
			'filter_language_id' => isset($_POST['filter_language_id']) ? $_POST['filter_language_id'] : '',
			'filter_isbn' => isset($_POST['filter_isbn']) ? $_POST['filter_isbn'] : '',
			'filter_format_id' => isset($_POST['filter_format_id']) ? $_POST['filter_format_id'] : '',
			'filter_publisher_id' => isset($_POST['filter_publisher_id']) ? $_POST['filter_publisher_id'] : '',
			'filter_location_id' => isset($_POST['filter_location_id']) ? $_POST['filter_location_id'] : '',
			'filter_location_ex' => isset($_POST['filter_location_ex']) ? $_POST['filter_location_ex'] : '',
			'filter_summary' => isset($_POST['filter_summary']) ? $_POST['filter_summary'] : ''
		);
		
		return $filters;
	}
?>