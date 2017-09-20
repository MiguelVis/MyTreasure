<?php

	// ----------
	// MyTreasure
	// ----------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	// Report any error
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	// Libraries
	require_once(dirname(__FILE__) . '/conf.php');
	require_once(dirname(__FILE__) . '/lang.php');
	require_once(dirname(__FILE__) . '/db.php');
	require_once(dirname(__FILE__) . '/session.php');
		
	// Session
	session_setup();
	
	// Database
	global $db;
	
	$db = DataBase::getConnection();
	
	$db->setQuery('SET NAMES "utf8";');
	
	// Dashboard
	global $dashboard_error;
?>