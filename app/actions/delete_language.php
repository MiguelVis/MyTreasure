<?php

	// ---------------------------
	// MyTreasure: Delete language
	// ---------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_language() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('language_id', $_POST)) {
				
			$language_id = $_POST['language_id'];
			
			if(!$db->setQuery('delete from languages where id = "'.$language_id.'";')) {
				$ret = 'CantDeleteLanguage';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_language();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>