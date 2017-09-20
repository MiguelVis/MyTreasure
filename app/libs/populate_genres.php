<?php
  
	// ------------------------------------------
	// MyTreasure: Populate genres in html select
	// ------------------------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function populate_genres($selected_id = null) {
		global $db;

		// Read total # of records
		$numrecs = $db->getQuery('select count(*) as c from genres;');
		
		if($numrecs !== false)
		{
			// Read records
			$records = $db->getQuery('select id, name from genres order by name;');

			//
			echo('<option value="" '.($selected_id == null ? 'selected ' : '').'disabled>'.tr('SelectGenre').'</option>');
			
			if($records !== false) {
				for($i = 0; $i < count($records); ++$i) {
					echo('<option value="'.$records[$i]['id'].'"'.($records[$i]['id'] == $selected_id ? ' selected' : '').'>'.$records[$i]['name'].'</option>'."\n");
				}
			}

		}
	}
?>