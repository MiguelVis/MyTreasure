<?php

	// -----------------------------------
	// MyTreasure: Application entry point
	// -----------------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require_once(dirname(__FILE__) . '/libs/includes.php');
	
	if(array_key_exists('user_name', $_POST) && array_key_exists('user_password', $_POST) && session_getSessionId() == null) {
		$user_name     = trim($_POST['user_name']);
		$user_password = trim($_POST['user_password']);

		if($user_name !== '') {
			session_login($user_name, $user_password);	
		}
	}

	if(session_getSessionId() !== null) {
		if(isset($_REQUEST['action'])) {
			
			// Execute action
			switch($_REQUEST['action']) {
				
				// Session actions
				case 'logout' :
					session_logout();
					header('Location: index.php');
					break;
				
				// Dashboard actions
				case 'edit_conf' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'database';
					break;
				
				//
				case 'add_user' :
				case 'edit_user' :
				case 'delete_user' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'users';
					break;
					
				//
				case 'add_book' :
				case 'edit_book' :
				case 'delete_book' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'books';
					break;
					
				case 'print_books' :
					//$dashboard_action  = $_REQUEST['action'];
					require_once(dirname(__FILE__) . '/views/print_books.php');
					break;
				
				case 'export_books' :
					//$dashboard_action  = $_REQUEST['action'];
					require_once(dirname(__FILE__) . '/views/export_books.php');
					break;

				//
				case 'add_author' :
				case 'edit_author' :
				case 'delete_author' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'authors';
					break;
					
				//
				case 'add_publisher' :
				case 'edit_publisher' :
				case 'delete_publisher' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'publishers';
					break;
					
				//
				case 'add_genre' :
				case 'edit_genre' :
				case 'delete_genre' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'genres';
					break;
					
				//
				case 'add_format' :
				case 'edit_format' :
				case 'delete_format' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'formats';
					break;
					
				//
				case 'add_language' :
				case 'edit_language' :
				case 'delete_language' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'languages';
					break;
					
				//
				case 'add_location' :
				case 'edit_location' :
				case 'delete_location' :
					$dashboard_action  = $_REQUEST['action'];
					$dashboard_section = 'locations';
					break;
				
				// Dashboard sections
				case 'database' :
				case 'users' :
				case 'books' :
				case 'authors' :
				case 'publishers' :
				case 'genres' :
				case 'formats' :
				case 'languages' :
				case 'locations' :
					$dashboard_section = $_REQUEST['action']; break;
				
				// Unknown
				default : break; // FIXME
			}
			
			// Perform a dashboard action?
			if(isset($dashboard_action)) {
				require_once(dirname(__FILE__) . '/actions/'.$dashboard_action.'.php');
			}
			
			// Go to a dashboard section?
			if(isset($dashboard_section)) {
				require_once(dirname(__FILE__) . '/views/dashboard.php');
			}
		}
		else {
			header('Location: index.php?action=database');
		}
	}
	else {
		require_once(dirname(__FILE__) . '/views/login.php');
	}
?>