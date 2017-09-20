<?php

	// ---------------------
	// MyTreasure: Edit user
	// ---------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function edit_user() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('user_id', $_POST)
			&& array_key_exists('user_name', $_POST)
			&& array_key_exists('user_password', $_POST)
			&& array_key_exists('user_fullname', $_POST)
			&& array_key_exists('user_role_id', $_POST)) {

			$user_id       = $_POST['user_id'];
			$user_name     = $_POST['user_name'];
			$user_password = $_POST['user_password'];
			$user_fullname = $_POST['user_fullname'];
			$user_role_id  = $_POST['user_role_id'];
			
			$numrecs = $db->getQuery('select count(*) as c from users where id != "'.$user_id.'" && name = "'.$user_name.'";');
			
			if($numrecs !== false) {
				
				// Get #
				$numrecs = $numrecs[0]['c'];
				
				if($numrecs == 0) {
					
					// Update record
					if(!$db->setQuery('update users set '.
							'name = "'.$user_name.'", '.
							'password = "'.$user_password.'", '.
							'fullname = "'.$user_fullname.'", '.
							'role_id = "'.$user_role_id.'" '.
							'where id = "'.$user_id.'";')) {
						$ret = 'CantUpdateUser';
					}
				}
				else {
					$ret = 'UserAlreadyExists';
				}
				
				// -->
			}
			else {
				$ret = 'CantReadUsers';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		return $ret;
	}
	
	//
	$ret = edit_user();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>