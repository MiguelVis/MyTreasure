<?php

	// ------------------------
	// MyTreasure: Add language
	// ------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_language() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('language_name', $_POST)) {
				
			$language_name = $_POST['language_name'];
			
			// Check if record already exists
			$check = $db->getQuery('select count(*) as c from languages where name = "'.$language_name.'";');

			// Check result
			if($check !== false) {
				if($check[0]['c'] == 0) {
					// Add new record
					$result = $db->setQuery('insert into languages (name) values ("'.$language_name.'");');
					
					if($result == false) {
						$ret = 'CantAddLanguage';
					}
					
					// -->
				}
				else {
					$ret = 'LanguageAlreadyExists';
				}
			}
			else {
				$ret = 'CantReadLanguages';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_language();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>