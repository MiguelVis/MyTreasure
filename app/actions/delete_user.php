<?php

	// -----------------------
	// MyTreasure: Delete user
	// -----------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function delete_user() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('user_id', $_POST)) {
				
			$user_id = $_POST['user_id'];
			
			if(!$db->setQuery('delete from users where id = "'.$user_id.'";')) {
				$ret = 'CantDeleteUser';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = delete_user();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>