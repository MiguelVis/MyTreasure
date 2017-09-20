<?php
  
	// ----------------------
	// MyTreasure: Read books
	// ----------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function read_books($offset, $limit, $sort_by, $sort_order, $filters = null) {
		global $db;
		
		//
		$ret = '';
		
		// Read total # of records
		$numrecs = $db->getQuery('select count(*) as c from books;');
		
		if($numrecs !== false) {
			
			// Filters
			$where = array();
			
			if($filters !== null && is_array($filters)) {
				if(!empty($filters['filter_title'])) $where[] = 'b.title like "%'.$filters['filter_title'].'%"';
				if(!empty($filters['filter_author_id'])) $where[] = 'b.author_id = '.$filters['filter_author_id'];
				if(!empty($filters['filter_author2_id'])) $where[] = 'b.author2_id = '.$filters['filter_author2_id'];
				if(!empty($filters['filter_genre_id'])) $where[] = 'b.genre_id = '.$filters['filter_genre_id'];
				if(!empty($filters['filter_language_id'])) $where[] = 'b.language_id = '.$filters['filter_language_id'];
				if(!empty($filters['filter_isbn'])) $where[] = 'b.isbn like "%'.$filters['filter_isbn'].'%"';
				if(!empty($filters['filter_format_id'])) $where[] = 'b.format_id = '.$filters['filter_format_id'];
				if(!empty($filters['filter_publisher_id'])) $where[] = 'b.publisher_id = '.$filters['filter_publisher_id'];
				if(!empty($filters['filter_location_id'])) $where[] = 'b.location_id = '.$filters['filter_location_id'];
				if(!empty($filters['filter_location_ex'])) $where[] = 'b.location_ex like "%'.$filters['filter_location_ex'].'%"';
				if(!empty($filters['filter_summary'])) $where[] = 'b.summary like "%'.$filters['filter_summary'].'%"';
			}
			
			// Build query
			$sql = 'select b.*, '.
				'a.name as author, a2.name as author2, p.name as publisher, g.name as genre, f.name as format, l.name as language, o.name as location '.
				'from books as b '.
				'join authors as a on b.author_id = a.id '.
				'join authors as a2 on b.author2_id = a2.id '.
				'join publishers as p on b.publisher_id = p.id '.
				'join genres as g on b.genre_id = g.id '.
				'join formats as f on b.format_id = f.id '.
				'join languages as l on b.language_id = l.id '.
				'join locations as o on b.location_id = o.id ';

			if(count($where)) {
				$sql .= 'where ';
				
				for($i = 0; $i < count($where); ++$i) {
					$sql .= ' '.$where[$i].' ';
					
					if($i < count($where) - 1) {
						$sql .= 'and ';
					}
				}
				
				// Get # of total records
				$numrecs = $db->getQuery('select count(*) as c from ('.$sql.');');
			}
			
			// Get # of total records
			$numrecs = $numrecs[0]['c'];
				
			$sql .= 'order by '.$sort_by.' '.$sort_order;
			
			if($limit > 0) {
				$sql .= ' limit '.$limit;
			}
			
			if($offset > 0) {
				$sql .= ' offset '.$offset;
			}
			
			$sql .= ';';
//echo('['.$sql.']');	
			// Read records and foreign keys values
			$records = $db->getQuery($sql);
			
			// Check result
			if($records === false) {
				$ret = 'CantReadBooks';
			}
			
			// -->
		}
		else {
			$ret = 'CantReadBooks';
		}

		// -->
		
		$ret = array(
			'total_recs' => ($ret == '' ? $numrecs : 0),
			'paged_recs' => ($ret == '' ? count($records) : 0),
			'recs' => ($ret == '' ? $records : array()),
			'error' => $ret
		);
//echo('['.$ret['error'].']');		
		return $ret;
	}
?>