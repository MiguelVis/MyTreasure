<?php

	// -------------------------
	// MyTreasure: Edit language
	// -------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_language() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('language_id', $_POST)
			&& array_key_exists('language_name', $_POST)) {
				
			$language_id = $_POST['language_id'];
			$language_name = $_POST['language_name'];
			
			$numrecs = $db->getQuery('select count(*) as c from languages where id != "'.$language_id.'" && name = "'.$language_name.'";');
			
			if($numrecs !== false) {
				
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					
					// Update record
					if(!$db->setQuery('update languages set name = "'.$language_name.'" where id = "'.$language_id.'";')) {
						$ret = 'CantUpdateLanguage';
					}
				}
				else {
					$ret = 'LanguageAlreadyExists';
				}
				
				// -->
			}
			else {
				$ret = 'CantReadLanguages';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = edit_language();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>