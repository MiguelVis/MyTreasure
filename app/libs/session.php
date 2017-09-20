<?php
	// -------------------
	// MyTreasure: Session
	// -------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.

	function session_setup() {
			
		session_start();
	}
	
	
	/**
	 * User login.
	 *
	 * @param  user_name      user name
	 * @param  user_password  user password
	 * @return true on success, or false on failure
	 */
	function session_login($user_name, $user_password) {
		global $db;
		
		if($user_name !== null && $user_password !== null) {
			$user_name     = trim($user_name);
			$user_password = trim($user_password);
	
			if($user_name !== '') {
				$nrecs = $db->getQuery('select count(*) as c from users where name = "'.$user_name.'";');
		
				if($nrecs !== false)
				{
					$recs = $db->getQuery('select u.*, r.name as role from users as u join roles as r on u.role_id = r.id where u.name = "'.$user_name.'" limit 1;');
					
					if($recs !== false) {
						
						$nrecs = $nrecs[0]['c'];
						
						if($nrecs > 0) {
							$usr_id = $recs[0]['id'];
							$usr_name = $recs[0]['name'];
							$usr_password = $recs[0]['password'];
							$usr_fullname = $recs[0]['fullname'];
							$usr_role = $recs[0]['role'];

							if($usr_password == $user_password) {
								if($_SESSION['logged_user_name'] !== null) {
									session_logout();								
								}
								
								session_regenerate_id(true);
								
								$_SESSION['logged_user_name']     = $usr_name;
								$_SESSION['logged_user_fullname'] = $usr_fullname;
								$_SESSION['logged_user_role']     = $usr_role;
								$_SESSION['session_id']           = session_id();
							
								// Success
								return true;
							}
						}
					}
				}
			}
		}
		
		// Failure
		return false;
	}
		
	/**
	 * User logout.
	 */
	function session_logout() {
		$_SESSION = array();
		session_destroy();
		
		$_SESSION['logged_user_name']     = null;
		$_SESSION['logged_user_fullname'] = null;
		$_SESSION['logged_user_role']     = null;
		$_SESSION['session_id']           = null;
	}
		
	/**
	 * User re-login.
	 *
	 * @return true on success, or false on failure
	 */	
/*	 
	function session_reLogin() {
		if($_SESSION['session_id'] == session_id()) {
			
			return true;
		}
		
		return false;
	}
*/
	/**
	 * Get name of logged user.
	 *
	 * @return user name
	 */
	function session_getUserName() {
		return isset($_SESSION['logged_user_name']) ? $_SESSION['logged_user_name'] : '';
	}
	
	function session_getUserFullName() {
		return isset($_SESSION['logged_user_fullname']) ? $_SESSION['logged_user_fullname'] : '';
	}
	
	function session_getUserRole() {
		return isset($_SESSION['logged_user_role']) ? $_SESSION['logged_user_role'] : '';
	}
		
	/**
	 * Get session id.
	 *
	 * @return session id
	 */
	function session_getSessionId() {
			return isset($_SESSION['session_id']) ? $_SESSION['session_id'] : null;
	}


?>