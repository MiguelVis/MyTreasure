<?php
  
	// ---------------------------------
	// MyTreasure: Export book(s) to CSV
	// ---------------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	// Report any error
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	// Dependencies
	require_once(dirname(__FILE__) . '/../libs/get_book_filters.php');
	require_once(dirname(__FILE__) . '/../libs/read_books.php');
		
	function export_csv_books() {
		global $dashboard_error;
		
		//
		$ret = '';
	
		if(array_key_exists('export_csv_delimiter', $_POST)
			&& array_key_exists('export_csv_enclosure', $_POST)
			&& array_key_exists('export_csv_sort_by', $_POST)
			&& array_key_exists('export_csv_sort_order', $_POST)) {
				
			//
			$delimiter    = $_POST['export_csv_delimiter'];
			$enclosure    = $_POST['export_csv_enclosure'];
			$sort_by      = $_POST['export_csv_sort_by'];
			$sort_order   = $_POST['export_csv_sort_order'];
			
			// Filter books
			$filters = get_book_filters();
			
			// Set delimiter
			switch($delimiter) {
				case 'semicolon' : $delimiter = ';';  break;
				case 'tab'       : $delimiter = "\t"; break;
				case 'comma'     :
				default          : $delimiter = ',';  break;
			}
			
			// Set enclosure
			switch($enclosure) {
				case 'singlequote' : $enclosure = "'"; break;
				case 'doublequote' :
				default            : $enclosure = '"';  break;
			}
		
			// Start output
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=books.csv');
			
			$output = fopen('php://output', 'w');
			
			// Column titles
			fputcsv($output, array('Id',
			                       'Title',
								   'Author',
								   'Author #2',
								   'Genre',
								   'Format',
								   'Language',
								   'ISBN',
								   'Publisher',
								   'Location',
								   'Borrower',
								   'Summary'),
								   $delimiter,
								   $enclosure
								   );

			//
			$offset = 0;
			$limit  = 50;
			
			//
			$trecs = 0;
			$more = true;
			
			while($more) {
				// Read books
				$result = read_books($offset, $limit, $sort_by, $sort_order, $filters);
				
				// Check result
				if($result['error'] != '') {
					$ret = $result['error'];
					break;
				}
				
				// Get records
				$recs = $result['recs'];
			
				// Update offset and next iteration
				if(count($recs) < $limit) {
					$more = false;
				}
				else {
					$offset += $limit;
				}
				
				// Export records
				for($i = 0; $i < count($recs); ++$i) {
					fputcsv($output, array($recs[$i]['id'],
										   $recs[$i]['title'],
										   $recs[$i]['author'],
										   $recs[$i]['author2'],
										   $recs[$i]['genre'],
										   $recs[$i]['format'],
										   $recs[$i]['language'],
										   $recs[$i]['isbn'],
										   $recs[$i]['publisher'],
										   $recs[$i]['location'],
										   $recs[$i]['location_ex'],
										   $recs[$i]['summary']),
										   $delimiter,
						                   $enclosure
										   );			
					
					// Increment # of record
					++$trecs;
				}
			}
			
			// End output
		}
		else {
			$ret = 'MissingParameters';
		}
			
		return $ret;
	}
	
	
	//
	$ret = export_csv_books();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>