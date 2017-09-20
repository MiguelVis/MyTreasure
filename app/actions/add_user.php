<?php

	// --------------------
	// MyTreasure: Add user
	// --------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function add_user() {
		global $db;
		
		//
		$ret  = '';
		
		if(array_key_exists('user_name', $_POST)
			&& array_key_exists('user_password', $_POST)
			&& array_key_exists('user_fullname', $_POST)
			&& array_key_exists('user_role_id', $_POST)) {
				
			$user_name     = $_POST['user_name'];
			$user_password = $_POST['user_password'];
			$user_fullname = $_POST['user_fullname'];
			$user_role_id  = $_POST['user_role_id'];
			
			// Check if record already exists
			$check = $db->getQuery('select count(*) as c from users where name = "'.$user_name.'";');

			// Check result
			if($check !== false) {
				if($check[0]['c'] == 0) {
					// Add new record
					$result = $db->setQuery('insert into users (name, password, fullname, role_id) '.
									'values ("'.$user_name.'", "'.$user_password.'", "'.$user_fullname.'", "'.$user_role_id.'");');
					
					if($result == false) {
						$ret = 'CantAddUser';
					}
					
					// -->
				}
				else {
					$ret = 'UserAlreadyExists';
				}
			}
			else {
				$ret = 'CantReadUsers';
			}
		}
		else {
			$ret = 'MissingParameters';
		}
		
		// -->
		
		return $ret;
	}
	
	//
	$ret = add_user();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>